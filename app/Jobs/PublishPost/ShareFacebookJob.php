<?php

namespace App\Jobs\PublishPost;

use App\Services\SocialMedia\FacebookService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShareFacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $facebookService;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->facebookService = new FacebookService;
        $this->data = $data;

        $this->onQueue(config('queue.names.facebook.publish'));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->facebookService->sharePost($this->data);
        } catch (\Exception $e) {
            Log::error('Job failed: ' . $e->getMessage());
        }
    }
}
