<?php

namespace App\Jobs\PublishPost;

use App\Models\Post;
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
    protected $post;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $post)
    {
        $this->facebookService = new FacebookService;
        $this->data = $data;
        $this->post = $post;

        $this->onQueue(config('queue.names.facebook.publish'));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $data = $this->data;
            $post = $this->post;

            $response = $this->facebookService->sharePost($data);
            if ($response) {
                $externalPostId = $response['id'];

                $context = [
                    'facebook_group_id' => $data['facebook_group_id'],
                    'facebook_group_name' => $data['facebook_group_name'],
                    'external_post_id' => $externalPostId
                ];

                $post->update([
                    'context' => $context,
                    'status' => POST_STT_PUBLISHED
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Job failed: ' . $e->getMessage());
        }
    }
}
