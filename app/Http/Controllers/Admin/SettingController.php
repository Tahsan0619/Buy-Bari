<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\NittozClient;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(NittozClient $client)
    {
        $keys = ['name', 'tagline', 'phone', 'phone_link', 'whatsapp', 'email', 'address', 'facebook', 'hours', 'delivery_inside', 'delivery_outside', 'logo'];
        $values = [];
        foreach ($keys as $key) {
            $values[$key] = Setting::get($key, '');
        }

        return view('admin.settings', [
            'values' => $values,
            'nittozReady' => $client->configured(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'tagline' => ['required', 'string', 'max:300'],
            'phone' => ['required', 'string', 'max:40'],
            'phone_link' => ['required', 'string', 'max:40'],
            'whatsapp' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:160'],
            'address' => ['required', 'string', 'max:160'],
            'facebook' => ['required', 'url', 'max:300'],
            'hours' => ['required', 'string', 'max:120'],
            'delivery_inside' => ['required', 'integer', 'min:0'],
            'delivery_outside' => ['required', 'integer', 'min:0'],
            'logo' => ['required', 'string', 'max:300'],
        ]);
        Setting::putMany($data);

        return back()->with('status', 'Shop settings saved.');
    }
}
