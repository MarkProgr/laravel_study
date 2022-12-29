<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function signIn(SignInRequest $request): UserResource|Response
    {
        $user = $this->userService->signIn($request, $request->validated(), 'api');

        if ($user) {
            return new UserResource($user);
        }

        return response(status: 401);
    }

    public function signUp(SignUpRequest $request): UserResource
    {
        $user = $this->userService->signUp($request->validated());

        return new UserResource($user);
    }
}
