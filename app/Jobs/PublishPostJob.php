<?php

namespace App\Jobs;

use App\Jobs\PublishPost\ShareFacebookJob;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class PublishPostJob implements ShouldQueue
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
            $currentDateTime = Carbon::now();
            $futureDateTime = $currentDateTime->addMinute();
            $schedules = Schedule::whereBetween('publish_date', [$currentDateTime, $futureDateTime]);

            if ($schedules) {
                foreach ($schedules as $schedule) {
                    $post = $schedule->post;
                    $user = $post->user;

                    $accessToken = $user->facebook_access_token;
                    $message = $post->content;
                    $fbGroupId = $post->context->facebook_group_id;
                    $fbGroupName = $post->context->facebook_group_name;

                    $data = [
                        'facebook_group_id' => $fbGroupId,
                        'facebook_group_name' => $fbGroupName,
                        'access_token' => $accessToken,
                        'message' => $message
                    ];

                    ShareFacebookJob::dispatch($data, $post);
                }

            }
        } catch (\Exception $e) {
            Log::error('Job failed: ' . $e->getMessage());
        }
        // Set time, get all schedule table, where time like time hiện tại -> push (gọi queue)
//        \App\Models\User::factory(5)->create();
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $e
     * @return void
     */
    public function failed(Throwable $e)
    {

    }
}
