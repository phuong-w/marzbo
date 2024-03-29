<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    ) {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_VIEW_MENU_ROLE_PERMISSION)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE)->except('index');

        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $roles = $this->roleRepository->serverPaginationFilteringFor($request->all());

        return Inertia::render('Admin/Role/Index', [
            'roles' => RoleResource::collection($roles)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $permissions = $this->permissionRepository->all();

        return Inertia::render('Admin/Role/Create', [
            'permissions' => PermissionResource::collection($permissions)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = $this->roleRepository->create($request->validated());

        session()->flash(NOTIFICATION_SUCCESS, __('success.store', [
            'resource' => $role->name
        ]));

        return to_route('admin.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role, Request $request): Response
    {
        $data = $request->all();
        $data['role_id'] = $role->id;
        $permissions = $this->permissionRepository->all();
        $roleWithPermissions = $this->permissionRepository->serverPaginationFilteringFor($data);
        $role->load('permissions');

        return Inertia::render('Admin/Role/Edit', [
            'role' => new RoleResource($role),
            'permissions' => PermissionResource::collection($permissions),
            'roleWithPermissions' => PermissionResource::collection($roleWithPermissions)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleRepository->update($role, $request->validated());

        session()->flash(NOTIFICATION_SUCCESS, __('success.update', [
            'resource' => $role->name
        ]));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     */
    public function destroy(Role $role): RedirectResponse
    {
        $this->roleRepository->destroy($role);

        session()->flash(NOTIFICATION_SUCCESS, __('success.delete', [
            'resource' => 'role'
        ]));

        return redirect()->back();
    }
}
