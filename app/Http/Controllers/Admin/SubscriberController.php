<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(15);
        return view('dashboard.subscribers.index', compact('subscribers'));
    }

    public function create()
    {
        return view('dashboard.subscribers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['subscribed_at'] = now();

        Subscriber::create($validated);

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber added successfully.');
    }

    public function show(Subscriber $subscriber)
    {
        return view('dashboard.subscribers.show', compact('subscriber'));
    }

    public function edit(Subscriber $subscriber)
    {
        return view('dashboard.subscribers.edit', compact('subscriber'));
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:subscribers,email,' . $subscriber->id,
            'is_active' => 'boolean',
        ]);

        if (!$validated['is_active'] && $subscriber->is_active) {
            $validated['unsubscribed_at'] = now();
        }

        $subscriber->update($validated);

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber updated successfully.');
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber deleted successfully.');
    }
}
