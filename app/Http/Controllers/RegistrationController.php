<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        $html = "
        ";

        die($html);
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->lastName = $validated['lastName'];
        $user->phone = $validated['phone'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->save();

        dd($user);


    }
}
