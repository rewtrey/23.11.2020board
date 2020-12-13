<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('upload', function(\Illuminate\Http\Request $request) {
    $request->file('image')->storePubliclyAs('public', 'test.jpg');

    die(\Illuminate\Support\Facades\Storage::url('test.png'));
});

Route::put('put', function (\Illuminate\Http\Request $request) {
    dd($request->all());
});

//Route::group(['middleware' => 'crud'], function() {
   // Route::get('boards/create', 'App\Http\Controllers\BoardController@store');
//});







    Route::get('login', 'App\Http\Controllers\AuthController@showLoginForm');
    Route::get('register', 'App\Http\Controllers\AuthController@showRegisterForm');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout');





   Route::group(['middleware' => 'auth'], function()
   {Route::resource('boards', '\App\Http\Controllers\BoardController',
       ['only' => ['show','store', 'create','edit', 'update', 'destroy']]);
   });

    Route::resource('boards', \App\Http\Controllers\BoardController::class)
        ->only(['index']);




    Route::get('invite', function (\Illuminate\Http\Request $request) {
        $hash = $request->input('hash');

        /** @var \App\Models\UserVerification $uv */
        $uv = \App\Models\UserVerification::query()
            ->where('hash', $hash)
            ->firstOrFail();

        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()->where('id', $uv->user_id)->first();

        $user->verified = 1;
        $user->save();
        $uv->delete();

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect('/boards');
    });















