<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\CrudCursosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\ArchivosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Página Principal
Route::view('/', 'index')->name('index');

// Grupo para ALUMNOS (con middleware 'auth')
Route::prefix('alumno')->name('alumno.')->middleware('auth')->group(function () {
    Route::view('/inscripcion', 'alumno.inscripcion')->name('inscripcion');
    Route::view('/kardex', 'alumno.kardex')->name('kardex');
    Route::view('/informacion-personal', 'alumno.informacion_personal_alumno')->name('info_personal');
    Route::view('/grupo-inscrito', 'alumno.grupo_inscrito')->name('grupo_inscrito');
    Route::view('/secciones', 'alumno.secciones')->name('secciones');
});

// Grupo para ADMINISTRADORES (también con middleware 'auth')
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Para dashboard
    Route::get('/dashboard', [UserController::class,'show_user'])->name('dashboard');
    // Crud Usuarios - completo
    Route::post('/registrar-usuario', [CrudController::class, 'create'])->name('registrar-usuario');
    Route::delete('/borrar_usuarios/{id}', [CrudController::class, 'delete'])->name('usuarios.delete');
    Route::get('/registro', [CrudController::class, 'read'])->name('registro');
    Route::get('/actualiza_usuario/{id}', [CrudController::class, 'update'])->name('actualiza_usuario');
    Route::put('/update_alumno/{tipo}/{id_alumno}', [CrudController::class, 'update_alumno'])->name('update_alumno');
    Route::put('/update_docente/{tipo}/{id_docente}', [CrudController::class, 'update_docente'])->name('update_docente');
    //Crud Cursos - completo
    Route::post('/registrar-curso', [CrudCursosController::class, 'create'])->name('registrar-curso');
    Route::delete('/borrar_curso/{id}', [CrudCursosController::class, 'delete'])->name('cursos.delete');
    Route::get('/registro_cursos', [CrudCursosController::class, 'read'])->name('registro_cursos');
    Route::get('/actualiza_curso/{id}', [CrudCursosController::class, 'update'])->name('actualiza_curso');
    Route::put('/update_curso/{id}', [CrudCursosController::class, 'update_curso'])->name('update_curso');
    //Inscripciones - completo
    Route::post('/inscripciones/{id_alumno}/{id_curso}', [InscripcionController::class, 'create'])->name('inscripciones.create');
    Route::delete('/inscripciones/{id_alumno}/{id_curso}', [InscripcionController::class, 'delete'])->name('inscripciones.delete');
    Route::get('/inscripciones/{id}', [InscripcionController::class, 'inscribirAdministrativo'])->name('inscribir');
    //Calificaciones - incompleto
    Route::post('/calificaciones/{id_alumno}', [KardexController::class, 'create'])->name('calificaciones.create');
    Route::delete('/calificaciones/{id_kardex}', [KardexController::class, 'delete'])->name('calificaciones.delete');
    Route::get('/calificaciones/{id_alumno}', [KardexController::class, 'show'])->name('calificaciones.show');
    Route::put('/calificaciones/{id_kardex}', [KardexController::class, 'update'])->name('calificaciones.update');
    //Gestión de los cursos
    Route::get('/gestion', [GestionController::class, 'read'])->name('gestion');
    Route::put('/update_gestion/{id}', [GestionController::class, 'update'])->name('gestion.update');
    //Archivos - incompleto (revisar después y complementar)
    Route::get('/archivos/{id}/download', [ArchivosController::class, 'download'])->name('descargar-archivo');
    Route::post('/subir-archivo/{id_usuario}', [ArchivosController::class, 'store'])->name('subir-archivo');
});

// Grupo para Vistas Generales con auttenticación
Route::prefix('general')->name('general.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'show_user'])->name('dashboard');
});

// Grupo para Vistas Generales
Route::prefix('general')->name('general.')->group(function () {
    Route::view('/inicio-sesion', 'general.inicio_sesion')->name('inicio_sesion');

    // Login y logout de usuarios
    Route::post('/validar-login', [LoginController::class, 'login'])->name('validar-login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // POST es la mejor práctica para logout
});

Route::get('/instalar-base-datos', function () {
    try {
        \Artisan::call('migrate', ['--force' => true]);
        return '¡ÉXITO! Las tablas se han creado correctamente en Supabase.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/sembrar-todo', function () {
    try {
        Artisan::call('db:seed', [
            '--force' => true // Obligatorio para producción
        ]);
        
        return 'Base de datos poblada al 100% (Usuarios, Roles, Carreras y Cursos).';
    } catch (\Exception $e) {
        return 'Hubo un error: ' . $e->getMessage();
    }
});


