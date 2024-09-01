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
        $users = User::all()->transform(function($user){
            $user->verifiedAt = $user->email_verified_at ? $user->email_verified_at->format('d M Y h:i a') : null;

            return $user;
        });
        
        return Inertia::render('Admin/Users',[
            'users' => $users
        ]);
    }
}
