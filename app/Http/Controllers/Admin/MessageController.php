<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.messages.index', [
            'messages' => Message::query()->latest()->paginate(20),
        ]);
    }

    public function read(Message $message)
    {
        $message->update(['is_read' => true]);

        return back()->with('status', 'Message marked as read.');
    }
}
