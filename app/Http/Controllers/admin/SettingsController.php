<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected array $fields = [
        'delivery_charge' => ['label' => 'Delivery Charge', 'type' => 'number', 'placeholder' => 'e.g. 60', 'icon' => 'bi-truck'],
        'bkash_number' => ['label' => 'bKash Number', 'type' => 'text', 'placeholder' => 'e.g. 01700-000000', 'icon' => 'bi-phone'],
        'nogod_number' => ['label' => 'Nagad Number', 'type' => 'text', 'placeholder' => 'e.g. 01700-000000', 'icon' => 'bi-phone'],
        'facebook_page' => ['label' => 'Facebook Page', 'type' => 'url', 'placeholder' => 'https://facebook.com/yourpage', 'icon' => 'bi-facebook'],
        'instagram_page' => ['label' => 'Instagram Page', 'type' => 'url', 'placeholder' => 'https://instagram.com/yourpage', 'icon' => 'bi-instagram'],
        'whatsapp_number' => ['label' => 'WhatsApp Number', 'type' => 'text', 'placeholder' => 'e.g. 8801700000000', 'icon' => 'bi-whatsapp'],
        'gmail' => ['label' => 'Gmail', 'type' => 'email', 'placeholder' => 'yourmail@gmail.com', 'icon' => 'bi-envelope'],
    ];

    public function index()
    {
        $fields = $this->fields;
        $values = Setting::pluck('value', 'key')->toArray();

        return view('backend.settings.index', compact('fields', 'values'));
    }

    public function update(Request $request)
    {
        $rules = [];
        foreach (array_keys($this->fields) as $key) {
            $rules[$key] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);

        foreach ($this->fields as $key => $field) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $validated[$key] ?? '']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}