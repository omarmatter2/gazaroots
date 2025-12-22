<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterJob;
use App\Models\Newsletter;
use Illuminate\Console\Command;

class SendScheduledNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletters:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled newsletters that are due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsletters = Newsletter::where('status', 'scheduled')
            ->where('scheduled_at', '<=', now())
            ->get();

        if ($newsletters->isEmpty()) {
            $this->info('No scheduled newsletters to send.');
            return 0;
        }

        foreach ($newsletters as $newsletter) {
            $newsletter->update(['status' => 'sending']);
            SendNewsletterJob::dispatch($newsletter);
            $this->info("Dispatched newsletter: {$newsletter->subject_en}");
        }

        $this->info("Dispatched {$newsletters->count()} newsletter(s).");
        return 0;
    }
}
