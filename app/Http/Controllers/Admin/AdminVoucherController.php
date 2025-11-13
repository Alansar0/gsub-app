<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VoucherProfile;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{

    public function index()
    {
        $profiles = VoucherProfile::orderByDesc('id')->get();
        return view('admin.VoucherSettings.addVoucherPlan', compact('profiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mikrotik_profile' => 'required|string|max:255',
            'time_minutes' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        VoucherProfile::create($request->only('name','mikrotik_profile','time_minutes','price') + ['status'=>'active']);
        return back()->with('success', 'Voucher profile created successfully!');
    }

    public function update(Request $request, $id)
    {
        $profile = VoucherProfile::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'mikrotik_profile' => 'required|string|max:255',
            'time_minutes' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $profile->update($request->all());
        return back()->with('success', 'Voucher profile updated successfully!');
    }

    public function destroy($id)
    {
        VoucherProfile::findOrFail($id)->delete();
        return back()->with('success', 'Voucher profile deleted.');
    }
}

