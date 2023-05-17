<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

/**
 * The repository for Role Model
 */
class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
  /**
   * @inheritdoc
   */
  protected $model;
  const ITEM_PER_PAGE = 10;

  /**
   * @inheritdoc
   */
  public function __construct(Permission $model)
  {
    $this->model = $model;
    parent::__construct($model);
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

    if ($keyword) {
        if (is_array($keyword)) {
            $keyword = $keyword['value'];
        }
        $query->where(
            function ($q) use ($keyword) {
                $q->where('id', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
            }
        );
    }

    $query->latest();

    return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
  }
}
