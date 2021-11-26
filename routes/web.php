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
    return view('welcome');
});

Route::get('/profesor/showAllDP', [ProfesorController::class, 'show_all_dp'])->name('profesor.showAllDP');
Route::get('/profesor/showAllDE', [ProfesorController::class, 'show_all_de'])->name('profesor.showAllDE');
Route::get('/profesor/showAllDC', [ProfesorController::class, 'show_all_dc'])->name('profesor.showAllDC');
Route::get('/profesor/search', [ProfesorController::class, 'search'])->name('profesor.search');
Route::get('/profesor/{profesor}/evaluate', [ProfesorController::class, 'evaluate'])->name('profesor.evaluate');
Route::post('/profesor/{profesor}/evaluate', [ProfesorController::class, 'evaluation'])->name('profesor.evaluation');
Route::resource('profesor', ProfesorController::class);

//Ruta Admin
Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('dashboard/{admin}/profesor/showAllDP', [ProfesorController::class, 'show_all_dp'])->name('admin.profesorShowAllDP');
Route::get('dashboard/{admin}/profesor/showAllDE', [ProfesorController::class, 'show_all_de'])->name('admin.showAllDE');
Route::get('dashboard/{admin}/profesor/showAllDC', [ProfesorController::class, 'show_all_dc'])->name('admin.showAllDC');
Route::get('dashboard/{admin}/profesor/search', [ProfesorController::class, 'search'])->name('admin.search');
Route::get('dashboard/{admin}/profesor/{profesor}/evaluate', [ProfesorController::class, 'evaluate'])->name('admin.evaluate');
Route::post('dashboard/{admin}/profesor/{profesor}/evaluate', [ProfesorController::class, 'evaluation'])->name('admin.evaluation');
Route::resource('admin', AdminController::class);

//Ruta User
Route::middleware(['auth:sanctum', 'verified', 'user'])->get('/user', function () {
    return view('dashboard_user');
})->name('user');
