<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\PermissionEnum;
use App\Policies\UserPolicy;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users  = User::select('id', 'name', 'email', 'email_verified_at', 'created_at')
            ->paginate($request->input('per_page', config('providers.per_page')));

        return Inertia::render('Admin/Users/index', [
            'users' => UserResource::collection($users)
        ]);
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return back()->withErrors(['message' => 'User not found.']);
        }

        $response = Gate::inspect('delete', [User::class, $user]);

        if ($response->allowed()) {

            if (!$user->isStudent() && !$user->isTeacher()) {
                return back()->withErrors(['message' => "User, {$user->name} can't be deleted."]);
            }

            $user->delete();

            return back()->with('success', 'User deleted successfully.');
        }

        return back()->withErrors(['message' => $response->message()]);
    }
}
