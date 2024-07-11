<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unidad;

class Unidad_controller extends Controller
{
    public function insertar(Request $req){

        $unidad=new Unidad();
        $unidad->nombreUnidad=$req->nombreUnidad;
        $unidad->estatus=1;
        $unidad->save();

        if ($unidad->pkUnidad) {
            return redirect(url('/unidadVision'))->with('success', '¡Unidad Agregada!');
        } else {
            return redirect(url('/unidadVision'))->with('error', 'Error en insercion de unidad');
        } 
    }

    public function mostrar(){
        $datosUnidad=Unidad::where('estatus', '=', 1)->get();
        return view('agregarYVistaUnidad', compact('datosUnidad'));
    }

    public function baja($pkUnidad){
        $dato = Unidad::findOrFail($pkUnidad);
        
        if ($dato) {
            $dato->estatus = 0;
            $dato->save();

            return redirect(url('/unidadVision'))->with('success', '¡Baja de Unidad Completada!');
        } else {
            return redirect(url('/unidadVision'))->with('error', 'Error en Baja de Unidad');
        }
    }

    public function mostrarPorId($pkUnidad){
        $datosUnidad = Unidad::findOrFail($pkUnidad)
            ->first(); // Agrega esta línea para obtener el primer resultado
        return view('editarUnidad', compact('datosUnidad'));
    }
    

    public function editar(Request $req, $pkUnidad){
        $datosUnidad=Unidad::findOrFail($pkUnidad);

        $datosUnidad->nombreUnidad=$req->nombreUnidad;
        $datosUnidad->save();

        if ( $datosUnidad->pkUnidad) {
            return redirect(url('/unidadVision'))->with('success', '¡Actualizacion de Unidad Completada!');
        } else {
            return redirect(url('/unidadVision'))->with('error', 'Error en Actualización de Unidad');
        }
    }
}
