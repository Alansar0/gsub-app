<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Step 1: Initiate payment
    public function initialize(Request $request)
    {
        $amount = $request->amount;
        $reference = uniqid('pay_');

        // Create a transaction record
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $amount,
            'reference' => $reference,
            'status' => 'pending',
            'gateway' => 'paymentpoint',
        ]);

        // Redirect to PaymentPoint (replace this with real API URL)
        return redirect()->away("https://paymentpoint.co/pay?amount=$amount&ref=$reference");
    }

    // Step 2: Handle Webhook callback
                public function webhook(Request $request)
            {
                // Log incoming webhook
                \Log::info('PaymentPoint webhook received:', $request->all());

                $reference = $request->reference ?? null;
                $status = $request->status ?? null;
                $accountNumber = $request->account_number ?? null;
                $amount = $request->amount ?? 0;

                // Find transaction if reference exists
                $transaction = Transaction::where('reference', $reference)->first();

                if ($transaction && $status === 'success') {
                    $transaction->update(['status' => 'success']);

                    $wallet = Wallet::firstOrCreate(['user_id' => $transaction->user_id]);
                    $wallet->increment('balance', $transaction->amount);
                }

                // Or if PaymentPoint sends only account number (without reference)
                elseif ($accountNumber && $status === 'success') {
                    $user = \App\Models\User::where('virtual_account', $accountNumber)->first();

                    if ($user) {
                        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
                        $wallet->increment('balance', $amount);

                        Transaction::create([
                            'user_id' => $user->id,
                            'amount' => $amount,
                            'status' => 'success',
                            'reference' => 'fund_' . uniqid(),
                            'gateway' => 'paymentpoint',
                        ]);
                    }
                }

                return response()->json(['message' => 'Webhook processed successfully']);
            }

                    public function simulateWebhook()
        {
            // Fake test data that mimics a real payment
            $fakeData = [
                'reference' => 'TEST_REF_' . rand(1000, 9999),
                'status' => 'success',
                'account_number' => auth()->user()->virtual_account ?? '1234567890',
                'amount' => 5000,
            ];

            // Log the fake data for confirmation
            \Log::info('Simulated webhook triggered:', $fakeData);

            // Call the actual webhook logic directly (no HTTP call)
            $request = new \Illuminate\Http\Request($fakeData);
            return $this->webhook($request);
        }


}
