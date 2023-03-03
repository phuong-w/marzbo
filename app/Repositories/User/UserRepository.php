<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * The repository for User Model
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  /**
   * @inheritdoc
   */
  protected $model;

  const ITEM_PER_PAGE = 50;

  /**
   * @inheritdoc
   */
  public function __construct(User $model)
  {
    $this->model = $model;
    parent::__construct($model);
  }

  /**
   * @inheritdoc
   */
  public function allWithRoles()
  {
    return $this->model->with('roles')->get();
  }

  /**
   * @inheritdoc
   */
  public function create($data)
  {
    try {
      DB::beginTransaction();

      $data['password'] = Hash::make($data['password']);

      $data['name'] = $data['last_name'] . ' ' . $data['first_name'];

      $user = $this->model->create($data);

      $user->syncRoles($data['role']);

      DB::commit();

      return $user;
    } catch (\Exception $e) {
      DB::rollBack();
      return $e->getMessage();
    }
  }

  /**
   * @inheritdoc
   */
  public function update($model, $data)
  {
    try {
      DB::beginTransaction();

      $user = $model->update($data);

      if (isset($data['role'])) {
        $model->syncRoles([$data['role']]);
      }

      DB::commit();

      return $user;
    } catch (\Exception $e) {
      DB::rollBack();
      return $e->getMessage();
    }
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

        $query->orderByDesc('created_at');

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @param $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForApi($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::ITEM_PER_PAGE);

        $query = $this->model->query();

        $query->latest();

        return $query->paginate($limit);
    }
}
