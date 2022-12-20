<?php

namespace App\Http\Controllers;

use App\Http\Requests\Genre\CreateRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function addForm()
    {
        return view('genres.create-form');
    }

    public function add(CreateRequest $request)
    {
        $data = $request->validated();
        $genre = new Genre($data);
        $genre->save();

        session()->flash('success', 'Genre successfully added');

        return redirect()->route('movies.list');
    }
}
