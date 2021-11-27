<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfesorController;
use App\Models\Profesor;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('profesor.index');
});

Route::get('/profesor/showAllDP', [ProfesorController::class, 'show_all_dp'])->name('profesor.showAllDP');
Route::get('/profesor/showAllDE', [ProfesorController::class, 'show_all_de'])->name('profesor.showAllDE');
Route::get('/profesor/showAllDC', [ProfesorController::class, 'show_all_dc'])->name('profesor.showAllDC');
Route::get('/profesor/search', [ProfesorController::class, 'search'])->name('profesor.search');
Route::get('/profesor/{profesor}/evaluate', [ProfesorController::class, 'evaluate'])->name('profesor.evaluate');
Route::post('/profesor/{profesor}/evaluate', [ProfesorController::class, 'evaluation'])->name('profesor.evaluation');
Route::get('/profesor/{profesor}/createMateria', [ProfesorController::class, 'create_materia'])->name('profesor.createMateria');
Route::post('/profesor/{profesor}/storeMateria', [ProfesorController::class, 'store_materia'])->name('profesor.storeMateria');
Route::get('/profesor/miPerfil', [ProfesorController::class, 'mi_perfil'])->name('profesor.miPerfil');
Route::patch('/profesor/miPerfil/{usuario}/update', [ProfesorController::class, 'update_mi_perfil'])->name('profesor.updateMiPerfil');
Route::resource('profesor', ProfesorController::class);

//Ruta Admin
Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/dashboard', function () {
    return redirect()->route('admin.index');
})->name('dashboard');

Route::get('/admin/profesor/create', [AdminController::class, 'profesor_create'])->name('admin.profesorCreate');
Route::post('/admin/profesor/store', [AdminController::class, 'profesor_store'])->name('admin.profesorStore');
Route::get('/admin/profesor/{profesor}/edit', [AdminController::class, 'profesor_edit'])->name('admin.profesorEdit');
Route::patch('/admin/profesor/{profesor}/update', [AdminController::class, 'profesor_update'])->name('admin.profesorUpdate');
Route::delete('/admin/profesor/delete/{profesor}', [AdminController::class, 'profesor_delete'])->name('admin.profesorDelete');
Route::get('/admin/profesor/show/{profesor}', [AdminController::class, 'profesor_show'])->name('admin.profesorShow');
Route::get('/admin/profesor/showAllDP', [AdminController::class, 'show_all_dp'])->name('admin.profesorShowAllDP');
Route::get('/admin/profesor/showAllDE', [AdminController::class, 'show_all_de'])->name('admin.profesorShowAllDE');
Route::get('/admin/profesor/showAllDC', [AdminController::class, 'show_all_dc'])->name('admin.profesorShowAllDC');
Route::get('/admin/usuarios', [AdminController::class, 'user_all'])->name('admin.usuarios');
Route::get('/admin/profesor/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/admin/profesor/find', [AdminController::class, 'profesor_find'])->name('admin.find');
Route::get('/admin/profesor/{profesor}/evaluate', [AdminController::class, 'evaluate'])->name('admin.evaluate');
Route::post('/admin/profesor/{profesor}/evaluate', [AdminController::class, 'evaluation'])->name('admin.evaluation');
Route::get('/admin/usuario/{usuario}/edit', [AdminController::class, 'usuario_edit'])->name('admin.usuarioEdit');
Route::patch('/admin/usuario/{usuario}/update', [AdminController::class, 'usuario_update'])->name('admin.usuarioUpdate');
Route::get('/admin/reporteUsuarios', [AdminController::class, 'reporte_usuarios'])->name('admin.reporteUsuarios');
Route::get('/admin/reporteProfesores', [AdminController::class, 'reporte_profesores'])->name('admin.reporteProfesores');
Route::get('/admin/profesor/show/{profesor}/createMateria', [AdminController::class, 'create_materia'])->name('admin.createMateria');
Route::post('/admin/profesor/show/{profesor}/storeMateria', [AdminController::class, 'store_materia'])->name('admin.storeMateria');
Route::get('/admin/miPerfil', [AdminController::class, 'mi_perfil'])->name('admin.miPerfil');
Route::patch('/admin/miPerfil/{usuario}/update', [AdminController::class, 'update_mi_perfil'])->name('admin.updateMiPerfil');
Route::resource('/admin', AdminController::class);

//Ruta User
Route::middleware(['auth:sanctum', 'verified', 'usuario'])->get('/usuario', function () {
    return redirect()->route('profesor.index');
})->name('usuario');
