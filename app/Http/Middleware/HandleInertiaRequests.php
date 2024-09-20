<?php

namespace App\Http\Middleware;

use App\RoleEnum;
use App\Models\User;
use App\PermissionEnum;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

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

    private function currentUser(Request $request)
    {
        $user = $request->user()
            ? User::where('id', $request->user()->id)
                ->with([
                    'roles.permissions' => function ($query) {
                        $query->select('id', 'name');
                    }
                ])
                ->first()
            : null;

        if ($user) {
            // dd($user->roles);
            return (new UserResource($user))->toArray($request);
        }

        return null;
    }
}
