<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        return User::create([
            'name' => $data->name,
            'lastName' => $data->lastName,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'api_token' => bcrypt(Str::random(25)),
        ]);
    }

    //TO DO ACTUALIZAR

    protected function delete($id){
        $response = array('error_code' => 404, 'error_msg' => 'User '.$id.' not found');
        $user = User::find($id);

        if (!empty($user)) {
            try{
                $user->delete();
                $response = array('error_code' => 200, 'error_msg' => '');
                Log::info('User delete');

            } catch (\Exception $e) {

                Log::alert('Function: Delete User, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
    }

    protected function update(Request $request, $id){
        $response = array('error_code' => 400, 'error_msg' => 'User '.$id.' not found');
        $user = User::find($id);

        if (!empty($user)) {
            //TO DO comprobaciones del update(correo no existente ya)
        }
    }

}
