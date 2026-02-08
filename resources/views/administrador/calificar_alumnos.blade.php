@extends('layouts.layout_prin')
@section('title', 'Calificaciones')
@section('estilos')
<link rel="stylesheet" href="{{ asset('css/calificaciones.css') }}">
@endsection
@section('contenido')
<div class="container-">
    <h2>Gestión de Calificaciones</h2>
    <h3>Información del Alumno</h3>
    <label for="nombre_alumno">Nombre:</label>
    <input type="text" name="nombre_alumno" value="{{ $alumno->nombre_alumno . ' ' . $alumno->apellidos_alumno }}" disabled>
    <br>
    <label for="matricula_alumno">Matrícula:</label>
    <input type="text" name="matricula_alumno" value="{{ $alumno->matricula_alumno }}" disabled>
    <br>

    <h3>Kardex</h3>
    <button id="btn-abrir-modal" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
        </svg></button>

    <dialog id="modal" class="modal">
        <button id="btn-cerrar-modal" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg></button>
        <h2>Registrar Curso</h2>
        <form action="{{ route('admin.calificaciones.create', $alumno->id_alumno) }}" method="POST" class="form-agregar">
            @csrf
            <div id="datos_generales" class="contenedor-info-general">
                <h3>Datos de la calificación</h3>
                <label for="nivel">Nivel del cursado:</label>
                <select id="nivel" name="nivel">
                    <option value="" selected>...</option>
                    @foreach ($niveles as $nivel)
                    <option value="{{ $nivel->id }}">{{ $nivel->nombre_nivel }} ({{ $nivel->mcr_nivel }})</option>
                    @endforeach
                </select>
                <br>
                <label for="periodo">Periodo:</label>
                <input type="text" id="periodo" name="periodo" required>
                <br>
                <label for="calificacion">Calificación:</label>
                <input type="number" id="calificacion" name="calificacion" min="0" max="100" required>
                <br>
            </div>
            <button type="submit" id="button_enviar" class="button_enviar">Agregar</button>
        </form>
    </dialog>
    <table>
        <thead>
            <tr>
                <th>Nivel</th>
                <th>Calificación</th>
                <th>Periodo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumno->kardex as $registro)
            <tr>
                <td>
                    <p>{{ $registro->nivel->nombre_nivel }}</p>
                </td>
                <td>
                    <form action="{{ route('admin.calificaciones.update', $registro->id) }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
                        @csrf
                        @method('PUT')
                        <input type="number" name="calificacion" value="{{ $registro->calificacion }}" min="0" max="100" required style="flex: 1;">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z" />
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                            </svg>
                        </button>
                    </form>
                </td>
                <td>
                    <p>{{ $registro->periodo }}</p>
                </td>
                <td>
                    <p>{{ $registro->estado }}</p>
                </td>
                <td>
                    <form action="{{ route('admin.calificaciones.delete', $registro->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
</tbody>
</table>
</div>
<script src="{{ asset('js/modal.js') }}"></script>
<script>
    //Modales
    document.addEventListener("DOMContentLoaded", function() {
        setupModal("#btn-abrir-modal", "#modal", "#btn-cerrar-modal");
    });

</script>
@endsection
