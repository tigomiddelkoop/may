<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// This only exists to test the app with, this route will dissappear
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/auth')->group(function () {
    Route::post('/login');
    Route::post('/forgot-password');
});

Route::prefix('/expenses')->group(function () {

});

Route::prefix('/vehicles')->group(function () {
    Route::prefix('/overview')->group(function () {
        Route::get('/');
        Route::get('/{licence_plate}');
    });
});

Route::prefix('/fuels')->group(function () {

});

Route::prefix('/locations')->group(function () {

});

Route::prefix('/routes')->group(function () {

});

