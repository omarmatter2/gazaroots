<?php

namespace App\Jobs;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Mail\NewsletterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsletterJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Newsletter $newsletter
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscribers = Subscriber::where('is_active', true)->get();
        $sentCount = 0;
        $failedCount = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterMail($this->newsletter));
                $sentCount++;
            } catch (\Exception $e) {
                Log::error("Failed to send newsletter to {$subscriber->email}: " . $e->getMessage());
                $failedCount++;
            }
        }

        $this->newsletter->update([
            'status' => $failedCount === $subscribers->count() ? 'failed' : 'sent',
            'sent_at' => now(),
            'sent_count' => $sentCount,
            'failed_count' => $failedCount,
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        $this->newsletter->update([
            'status' => 'failed',
        ]);

        Log::error("Newsletter job failed: " . $exception->getMessage());
    }
}
