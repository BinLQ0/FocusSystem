<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Convert to query
        $user = User::query();

        $user = $user->when(request()->has('roles'), function ($q) {
            return $q->with(['roles' => function ($query) {
                $query->whereIn('name', request('roles'));
            }]);
        });

        return UserResource::collection($user->orderBy('username')->get());
    }
}
