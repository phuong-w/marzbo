<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\StoreScheduleRequest;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Models\Schedule;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_SCHEDULE_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_SCHEDULE_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_SCHEDULE_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_SCHEDULE_DELETE)->only('destroy');

        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schedules = $this->scheduleRepository->serverPaginationFilteringFor($request->all());
        if ($request->ajax()) {
            return ScheduleResource::collection($schedules);
        }
        return view('admin.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $this->scheduleRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.schedule.store'));
        return redirect()->route('admin.schedule.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Schedule $schedule
     * @return Application|Factory|View
     */
    public function edit(Schedule $schedule)
    {
        return view('admin.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateScheduleRequest $request
     * @param Schedule $schedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $this->scheduleRepository->update($schedule, $request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.schedule.update'));
        return redirect()->route('admin.schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
