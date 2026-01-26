<?php

namespace App\Jobs;

use App\Models\IncomingWebhooks;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Transactions\Parsers\ParseFactory;

class IncomingWebHook implements ShouldQueue
{
    use Queueable;

    protected $bank;
    protected $payload;
    protected $incomingWebhookId;

    /**
     * Create a new job instance.
     */
    public function __construct($bank , $payload , $incomingWebhookId)
    {
        $this->bank = $bank;
        $this->payload = $payload;
        $this->incomingWebhookId = $incomingWebhookId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $webhook = IncomingWebhooks::findOrFail($this->incomingWebhookId);

        try {
                $parser = ParseFactory::make($webhook->bank);
                $transactions = $parser->parse($webhook->payload);
                $webhook->update([
                'status'       => 'done',
                'processed_at' => now(),
            ]);


        } catch (\Exception $e) {
                $webhook->status = 'failed';
                $webhook->processed_at = now();
                $webhook->save();
        }
    }
}
