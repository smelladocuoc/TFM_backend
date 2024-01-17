<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ElementRequest;
use App\Http\Requests\ArrayStringsRequest;
use App\Models\Elemento;
use App\Models\Coleccion;
use App\Models\Coleccion_Elemento;
use App\Models\Elemento_Usuario;

class ElementoController extends Controller
{
    public function elementoJSON($elementoId){

        $elemento = Elemento::find($elementoId);

        return $elemento;

    }

    public function ElementosJSON(){

        $elemento = Elemento::select(['id', 'nombre', 'imagen', 'fecha_publicacion', 'comentario'])->get();

        return $elemento;

    }

    public function elementoNuevo(ElementRequest $request, $coleccionId){

        $elemento = Elemento::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'fecha_publicacion' => $request->fecha_publicacion,
            'comentario' => $request->comentario,
        ]);

        $coleccion_elemento = Coleccion_Elemento::create([
            'coleccion_id' => $coleccionId,
            'elemento_id' => $elemento->id,
        ]);

        return response()->json(compact('elemento', 'coleccion_elemento'), 201);
    }

    public function elementoUsuarioNuevo(ArrayStringsRequest $elementoArrayId, $usuarioId){

        for($i = 0; $i < count((array)$elementoArrayId); $i++){
            if(!is_null($elementoArrayId[$i])){
                $elemento = Elemento_Usuario::create([
                    'elemento_id' => $elementoArrayId[$i],
                    'usuario_id' => $usuarioId,
                ]);
            }
        }

        return response()->json(201);
    }

    public function elementoUpdate(ElementRequest $request, $elementId, $coleccionId){
        $elemento = Elemento::where('id', $elementId)->update([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'fecha_publicacion' => $request->fecha_publicacion,
            'comentario' => $request->comentario,
        ]);

        $coleccion_elemento = Coleccion_Elemento::where('elemento_id', $elementId)->update([
            'coleccion_id' => $coleccionId,
        ]);

        return response()->json(compact('elemento', 'coleccion_elemento'), 201); 
    }

    public function elementoComentario(ArrayStringsRequest $comentario, $elementId){
        $comentario_string = $comentario->all();
        $comentario_update = $comentario_string["comentario"];
        $elemento = Elemento::where('id', $elementId)->update([
            'comentario' => $comentario_update,
        ]);
        

        return response()->json(compact('elemento'), 201); 
    }

    public function elementoDelete($elementoId){
        $elementosId = Coleccion_Elemento::where('elemento_id', $elementoId)->delete();
        $elementoUsuarioBorrados = Elemento_Usuario::where('elemento_id', $elementoId)->delete();
        $elementoBorrados = Elemento::where('id', $elementoId)->delete();
        return response()->json(compact('elementosId', 'elementoBorrados'), 201); 
    }

    public function elementoUserDelete($elementoId, $usuarioId){
        $elementoUsuarioBorrados = Elemento_Usuario::where('elemento_id', $elementoId)->where('usuario_id', $usuarioId)->delete();
        return response()->json(compact('elementoUsuarioBorrados'), 201); 
    }

    public function coleccionesElementosJSON($coleccionId, $usuarioId){

        $elementosId = Coleccion_Elemento::select('elemento_id')->where('coleccion_id', $coleccionId)->get();
        $elementosUsuarioId = Elemento_Usuario::select('elemento_id')->where('usuario_id', $usuarioId)->whereIn('elemento_id', $elementosId)->get();
        $elementos = Elemento::select(['id', 'nombre', 'imagen', 'fecha_publicacion', 'comentario'])->whereIn('id', $elementosUsuarioId)->get();

        return $elementos;

    }

    public function coleccionElementoJSON($elementoId){

        $coleccionId = Coleccion_Elemento::select('coleccion_id')->where('elemento_id', $elementoId)->get();
        $coleccion = Coleccion::select(['id', 'nombre_coleccion', 'tipo_coleccion'])->whereIn('id', $coleccionId)->get();

        return $coleccion;

    }

    public function coleccionElementosJSON(){

        $coleccionId = Coleccion::select(['id', 'nombre_coleccion'])->get();
        $elementosIdArray = [];
        for($i = 0; $i < sizeof($coleccionId); $i++){
            $elementoId = Coleccion_Elemento::select('elemento_id')->where('coleccion_id', $coleccionId[$i]->id)->count();
            array_push($elementosIdArray, $coleccionId[$i]->nombre_coleccion);
            array_push($elementosIdArray, $elementoId);
        }

        return $elementosIdArray;

    }

    public function coleccionNouserJSON($coleccionId, $usuarioId){

        $elementosId = Coleccion_Elemento::select('elemento_id')->where('coleccion_id', $coleccionId)->get();
        $elementosNousuarioId = Elemento_Usuario::select('elemento_id')->where('usuario_id', $usuarioId)->whereIn('elemento_id', $elementosId)->get();
        
        $elementosIdArray = [];
        $elementosNousuarioIdArray = [];
        for($i = 0; $i < sizeof($elementosId); $i++){
                array_push($elementosIdArray, $elementosId[$i]->elemento_id);
        }
        for($j = 0; $j < sizeof($elementosNousuarioId); $j++){
            array_push($elementosNousuarioIdArray, $elementosNousuarioId[$j]->elemento_id);
        }
        $elementosNousuarioArray = array_diff($elementosIdArray, $elementosNousuarioIdArray);
        
        $elementos = Elemento::select(['id', 'nombre', 'imagen', 'fecha_publicacion', 'comentario'])->whereIn('id', $elementosNousuarioArray)->get();

        return $elementos;

    }

    public function elementoUsuarioJSON($usuarioId){

        $elementosId = Elemento_Usuario::select('elemento_id')->where('usuario_id', $usuarioId)->get();
        $elemento = Elemento::select(['id', 'nombre', 'imagen', 'fecha_publicacion', 'comentario'])->whereIn('id', $elementosId)->get();

        return $elemento;

    }
}
