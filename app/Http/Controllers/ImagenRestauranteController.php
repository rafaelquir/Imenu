<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImagenRestauranteController extends Controller
{
  public function create(Request $request) {
    $response = array('error_code' =>400, 'error_msg' => 'Error inserting info');
    $imagen = new ImagenRestaurante();

    if(!$request->URL) {
        $response['error_msg'] = 'URL is required';

    }elseif(!$request->restaurante_id) {
        $response['error_msg'] = 'Restaurante_id is requiered';

    }else{
        try{
            $imagen->restaurante_id = $request->restaurante_id;
            $imagen->URL = $request->URL;
            $imagen->save();
            $response = array('error_code'=>200, 'error_msg' => 'OK');
            Log::info('Image '.$imagen->URL.' from restaurant '.$imagen->restaurante_id.' create');

        } catch (\Exception $e) {
            Log::alert('Function: Create ImagenRestaurante, Message: '.$e);
            $response = array('error_code' => 500, 'error_msg' => "Server connection error");
        }

        }
        return response()->json ($response);
    }

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

    public function delete($id) {
        $response = array('error_code'=>404, 'error_msg' => 'Image '.$id.' not found');
        $imagen = ImagenRestaurante::find($id);

        if (!empty($imagen)) {
            try {
                $imagen->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Image delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete ImagenRestaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

}
