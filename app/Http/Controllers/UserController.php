<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
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

        return response()->json($response);
    }

    protected function update(Request $request, $id){
        $response = array('error_code' => 400, 'error_msg' => 'User '.$id.' not found');
        $user = User::find($id);

        if (!empty($user)) {
            $ok = true;

            if (isset($request->name) || isset($request->lastName)) {

                if (!empty($request->name)) {
                    $user->name = ucfirst(strtolower($request->name));
                }

                if (!empty($request->lastName)) {
                    $user->lastName = ucfirst(strtolower($request->lastName));
                }

            } else {
                $ok = false;
                $response['error_msg'] = 'No changes made';
            }

            if ($ok) {
                try {
                    $user->save();
                    $response = array('error_code' => 200, 'error_msg' => 'OK');
                } catch (\Exception $e) {
                    Log::alert('Function: Update User, Message: '.$e);
                    $response = array('error_code' => 500, 'error_msg' => "Server connection error");
                }
            }
        }else {
            $response = array('error_code' => 404, 'error_msg' => 'User '.$id.' not found');
        }

        return response()->json($response);
    }

    //TO DO Funcion para contraseña
}
