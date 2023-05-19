<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * The repository for User Model
 */
class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    const ITEM_PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(Schedule $model)
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
