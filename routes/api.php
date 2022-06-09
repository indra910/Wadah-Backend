<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\PropertiController;
use App\Http\Controllers\API\UserController;
use App\Models\Properti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user/u', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);

    Route::post('add_properti', [PropertiController::class, 'add_properti']);
    Route::post('properti/photo', [PropertiController::class, 'updatePhotoProperti']);
    Route::post('properti/u/{id}', [PropertiController::class, 'updateProperti']);
    Route::get('properti/f/{id}', [PropertiController::class, 'properti_user']);
    Route::delete('delete/p/{id}', [PropertiController::class, 'deleteProperti']);
    Route::post('logout', [UserController::class, 'logout']);
});
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('artikels', [ArtikelController::class, 'artikel']);
Route::get('properti', [PropertiController::class, 'all']);
Route::get('kategori', [KategoriController::class, 'kategori']);
