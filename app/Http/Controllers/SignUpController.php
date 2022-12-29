<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\SignUpRequest;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function showForm()
    {
        return view('sign-up');
    }

    public function signUp(SignUpRequest $request)
    {
        $this->userService->signUp($request->validated());

        session()->flash('success', 'Successfully authorized');

        return redirect()->route('main');
    }

    public function verifyEmail(int $id, string $hash, Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        $user = User::query()->findOrFail($id);

        if (!hash_equals($hash, sha1($user->email))) {
            abort(403);
        }

        $user->email_verified_at = new DateTime();
        $user->save();

        return redirect()->route('main');
    }
}
