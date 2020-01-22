<?php

namespace App\Http\Controllers;

use App\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RestauranteController extends Controller
{
    public function create (Request $request){
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $restaurante = new Restaurante();

        if (!$request->name) {
            $response['error_msg'] = 'Name is requiered';

        }elseif (!$request->address) {
            $response['error_msg'] = 'Address is requiered';

        }elseif (!$request->latitude) {
            $response['error_msg'] = 'Latitude is requiered';

        }elseif (!$request->longitude) {
            $response['error_msg'] = 'Longitude is requiered';

        }elseif (!$request->phone_number) {
            $response['error_msg'] = 'Phone number is requiered';

        }elseif (strlen((string)$request->phone_number) != 9) {
            $response['error_msg'] = 'Phone number must have 9 characters';

        }elseif (!$request->tipo_id) {
            $response['error_msg'] = 'Type is requiered';

        }else {
            try {
                $restaurante->name = ucfirst(strtolower($request->name));
                $restaurante->address = ucfirst(strtolower($request->address));
                $restaurante->latitude = $request->latitude;
                $restaurante->longitude = $request->longitude;
                $restaurante->phone_number = $request->phone_number;
                $restaurante->tipo_id = $request->tipo_id;
                $restaurante->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');

            } catch (\Exception $e) {

                Log::alert('Function: create Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }

        }
        return response()->json($response);
    }

    public function delete($id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $restaurante = Restaurante::find($id);

        if (!empty($restaurante)) {
            try {
                $restaurante->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

    public function update(Request $request, $id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $restaurante = Restaurante::find($id);

        if (isset($request) && isset($id) && !empty($restaurante)) {
            try {
                $restaurante->name = $request->name ? ucfirst(strtolower($request->name)) : $restaurante->name;
                $restaurante->address = $request->address ? ucfirst(strtolower($request->address)) : $restaurante->address;
                $restaurante->latitude = $request->latitude ? $request->latitude : $restaurante->latitude;
                $restaurante->longitude = $request->longitude ? $request->longitude : $restaurante->longitude;
                $restaurante->phone_number = $request->phone_number ? $request->phone_number : $restaurante->phone_number;
                $restaurante->tipo_id = $request->tipo_id ? $request->tipo_id : $restaurante->tipo_id;
                $restaurante->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');

            } catch (\Exception $e) {
                Log::alert('Function: Update Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");
            }
        }
        return response()->json($response);
    }

}
