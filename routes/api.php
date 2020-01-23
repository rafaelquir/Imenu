<?php

use App\ImagenRestaurante;
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

Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

//Mostrar tipos de comida
Route::get('tipo', 'TipoController@listarTipos');
//Crear nuevo tipo
Route::post('tipo/create', 'TipoController@anadirTipos');
//Borrar un tipo de comida
Route::delete('tipo/delete/{id}', 'TipoController@borrarTipos');
//Editar un tipo de comida
Route::put('tipo/update/{id}', 'TipoController@modificarTipos');

Route::get('enviar', ['as' => 'enviar', function () {

    $data = ['link' => 'https://cev.com,'];

    \Mail::send('emails.notificacion', $data, function ($message) {

        $message->from('email@cev.com', 'cev.com');

        $message->to('user@example.com')->subject('Notificación');

    });

    return "Se envío el email";
}]);
//Create restaurante
Route::middleware('auth:api')->post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::middleware('auth:api')->delete('restaurantes/delete/{id}', 'RestauranteController@delete');
//Update restaurante
Route::middleware('auth:api')->put('restaurantes/update/{id}', 'RestauranteController@update');


//Get tipo
Route::middleware('auth:api')->get('tipo', 'TipoController@getAll');
//Create tipo
Route::middleware('auth:api')->post('tipo/create', 'TipoController@create');
//Delete tipo
Route::middleware('auth:api')->delete('tipo/delete/{id}', 'TipoController@delete');
//Update tipo
Route::middleware('auth:api')->put('tipo/update/{id}', 'TipoController@update');

//Crear una imagen
Route::post('imagenRestaurante/create', 'ImagenRestauranteController@anadirfotos');
//Borrar una imagen
Route::delete('ImagenRestaurante/delete/{id}', 'ImagenRestauranteController@borrarImagenes');



//Update imagen restaurante
Route::put('imagenRestaurante/update/{id}', 'ImagenRestauranteController@update');
