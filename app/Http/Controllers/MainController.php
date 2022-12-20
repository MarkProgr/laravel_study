<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\LoginHistory;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $query = Movie::query()
            ->with(['user', 'genres', 'actors'])
            ->latest();

        if ($request->has('title')) {
            $search = '%' . $request->get('title') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search);
            });
        }

        if ($request->has('year_of_issue')) {
            $search = '%' . $request->get('year_of_issue') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('year_of_issue', 'like', $search);
            });
        }

        if ($request->has('genres')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('genres.id', $request->get('genres'));
            });
        }

        if ($request->has('actors')) {
            $query->whereHas('actors', function ($q) use ($request) {
                $q->whereIn('actors.id', $request->get('actors'));
            });
        }

        $genres = Genre::all();

        $actors = Actor::all();

        $movies = $query
            ->paginate(1)
            ->appends($request->query());

        return view('welcome', compact('movies', 'genres', 'actors'));
    }

    public function indexLoginHistory()
    {
        $loggedUsers = LoginHistory::query()->paginate(10);

        return view('login-history', compact('loggedUsers'));
    }

    public function about()
    {
        return view('about-us');
    }
}

