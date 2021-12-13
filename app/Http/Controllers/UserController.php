<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('posts', function ($query) {
            $query->where('published_at', '>', now());
        })->paginate();;

        return view('users.index', compact('users'));
    }
}
