<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:160'],
            'subject' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $phone = preg_replace('/[\s-]/', '', $data['phone']) ?? '';
        if (! preg_match('/^(?:\+?88)?01[3-9]\d{8}$/', $phone)) {
            return response()->json(['message' => 'Enter a valid Bangladeshi mobile number.', 'errors' => ['phone' => ['Enter a valid Bangladeshi mobile number.']]], 422);
        }

        Message::query()->create([
            'name' => $data['name'],
            'phone' => $phone,
            'email' => $data['email'] ?? null,
            'subject' => $data['subject'] ?? 'Product enquiry',
            'message' => $data['message'],
        ]);

        return response()->json(['ok' => true]);
    }
}
