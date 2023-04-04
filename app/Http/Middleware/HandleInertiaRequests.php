<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'layouts/app';

    protected $adminPrefix = '/admin';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $prefixCurrentRoute = Route::current()->action['prefix'];

        if ($prefixCurrentRoute === $this->adminPrefix) {
            $this->rootView = 'admin/layouts/app';
        }

        return parent::handle($request, $next);
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'appName' => config('app.name'),
            'auth.user' => fn () => $request->user()
                ? new UserResource($request->user())
                : null,
            'flash' => [
                'success' => fn () => $request->session()->get(NOTIFICATION_SUCCESS),
                'error' => fn () => $request->session()->get(NOTIFICATION_ERROR),
            ],
        ]);
    }
}
