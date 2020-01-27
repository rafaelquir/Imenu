<?php

namespace App\Http\Controllers;

use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipoController extends Controller
{
    public function getAll() {
        $tipos = Tipo::all(['name']);
        return response()->json($tipos);

    }

    public function create( Request $request) {
       $response = array('error_code' => 400, 'error_msg' => 'Error inserting info' );
       $tipo = new Tipo;

        if (!$request->name){
            $response['error_msg'] = 'Name is requiered';

        }else{
            try{
                $tipo->name = ucfirst(strtolower($request->name));
                $tipo->save();
                $response = array('error_code'=>200, 'error_msg'=> 'OK');
                Log::info('Type '.$tipo->name.' create');

            } catch (\Exception $e) {
                Log::alert('Function: Create Tipo, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }


    public function update(Request $request, $id ) {
        $response = array('error_code'=> 404, 'error_msg'=> 'Type '.$id.' not found');
        $tipo = Tipo::find($id);

        if (isset($request) && isset($id) && !empty($tipo)) {
            try {
                $tipo->name = $request->name ? ucfirst(strtolower($request->name)) : $tipo->name;
                $tipo->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Type '.$tipo->name.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Tipo, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

    public function delete($id) {
        $response = array('error_code'=>404, 'error_msg'=> 'Type '.$id.' not found');
        $tipo = Tipo::find($id);

        if (!empty($tipo)) {
            try {
                $tipo->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Type delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Tipo, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

}
