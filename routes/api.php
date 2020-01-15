<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:api')->get('user/{id}', function (Request $request) {
    return User::find($request->id);
});
Route::post('user/create', 'Auth\RegisterController@create');

Route::middleware('auth:api')->put('user/modify/{id}', 'UserController@update');
