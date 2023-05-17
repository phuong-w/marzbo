<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
* The repository for Role Model
*/
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
    * @inheritdoc
    */
    protected $model;
    const ITEM_PER_PAGE = 10;

    /**
    * @inheritdoc
    */
    public function __construct(Role $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
    * @inheritdoc
    */
    public function allRolesWithPermissions()
    {
        return $this->model->with('permissions')->get();
    }

    /**
    * @inheritdoc
    */
    public function create($data)
    {
        try {
            DB::beginTransaction();

            $role = $this->model->findOrCreate($data['name']);
            $role->givePermissionTo($data['permissions']);

            DB::commit();

            return $role;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
    * @inheritdoc
    */
    public function update($model, $data)
    {
        try {
            DB::beginTransaction();

            $model->update(['name' => $data['name']]);
            $model->syncPermissions($data['permissions']);

            DB::commit();

            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
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
