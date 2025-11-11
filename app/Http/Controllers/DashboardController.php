<?php

namespace App\Http\Controllers;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $wallet = Wallet::where('user_id', auth()->id())->first();
        return view('dashboard', compact('wallet'));
    }

        public function acc()
    {
         $wallet = Wallet::where('user_id', auth()->id())->first();
        return view('wallet.accno', compact('wallet'));
    }
}
