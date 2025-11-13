<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Voucher;
use App\Models\Reseller;
use App\Models\Router;
use App\Models\VoucherProfile;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Transaction;
use App\Services\RouterApi\MockMikroTikService;
use App\Services\RouterApi\LiveMikroTikService;

class GetVoucherController extends Controller
{


    // public function index()
    // {
    //     return view('getVocher.index');
    // }
    // public function receipt()
    // {
    //     return view('getVoucher.receipt');
    // }

    // public function paycheckout()
    // {
    //     return view('getVoucher.paycheckout');
    // // }
            protected $routerService;

    public function __construct()
    {
        // Currently using mock; switch to Live when router ready
        $this->routerService = new MockMikroTikService();
    }

    /**
     * Show purchase form.
     */
    public function index()
    {
        $resellers = Reseller::where('status', 'active')->get();
        // $profiles = $this->routerService->getProfiles(); // e.g. 1d, 3d, 1w
        $profiles = VoucherProfile::all(); // Use real DB model


        return view('getVoucher.index', compact('resellers', 'profiles'));
    }

    /**
     * Handle a single voucher purchase.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reseller_id' => 'required|exists:resellers,id',
            'profile_id'  => 'required|exists:voucher_profiles,id',
        ]);

        $reseller = Reseller::with(['user', 'router'])->findOrFail($request->reseller_id);
        $profile  = VoucherProfile::findOrFail($request->profile_id);
        $amount   = $profile->price; // no quantity

        if (!$reseller->router) {
            return back()->with('error', 'Router not found for this reseller.');
        }

        $connection = [
            'host'     => $reseller->router->host,
            'port'     => $reseller->router->port ?? 8728,
            'username' => $reseller->router->username,
            'password' => encrypt($reseller->router->password),
        ];

        try {
            DB::transaction(function () use ($reseller, $profile, $amount, $connection) {
                // Connect to router
                if (!$this->routerService->connect($connection)) {
                    throw new \Exception('Router connection failed.');
                }

                // Create voucher on router (mock/live)
                $voucherData = $this->routerService->createVoucher([
                    'username' => 'V' . strtoupper(Str::random(6)),
                    'password' => Str::random(8),
                    'profile'  => $profile->mikrotik_profile,
                ]);

                // Store voucher
                $voucher = Voucher::create([
                    'reseller_id' => $reseller->id,
                    'profile_id'  => $profile->id,
                    'code'        => $voucherData['username'],
                    'password'    => $voucherData['password'],
                    'status'      => 'active',
                    // 'sold_by_user_id' => auth()->id() ?? null,
                ]);

                // Handle wallet credit
                $wallet = Wallet::firstOrCreate(
                    ['user_id' => $reseller->user->id],
                    [
                        'account_number' => User::generateAccountNumber(),
                        'balance' => 0,
                    ]
                );

                $wallet->balance += $amount;
                $wallet->save();

                // Record transaction
                Transaction::create([
                    'user_id' => $reseller->user->id,
                    'type' => 'credit',
                    'amount' => $amount,
                    'status' => 'success',
                    'reference' => 'VOUCHER-' . strtoupper(Str::random(10)),
                    'description' => 'Voucher sale: ' . $profile->name,
                ]);
            });
        } catch (\Throwable $e) {
            return back()->with('error', 'Purchase failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Voucher purchased and reseller credited successfully!');
    }
}
