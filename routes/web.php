<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NameController;

Route::get('/', [NameController::class, 'index'])->name('name.index');
Route::post('/', [NameController::class, 'store'])->name('name.store');
Route::get('/{id}/edit', [NameController::class, 'edit'])->name('name.edit');
Route::put('/{id}', [NameController::class, 'update'])->name('name.update');
Route::delete('/{id}', [NameController::class, 'destroy'])->name('name.destroy');