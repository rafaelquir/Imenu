<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Get user by id//
Route::middleware('auth:api')->get('user/{id}', function (Request $request) {
    return User::find($request->id);
});
//Create y Register user//
Route::post('register', 'Auth\RegisterController@create');
//Update user//
Route::middleware('auth:api')->put('user/modify/{id}', 'UserController@update');

Route::get('/login', 'Auth\LoginController@login');

Route::get('password/reset', 'Auth\ResetPasswordController@getEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@postEmail');
