<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::middleware('checkIsNotLogged')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('checkIsLogged')->group(function () {

    Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
    Route::get('/autores/novo', [AutorController::class, 'create'])->name('autores.create');
    Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
    Route::get('/autores/{id}/editar', [AutorController::class, 'edit'])->name('autores.edit');
    Route::put('/autores/{id}', [AutorController::class, 'update'])->name('autores.update');
    Route::delete('/autores/{id}', [AutorController::class, 'destroy'])->name('autores.destroy');

    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/livros/novo', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
    Route::get('/livros/{id}/editar', [LivroController::class, 'edit'])->name('livros.edit');
    Route::put('/livros/{id}', [LivroController::class, 'update'])->name('livros.update');
    Route::delete('/livros/{id}', [LivroController::class, 'destroy'])->name('livros.destroy');
});