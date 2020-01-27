<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected function delete($id){
        $response = array('error_code' => 404, 'error_msg' => 'User '.$id.' not found');
        $user = User::where('id', $id)
            ->get()[0];

        if (!empty($user)) {
            try{
                $user->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
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
        $user = User::where('id', $id)
            ->get()[0];

        if (isset($request) && isset($id) && !empty($user)) {
            try {
                $user->name = $request->name ? ucfirst(strtolower($request->name)) : $user->name;
                $user->lastName =$request->lastName ? ucfirst(strtolower($request->lastName)) : $user->lastName;
                $user->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('User '.$user->name.' '.$user->lastName.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update User, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");
            }
        }

        return response()->json($response);
    }

}
