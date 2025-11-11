<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Webhook endpoint for PaymentPoint.
     * Behavior toggled by env PAYMENTPOINT_MODE (fake|live).
     */
    public function webhook(Request $request)
        // public function handleWebhook(Request $request)
    {
        $mode = env('PAYMENTPOINT_MODE', 'fake');

        if ($mode === 'fake') {
            // -----------------------------
            // FAKE / SIMULATION FLOW (DEV)
            // -----------------------------
            Log::info('[FAKE WEBHOOK] payload:', $request->all());

            $data = $request->all();

            // You might accept either amount_paid or amount depending on your simulate-route
            $amount = $data['amount_paid'] ?? $data['amount'] ?? 0;
            $transactionId = $data['transaction_id'] ?? 'SIM-' . now()->timestamp;
            $status = $data['transaction_status'] ?? $data['status'] ?? 'success';

            if ($status !== 'success') {
                return response()->json(['status' => 'ignored'], 200);
            }

            // Try to find user by email or phone (your simulation sends customer details)
            $user = null;
            if (!empty($data['customer']['email'])) {
                $user = User::where('email', $data['customer']['email'])->first();
            }
            if (!$user && !empty($data['customer']['phone'])) {
                $user = User::where('phone', $data['customer']['phone'])->first();
            }

            // If user not found — optionally map by receiver.account_number to wallets
            if (!$user && !empty($data['receiver']['account_number'])) {
                $wallet = Wallet::where('account_number', $data['receiver']['account_number'])->first();
                $user = $wallet?->user;
            }

            if ($user && $user->wallet) {
                $user->wallet->credit($amount, 'Simulated Payment (fake webhook)');
            }

            Transaction::create([
                'user_id' => $user->id ?? null,
                'type' => 'credit',
                'amount' => $amount,
                'status' => 'success',
                'reference' => $transactionId,
                'description' => $data['description'] ?? 'Simulated payment',
                'gateway' => 'paymentpoint_fake',
            ]);

            return response()->json(['status' => 'ok', 'mode' => 'fake']);
        }

        // -----------------------------
        // REAL / PRODUCTION FLOW (LIVE)
        // -----------------------------
        // Uncomment and use this section when PaymentPoint gives you the secret & signs webhooks
        /*
        // 1. Verify signature
        $payload = $request->getContent();
        $signature = $request->header('Paymentpoint-Signature') ?? $request->header('X-Paymentpoint-Signature');

        if (empty($signature) || empty(env('PAYMENTPOINT_SECRET_KEY'))) {
            Log::warning('[PAYMENTPOINT] Missing signature or secret.');
            return response('Invalid signature', 400);
        }

        $calculated = hash_hmac('sha256', $payload, env('PAYMENTPOINT_SECRET_KEY'));

        if (!hash_equals($calculated, $signature)) {
            Log::warning('[PAYMENTPOINT] Signature mismatch', ['calc' => $calculated, 'sig' => $signature]);
            return response('Invalid signature', 400);
        }

        // 2. Decode payload and handle only success events
        $data = json_decode($payload, true);

        if (($data['transaction_status'] ?? '') !== 'success') {
            return response()->json(['status' => 'ignored'], 200);
        }

        // 3. Find the wallet by the receiver account number (this is the canonical mapping)
        $receiverAccount = $data['receiver']['account_number'] ?? null;
        $wallet = Wallet::where('account_number', $receiverAccount)->first();

        if (!$wallet) {
            Log::error('[PAYMENTPOINT] Wallet not found for account', ['account' => $receiverAccount]);
            return response('Wallet not found', 404);
        }

        // 4. Credit wallet safely
        $amount = $data['amount_paid'] ?? $data['amount'] ?? 0;
        $txId = $data['transaction_id'] ?? null;

        $wallet->credit($amount, 'PaymentPoint deposit');
        Transaction::create([
            'user_id' => $wallet->user_id,
            'type' => 'credit',
            'amount' => $amount,
            'status' => 'success',
            'reference' => $txId,
            'description' => $data['description'] ?? 'PaymentPoint deposit',
            'gateway' => 'paymentpoint',
        ]);

        return response()->json(['status' => 'ok']);
        */
    }

    /**
     * Optional: initialize payment (call PaymentPoint API to give user instructions)
     * For fake mode, you can simulate a redirect URL or reference.
     */
    public function initialize(Request $request)
    {
        if (env('PAYMENTPOINT_MODE', 'fake') === 'fake') {
            // Return fake redirect/instructions for dev
            return response()->json([
                'status' => 'ok',
                'payment_url' => url('/simulate-payment-page'),
                'reference' => 'SIM-' . now()->timestamp,
            ]);
        }

        // Real initialization code using PAYMENTPOINT_API_KEY / BEARER token goes here...
    }
}
