<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Http\Requests\SignInRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function signInForm()
    {
        return view('sign-in');
    }

    public function signIn(SignInRequest $request)
    {
        $user = $this->userService->signIn($request, $request->validated(), 'web');

        if ($user) {
            session()->flash('success', 'Signed In!');

            return redirect()->route('main');
        }
        session()->flash('error', 'Incorrect Email or Password');

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
