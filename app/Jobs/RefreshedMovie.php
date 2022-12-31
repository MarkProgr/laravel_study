<?php

namespace App\Jobs;

use App\Mail\YearChanged;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RefreshedMovie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Movie $movie)
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->id === $movie->user_id) {
                continue;
            }
            Mail::to($user->email)->send(new YearChanged($movie));
        }
    }
}
