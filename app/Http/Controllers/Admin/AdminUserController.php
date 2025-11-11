<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{

    // View all users

     public function view(Request $request)
    {
        $query = User::query();

        // Search by email or phone
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('email', 'LIKE', "%$search%")
                  ->orWhere('phone_number', 'LIKE', "%$search%");
        }

        $users = $query->latest()->paginate(10);
        return view('admin.user.viewUser', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'required|string|max:20|unique:users,phone_number,' . $user->id,
    ]);

    $user->update([
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
    ]);

    return redirect()->route('viewUser')->with('success', 'User updated successfully!');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

      public function displaychangepassword()
    {
        return view('admin.user.changepassword');
    }

    // Update user password manually
    public function updatechangePassword(Request $request)
    {
        $request->validate([
            'identifier' => 'required', // can be email or phone
            'new_password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('phone_number', $request->identifier)
                    ->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }


        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', $user->full_name.' Password updated successfully to ' . $request->new_password);
    }



     public function walletView(Request $request)
        {
            $wallet = null;
            $transactions = collect();

            if ($q = $request->query('query')) {
                $wallet = Wallet::where('account_number', $q)
                    ->orWhereHas('user', function ($query) use ($q) {
                        $query->where('email', $q)->orWhere('phone_number', $q);
                    })->first();
                if ($wallet) {
                    $transactions = Transaction::where('user_id', $wallet->user_id)
                        ->latest()->take(10)->get();
                }
            }

            return view('admin.user.walletManage', compact('wallet', 'transactions'));
        }


    public function updateWallet(Request $request, Wallet $wallet)
    {
        // $wallet = Wallet::findOrFail($wallet);
        $request->validate([
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        $desc = $request->description ?? 'Manual adjustment';

        if ($request->type === 'credit') {
            $wallet->credit($request->amount, $desc);
        } else {
            $wallet->debit($request->amount, $desc);
        }

        return back()->with('success', 'Wallet updated successfully.');
    }

}
