<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\UserBirthdayGreetings;
use App\Events\UserBirthday as UserBirthdayEvent;

class UserBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Birthday greetings for users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = User::where('birthday', now()->format('Y-m-d'))->get();
        foreach ($data as $key => $value) {
            // event(new UserBirthdayEvent($value));
            $value->notify(new UserBirthdayGreetings($value));
        }
    }
}
