<?php

namespace App\Console\Commands;

use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailVerify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify-verification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a letter with a verification link';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::query()->where('email_verified_at', null)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new VerifyMail($user));
        }

        return self::SUCCESS;
    }
}
