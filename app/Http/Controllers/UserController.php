<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Gestion;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show_users()
    {
        $usuario = Auth::user();
        return view('general.registro', compact('usuario'));
    }

    public function show_user()
    {
        $usuario = Auth::user();
        $roles = $usuario->getRoleNames();

        if ($roles->contains('alumno')) {
            $alumno = Alumno::where('id_usuario', $usuario->id)->first();
            $edad = $alumno ? $alumno->alumno_edad : null;
            $nombre = $alumno ? $alumno->alumno_nombre : null;
            $apellidos = $alumno ? $alumno->alumno_apellidos : null;
            return view('general.dashboard', compact('usuario', 'edad', 'nombre', 'apellidos'));
        } elseif ($roles->contains('docente')) {
            $docente = Docente::where('id_usuario', $usuario->id)->first();
            $edad = $docente ? $docente->docente_edad : null;
            $nombre = $docente ? $docente->docente_nombre : null;
            $apellidos = $docente ? $docente->docente_apellidos : null;
            return view('general.dashboard', compact('usuario', 'edad', 'nombre', 'apellidos'));
        } elseif ($roles->contains('admin') || $roles->contains('coordinador')){
            /*
            Hay que asegurarnos de mandar datos necesarios para los datos estadisticos, en este caso
            hay muy poco que mandar, así que por mi parte creo que podemos mandar directamente toda la
            tabla.
            */
            $alumnos = Alumno::All();
            $docentes = Docente::All();
            $gestion = Gestion::All();
            $admin =  $usuario;

            // Consulta para mostrar alumnos por sexo que esten cursando algún idioma
            $alumnos_inscritos = $alumnos->where('inscrito', 1);
            $conteo_alumnos = $alumnos->where('liberado', 1)->count();

            return view('administrador.dashboard', compact('admin', 'gestion', 'alumnos', 'docentes', 'alumnos_inscritos', 'conteo_alumnos'));
        }
    }
}
