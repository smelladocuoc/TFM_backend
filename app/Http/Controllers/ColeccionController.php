<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectionRequest;
use App\Models\Coleccion;

class ColeccionController extends Controller
{
    public function coleccionJSON($coleccionId){

        $coleccion = Coleccion::find($coleccionId);

        return $coleccion;

    }

    public function tipoColeccionJSON($tipo){

        $coleccion = Coleccion::select(['id', 'nombre_coleccion'])->where('tipo_coleccion', $tipo)->get();

        return $coleccion;

    }

    public function ColeccionesJSON(){

        $coleccion = Coleccion::select(['id', 'nombre_coleccion', 'tipo_coleccion', 'imagen_coleccion'])->get();

        return $coleccion;

    }

    public function coleccionNueva(CollectionRequest $request){

        $coleccion = Coleccion::create([
            'nombre_coleccion' => $request->nombre_coleccion,
            'tipo_coleccion' => $request->tipo_coleccion,
            'imagen_coleccion' => $request->imagen_coleccion,
        ]);

        return response()->json(compact('coleccion'), 201);
    }

    public function coleccionUpdate(CollectionRequest $request, $coleccionId){
        $coleccion = Coleccion::where('id', $coleccionId)->update([
            'nombre_coleccion' => $request->nombre_coleccion,
            'tipo_coleccion' => $request->tipo_coleccion,
            'imagen_coleccion' => $request->imagen_coleccion,
        ]);

        return response()->json(compact('coleccion'), 201); 
    }

    public function coleccionDelete($coleccionId){
        $coleccionBorrados = Coleccion::where('id', $coleccionId)->delete();
        return response()->json(compact('coleccionBorrados'), 201); 
    }
}
