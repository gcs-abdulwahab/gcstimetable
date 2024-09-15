<?php

namespace App\Http\Middleware;

use App\RoleEnum;
use App\PermissionEnum;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $this->currentUser($request),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy())->toArray(),
                'location' => $request->url(),
            ]      ];
    }

    private function currentUser(Request $request): array|null
    {
        return $request->user()
            ? $request->user()->toArray()
                + ['roles' => $request->user()->getRoleNames(),
                   'permissions' => $request->user()->getPermissionsViaRoles()]
            : null;
    }
}
