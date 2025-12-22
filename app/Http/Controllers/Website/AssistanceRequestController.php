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
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'location' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $validated['status'] = 'new';

        AssistanceRequest::create($validated);

        // Check if request expects JSON (AJAX/fetch)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your request has been submitted successfully. We will contact you as soon as possible.',
            ]);
        }

        return redirect()->route('request-help')
            ->with('success', 'Your request has been submitted successfully. We will contact you soon.');
    }
}

