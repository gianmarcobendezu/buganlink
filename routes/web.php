<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExtranetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/facturas', function () {
    return view('facturas.index');
})->middleware('auth')->name('facturas.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/api/v1/extranet.listar',                  [ExtranetController::class, 'listar']);
    Route::post('/api/v1/extranet.guardar',                 [ExtranetController::class, 'guardar']);
    Route::post('/api/v1/extranet.editar',                  [ExtranetController::class, 'editar']);
    Route::post('/api/v1/extranet.subirarchivo',            [ExtranetController::class, 'subirarchivo']);
    Route::get('/api/v1/extranet.listararchivos/{id}',      [ExtranetController::class, 'listararchivos']);
    Route::delete('/api/v1/extranet.eliminararchivo/{id}',  [ExtranetController::class, 'eliminararchivo']);
    Route::post('/api/v1/extranet.subirpago',               [ExtranetController::class, 'subirpago']);
    Route::post('/api/v1/extranet.eliminarpago',            [ExtranetController::class, 'eliminarpago']);

});



require __DIR__.'/auth.php';
