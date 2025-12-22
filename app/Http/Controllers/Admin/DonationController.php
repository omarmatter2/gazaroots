<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\WaterProject;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('waterProject')->latest()->paginate(15);
        return view('dashboard.donations.index', compact('donations'));
    }

    public function create()
    {
        $waterProjects = WaterProject::active()->get();
        return view('dashboard.donations.create', compact('waterProjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_project_id' => 'nullable|exists:water_projects,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'donor_phone' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:one_time,monthly',
            'status' => 'required|in:pending,completed,failed,refunded',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Donation::create($validated);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation recorded successfully.');
    }

    public function show(Donation $donation)
    {
        return view('dashboard.donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        $waterProjects = WaterProject::active()->get();
        return view('dashboard.donations.edit', compact('donation', 'waterProjects'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'water_project_id' => 'nullable|exists:water_projects,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'donor_phone' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:one_time,monthly',
            'status' => 'required|in:pending,completed,failed,refunded',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $donation->update($validated);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation deleted successfully.');
    }
}
