<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\WaterProject;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'donation_type' => 'required|in:one_time,monthly',
            'donor_name' => 'nullable|string|max:255',
            'donor_email' => 'nullable|email|max:255',
        ]);

        // Create donation record
        $donation = Donation::create([
            'water_project_id' => WaterProject::active()->first()?->id,
            'donor_name' => $validated['donor_name'] ?? 'Anonymous',
            'donor_email' => $validated['donor_email'] ?? null,
            'amount' => $validated['amount'],
            'type' => $validated['donation_type'],
            'status' => 'pending',
            'payment_method' => 'website_form',
            'notes' => 'Submitted via website donation modal',
        ]);

        // Check if request expects JSON (AJAX/fetch)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your generous donation of $' . number_format($validated['amount'], 2) . '! We will contact you for payment processing.',
                'donation_id' => $donation->id,
            ]);
        }

        return back()->with('success', 'Thank you for your donation!');
    }
}

