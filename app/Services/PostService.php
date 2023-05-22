<?php

namespace App\Services;

use App\Jobs\PublishPost\ShareFacebookJob;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Services\SocialMedia\FacebookService;
use App\Services\SocialMedia\InstagramService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
            $firstIteration = true;
            $groupId = null;

            foreach ($data['content'] as $socialMediaId => $value) {
                $dataForCreate = [
                    'group_id' => $groupId,
                    'user_id' => auth()->id(),
                    'category_id' => 1,
                    'content' => $value,
                    'social_media_id' => $socialMediaId
                ];

                if ($firstIteration) {
                    $post = $this->postRepository->create($dataForCreate);
                    $groupId = $post->id;

                    $post->update(['group_id' => $groupId]);
                    $firstIteration = false;

                    if ($files = json_decode($data['files'][$socialMediaId])) {
                        foreach ($files as $file) {
                            $url = $this->replaceTypeBase64($post, $file, 'photo/video');
                        }
                    }
                } else {
                    $model = $this->postRepository->create($dataForCreate);

                    if ($files = json_decode($data['files'][$socialMediaId])) {
                        foreach ($files as $file) {
                            $url = $this->replaceTypeBase64($model, $file, 'photo/video');
                        }
                    }
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
//                        ShareFacebookJob::dispatch($data);
                        $response = $this->facebookService->sharePost($data);
                        if ($response) {
                            $externalPostId = $response['id'];
                            $context = [
                                'id' => $data['facebook_group']['id'],
                                'name' => $data['facebook_group']['name'],
                                'external_post_id' => $externalPostId
                            ];

                            $post->update([
                                'context' => $context,
                                'status' => POST_STT_PUBLISHED
                            ]);
                        }
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
                }
            } else {
                $posts = Post::where('group_id', $groupId)->get();

                foreach ($posts as $post) {
                    $socialMediaId = $post->social_media_id;
                    $this->scheduleRepository->create([
                        'user_id' => auth()->id(),
                        'post_id' => $post->id,
                        'social_media_id' => $socialMediaId,
                        'publish_date' => $data['scheduled_time'],
                        'status' => SCHEDULE_STT_PENDING
                    ]);
                }
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function stats($post)
    {
        if ($post->social_media_id == FACEBOOK) {
            $accessToken = auth()->user()->facebook_access_token;
            return $this->facebookService->stats($accessToken, $post);
        }
        return false;
    }

    private function replaceTypeBase64($model, $item, $collection): array|string
    {
        // Get extension
        $data = explode(',', $item);
        $mimeTemp = explode('/', $data[0])[1];
        $mime = explode(';', $mimeTemp)[0];
        $extension = strtolower($mime);

        // Create new filename
        $timestamp = now()->timestamp;
        $random = Str::random(10);
        $filename = $timestamp . '_' . $random . '.' . $extension;

        // Create a new file from base64
        $model->addMediaFromBase64($item)->usingFileName($filename)->toMediaCollection($collection);

        // Get all images as we will need the last one uploaded
        $mediaItems = $model->load('media')->getMedia($collection);

        return $mediaItems[count($mediaItems) - 1]->getFullUrl();
//        // Replace the base64 string in article body with the url of the last uploaded image
//        return str_replace($item, $mediaItems[count($mediaItems) - 1]->getFullUrl(), $dataContent);
    }
}
