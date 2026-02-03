@extends('layouts.layout_prin')
@section('title', 'Actualizar Curso')
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/actualiza_grupo.css') }}">
@endsection
@section('contenido')
    <div class="container-">
        <h2>Actualizar Curso</h2>
        <form action="{{ route('admin.update_curso', $curso->id_curso) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tipo_curso">Tipo de curso:</label>
                <select name="tipo_curso" id="tipo_curso" class="form-control">
                    <option value="Online" {{ $curso->tipo_curso == "Online" ? 'selected' : '' }}>Online</option>
                    <option value="Presencial" {{ $curso->tipo_curso == "Presencial" ? 'selected' : '' }}>Presencial</option>
                </select>
            </div>
            <div class="form-group">
                <label for="docente_curso">Docente:</label>
                <select name="docente_curso" id="docente_curso" class="form-control">
                    <option value="" selected>...</option>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id_docente }}"
                            {{ $curso->id_docente == $docente->id_docente ? 'selected' : '' }}>
                            {{ $docente->docente_nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="modelo_curso">Modelo del curso:</label>
                <input type="text" name="modelo_curso" id="modelo_curso" class="form-control"
                    value="{{ $curso->modelo_curso }}" required>
            </div>
            <div class="form-group">
                <label for="modulo_curso">Módulo del curso:</label>
                    <select id="modulo_curso" name="modulo_curso">
                        <option value="{{ $curso->nivel->id }}" selected>{{ $curso->nivel->nombre_nivel }} ({{ $curso->nivel->mcr_nivel }})</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}">{{ $nivel->nombre_nivel }} ({{ $nivel->mcr_nivel }})</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label for="nombre_tms_curso">Nombre TMS del curso:</label>
                <input type="text" name="nombre_tms_curso" id="nombre_tms_curso" class="form-control"
                    value="{{ $curso->nombre_tms_curso }}" required>
            </div>
            <div class="form-group">
                <label for="inicio_curso">Fecha de inicio del curso:</label>
                <input type="date" name="inicio_curso" id="inicio_curso" class="form-control"
                    value="{{ $curso->inicio_curso }}" required>
            </div>
            <div class="form-group">
                <label for="fin_curso">Fecha de fin del curso:</label>
                <input type="date" name="fin_curso" id="fin_curso" class="form-control"
                    value="{{ $curso->fin_curso }}" required>
            </div>
            <div class="form-group">
                <label for="dias_curso">Días del curso:</label>
                <input type="text" name="dias_curso" id="dias_curso" class="form-control"
                    value="{{ $curso->dias_curso }}">
            </div>
            <div class="form-group">
                <label for="horario_curso">Horario del curso:</label>
                <input type="text" name="horario_curso" id="horario_curso" class="form-control"
                    value="{{ $curso->horario_curso }}">
            </div>
            <div class="form-group">
                <label for="cupo_curso">Cupo del curso:</label>
                <input type="number" name="cupo_curso" id="cupo_curso" class="form-control"
                    value="{{ $curso->cupo_curso }}">
            </div>
            <div class="form-group">
                <label for="clases_via_curso">Clases vía curso:</label>
                <input type="text" name="clases_via_curso" id="clases_via_curso" class="form-control"
                    value="{{ $curso->clases_via_curso }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
