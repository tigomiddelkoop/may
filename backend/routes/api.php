<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Expense\DestroyController as ExpenseDestroyController;
use App\Http\Controllers\Expense\IndexController as ExpenseIndexController;
use App\Http\Controllers\Expense\ShowController as ExpenseShowController;
use App\Http\Controllers\Expense\StoreController as ExpenseStoreController;
use App\Http\Controllers\Expense\UpdateController as ExpenseUpdateController;
use App\Http\Controllers\Fuel\DestroyController as FuelDestroyController;
use App\Http\Controllers\Fuel\IndexController as FuelIndexController;
use App\Http\Controllers\Fuel\ShowController as FuelShowController;
use App\Http\Controllers\Fuel\StoreController as FuelStoreController;
use App\Http\Controllers\Fuel\UpdateController as FuelUpdateController;
use App\Http\Controllers\Location\DestroyController as LocationDestroyController;
use App\Http\Controllers\Location\IndexController as LocationIndexController;
use App\Http\Controllers\Location\ShowController as LocationShowController;
use App\Http\Controllers\Location\StoreController as LocationStoreController;
use App\Http\Controllers\Location\UpdateController as LocationUpdateController;
use App\Http\Controllers\Route\DestroyController as RouteDestroyController;
use App\Http\Controllers\Route\IndexController as RouteIndexController;
use App\Http\Controllers\Route\ShowController as RouteShowController;
use App\Http\Controllers\Route\StoreController as RouteStoreController;
use App\Http\Controllers\Route\UpdateController as RouteUpdateController;
use App\Http\Controllers\Vehicle\DestroyController as VehicleDestroyController;
use App\Http\Controllers\Vehicle\IndexController as VehicleIndexController;
use App\Http\Controllers\Vehicle\Overview\IndexController as VehicleOverviewIndexController;
use App\Http\Controllers\Vehicle\Overview\ShowController as VehicleOverviewShowController;
use App\Http\Controllers\Vehicle\ShowController as VehicleShowController;
use App\Http\Controllers\Vehicle\StoreController as VehicleStoreController;
use App\Http\Controllers\Vehicle\UpdateController as VehicleUpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Route
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// This only exists to test the app with, this route will dissappear
Route::get('/', function () {
    return [
        'title' => 'Welcome to May, a third generation Vehicle Tracking Tool',
        'version' => '0.0.1',
    ];
});

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/forgot-password', ForgotPasswordController::class)->name('forgot-password');
});

Route::middleware([])->group(function () {
    Route::prefix('/vehicles')->name('vehicles.')->group(function () {
        Route::prefix('/overview')->name('overview.')->group(function () {
            Route::get('/', VehicleOverviewIndexController::class)->name('index');
            Route::get('/{licence_plate}', VehicleOverviewShowController::class)->name('show');
        });

        Route::get('/', VehicleIndexController::class)->name('index');

        Route::get('/{id}', VehicleShowController::class)->name('show');
        Route::post('/', VehicleStoreController::class)->name('store');
        Route::patch('/{id}', VehicleUpdateController::class)->name('update');
        Route::delete('/{id}', VehicleDestroyController::class)->name('destroy');
    });

    Route::prefix('/fuels')->name('fuels.')->group(function () {
        Route::get('/', FuelIndexController::class)->name('index');

        Route::get('/{id}', FuelShowController::class)->name('show');
        Route::post('/', FuelStoreController::class)->name('store');
        Route::patch('/{id}', FuelUpdateController::class)->name('update');
        Route::delete('/{id}', FuelDestroyController::class)->name('destroy');

    });

    Route::prefix('/locations')->name('locations.')->group(function () {
        Route::get('/', LocationIndexController::class)->name('index');

        Route::get('/{id}', LocationShowController::class)->name('show');
        Route::post('/', LocationStoreController::class)->name('store');
        Route::patch('/{id}', LocationUpdateController::class)->name('update');
        Route::delete('/{id}', LocationDestroyController::class)->name('destroy');
    });

    Route::prefix('/expenses')->name('expenses.')->group(function () {
        Route::get('/', ExpenseIndexController::class)->name('index');

        Route::get('/{id}', ExpenseShowController::class)->name('show');
        Route::post('/', ExpenseStoreController::class)->name('store');
        Route::patch('/{id}', ExpenseUpdateController::class)->name('update');
        Route::delete('/{id}', ExpenseDestroyController::class)->name('destroy');
    });

    Route::prefix('/routes')->name('route.')->group(function () {
        Route::get('/', RouteIndexController::class)->name('index');

        Route::get('/{id}', RouteShowController::class)->name('show');
        Route::post('/', RouteStoreController::class)->name('store');
        Route::patch('/{id}', RouteUpdateController::class)->name('update');
        Route::delete('/{id}', RouteDestroyController::class)->name('destroy');
    });
    //
    //Route::prefix('/quick')->group(function () {
    //    Route::get()
    //})
});
