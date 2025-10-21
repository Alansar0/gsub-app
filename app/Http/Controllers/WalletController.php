<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wallet;
use App\Models\User;

class WalletController extends Controller
{

     public function acc()
    {
        // Fetch or create the wallet for the logged-in user
        $wallet = Wallet::firstOrCreate(['user_id' => Auth::id()],
        ['account_number' => '9911' . rand(100000, 999999), 'balance' => 0]
    );

        // Show wallet view
        return view('wallet.acc', compact('wallet'));
    }

    // public function acc()
    // {
    //     return view('wallet.accno');
    // }
}
