<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\StoreScheduleRequest;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

        return Inertia::render('Admin/Schedule/Index', [
            'schedules' => ScheduleResource::collection($schedules)
        ]);
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
     */
    public function edit(Schedule $schedule)
    {
        return Inertia::render('Admin/Schedule/Edit', [
            'schedule' => new ScheduleResource($schedule)
        ]);
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
        session()->flash(NOTIFICATION_SUCCESS, __('success.update', ['resource' => 'schedule']));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
