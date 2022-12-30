<?php

namespace App\Services;

use App\Events\UserLoggedIn;
use App\Events\UserRegistered;
use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function signUp(array $data)
    {
        $user = new User($data);
        $user->save();

        $event = new UserRegistered($user);
        event($event);

        return $user;
    }

    public function signIn(SignInRequest $request, array $credentials, string $guard)
    {
        if (Auth::guard($guard)->attemptWhen($credentials)) {
            $user = \auth($guard)->user();

            $event = new UserLoggedIn($user, $request);
            event($event);
            return $user;
        }

        return null;
    }
}
