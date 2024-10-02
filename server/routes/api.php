<?php

use App\Http\Controllers\DeveloperApiController;
use App\Http\Controllers\Game\AdminGameApiController;
use App\Http\Controllers\Game\GameApiController;
use App\Http\Controllers\GamelistApiController;
use App\Http\Controllers\GenreApiController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\PlatformApiController;
use App\Http\Controllers\RatingApiController;
use App\Http\Controllers\UserApiController;
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



Route::post("register", [JwtAuthController::class, "register"]);
Route::post("login", [JwtAuthController::class, "login"]);

Route::prefix('games')->group(function () {
    Route::get('/', [GameApiController::class, 'all']);
    Route::get('/favorites', [GameApiController::class, 'favorites']);
    Route::get('/featured', [GameApiController::class, 'featured']);
    Route::get('/top-rated', [GameApiController::class, 'topRated']);
    Route::get('/popular', [GameApiController::class, 'popular']);
    Route::get('/{id}', [GameApiController::class, 'find']);
    Route::get('/{id}/ratings', [GameApiController::class, 'ratings']);



});

Route::group(["middleware" => ["auth.csrf.jwt", "auth:api"]], function () {

    Route::get("refresh", [JwtAuthController::class, "refreshToken"]);
    Route::get("logout", [JwtAuthController::class, "logout"]);
    Route::get("profile", [JwtAuthController::class, "profile"]);

    Route::prefix('users')->group(function () {
        Route::post('/', [UserApiController::class, 'create']);
        Route::get('/{id}', [UserApiController::class, 'find']);
        Route::get('/{id}/ratings', [UserApiController::class, 'ratings']);

        Route::get('/{id}/games', [GamelistApiController::class, 'games']);
        Route::post('/{id}/games/{gameId}', [GamelistApiController::class, 'addGame']);
        Route::delete('/{id}/games/{gameId}', [GamelistApiController::class, 'removeGame']);

        Route::post('/{id}/rate/{gameId}', [RatingApiController::class, 'rateGame']);
    });


    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::prefix('games')->group(function () {
            Route::get('/{id}', [AdminGameApiController::class, 'find']);
            Route::post('/', [AdminGameApiController::class, 'create']);
            Route::put('/{id}', [AdminGameApiController::class, 'update']);
            Route::delete('/{id}', [AdminGameApiController::class, 'delete']);
            Route::put('/{id}/toggle', [AdminGameApiController::class, 'toggleFeatured']);
        });

        Route::prefix('developers')->group(function () {
            Route::get('/', [DeveloperApiController::class, 'all']);
            Route::post('/', [DeveloperApiController::class, 'create']);
            Route::put('/{id}', [DeveloperApiController::class, 'update']);
            Route::delete('/{id}', [DeveloperApiController::class, 'delete']);
        });

        Route::prefix('genres')->group(function () {
            Route::get('/', [GenreApiController::class, 'all']);
            Route::post('/', [GenreApiController::class, 'create']);
            Route::put('/{id}', [GenreApiController::class, 'update']);
            Route::delete('/{id}', [GenreApiController::class, 'delete']);
        });

        Route::prefix('platforms')->group(function () {
            Route::get('/', [PlatformApiController::class, 'all']);
            Route::post('/', [PlatformApiController::class, 'create']);
            Route::put('/{id}', [PlatformApiController::class, 'update']);
            Route::delete('/{id}', [PlatformApiController::class, 'delete']);
        });

        Route::prefix('esrb-ratings')->group(function () {
            Route::get('/', [EsrbRatingApiController::class, 'all']);
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserApiController::class, 'all']);
            Route::delete('/{id}', [UserApiController::class, 'delete']);
        });

    });
});

