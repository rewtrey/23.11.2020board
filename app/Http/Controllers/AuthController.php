<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\InvitationLinkEmail;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginUserRequest $request)
    {

        $validated = $request->validated();

        $unverifiedUser = User::query()
            ->where('email', $validated['email'])
            ->where('verified', 0)
            ->first();

        if ($unverifiedUser) {
            die("Перевір свій email для підтвердження реєстрації");
        }


        /** @var User $user */
        $user = User::query()->where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return view('auth.errorLogin');
        }

        Auth::login($user);

        return redirect('/boards');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()
            ->where('email', $validated['email'])
            ->first();

        if ($user) {
            return view('auth.errorAlreadyRegister');
        }

        $user = new User();
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->name = $validated['name'];
        $user->lastName = $validated['lastName'];
        $user->phone = $validated['phone'];
        $user->save();

        $uv = new UserVerification();
        $uv->user_id = $user->id;
        $uv->hash = md5(time() . $user->id);
        $uv->save();

        Mail::to($user)->send(new InvitationLinkEmail($uv->hash));

        die(view('mail.CheckEmail'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/boards');
    }
}
