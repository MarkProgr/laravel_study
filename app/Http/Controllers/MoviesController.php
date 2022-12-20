<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movies\CreateRequest;
use App\Http\Requests\Movies\EditRequest;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function createMovie(Request $request)
    {
        $genres = Genre::all();

        $actors = Actor::all();

        return view('movies.create-form', compact('genres', 'actors'));
    }

    public function createCard(CreateRequest $request)
    {
        $data = $request->validated();
        $movie = new Movie($data);

        $user = $request->user();
//        dd($user);

        $movie->user()->associate($user);

        $movie->save();

        $movie->genres()->attach($data['genres']);
        $movie->actors()->attach($data['actors']);

        session()->flash('success', trans('messages.movie.success'));

        return redirect()->route('movies.list');
    }

    public function list(Request $request)
    {
        $movies = Movie::query()->paginate(5);

        return view('movies.list', compact('movies'));
    }

    public function showCard(int $id)
    {
        $movie = Movie::query()->findOrFail($id);

        $genres = $movie->genres()->get()->pluck('name');

        $actors = $movie->actors()->get();

        return view('movies.show-card', compact('movie', 'genres', 'actors'));
    }

    public function editForm(int $id)
    {
        $movie = Movie::query()->findOrFail($id);

        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies.edit-form', compact('movie', 'genres', 'actors'));
    }

    public function edit(int $id, EditRequest $request)
    {
        $movie = Movie::query()->findOrFail($id);

        $data = $request->validated();
        $movie->fill($data);
        $movie->save();
        $movie->genres()->sync($data['genres']);
        $movie->actors()->sync($data['actors']);

        session()->flash('success', trans('messages.movie.edit'));

        return redirect()->route('movies.show.card', ['id' => $movie->id]);
    }

    public function deleteMovie(int $id)
    {
        $movie = Movie::query()->findOrFail($id)->delete();

        session()->flash('success', trans('messages.movie.delete'));
        return redirect()->route('movies.list');
    }
}
