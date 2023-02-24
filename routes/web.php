<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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
Route::get('/', function () {
    return Response::HTTP_OK;
});
Route::get('/data/all', [\App\Http\Controllers\DataController::class, 'index']);
Route::get('/data/{id}', [\App\Http\Controllers\DataController::class, 'show'])->name('data.show');
