<?php

use Illuminate\Support\Facades\Route;

// Rota pública principal
Route::get('/', function () {
    return view('welcome', [
        'admin_url' => url('/admin') // URL genérica para o painel
    ]);
})->name('home');

// Rotas de autenticação padrão (opcional)
Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
