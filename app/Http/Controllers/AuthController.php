<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();

        $auth = Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        if ($auth) {
            return redirect('/boards');
        }

        die("FAILED");
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->name = $validated['name'];
        $user->lastName = $validated['lastName'];
        $user->phone = $validated['phone'];
        $user->save();

        $auth = Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        return redirect('/boards');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/boards');
    }
}
