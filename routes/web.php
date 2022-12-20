<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\JenreController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SignUpController;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Jenre;
use App\Models\Movie;
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

Route::get('/movies/create', [MoviesController::class, 'createMovie'])->name('movies.create.form')
    ->middleware('can:create' . Movie::class);
Route::post('/movies/create', [MoviesController::class, 'createCard'])->name('movies.create')
    ->middleware('can:create' . Movie::class);

Route::get('/movies/{id}', [MoviesController::class, 'showCard'])->name('movies.show.card');

Route::get('/movies/{id}/edit', [MoviesController::class, 'editForm'])->name('movies.edit.form')
    ->middleware('can:edit' . Movie::class);
Route::post('/movies/{id}/edit', [MoviesController::class, 'edit'])->name('movies.edit.card')
    ->middleware('can:edit' . Movie::class);

Route::post('/movies/{id}/delete', [MoviesController::class, 'deleteMovie'])->name('movies.delete')
    ->middleware('can:delete' . Movie::class);

Route::get('/sign-up', [SignUpController::class, 'showForm'])->name('sign-up.form');
Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('sign-up');

Route::get('/verify-email/{id}/{hash}', [SignUpController::class, 'verifyEmail'])->name('verify-email');

Route::get('/sign-in', [AuthController::class, 'signInForm'])->name('login');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/genre/create', [GenreController::class, 'addForm'])->name('add.genre.form')
    ->middleware('can:create' . Genre::class);
Route::post('/genre/create', [GenreController::class, 'add'])->name('add.genre')
    ->middleware('can:create' . Genre::class);

Route::get('/actors/create', [ActorsController::class, 'addActorsForm'])->name('add.actor.form')
    ->middleware('can:create' . Actor::class);
Route::post('/actors/create', [ActorsController::class, 'addActors'])->name('add.actor')
    ->middleware('can:create' . Actor::class);
Route::get('/actors/list', [ActorsController::class, 'list'])->name('actors.list')
    ->middleware('can:show' . Actor::class);
Route::get('/actors/{actor}/edit', [ActorsController::class, 'editActorsForm'])->name('edit.actor.form')
    ->middleware('can:edit' . Actor::class);
Route::post('/actors/{actor}/edit', [ActorsController::class, 'editActors'])->name('edit.actor')
    ->middleware('can:edit' . Actor::class);
Route::post('/actors/{actor}/delete', [ActorsController::class, 'deleteActors'])->name('delete.actor')
    ->middleware('can:delete' . Actor::class);

