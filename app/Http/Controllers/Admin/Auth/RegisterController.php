<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendEmailWelcomeToMarzboJob;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the registration view.
     */
    public function showRegisterForm(): Response
    {
        return Inertia::render('Admin/Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userRepository->registerCustomer($request->validated());

        if (!$user) {
            session()->flash(NOTIFICATION_ERROR, __('error.user.register'));
        }

        event(new Registered($user));
        SendEmailWelcomeToMarzboJob::dispatch($user);


//        Auth::login($user);

        session()->flash(NOTIFICATION_SUCCESS, __('success.user.register', [
            'user' => $user->name
        ]));

        return to_route('admin.login.show-form');
    }
}
