<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Jobs\SendNewsletterJob;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(15);
        return view('dashboard.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        $subscribersCount = Subscriber::where('is_active', true)->count();
        return view('dashboard.newsletters.create', compact('subscribersCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject.en' => 'required|string|max:255',
            'subject.ar' => 'required|string|max:255',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'send_type' => 'required|in:now,scheduled',
            'scheduled_at' => 'required_if:send_type,scheduled|nullable|date|after:now',
        ]);

        $subscribersCount = Subscriber::where('is_active', true)->count();

        $newsletter = new Newsletter();
        $newsletter->setTranslations('subject', $request->input('subject'));
        $newsletter->setTranslations('content', $request->input('content'));
        $newsletter->status = $request->send_type === 'now' ? 'sending' : 'scheduled';
        $newsletter->scheduled_at = $request->send_type === 'scheduled' ? $request->input('scheduled_at') : null;
        $newsletter->recipients_count = $subscribersCount;
        $newsletter->save();

        if ($request->send_type === 'now') {
            SendNewsletterJob::dispatch($newsletter);
            return redirect()->route('admin.newsletters.index')
                ->with('success', 'Newsletter is being sent to ' . $subscribersCount . ' subscribers!');
        }

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Newsletter scheduled successfully!');
    }

    public function show(Newsletter $newsletter)
    {
        return view('dashboard.newsletters.show', compact('newsletter'));
    }

    public function edit(Newsletter $newsletter)
    {
        if ($newsletter->status === 'sent' || $newsletter->status === 'sending') {
            return redirect()->route('admin.newsletters.index')
                ->with('error', 'Cannot edit a newsletter that has been sent or is being sent.');
        }

        $subscribersCount = Subscriber::where('is_active', true)->count();
        return view('dashboard.newsletters.edit', compact('newsletter', 'subscribersCount'));
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        if ($newsletter->status === 'sent' || $newsletter->status === 'sending') {
            return redirect()->route('admin.newsletters.index')
                ->with('error', 'Cannot update a newsletter that has been sent or is being sent.');
        }

        $request->validate([
            'subject.en' => 'required|string|max:255',
            'subject.ar' => 'required|string|max:255',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'send_type' => 'required|in:now,scheduled',
            'scheduled_at' => 'required_if:send_type,scheduled|nullable|date|after:now',
        ]);

        $subscribersCount = Subscriber::where('is_active', true)->count();

        $newsletter->setTranslations('subject', $request->input('subject'));
        $newsletter->setTranslations('content', $request->input('content'));
        $newsletter->status = $request->send_type === 'now' ? 'sending' : 'scheduled';
        $newsletter->scheduled_at = $request->send_type === 'scheduled' ? $request->input('scheduled_at') : null;
        $newsletter->recipients_count = $subscribersCount;
        $newsletter->save();

        if ($request->send_type === 'now') {
            SendNewsletterJob::dispatch($newsletter);
            return redirect()->route('admin.newsletters.index')
                ->with('success', 'Newsletter is being sent!');
        }

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Newsletter updated successfully!');
    }

    public function destroy(Newsletter $newsletter)
    {
        if ($newsletter->status === 'sending') {
            return redirect()->route('admin.newsletters.index')
                ->with('error', 'Cannot delete a newsletter that is being sent.');
        }

        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Newsletter deleted successfully!');
    }

    public function sendNow(Newsletter $newsletter)
    {
        if ($newsletter->status === 'sent' || $newsletter->status === 'sending') {
            return redirect()->route('admin.newsletters.index')
                ->with('error', 'Newsletter has already been sent or is being sent.');
        }

        $newsletter->update(['status' => 'sending']);
        SendNewsletterJob::dispatch($newsletter);

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Newsletter is being sent!');
    }
}

