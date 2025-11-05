<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;
// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\MessageController;
Route::middleware('auth')->group(function () {
    Route::get('/kapcsolat', [MessageController::class, 'showForm'])->name('kapcsolat.form');
    Route::post('/kapcsolat', [MessageController::class, 'store'])->name('kapcsolat.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/uzenetek', [MessageController::class, 'index'])->name('uzenetek.index');
});

use App\Http\Controllers\DiagramController;
Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram');

use App\Http\Controllers\AdatbazisController;
Route::get('/adatbazis', [AdatbazisController::class, 'index'])->name('adatbazis');

use App\Http\Controllers\PizzaController;
Route::resource('pizzak', PizzaController::class)->middleware('auth');
use App\Http\Controllers\AdminController;