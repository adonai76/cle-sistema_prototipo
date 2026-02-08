<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Kardex;
use App\Models\Gestion;
use App\Models\Nivel;

class KardexController extends Controller
{
    // Mostrar calificaciones de un alumno
    public function show($id_alumno)
    {
        $alumno = Alumno::find($id_alumno);
        $kardex = $alumno->kardex;
        $calificar = Gestion::find(2);
        $niveles = Nivel::All();

        return view('administrador.calificar_alumnos', compact('alumno', 'kardex', 'calificar', 'niveles'));
    }

    public function create(Request $request, $id_alumno)
    {

        Kardex::create([
            'id_alumno' => $id_alumno,
            'id_nivel' => $request->nivel,
            'calificacion' => $request->calificacion,
            'estado' => $request->calificacion >= 70 ? 'aprobado' : 'reprobado',
            'periodo' => $request->periodo,
            'evaluado' => false
        ]);

        return redirect()->back()->with('success', 'Calificaciones creada correctamente.');

    }

    public function delete($id_kardex)
    {
        $kardex = Kardex::find($id_kardex);

        if (!$kardex) {
            return redirect()->back()->with('error', 'Kardex no encontrado.');
        }

        $kardex->delete();

        return redirect()->back()->with('success', 'Calificación eliminada correctamente.');
    }

    // Actualizar calificación
    public function update(Request $request, $id_kardex)
    {

        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:100',
        ]);

        $kardex = Kardex::find($id_kardex);

        if (!$kardex) {
            return redirect()->back()->with('error', 'Kardex no encontrado.');
        }

        if($request->calificacion >= 70){
            $kardex->alumno->acredita = true;
            $kardex->estado = 'aprobado';
        }else{
            $kardex->alumno->acredita = false;
            $kardex->estado = 'reprobado';
        }

        $kardex->calificacion = $request->calificacion;

        $kardex->save();
        $kardex->alumno->save();

        return redirect()->back()->with('success', 'Calificaciones actualizadas correctamente.');
    }
}
