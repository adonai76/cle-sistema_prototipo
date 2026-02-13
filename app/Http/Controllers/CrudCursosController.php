<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Nivel;
class CrudCursosController extends Controller
{
    public function create(Request $request)
    {
        //Favor de hacer una validación aquí

        Curso::create([
            'id_docente' => $request->docente_curso,
            'id_nivel' => $request->modulo_curso,
            'modelo_solucion_curso' => "N/A",
            'tecnm_curso' => "N/A",
            'modelo_curso' => $request->modelo_curso,
            'nombre_tms_curso' => $request->nombre_tms_curso,
            'inicio_curso' => $request->inicio_curso,
            'fin_curso' => $request->fin_curso,
            'dias_curso' => $request->dias_curso,
            'horario_curso' => $request->horario_curso,
            'alumnos_actuales_curso' => 0,
            'cupo_curso' => $request->cupo_curso,
            'clases_via_curso' => $request->clases_via_curso,
            'tipo_curso' => $request->tipo_curso,
            'acceso_plataforma_curso' => "N/A",
            'acceso_teams_curso' => "N/A",
            'link_clase_curso' => "N/A",
        ]);

        return redirect(route('admin.registro_cursos'))->with('success', 'Curso registrado correctamente');
    }
    public function read(Request $request)
    {
        $docentes = Docente::all();
        $cursos = Curso::all();
        $niveles = Nivel::all();
        return view('administrador.registro_cursos', compact('docentes', 'cursos', 'niveles'));
    }

    public function update($id)
    {
        $curso = Curso::find($id);
        $docentes = Docente::all();
        $niveles = Nivel::all();

        if ($curso) {
            return view('administrador.actualiza_curso', compact('curso', 'docentes','niveles'));
        } else {
            return redirect(route('admin.registro_cursos'))->with('error', 'Curso no encontrado');
        }
    }

    public function update_curso(Request $request, $id)
    {
        $curso = Curso::find($id);

        if ($curso) {
            $curso->update([
                'id_docente' => $request->docente_curso,
                'modelo_curso' => $request->modelo_curso,
                'id_nivel' => $request->modulo_curso,
                'nombre_tms_curso' => $request->nombre_tms_curso,
                'inicio_curso' => $request->inicio_curso,
                'fin_curso' => $request->fin_curso,
                'dias_curso' => $request->dias_curso,
                'horario_curso' => $request->horario_curso,
                'cupo_curso' => $request->cupo_curso,
                'clases_via_curso' => $request->clases_via_curso,
                'tipo_curso' => $request->tipo_curso,
            ]);

            return redirect(route('admin.registro_cursos'))->with('success', 'Curso actualizado correctamente');
        } else {
            return redirect(route('admin.registro_cursos'))->with('error', 'Curso no encontrado');
        }
    }

    public function delete($id)
    {
        $grupo = Curso::find($id);

        if ($grupo) {
            $grupo->delete();
            return redirect(route('admin.registro_cursos'))->with('success', 'Curso eliminado correctamente');
        } else {
            return redirect(route('admin.registro_cursos'))->with('error', 'Curso no encontrado');
        }
    }

}
