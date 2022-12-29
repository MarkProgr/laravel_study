<?php

namespace App\Http\Controllers;

use App\Http\Requests\Actors\CreateRequest;
use App\Http\Requests\Actors\EditRequest;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function addActorsForm()
    {
        return view('actors.create-form');
    }

    public function addActors(CreateRequest $request)
    {
        $data = $request->validated();
        $actor = new Actor($data);
        $actor->save();

        session()->flash('success', 'Actor successfully Added!');
        return redirect()->route('actors.list');
    }

    public function list()
    {
        $actors = Actor::query()->paginate(10);

        return view('actors.list', compact('actors'));
    }

    public function editActorsForm(Actor $actor)
    {
        return view('actors.edit-form', compact('actor'));
    }

    public function editActors(Actor $actor, EditRequest $request)
    {
        $data = $request->validated();
        $actor->fill($data);
        $actor->save();

        session()->flash('success', 'Actor successfully edited');

        return redirect()->route('actors.list', ['actor' => $actor->id]);
    }

    public function deleteActors(Actor $actor)
    {
        $actor->delete();

        session()->flash('success', 'Actor successfully deleted');
        return redirect()->route('actors.list');
    }
}
