<?php

namespace App\Observers;

use App\Mail\YearChanged;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MovieObserver
{
    /**
     * Handle the Movie "created" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function created(Movie $movie)
    {
        //
    }

    /**
     * Handle the Movie "updated" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function updated(Movie $movie)
    {
        $isYearOfIssueChanged = $movie->year_of_issue !== $movie->getOriginal('year_of_issue');
        if ($isYearOfIssueChanged) {
            $users = User::all();
            foreach ($users as $user) {
                if ($user->id === $movie->user_id) {
                    continue;
                }
                Mail::to($user->email)->send(new YearChanged($movie));
            }
        }
    }

    /**
     * Handle the Movie "deleted" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function deleted(Movie $movie)
    {
        //
    }

    /**
     * Handle the Movie "restored" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function restored(Movie $movie)
    {
        //
    }

    /**
     * Handle the Movie "force deleted" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function forceDeleted(Movie $movie)
    {
        //
    }
}
