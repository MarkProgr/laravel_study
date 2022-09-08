<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movies\CreateRequest;
use App\Http\Requests\Movies\EditRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function createMovie()
    {
        return view('movies.create-form');
    }

    public function createCard(CreateRequest $request)
    {
        $data = $request->validated();
        $movie = new Movie($data);
        $movie->save();

        session()->flash('success', trans('messages.movie.success'));

        return redirect()->route('movies.list');
    }

    public function list()
    {
        $movies = Movie::all();

        return view('movies.list', compact('movies'));
    }

    public function showCard(int $id)
    {
        $movie = Movie::query()->findOrFail($id);

        return view('movies.show-card', compact('movie'));
    }

    public function editForm(int $id)
    {
        $movie = Movie::query()->findOrFail($id);

        return view('movies.edit-form', compact('movie'));
    }

    public function edit(int $id, EditRequest $request)
    {
        $movie = Movie::query()->findOrFail($id);

        $data = $request->validated();
        $movie->fill($data);
        $movie->save();

        session()->flash('success', trans('messages.movie.success'));

        return redirect()->route('movies.list', ['id' => $movie->id]);
    }
}
