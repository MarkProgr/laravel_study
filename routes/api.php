<?php

use App\Http\Controllers\Api\ActorController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MoviesController;
use App\Http\Controllers\Api\UserController;
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

Route::get('/movies', [MoviesController::class, 'list']);
Route::post('/movies/create', [MoviesController::class, 'create']);
Route::get('/movies/{movie}', [MoviesController::class, 'show']);
Route::put('/movies/{movie}/edit', [MoviesController::class, 'update']);
Route::delete('/movies/{movie}/delete', [MoviesController::class, 'delete']);

Route::get('/genres', [GenreController::class, 'list']);

Route::get('/actors', [ActorController::class, 'list']);

Route::post('/sign-up', [UserController::class, 'signUp']);
Route::post('/sign-in', [UserController::class, 'signIn']);
