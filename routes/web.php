<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\mail\ContactoController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\ShowTypes;
use App\Livewire\ShowUserCourses;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('courses', ShowUserCourses::class)->name('courses');
    
    Route::resource('tags', TagController::class)->middleware(AdminMiddleware::class);
    Route::get('types', ShowTypes::class)->name('show.types')->middleware(AdminMiddleware::class);
});

Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('contacto', [ContactoController::class, 'send'])->name('contacto.send');
