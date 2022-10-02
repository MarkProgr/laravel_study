<?php

namespace App\Http\Controllers;

use App\Models\Jenre;
use Illuminate\Http\Request;

class JenreController extends Controller
{
    public function addForm()
    {
        return view('jenres.create-form');
    }

    public function add(\App\Http\Requests\Jenre\Request $request)
    {
        $data = $request->validated();
        $jenre = new Jenre($data);
        $jenre->save();

        session()->flash('success', 'Jenre successfully added');

        return redirect()->route('movies.list');
    }
}
