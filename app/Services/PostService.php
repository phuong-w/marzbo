<?php

namespace App\Services;

use App\Repositories\Post\PostRepositoryInterface;
use App\Services\SocialMedia\FacebookService;
use App\Services\SocialMedia\InstagramService;
use Illuminate\Support\Facades\Log;

class PostService
{
    private $postRepository;

    private $facebookService,
        $instagramService;

    public function __construct(
        PostRepositoryInterface $postRepository,

        FacebookService $facebookService,
        InstagramService $instagramService
    ) {
        $this->postRepository = $postRepository;

        $this->facebookService = $facebookService;
        $this->instagramService = $instagramService;
    }

    public function create($data)
    {
        try {
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

                // Handle for post articles on social media
                // Facebook
                if ($socialMediaId === FACEBOOK) {
                    $this->facebookService->sharePost($data);
                }

                // Instagram
                if ($socialMediaId === INSTAGRAM) {
                    //
                }

                // Instagram
                if ($socialMediaId === TIKTOK) {
                    //
                }
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
