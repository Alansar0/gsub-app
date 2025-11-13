<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reseller;
use App\Models\Router;

class ResellerController extends Controller
{
    /**
     * Show self-upgrade form
     */
    public function showUpgradeForm()
    {
        return view('reseller.upgrade');
    }

    /**
     * Self-upgrade endpoint (auto approve)
     */
    public function selfUpgrade(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:resellers,name',
            'host' => 'required|string|max:255',
            'port' => 'required|numeric',
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Create Reseller entry
        $reseller = Reseller::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'status' => 'active', // Auto active
        ]);

        // Save Router details
        Router::create([
            'reseller_id' => $reseller->id,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => encrypt($request->password),
        ]);

        // Optionally mark user as reseller
        $user->update(['role' => 'reseller']);

        return redirect()->route('dashboard')->with('success', 'You are now upgraded to a Hotspot Reseller!');
    }

    
}
