<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\Vehicle\Overview\IndexController as VehicleOverviewIndexController;
use App\Http\Controllers\Vehicle\Overview\ShowController as VehicleOverviewShowController;
use App\Http\Controllers\Vehicle\VehicleController;
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

        Route::get('/', [VehicleController::class, 'index'])->name('index');

        Route::get('/{id}', [VehicleController::class, 'show'])->name('show');
        Route::post('/', [VehicleController::class, 'store'])->name('store');
        Route::patch('/{id}', [VehicleController::class, 'update'])->name('update');
        Route::delete('/{id}', [VehicleController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/fuels')->name('fuels.')->group(function () {
        Route::get('/', [FuelController::class, 'index'])->name('index');

        Route::get('/{id}', [FuelController::class, 'show'])->name('show');
        Route::post('/{id}', [FuelController::class, 'store'])->name('store');
        Route::patch('/{id}', [FuelController::class, 'update'])->name('update');
        Route::delete('/{id}', [FuelController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/locations')->name('locations.')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('index');

        Route::get('/{id}', [LocationController::class, 'show'])->name('show');
        Route::post('/{id}', [LocationController::class, 'store'])->name('store');
        Route::patch('/{id}', [LocationController::class, 'update'])->name('update');
        Route::delete('/{id}', [LocationController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/repairs')->name('repairs.')->group(function () {
        Route::get('/', [RepairController::class, 'index'])->name('index');

        Route::get('/{id}', [RepairController::class, 'show'])->name('show');
        Route::post('/{id}', [RepairController::class, 'store'])->name('store');
        Route::patch('/{id}', [RepairController::class, 'update'])->name('update');
        Route::delete('/{id}', [RepairController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/cleanings')->name('cleaning.')->group(function () {
        Route::get('/', [CleaningController::class, 'index'])->name('index');

        Route::get('/{id}', [CleaningController::class, 'show'])->name('show');
        Route::post('/{id}', [CleaningController::class, 'store'])->name('store');
        Route::patch('/{id}', [CleaningController::class, 'update'])->name('update');
        Route::delete('/{id}', [CleaningController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/expenses')->name('expenses.')->group(function () {
        Route::get('/', [ExpensesController::class, 'index'])->name('index');

        Route::get('/{id}', [ExpensesController::class, 'show'])->name('show');
        Route::post('/{id}', [ExpensesController::class, 'store'])->name('store');
        Route::patch('/{id}', [ExpensesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ExpensesController::class, 'destroy'])->name('destroy');
    });

    //Route::prefix('/routes')->group(function () {
    //    Route::get('/', [RouteController::class, 'index']);
    //
    //    Route::get('/{id}', [RouteController::class, 'show']);
    //    Route::post('/{id}', [RouteController::class, 'store']);
    //    Route::patch('/{id}', [RouteController::class, 'update']);
    //    Route::delete('/{id}', [RouteController::class, 'destroy']);
    //});

    //Route::prefix('/quick')->group(function () {
    //    Route::get()
    //})
});
