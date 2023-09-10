<?php

use App\Http\Controllers\Activity\CategoryController as ActivityCategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Engine\TypeController as EngineTypeController;
use App\Http\Controllers\Fuel\TypeController as FuelTypeController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\Location\CategoryController as LocationCategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Vehicle\Expense\ActivityController as VehicleExpenseActivityController;
use App\Http\Controllers\Vehicle\Expense\FuelController as VehicleExpenseFuelController;
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
            'instance_info' => [
                'vehicles' => \App\Models\Vehicle::count(),
            ],
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

        Route::prefix('/{license_plate}')->middleware(['exists.vehicle'])->group(function () {
            Route::prefix('/expense')->name('expenses.')->group(function () {
                Route::prefix('/fuel')->name('fuel.')->group(function () {
                    Route::get('/', [VehicleExpenseFuelController::class, 'index'])->name('index');
                    Route::post('/', [VehicleExpenseFuelController::class, 'store'])->name('store');

                    Route::middleware(['exists.vehicle.expense.fuel'])->group(function () {
                        Route::get('/{id}', [VehicleExpenseFuelController::class, 'show'])->name('show');
                        Route::patch('/{id}', [VehicleExpenseFuelController::class, 'update'])->name('update');
                        Route::delete('/{id}', [VehicleExpenseFuelController::class, 'destroy'])->name('destroy');
                    });
                });

                Route::prefix('/activity')->name('activity.')->group(function () {
                    Route::get('/', [VehicleExpenseActivityController::class, 'index'])->name('index');
                    Route::post('/', [VehicleExpenseActivityController::class, 'store'])->name('store');

                    Route::middleware(['exists.vehicle.expense.activity'])->group(function () {
                        Route::get('/{id}', [VehicleExpenseActivityController::class, 'show'])->name('show');
                        Route::patch('/{id}', [VehicleExpenseActivityController::class, 'update'])->name('update');
                        Route::delete('/{id}', [VehicleExpenseActivityController::class, 'destroy'])->name('destroy');
                    });
                });
            });
        });

        Route::prefix('/types')->name('types.')->group(function () {
            Route::get('/', [VehicleTypeController::class, 'index'])->name('index');
            Route::post('/', [VehicleTypeController::class, 'store'])->name('store');
            Route::middleware(['exists.vehicle.type'])->group(function () {
                Route::get('/{id}', [VehicleTypeController::class, 'show'])->name('show');
                Route::patch('/{id}', [VehicleTypeController::class, 'update'])->name('update');
                Route::delete('/{id}', [VehicleTypeController::class, 'destroy'])->name('destroy');
            });
        });

        Route::prefix('/overview')->name('overview.')->group(function () {
            Route::get('/', [VehicleOverviewController::class, 'index'])->name('index');
            Route::get('/{license_plate}', [VehicleOverviewController::class, 'show'])->name('show');
        });

        Route::get('/', [VehicleController::class, 'index'])->name('index');
        Route::post('/', [VehicleController::class, 'store'])->name('store');
        Route::middleware(['exists.vehicle'])->group(function () {
            Route::get('/{license_plate}', [VehicleController::class, 'show'])->name('show');
            Route::patch('/{license_plate}', [VehicleController::class, 'update'])->name('update');
            Route::delete('/{license_plate}', [VehicleController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('/fuels')->name('fuels.')->group(function () {
        Route::prefix('/types')->name('types.')->group(function () {
            Route::get('/', [FuelTypeController::class, 'index'])->name('index');
            Route::post('/', [FuelTypeController::class, 'store'])->name('store');
            Route::middleware(['exists.fuel.type'])->group(function () {
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

    Route::prefix('/locations')->name('locations.')->group(function () {
        Route::prefix('/categories')->name('categories.')->group(function () {
            Route::get('/', [LocationCategoryController::class, 'index'])->name('index');
            Route::post('/', [LocationCategoryController::class, 'store'])->name('store');
            Route::middleware('exists.location.category')->group(function () {
                Route::get('/{id}', [LocationCategoryController::class, 'show'])->name('show');
                Route::patch('/{id}', [LocationCategoryController::class, 'update'])->name('update');
                Route::delete('/{id}', [LocationCategoryController::class, 'destroy'])->name('destroy');
            });
        });

        Route::get('/', [LocationController::class, 'index'])->name('index');
        Route::post('/', [LocationController::class, 'store'])->name('store');
        Route::middleware('exists.location')->group(function () {
            Route::get('/{id}', [LocationController::class, 'show'])->name('show');
            Route::patch('/{id}', [LocationController::class, 'update'])->name('update');
            Route::delete('/{id}', [LocationController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('/engines')->name('engines.')->group(function () {
        Route::prefix('/types')->name('types.')->group(function () {
            Route::get('/', [EngineTypeController::class, 'index'])->name('index');
            Route::post('/', [EngineTypeController::class, 'store'])->name('store');
            Route::middleware(['exists.engine.type'])->group(function () {
                Route::get('/{id}', [EngineTypeController::class, 'show'])->name('show');
                Route::patch('/{id}', [EngineTypeController::class, 'update'])->name('update');
                Route::delete('/{id}', [EngineTypeController::class, 'destroy'])->name('destroy');
            });
        });
    });

    Route::prefix('/activities')->name('activities.')->group(function () {
        Route::prefix('/categories')->name('categories')->group(function () {
            Route::get('/', [ActivityCategoryController::class, 'index'])->name('index');
            Route::post('/', [ActivityCategoryController::class, 'store'])->name('store');
            Route::middleware(['exists.activity.category'])->group(function () {
                Route::get('/{id}', [ActivityCategoryController::class, 'show'])->name('show');
                Route::patch('/{id}', [ActivityCategoryController::class, 'update'])->name('update');
                Route::delete('/{id}', [ActivityCategoryController::class, 'destroy'])->name('destroy');
            });
        });
        Route::prefix('/expenses')->name('expenses')->group(function () {
            Route::get('/', [ActivityExpenseController::class, 'index'])->name('index');
            Route::post('/', [ActivityExpenseController::class, 'store'])->name('store');
            Route::middleware(['exists.activity.expenses'])->group(function () {
                Route::get('/{id}', [ActivityExpenseController::class, 'show'])->name('show');
                Route::patch('/{id}', [ActivityExpenseController::class, 'update'])->name('update');
                Route::delete('/{id}', [ActivityExpenseController::class, 'destroy'])->name('destroy');
            });
        });
    });
});

//Route::prefix('/quick')->group(function () {
//    Route::get()
//})
