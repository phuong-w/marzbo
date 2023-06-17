<?php

namespace App\Jobs;

use App\Jobs\PublishPost\ShareFacebookJob;
use App\Models\Post;
use App\Models\Schedule;
use App\Services\SocialMedia\FacebookService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ReportDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $posts = Post::published()->get();
            $facebookSerivce = new FacebookService;

            foreach ($posts as $post) {
                if (!empty($post->context)) {
                    $user = $post->user;
                    $accessToken = $user->facebook_access_token;
                    $facebookSerivce->stats($accessToken, $post);
                }
            }

        } catch (\Exception $e) {
            Log::error('Job failed: ' . $e->getMessage());
        }
    }
}
