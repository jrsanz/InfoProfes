<?php

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
Route::resource('profesor', ProfesorController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
