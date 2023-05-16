<?php

namespace App\Repositories\SocialMediaCredential;

use App\Models\SocialMedia;
use App\Models\SocialMediaCredential;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * The repository for User Model
 */
class SocialMediaCredentialRepository extends BaseRepository implements SocialMediaCredentialRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    const ITEM_PER_PAGE = 50;

    /**
     * @inheritdoc
     */
    public function __construct(SocialMediaCredential $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        $data['slug'] = $this->generateSlug($data['name']);
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        $data['slug'] = $this->generateSlug($data['name'], $model->id);
        return $model->update($data);
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

    public function updateOrCreate($userSocialConnected, $provider)
    {
        try {
            $socialMedia = SocialMedia::where('name', $provider)->first();

            return $this->model->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'social_media_id' => $socialMedia->id
                ],
                [
                    'credentials' => $userSocialConnected
                ]
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
