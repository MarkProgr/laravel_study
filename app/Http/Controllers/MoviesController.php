<?php

namespace App\Http\Controllers;

//use App\Http\Requests\EditRequest;
use App\Http\Requests\Movies\EditRequest;
use App\Http\Requests\Movies\MoviesRequest;
//use App\Http\Requests\MoviesRequest;
use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function createMovie()
    {
        return view('movies.create-form');
    }

    public function createCard(MoviesRequest $request)
    {
        $data = $request->validated();
        $movie = new Movies($data);
        $movie->save();

        session()->flash('success', trans('messages.movie.success'));

        return redirect()->route('movies.list');
    }

    public function list()
    {
        $movies = Movies::all();

        return view('movies.list', ['movies' => $movies]);
    }

    public function showCard(int $id)
    {
        $movie = Movies::query()->findOrFail($id);

        return view('movies.show-card', compact('movie'));
    }

    public function editForm(int $id)
    {
        $movie = Movies::query()->findOrFail($id);

        return view('movies.edit-form', compact('movie'));
    }

    public function edit(int $id, EditRequest $request)
    {
        $movie = Movies::query()->findOrFail($id);

        $data = $request->validated();
        $movie->fill($data);
        $movie->save();

        session()->flash('success', trans('messages.movie.success'));

        return redirect()->route('movies.list', ['id' => $movie->id]);
    }
}
