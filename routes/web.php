<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditoraController;
use App\Http\Controllers\GeneroController;
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

    Route::get('/generos', [GeneroController::class, 'index'])->name('generos.index');
    Route::get('/generos/novo', [GeneroController::class, 'create'])->name('generos.create');
    Route::post('/generos', [GeneroController::class, 'store'])->name('generos.store');
    Route::get('/generos/{id}/editar', [GeneroController::class, 'edit'])->name('generos.edit');
    Route::put('/generos/{id}', [GeneroController::class, 'update'])->name('generos.update');
    Route::delete('/generos/{id}', [GeneroController::class, 'destroy'])->name('generos.destroy');

    Route::get('/editoras', [EditoraController::class, 'index'])->name('editoras.index');
    Route::get('/editoras/novo', [EditoraController::class, 'create'])->name('editoras.create');
    Route::post('/editoras', [EditoraController::class, 'store'])->name('editoras.store');
    Route::get('/editoras/{id}/editar', [EditoraController::class, 'edit'])->name('editoras.edit');
    Route::put('/editoras/{id}', [EditoraController::class, 'update'])->name('editoras.update');
    Route::delete('/editoras/{id}', [EditoraController::class, 'destroy'])->name('editoras.destroy');
});