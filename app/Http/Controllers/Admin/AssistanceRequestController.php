<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssistanceRequest;
use Illuminate\Http\Request;

class AssistanceRequestController extends Controller
{
    public function index()
    {
        $requests = AssistanceRequest::latest()->paginate(15);
        return view('dashboard.assistance-requests.index', compact('requests'));
    }

    public function create()
    {
        return view('dashboard.assistance-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:new,in_progress,resolved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        AssistanceRequest::create($validated);

        return redirect()->route('admin.assistance-requests.index')
            ->with('success', 'Assistance request created successfully.');
    }

    public function show(AssistanceRequest $assistanceRequest)
    {
        return view('dashboard.assistance-requests.show', compact('assistanceRequest'));
    }

    public function edit(AssistanceRequest $assistanceRequest)
    {
        return view('dashboard.assistance-requests.edit', compact('assistanceRequest'));
    }

    public function update(Request $request, AssistanceRequest $assistanceRequest)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:new,in_progress,resolved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $assistanceRequest->update($validated);

        return redirect()->route('admin.assistance-requests.index')
            ->with('success', 'Assistance request updated successfully.');
    }

    public function destroy(AssistanceRequest $assistanceRequest)
    {
        $assistanceRequest->delete();

        return redirect()->route('admin.assistance-requests.index')
            ->with('success', 'Assistance request deleted successfully.');
    }
}
