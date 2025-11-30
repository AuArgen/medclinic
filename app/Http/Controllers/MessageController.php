<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', Auth::id())
                            ->orWhere('sender_id', Auth::id())
                            ->with('sender', 'receiver')
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->groupBy(function($message) {
                                return $message->sender_id === Auth::id() ? $message->receiver_id : $message->sender_id;
                            });

        $conversations = collect();
        foreach ($messages as $userId => $userMessages) {
            $lastMessage = $userMessages->first();
            $otherUser = ($lastMessage->sender_id === Auth::id()) ? $lastMessage->receiver : $lastMessage->sender;
            $conversations->push([
                'user' => $otherUser,
                'last_message' => $lastMessage,
                'unread_count' => $userMessages->where('receiver_id', Auth::id())->whereNull('read_at')->count(),
            ]);
        }

        return view('messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        // Mark messages as read
        Message::where('sender_id', $user->id)
               ->where('receiver_id', Auth::id())
               ->whereNull('read_at')
               ->update(['read_at' => now()]);

        $messages = Message::where(function ($query) use ($user) {
                                $query->where('sender_id', Auth::id())
                                      ->where('receiver_id', $user->id);
                            })
                            ->orWhere(function ($query) use ($user) {
                                $query->where('sender_id', $user->id)
                                      ->where('receiver_id', Auth::id());
                            })
                            ->orderBy('created_at', 'asc')
                            ->get();

        return view('messages.show', compact('user', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $currentUser = Auth::user();

        // Authorization logic
        if ($currentUser->role === 'customer' && $user->role !== 'medic') {
            abort(403, 'Кардарлар медиктерге гана билдирүү жөнөтө алат.');
        }
        if ($currentUser->role === 'medic' && $user->role !== 'customer') {
            abort(403, 'Медиктер кардарларга гана билдирүү жөнөтө алат.');
        }
        if ($currentUser->role === 'admin') {
            abort(403, 'Админдер билдирүү жөнөтө албайт.');
        }

        $request->validate([
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (empty($request->message) && !$request->hasFile('image')) {
            return back()->withErrors(['message' => 'Билдирүү же сүрөт талап кылынат.']);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('messages', 'public');
        }

        Message::create([
            'sender_id' => $currentUser->id,
            'receiver_id' => $user->id,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Билдирүү ийгиликтүү жөнөтүлдү!');
    }
}
