<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    //

    public function index()
    {

        $user = UserResource::collection(User::paginate());

        return Inertia(
            'Users/Index',
            [
                "users" => $user
            ]
        );
    }
}