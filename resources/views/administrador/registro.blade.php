@extends('layouts.layout_prin')
@section('title', 'Usuarios')
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
@endsection
@section('contenido')
    <div class="container-">
        <h2>Gestión de usuarios</h2>

        <div class="opciones">
            @can('crear usuarios')
                <button id="btn-abrir-modal" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                    </svg></button>
            @endcan
            @can('ver usuarios')
                <form method="GET" action="{{ route('admin.registro') }}">
                    @csrf
                    <label for="tipo">Tabla a mostrar</label>
                    <select name="tipo" id="tipo" onchange="this.form.submit()">
                        @can('ver alumnos')
                            <option value="alumnos" {{ request('tipo') == 'alumnos' ? 'selected' : '' }}>Alumnos</option>
                        @endcan
                        @can('ver docentes')
                            <option value="docentes" {{ request('tipo') == 'docentes' ? 'selected' : '' }}>Docentes</option>
                        @endcan
                    </select>
                    <div class="search-bar">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Buscar por nombre, apellido o matrícula" autocomplete="off">
                        <button type="submit" class="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </div>
                </form>
            @endcan
        </div>

        <dialog id="modal" class="modal">
            <button id="btn-cerrar-modal" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg></button>
            <h2>Registrar usuario</h2>
            <form action="{{ route('admin.registrar-usuario') }}" method="POST" class="form-agregar">
                @csrf
                <div>
                    <h3>Tipo de usuario:</h3>
                    <select id="tipo_usuario" name="tipo_usuario" onchange="mostrarFormulario()"
                        value="{{ old('tipo_usuario') }}">
                        <option value="" selected>...</option>
                        @can('crear admins')
                            <option value="admin">Administrador</option>
                        @endcan
                        @can('crear alumnos')
                            <option value="alumno">Alumno</option>
                        @endcan
                        @can('crear docentes')
                            <option value="docente">Docente</option>
                        @endcan
                    </select>
                </div>

                <div id="datos_generales" style="display:none" class="contenedor-info-general">
                    <h3>Datos Generales</h3>
                    <label for="usuario_telefono">Número de teléfono:</label>
                    <input type="number" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}"
                        placeholder="Escribe el número de teléfono">
                    <br>
                    @error('phonenumber')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="nombre">Nombre(s):</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Escribe el nombre(s)">
                    <br>
                    @error('nombre')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="apellidos">Apellido(s):</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}"
                    placeholder="Escribe el apellido(s)">
                    <br>
                    @error('apellidos')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" value="{{ old('sexo') }}">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    @error('sexo')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" value="{{ old('edad') }}" placeholder="Escribe la edad">
                    <br>
                    @error('edad')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                </div>
                <div id="alumnoForm" style="display:none" class="contenedor-info-alumno">
                    <h3>Alumno Datos</h3>
                    <label for="numero_control">Numero de control:</label>
                    <input type="text" id="numero_control" name="numero_control" value="{{ old('numero_control') }}"
                        placeholder="Escribe el número de control">
                    <br>
                    @error('numero_control')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="semestre">Semestre:</label>
                    <input type="number" id="semestre" name="semestre" value="{{ old('semestre') }}"
                        placeholder="Escribe el semestre">
                    <br>
                    @error('semestre')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="caarrera">Carrera: </label>
                    <select name="carrera" id="carrera" value="{{ old('carrera') }}">
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{ $carrera->nombre_carrera }}</option>
                        @endforeach
                    </select>
                    @error('carrera')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="nivel">Nivel: </label>
                    <select name="nivel" id="nivel" value="{{ old('nivel') }}">
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}">{{ $nivel->nombre_nivel }}</option>
                        @endforeach
                    </select>
                    @error('nivel')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="verificado" value="{{ old('verificado') }}">Chek Lists:</label>
                    <select name="verificado" id="verificado">
                        <option value="1">Verificado</option>
                        <option value="0">No verificado</option>
                    </select>
                </div>

                <div id="adminForm" style="display:none">
                </div>

                <div id="maestroForm" style="display:none" class="contenedor-info-docente">
                    <h3>Docente Datos</h3>
                    <label for="email">Correo eletrónico:</label>
                    <input type="text" id="email" name="email"
                        value="{{ old('email') }}" placeholder="Escribe el email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="numero_trabajador">Numero de trabajador:</label>
                    <input type="text" id="numero_trabajador" name="numero_trabajador"
                        value="{{ old('numero_trabajador') }}" placeholder="Escribe el número de trabajador">
                    @error('numero_control')
                        <span class="error">{{ $message }}</span>
                        <br>
                    @enderror
                </div>
                <button type="submit" id="button_enviar" style="display:none" class="button_enviar">Agregar</button>
            </form>
        </dialog>
        @if ($tipo == 'alumnos')
            <h3>Alumnos</h3>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Número de control</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $alumno)
                        <tr>
                            <td class="infor">{{ $alumno->matricula_alumno }}</td>
                            <td class="infor">{{ $alumno->carrera->nombre_carrera ?? 'Sin carrera' }}</td>
                            <td class="infor">{{ $alumno->semestre_alumno }}</td>
                            <td class="infor">{{ $alumno->nombre_alumno }} {{ $alumno->apellidos_alumno }}</td>
                            <td class="infor">{{ $alumno->sexo_alumno }}</td>
                            <td class="infor">{{ $alumno->edad_alumno }}</td>
                            <td>
                                <div class="gestionar">
                                    <form method="GET" action="{{ route('admin.actualiza_usuario', $alumno->id_usuario) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg></button>
                                    </form>
                                    <form action="{{ route('admin.usuarios.delete', $alumno->id_usuario) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro?')"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z" />
                                            </svg></button>
                                    </form>
                                    <form method="GET" action="{{ route('admin.calificaciones.show', $alumno->id_alumno) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-journal" viewBox="0 0 16 16">
                                                <path
                                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                                <path
                                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif ($tipo == 'docentes')
            <h3>Docentes</h3>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Número de trabajador</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $docente)
                        <tr>
                            <td class="infor">{{ $docente->docente_clave }}</td>
                            <td class="infor">{{ $docente->docente_nombre }} {{ $docente->docente_apellidos }}</td>
                            <td class="infor">{{ $docente->docente_sexo }}</td>
                            <td class="infor">{{ $docente->docente_edad }}</td>
                            <td class="infor">
                                <div class="gestionar">
                                    <form method="GET" action="{{ route('admin.actualiza_usuario', $docente->id_usuario) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg></button>
                                    </form>
                                    <form action="{{ route('admin.usuarios.delete', $docente->id_usuario) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro?')"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z" />
                                            </svg></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Paginación -->
        {{ $data->appends(['tipo' => $tipo, 'search' => $search])->links('vendor.pagination.custom') }}

        <script src="{{ asset('js/modal.js') }}"></script>
        <script>
            //Modales
            document.addEventListener("DOMContentLoaded", function () {
                setupModal("#btn-abrir-modal", "#modal", "#btn-cerrar-modal");
            });
        </script>
        <script src="{{ asset('js/crud_usuarios.js') }}"></script>
@endsection
    @section('scripts')

    @endsection
