<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImagenRestauranteController extends Controller
{
    public function update(Request $request, $id){
        $response = array('error_code'=> 404, 'error_msg'=> 'Image '.$id.' not found');
        $imagen = ImagenRestaurante::find($id);

        if (isset($request) && isset($id) && !empty($imagen)) {
            try {
                $imagen->URL = $request->URL ? $request->URL : $imagen->URL;
                $imagen->restaurante_id = $request->restaurante_id ? $request->restaurante_id : $imagen->restaurante_id ;
                $imagen->save();
                $response = array('error_code'=>200, 'error_msg'=> 'OK');
                Log::info('Image '.$imagen->URL.' from restaurant '.$imagen->restaurante_id.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update ImagenRestaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }
}
