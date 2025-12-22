<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AssistanceRequest;
use Illuminate\Http\Request;

class AssistanceRequestController extends Controller
{
    public function create()
    {
        return view('website.request-help');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'type' => 'required|in:food,medical,shelter,water,other',
            'description' => 'required|string|max:2000',
            'family_members' => 'required|integer|min:1|max:50',
        ]);

        $validated['status'] = 'new';

        AssistanceRequest::create($validated);

        return redirect()->route('request-help')
            ->with('success', 'Your request has been submitted successfully. We will contact you soon.');
    }
}

