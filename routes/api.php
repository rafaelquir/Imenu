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

Route::middleware('auth:api')->get('user/{id}', function (Request $request) {
    return User::find($request->id);
});
<<<<<<< HEAD
Route::post('user/create', 'Auth\RegisterController@create');

Route::middleware('auth:api')->put('user/modify/{id}', 'UserController@update');
=======
Route::post('/user/create', 'Auth\RegisterController@create');

Route::get('/login', function (Request $request) {
    $user = User::find($request->email);
    if (Hash::check($request->password, $user->password)) {
        $loginUser = [
            'serverRequest'=> 200,
            'name'=>$user->name,
            'lastName'=>$user->lastName,
            'api_token'=>$user->api_token,
        ];
        return $loginUser;
    }else{
        return 400;
    }

});
>>>>>>> creacionDelUser
