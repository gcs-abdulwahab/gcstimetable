<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $dateFormat = config('providers.date.readable');
        $users = User::select('id', 'name', 'email', 'email_verified_at', 'created_at')
            ->get()
            ->transform(function ($user) use ($dateFormat) {
                $user->verifiedAt = $user->email_verified_at?->format($dateFormat);
                $user->createdAt  = $user->created_at?->format($dateFormat);

                return $user;
            });

        return Inertia::render('Admin/Users', [
            'users' => $users
        ]);
    }
}
