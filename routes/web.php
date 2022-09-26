<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('/about-us', [MainController::class, 'about'])->name('about');

Route::get('/contact-us', [ContactController::class, 'show'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-new');

Route::get('/movies', [MoviesController::class, 'list'])->name('movies.list');

Route::get('/movies/create', [MoviesController::class, 'createMovie'])->name('movies.create.form');
Route::post('/movies/create', [MoviesController::class, 'createCard'])->name('movies.create');

Route::get('/movies/{id}', [MoviesController::class, 'showCard'])->name('movies.show.card');

Route::get('/movies/{id}/edit', [MoviesController::class, 'editForm'])->name('movies.edit.form');
Route::post('/movies/{id}/edit', [MoviesController::class, 'edit'])->name('movies.edit.card');

Route::post('/movies/{id}/delete', [MoviesController::class, 'deleteMovie'])->name('movies.delete');

Route::get('/sign-up', [SignUpController::class, 'showForm'])->name('sign-up.form');
Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('sign-up');

Route::get('/verify-email/{id}/{hash}', [SignUpController::class, 'verifyEmail'])->name('verify-email');
