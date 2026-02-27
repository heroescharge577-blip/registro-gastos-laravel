<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;

Route::get('/', [GastoController::class, 'index'])->name('gastos.index');

Route::post('/gasto', [GastoController::class, 'store'])->name('gastos.store');

Route::post('/gastos/limpiar', function () {
    session()->forget('gastos');
    return redirect()->route('gastos.index');
})->name('gastos.limpiar');
