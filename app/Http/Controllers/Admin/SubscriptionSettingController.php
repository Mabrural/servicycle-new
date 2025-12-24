<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionSetting;
use Illuminate\Http\Request;

class SubscriptionSettingController extends Controller
{
    public function index()
    {
        $setting = SubscriptionSetting::firstOrCreate([]);
        return view('admin.subscriptions.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = SubscriptionSetting::first();

        $setting->update([
            'is_enabled' => $request->boolean('is_enabled'),
            'customer_price' => $request->customer_price,
            'mitra_price' => $request->mitra_price,
        ]);

        return back()->with('success', 'Pengaturan berhasil disimpan');
    }
}
