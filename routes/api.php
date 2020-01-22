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
//Delete user//
Route::middleware('auth:api')->delete('user/delete/{id}', 'UserController@delete');

Route::post('/login', 'Auth\LoginController@login');
//Create restaurante
Route::post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::delete('restaurantes/delete/{id}', 'RestauranteController@delete');
//Update restaurante
Route::put('restaurantes/update/{id}', 'RestauranteController@update');
