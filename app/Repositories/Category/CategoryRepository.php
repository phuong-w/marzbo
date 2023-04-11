<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * The repository for User Model
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    const ITEM_PER_PAGE = 5;

    /**
     * @inheritdoc
     */
    public function __construct(Category $model)
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

        $query = $this->model->query();

        if (isset($keyword)) {
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

        $query->latest();

        return $query->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function toggleStatus($model)
    {
        return $model->update(['status' => !$model->status]);
    }
}
