<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movies\CreateRequest;
use App\Http\Requests\Movies\EditRequest;
use App\Models\Actor;
use App\Models\Jenre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function createMovie()
    {
        $jenres = Jenre::all();

        $actors = Actor::all();

        return view('movies.create-form', compact('jenres', 'actors'));
    }

    public function createCard(CreateRequest $request)
    {
        $data = $request->validated();
        $movie = new Movie($data);

        $user = $request->user();

        $movie->user()->associate($user);

        $movie->save();

        $movie->jenres()->attach($data['jenres']);
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

        $jenres = $movie->jenres()->get()->pluck('name');

        $actors = $movie->actors()->get();

        return view('movies.show-card', compact('movie', 'jenres', 'actors'));
    }

    public function editForm(int $id)
    {
        $movie = Movie::query()->findOrFail($id);

        $jenres = Jenre::all();
        $actors = Actor::all();

        return view('movies.edit-form', compact('movie', 'jenres', 'actors'));
    }

    public function edit(int $id, EditRequest $request)
    {
        $movie = Movie::query()->findOrFail($id);

        $data = $request->validated();
        $movie->fill($data);
        $movie->save();
        $movie->jenres()->sync($data['jenres']);
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
