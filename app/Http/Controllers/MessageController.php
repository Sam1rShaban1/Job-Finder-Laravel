<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Messages/Index', [
            'messages' => auth()->user()->messages()
                ->with(['sender', 'receiver'])
                ->latest()
                ->paginate(20)
        ]);
    }

    public function store(StoreMessageRequest $request): RedirectResponse
    {
        auth()->user()->sentMessages()->create($request->validated());
        
        return back()->with('success', 'Message sent successfully');
    }

    public function update(StoreMessageRequest $request, Message $message): RedirectResponse
    {
        $this->authorize('update', $message);
        $message->update($request->validated());
        
        return back()->with('success', 'Message updated');
    }

    public function destroy(Message $message): RedirectResponse
    {
        $this->authorize('delete', $message);
        $message->delete();
        
        return back()->with('success', 'Message deleted');
    }
}
