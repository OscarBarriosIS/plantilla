<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FormularioController;


use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacacionesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FestividadController;
use App\Http\Controllers\OcrController;
use App\Http\Controllers\SepomexController;
use App\Http\Controllers\TicketController;
use Illuminate\Auth\Events\Authenticated;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/recuperarContrase', function () {
    return view('perfil.RecuperarContrase');
})->name('recuperarContrase');

Route::post('/recover', [ForgotPasswordController::class, 'recover'])->name('password.recover');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //perfil

    Route::get('/perfil', [AuthenticatedSessionController::class, 'showProfile'])->name('perfil.show');
    Route::put('/perfil/password', [AuthenticatedSessionController::class, 'updatePassword'])->name('perfil.password.update');

    // Ruta para el Dashboard
    Route::get('/formulario_alta', [FormularioController::class, 'showFormulario'])->name('form');
    Route::get('/formulario_consulta', [FormularioController::class, 'showFormularioConsulta'])->name('form_consulta');
    Route::get('/formulario_ine/{id}', [FormularioController::class, 'getIneDetails'])->name('ine.details');

    //Ruta para actualizar el formulario
    Route::put('/formulario_ine/{id}', [FormularioController::class, 'updateIne'])->name('ine.update');
    Route::delete('/formulario_ine/{id}', [FormularioController::class, 'deleteIne'])->name('ine.delete');

    Route::post('/guardarINE', [AppController::class, 'guardarINE'])->name('guardarINE');

    // Usuarios
    Route::resource('/user', UserController::class);
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

//OCR
Route::middleware(['auth', 'verified'])->post('procesar_ine', [OcrController::class, 'procesar_ine'])->name('procesar_ine');


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loginn');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registerNel', [LoginController::class, 'showForm'])->name('registerNel');
Route::get('/registro', [LoginController::class, 'showForm2'])->name('registro');

// Cambiar la ruta POST a '/register' para que coincida con la GET
Route::post('/registerNel', [LoginController::class, 'register']);
Route::post('/registro_usuarios', [LoginController::class, 'register2'])->name('registro_usuarios');









Route::put('/actualizar-datos-perfil/{id}', [UserController::class, 'updateProfileData'])->name('update-profile-data');
Route::get('/cambiar-datos-perfil/{id}', [UserController::class, 'showChangeProfileData'])->name('change-profile-data');

Route::get('/ver-users', [UserController::class, 'index'])->name('ver_users');
Route::get('/editar-user/{id}', [UserController::class, 'edit'])->name('edit_user');
Route::put('/actualizar-user/{id}', [UserController::class, 'update'])->name('update_user');

Route::get('/users/{id}', [UserController::class, 'show'])->name('show_user');
// Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('delete_user');


Route::get('/activity/{id}', [UserController::class, 'showActivity']);


Route::get('/colonias/{cp}', [SepomexController::class, 'getColonias'])->middleware(['auth', 'verified'])->name('colonias.get');

/* Privacidad */
Route::get('privacidad', function () {
    return view('privacidad');
})->name('privacidad');
