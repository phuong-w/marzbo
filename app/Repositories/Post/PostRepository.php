<?php

namespace App\Repositories\Post;

use App\Models\FacebookGroup;
use App\Models\Post;
use App\Models\SocialMedia;
use App\Repositories\BaseRepository;
use App\Services\SocialMedia\FacebookService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * The repository for User Model
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    const ITEM_PER_PAGE = 50;

    /**
     * @inheritdoc
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        try {
            $post = $this->model->create([
                'user_id' => auth()->id(),
                'category_id' => $data['category_id'],
                'content' => 'placeholder'
            ]);

            foreach ($data['content'] as $key => $value) {
                $images = json_decode($data['images'][$key]);
                $videos = json_decode($data['videos'][$key]);
                $data['content'][$key] = $this->replaceTypeImagesVideosForContent($post, $images, $videos, $data['content'][$key]);

                // Handle for post articles on social media
                // Facebook
                $facebookService = new FacebookService();
                $facebookService->sharePost($data);
            }

            $post->update(['content' => $data['content']]);

            return $post;
        } catch (\Exception $e) {
            return false;
        }

    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        $data['slug'] = $this->generateSlug($data['name'], $model->id);
        return $model->update($data);
    }

    private function replaceTypeImagesVideosForContent($model, $images, $videos, $dataContent)
    {
        if ($images) {
            foreach ($images as $image) {
                $dataContent = $this->replaceTypeBase64($model, $image, POST_IMAGES_COLLECTION, $dataContent);
            }
        }

        if ($videos) {
            foreach ($videos as $video) {
                $dataContent = $this->replaceTypeBase64($model, $video, POST_VIDEOS_COLLECTION, $dataContent);
            }
        }

        return $dataContent;
    }

    private function replaceTypeBase64($model, $item, $collection, $dataContent): array|string
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

        // Replace the base64 string in article body with the url of the last uploaded image
        return str_replace($item, $mediaItems[count($mediaItems) - 1]->getFullUrl(), $dataContent);
    }

    public function checkSlugExist($slug, $id = null)
    {
        return $this->model->where('id', '!=', $id)->where('slug', $slug)->first();
    }

    /**
     * Generate slug
     */
    function generateSlug($name, $id = null)
    {
        $slug = Str::slug($name, '-');
        $checkSlug = $this->checkSlugExist($slug, $id);
        while ($checkSlug) {
            $slug = $slug . '-1';
            $checkSlug = $this->checkSlugExist($slug, $id);
        }
        return $slug;
    }

    /**
     * @param $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $dtColumns = Arr::get($searchParams, 'columns');
        $dtOrders = Arr::get($searchParams, 'order');

        $query = $this->model->query();

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(
                function ($q) use ($keyword) {
                    $q->where('id', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('created_at', 'LIKE', '%' . $keyword . '%');
                }
            );
        }

        if ($dtColumns && $dtOrders) {
            foreach ($dtOrders as $dtOrder) {
                $colIndex = $dtOrder['column'];
                $col = $dtColumns[$colIndex];
                if ($col['orderable'] === "true") {
                    $orderDirection = $dtOrder['dir'];
                    $orderName = $col['data'];
                    $query->orderBy($orderName, $orderDirection);
                }
            }
        }

        $query->latest();

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }
}
