<?php

namespace App\Http\Controllers;

use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipoController extends Controller
{
    public function listarTipos() {
        $tipos = Tipo::all(['name']);
        return $tipos;

    }

    public function anadirTipos( Request $request) {
       $response = array('error_code' => 400, 'error_msg' => 'error al insertar un tipo' );
       $tipo = new tipo;

       if(!$request->name){
         $response['error_msg'] = 'Se requiere un nombre';
        }
       else{try{
          $tipo->name = $request->name;
          $tipo->save();
          $response = array('error_code'=>200, 'error_msg'=> '');

       }
       catch (\Exception $e) {
        Log::alert('Function: Update User, Message: '.$e);
        $response = array('error_code' => 500, 'error_msg' => "Server connection error");
    }
    }
        return response()->json($response);
}


        public function modificarTipos(Request $request, $id ) {
         $response = array('error_code'=> 404, 'error_msg'=> 'el tipo' .$id. 'no se encuentra');
         $tipo = Tipo::find($id);
         if(!empty($tipo)) {
            $tipo->name=$request->name;
            $tipo->save();
            $response = array('error_code' => 200, 'error_msg' => 'Tipo modificado');

         }
         return response()->json($response);
        }

        public function borrarTipos($id) {
          $response = array('error_code'=>200, 'error_msg'=> 'Tipo de restaurante borrado');
          $tipo=Tipo::find($id);
          $tipo->delete();
          return response()->json($response);



        }

}
