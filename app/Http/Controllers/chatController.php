<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Chats/Index', ['chats' => Chat::get()]);
    }

    public function create()
    {
        return Inertia::render('Chats/Create');
    }
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string',
           'email' => 'required|email',
           'image' => 'nullable|image',
           'title' => 'nullable|string',
           'status' => 'nullable|string',
           'role' => 'nullable|string',
        ]);
        $chat = new Chat();

        $chat -> name = $request->name;
        $chat -> email = $request->email;
        $chat ->status = $request ->status;
        $chat ->role = $request->role;
        $chat ->title = $request->title;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/chats-images', $imageName);
            $chat->image = $imageName;
        }
        $chat ->save();
        return redirect()->route('chat.index');
    }
    public function edit($id)
    {
        $chat = Chat::where('id', $id)->first();
        return Inertia::render('Chats/Create', ['chat' => $chat]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
          'name' => 'required|string',
          'email' => 'required|email',
          'image' => 'nullable|image',
          'title' => 'nullable|string',
          'status' => 'nullable|string',
          'role' => 'nullable|string',
        ]);
        $chat = new Chat();

        $chat -> name = $request->name;
        $chat -> email = $request->email;
        $chat ->status = $request ->status;
        $chat ->role = $request->role;
        $chat ->title = $request->title;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/chats-images', $imageName);
            $chat->image = $imageName;
        }
        $chat ->save();
        return redirect()->route('chat.index');
    }
}
