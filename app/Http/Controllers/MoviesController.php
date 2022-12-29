<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movies\CreateRequest;
use App\Http\Requests\Movies\EditRequest;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function __construct(private MovieService $movieService)
    {
    }

    public function createMovie(Request $request)
    {
        $genres = Genre::all();

        $actors = Actor::all();

        return view('movies.create-form', compact('genres', 'actors'));
    }

    public function createCard(CreateRequest $request)
    {
        $this->movieService->create($request->validated(), $request->user());

        session()->flash('success', trans('messages.movie.success'));

        return redirect()->route('movies.list');
    }

    public function list(Request $request)
    {
        $movies = Movie::query()->paginate(5);

        return view('movies.list', compact('movies'));
    }

    public function showCard(Movie $movie)
    {
        $genres = $movie->genres()->get()->pluck('name');

        $actors = $movie->actors()->get();

        return view('movies.show-card', compact('movie', 'genres', 'actors'));
    }

    public function editForm(Movie $movie)
    {
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies.edit-form', compact('movie', 'genres', 'actors'));
    }

    public function edit(Movie $movie, EditRequest $request)
    {
        $this->movieService->edit($movie, $request->validated());

        session()->flash('success', trans('messages.movie.edit'));

        return redirect()->route('movies.list');
    }

    public function deleteMovie(Movie $movie)
    {
        $this->movieService->delete();
        session()->flash('success', trans('messages.movie.delete'));
        return redirect()->route('movies.list');
    }
}
