<?php

namespace App\Repositories\Post;

use App\Models\FacebookGroup;
use App\Models\Post;
use App\Models\SocialMedia;
use App\Repositories\BaseRepository;
use App\Services\SocialMedia\FacebookService;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

    const ITEM_PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
        parent::__construct($model);
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

        $notPublished = Arr::get($searchParams, 'not_published', false);

        $query = $this->model->query();
        $query->where('user_id', auth()->id());

        if ($notPublished) {
            $query->where('status', POST_STT_UNPUBLISHED);
        } else {
            $query->where('status', POST_STT_PUBLISHED);
        }

        $query->whereColumn('id', '=', 'group_id');

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

    /**
     * @return array[]
     */
    public function getStasOfLastTwelveMonths()
    {
        $lastYear = Carbon::now()->subYear();

        $results = $this->model->select([
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('AVG(total_view) as average_total_view'),
            DB::raw('AVG(total_comment) as average_total_comment'),
            DB::raw('AVG(total_react) as average_total_react'),
        ])
            ->where('updated_at', '>=', $lastYear)
            ->groupBy(DB::raw('MONTH(updated_at)'), DB::raw('YEAR(updated_at)'))
            ->get();

        $date = [];
        $totalView = [];
        $totalComment = [];
        $totalReact = [];

        foreach ($results as $result) {
            $date[] = $result->month . '-' . $result->year;
            $totalView[] = $result->average_total_view;
            $totalComment[] = $result->average_total_comment;
            $totalReact[] = $result->average_total_react;
        }

        return [
            'months' => $date,
            'average_total_view' => $totalView,
            'average_total_comment' => $totalComment,
            'average_total_react' => $totalReact,
        ];
    }
}
