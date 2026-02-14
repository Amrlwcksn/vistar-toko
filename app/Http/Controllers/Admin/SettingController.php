<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreSetting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = StoreSetting::firstOrNew();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_number' => 'required',
            'store_phone' => 'nullable',
            'opening_hours' => 'required',
            'address' => 'required',
            'maps_embed' => 'nullable',
            'tagline' => 'nullable',
            'social_links' => 'nullable|array'
        ]);

        $setting = StoreSetting::first();
        if ($setting) {
            $setting->update($validated);
        } else {
            StoreSetting::create($validated);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan toko berhasil diperbarui');
    }
}
