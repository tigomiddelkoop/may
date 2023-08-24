<?php

// Auth
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Fuel\TypeController as FuelTypeController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\Vehicle\OverviewController as VehicleOverviewController;
use App\Http\Controllers\Vehicle\TypeController as VehicleTypeController;
use App\Http\Controllers\VehicleController;
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

Route::any('/', function () {
    return new \App\Classes\Response(
        data: [
            'version' => '0.0.1',
        ],
        message: 'Welcome to May, a third generation Vehicle Tracking Tool',
    );
});

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/forgot-password', ForgotPasswordController::class)->name('forgot-password');
});

Route::prefix('/users')->name('users.')->group(function () {

});

Route::middleware([])->group(function () {
    Route::prefix('/vehicles')->name('vehicles.')->group(function () {

        // Vehicle Types
        Route::prefix('/types')->name('types.')->group(function () {
            Route::get('/', [VehicleTypeController::class, 'index'])->name('index');
            Route::post('/', [VehicleTypeController::class, 'store'])->name('store');
            Route::middleware(['exists.vehicletype'])->group(function () {
                Route::get('/{id}', [VehicleTypeController::class, 'show'])->name('show');
                Route::patch('/{id}', [VehicleTypeController::class, 'update'])->name('update');
                Route::delete('/{id}', [VehicleTypeController::class, 'destroy'])->name('destroy');
            });
        });

        // Overview
        Route::prefix('/overview')->name('overview.')->group(function () {
            Route::get('/', [VehicleOverviewController::class, 'index'])->name('index');
            Route::get('/{licence_plate}', [VehicleOverviewController::class, 'show'])->name('show');
        });

        // Vehicles
        Route::get('/', [VehicleController::class, 'index'])->name('index');
        Route::post('/', [VehicleController::class, 'store'])->name('store');
        Route::middleware(['exists.vehicle'])->group(function () {
            Route::get('/{id}', [VehicleController::class, 'show'])->name('show');
            Route::patch('/{id}', [VehicleController::class, 'update'])->name('update');
            Route::delete('/{id}', [VehicleController::class, 'destroy'])->name('destroy');
        });
    });

    //    Route::prefix('/expenses')->name('expenses.')->group(function () {
    //        Route::get('/', [FuelExpenseController::class, 'index'])->name('index');
    //
    //        Route::get('/{id}', [FuelExpenseController::class, 'show'])->name('show');
    //        Route::post('/', [FuelExpenseController::class, 'store'])->name('store');
    //        Route::patch('/{id}', [FuelExpenseController::class, 'update'])->name('update');
    //        Route::delete('/{id}', [FuelExpenseController::class, 'destroy'])->name('destroy');
    //    });

    Route::prefix('/fuels')->name('fuels.')->group(function () {
        Route::prefix('/types')->name('types.')->group(function () {
            Route::get('/', [FuelTypeController::class, 'index'])->name('index');
            Route::post('/', [FuelTypeController::class, 'store'])->name('store');
            Route::middleware(['exists.fueltype'])->group(function () {
                Route::get('/{id}', [FuelTypeController::class, 'show'])->name('show');
                Route::patch('/{id}', [FuelTypeController::class, 'update'])->name('update');
                Route::delete('/{id}', [FuelTypeController::class, 'destroy'])->name('destroy');
            });
        });

        Route::get('/', [FuelController::class, 'index'])->name('index');
        Route::post('/', [FuelController::class, 'store'])->name('store');
        Route::middleware(['exists.fuel'])->group(function () {
            Route::get('/{id}', [FuelController::class, 'show'])->name('show');
            Route::patch('/{id}', [FuelController::class, 'update'])->name('update');
            Route::delete('/{id}', [FuelController::class, 'destroy'])->name('destroy');
        });

    });

    //    Route::prefix('/locations')->name('locations.')->group(function () {
    //        Route::get('/', [LocationController::class, 'index'])->name('index');
    //
    //        Route::get('/{id}', [LocationController::class, 'show'])->name('show');
    //        Route::post('/', [LocationController::class, 'store'])->name('store');
    //        Route::patch('/{id}', [LocationController::class, 'update'])->name('update');
    //        Route::delete('/{id}', [LocationController::class, 'destroy'])->name('destroy');

    // @TODO add categories
    //    });

    //    Route::prefix('engines')->name('engines.')->group(function () {
    //        Route::get('/', [EngineController::class, 'index'])->name('index');
    //
    //        Route::get('/{id}', [EngineController::class, 'show'])->name('show');
    //        Route::post('/', [EngineController::class, 'store'])->name('store');
    //        Route::patch('/{id}', [EngineController::class, 'update'])->name('update');
    //        Route::delete('/{id}', [EngineController::class, 'destroy'])->name('destroy');
    //    });

    //    Route::prefix('/routes')->name('route.')->group(function () {
    //        Route::get('/', [RouteController::class, 'index'])->name('index');
    //
    //        Route::get('/{id}', [RouteController::class, 'show'])->name('show');
    //        Route::post('/', [RouteController::class, 'store'])->name('store');
    //        Route::patch('/{id}', [RouteController::class, 'update'])->name('update');
    //        Route::delete('/{id}', [RouteController::class, 'destroy'])->name('destroy');
    //
    // @TODO add categories
    //    });
});

//Route::prefix('/quick')->group(function () {
//    Route::get()
//})
