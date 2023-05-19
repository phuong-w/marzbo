<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\SocialMediaCredential;
use App\Models\User;
use App\Repositories\SocialMediaCredential\SocialMediaCredentialRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $userRepository;
    private $socialMediaCredentialRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        SocialMediaCredentialRepositoryInterface $socialMediaCredentialRepository
    ) {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_USER_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_USER_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_USER_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_USER_DELETE)->only('destroy');

        $this->userRepository = $userRepository;
        $this->socialMediaCredentialRepository = $socialMediaCredentialRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $users = $this->userRepository->serverPaginationFilteringFor($request->all());

        return Inertia::render('Admin/User/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Admin/User/Create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.account.store'));
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();

        return Inertia::render('Admin/User/Edit', [
            'user' => new UserResource($user),
            'roles' => RoleResource::collection($roles)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->validated());

        session()->flash(NOTIFICATION_SUCCESS, __('success.account.update'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->destroy($user);
        return redirect()->route('admin.user.index');
    }

    public function setting(): Response
    {
        return Inertia::render('Admin/User/Setting');
    }

    /**
     * Connect to social media by socialite
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Return callback from social media through socialite
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $result = $this->socialMediaCredentialRepository->updateOrCreate($user, $provider);

        if (!$result) {
            return response()->json(['error' => 'Có lỗi xảy ra'], 500);
        }

        return to_route('admin.setting');
    }
}
