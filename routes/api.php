<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\GardenerController;
use App\Http\Controllers\API\CountryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::group( [ 'middleware' => [ 'json' ] ], function () {

    // Unauthenticated Routes
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    // Authenticated Routes
    Route::group( [ 'middleware' => [ 'auth:sanctum' ] ], function () {

        //Customer Routes
        Route::get('customers', [CustomerController::class, 'index']);
        Route::get('customers/country/{country_id}', [CustomerController::class, 'getCustomersByCountry']);

        //Gardener Routes
        Route::get('gardeners', [GardenerController::class, 'index']);
        Route::get('gardeners/country/{country_id}', [GardenerController::class, 'getGardenersByCountry']);

        //Country Routes
        Route::get('countries', [CountryController::class, 'index']);

    });
});
