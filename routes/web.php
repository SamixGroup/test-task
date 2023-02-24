<?php

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

Route::get('/data/all', [\App\Http\Controllers\DataController::class, 'index']);
Route::delete('/data/{id}', [\App\Http\Controllers\DataController::class, 'delete'])->name('data.delete');
Route::get('/data/{id}', [\App\Http\Controllers\DataController::class, 'show'])->name('data.show');
