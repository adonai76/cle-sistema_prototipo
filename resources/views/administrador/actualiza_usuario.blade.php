@extends('layouts.layout_prin')
@section('title', 'Usuarios')
@section('estilos')
<link rel="stylesheet" href="{{ asset('css/actualiza_usuario.css') }}">
@endsection
@section('contenido')
<div class="container-">
    <h2>Información del usuario</h2>
    @if ($tipo == 'alumno')
    <form action="{{ route('admin.update_alumno', ['tipo', 'id_alumno' => $data_alumno->id_alumno]) }}" method="POST">
        @csrf
        @method('PUT')
        <h3>Datos de usuario</h3>
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" name="nombre" value="{{ $usuario->name }}" placeholder="Nombre de usuario">
        <br>
        <label for="correo">Correo del usuario:</label>
        <input type="email" name="correo" value="{{ $usuario->email }}" placeholder="Correo de usuario">
        <br>
        <label for="telefono">Correo del usuario:</label>
        <input type="text" name="telefono" value="{{ $usuario->phonenumber }}" placeholder="Correo de usuario">
        <br>
        <!--<label for="contraseña">Contraseña:</label>
                                                                                                            <input type="password" name="contraseña" value="{{ $usuario->password }}" placeholder="Contraseña">
                                                                                                            <label for="comfirma">Confirma contraseña:</label>
                                                                                                            <input type="password" name="confirma" placeholder="Contraseña">-->
        <br>
        <h3>Datos del alumno</h3>
        <label for="matricula_alumno">Matrícula:</label>
        <input type="text" name="matricula_alumno" value="{{ $data_alumno->matricula_alumno }}" placeholder="Matrícula del alumno">
        <br>
        <label for="carrera_alumno">Carrera:</label>
        <input type="text" name="carrera_alumno" value="{{ $data_alumno->carrera->nombre_carrera }}" placeholder="Carrera del alumno" disabled>
        <br>
        <label for="plan_estudio_carrera">Plan de estudios:</label>
        <input type="text" name="plan_estudios_carrera" value="{{ $data_alumno->carrera->plan_estudios_carrera }}" placeholder="Plan de estudios del alumno" disabled>
        <br>
        <label for="semestre_alumno">Semestre:</label>
        <input type="text" name="semestre_alumno" value="{{ $data_alumno->semestre_alumno }}" placeholder="Semestre del alumno">
        <br>
        <label for="nombre_alumno">Nombre del alumno:</label>
        <input type="text" name="nombre_alumno" value="{{ $data_alumno->nombre_alumno }}" placeholder="Nombre del alumno">
        <br>
        <label for="apellidos_alumno">Apellidos:</label>
        <input type="text" name="apellidos_alumno" value="{{ $data_alumno->apellidos_alumno }}" placeholder="Apellidos del alumno">
        <br>
        <label for="edad_alumno">Edad:</label>
        <input type="number" name="edad_alumno" value="{{ $data_alumno->edad_alumno }}" placeholder="Edad del alumno">
        <br>
        <label for="sexo_alumno">Sexo:</label>
        <select name="sexo_alumno" id="sexo_alumno">
            <option value="Masculino" @if ($data_alumno->sexo_alumno == 'Masculino') selected @endif>Masculino
            </option>
            <option value="Femenino" @if ($data_alumno->sexo_alumno == 'Femenino') selected @endif>Femenino
            </option>
        </select>
        <br>
        <label for="nivel">Nivel del alumno:</label>
        <select name="nivel" id="nivel">
            <option value="">Selecciona un nivel...</option>
            @if(isset($niveles))
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id }}" @if($data_alumno->id_nivel == $nivel->id) selected @endif>
                        {{ $nivel->nombre_nivel }} ({{ $nivel->mcr_nivel }})
                    </option>
                @endforeach
            @endif
        </select>
        <br>
        <label for="inscrito">Status de inscripción:
            @if ($data_alumno->inscrito == 1)
            <p>Inscrito</p>
            @else
            <p>No inscrito</p>
            @endif
        </label>
        <br>
        <label for="acredita">Status de acreditación:
            @if ($data_alumno->acredita == 1)
            <p>Acrédita</p>
            @else
            <p>No acrédita</p>
            @endif
        </label>
        <label for="verificado">Verificado:</label>
        <select name="verificado" id="verificado">
            <option value="1" @if ($data_alumno->liberado == '1') selected @endif>Verificado
            </option>
            <option value="0" @if ($data_alumno->liberado == '0') selected @endif>No verificado
            </option>
        </select>
        <br>
        <button type="submit">Actualizar datos</button>
    </form>
    @elseif($tipo == 'docente')
    <form action="{{ route('admin.update_docente', ['tipo', 'id_docente' => $data_docente->id_docente]) }}" method="POST">
        @csrf
        @method('PUT')
        <h3>Datos de usuario</h3>
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" name="nombre" value="{{ $usuario->name }}" placeholder="Nombre de usuario">
        <br>
        <label for="correo">Correo del usuario:</label>
        <input type="email" name="correo" value="{{ $usuario->email }}" placeholder="Correo de usuario">
        <br>
        <label for="telefono">Correo del usuario:</label>
        <input type="text" name="telefono" value="{{ $usuario->phonenumber }}" placeholder="Correo de usuario">
        <br>
        <!--<label for="contraseña">Contraseña:</label>
                                                                                                            <input type="password" name="contraseña" value="{{ $usuario->password }}" placeholder="Contraseña">
                                                                                                            <label for="comfirma">Confirma contraseña:</label>
                                                                                                            <input type="password" name="confirma" placeholder="Contraseña">-->
        <br>
        <h3>Datos del Docente</h3>
        <label for="docente_clave">Clave del docente:</label>
        <input type="text" name="docente_clave" value="{{ $data_docente->docente_clave }}" placeholder="Clave del docente">
        <br>
        <label for="nombre_docente">Nombre del docente:</label>
        <input type="text" name="nombre_docente" value="{{ $data_docente->docente_nombre }}" placeholder="Nombre del docente">
        <br>
        <label for="apellidos_docente">Apellidos:</label>
        <input type="text" name="apellidos_docente" value="{{ $data_docente->docente_apellidos }}" placeholder="Apellidos del docente">
        <br>
        <label for="sexo_docente">Sexo:</label>
        <select name="sexo_docente" id="sexo_docente">
            <option value="Masculino" @if ($data_docente->docente_sexo == 'Masculino') selected @endif>Masculino
            </option>
            <option value="Femenino" @if ($data_docente->docente_sexo == 'Femenino') selected @endif>Femenino
            </option>
        </select>
        <br>
        <label for="edad_docente">Edad:</label>
        <input type="number" name="edad_docente" value="{{ $data_docente->docente_edad }}" placeholder="Edad del docente">
        <br>
        <button type="submit">Actualizar datos</button>
    </form>
    @endif
    <div class="documentos">
        <h2>
            @if($tipo == 'alumno')
            Portafolio del alumno
            @elseif($tipo == 'docente')
            Portafolio del alumno
            @endif
        </h2>
        <div>
            <form action="{{route('admin.subir-archivo', ['id_usuario' => $usuario->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="archivo">Selecciona un archivo (imagen o PDF):</label>
                <input type="file" name="archivo" required>
                <button type="submit">Subir</button>
            </form>
        </div>
        <div>
            @foreach($archivos as $archivo)
            <div style="margin-bottom: 20px;">
                <p>{{ $archivo->nombre }}</p>
                @if(Str::startsWith($archivo->tipo, 'image/'))
                <!-- Vista previa de imagen -->
                <img src="{{ asset('storage/' . $archivo->ruta) }}" alt="Vista previa" width="200">
                <a href="{{ route('admin.descargar-archivo', $archivo->id) }}" target="_blank">Descargar</a>
                @elseif($archivo->tipo === 'application/pdf')
                <!-- Vista previa PDF -->
                <iframe src="{{ asset('storage/' . $archivo->ruta) }}" width="auto" height="auto"></iframe>
                <a href="{{ route('admin.descargar-archivo', $archivo->id) }}" target="_blank">Descargar</a>
                @else
                <!-- Otros archivos solo descarga -->
                <a href="{{ route('admin.descargar-archivo', $archivo->id) }}" target="_blank">Descargar</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
