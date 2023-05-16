<?php

namespace App\Services;

use App\Jobs\PublishPost\ShareFacebookJob;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Services\SocialMedia\FacebookService;
use App\Services\SocialMedia\InstagramService;
use Illuminate\Support\Facades\Log;

class PostService
{
    private $postRepository,
        $scheduleRepository;

    private $facebookService,
        $instagramService;

    public function __construct(
        PostRepositoryInterface $postRepository,
        ScheduleRepositoryInterface $scheduleRepository,

        FacebookService $facebookService,
        InstagramService $instagramService
    ) {
        $this->postRepository = $postRepository;
        $this->scheduleRepository = $scheduleRepository;

        $this->facebookService = $facebookService;
        $this->instagramService = $instagramService;
    }

    public function create($data)
    {
        try {
            dd($data['facebook_group']);
            $firstIteration = true;
            $groupId = null;

            foreach ($data['content'] as $socialMediaId => $value) {
                $dataForCreate = [
                    'group_id' => $groupId,
                    'user_id' => auth()->id(),
                    'category_id' => $data['category_id'],
                    'content' => $value,
                    'social_media_id' => $socialMediaId
                ];

                if ($firstIteration) {
                    $post = $this->postRepository->create($dataForCreate);
                    $groupId = $post->id;

                    $post->update(['group_id' => $groupId]);
                    $firstIteration = false;
                } else {
                    $this->postRepository->create($dataForCreate);
                }
            }

            // Handle for post articles on social media
            if (!isset($data['scheduled_time'])) {
                $posts = Post::where('group_id', $groupId)->get();

                foreach ($posts as $post) {
                    $socialMediaId = $post->social_media_id;
                    // Facebook
                    if ($socialMediaId === FACEBOOK) {
                        $data['access_token'] = auth()->user()->facebook_access_token;
                        ShareFacebookJob::dispatch($data);
                    }

                    // Instagram
                    if ($socialMediaId === INSTAGRAM) {
                        $data['access_token'] = '';
//                        dd(2);
                    }

                    // Instagram
                    if ($socialMediaId === TIKTOK) {
                        $data['access_token'] = '';
//                        dd(3);
                    }

                    $post->update(['status' => POST_STT_PUBLISHED]);
                }
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
