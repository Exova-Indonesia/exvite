<?php

namespace App\Console\Commands;

use Auth;
use Carbon\Carbon;
use App\Models\UserSubscription;
use App\Models\User;
use Illuminate\Console\Command;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Schedule Test';

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
        $data = User::whereHas('subs', function($q) {
            $now = date("Y-m-d H:i", strtotime(Carbon::now()));
            $q->where('ends_at', $now);
        })->get();
            foreach($data as $d){
                $d->notify(new \App\Notifications\MailResetPasswordNotification($d->name));
        }
    }
}
