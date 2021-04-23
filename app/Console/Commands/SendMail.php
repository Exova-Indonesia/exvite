<?php

namespace App\Console\Commands;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\OrderJasa;
use Illuminate\Console\Command;
use App\Models\UserSubscription;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:deadline';

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
    $data = OrderJasa::with('products.seller.owner')->whereDate('deadline', now()->format('Y-m-d'))->get();
        foreach($data as $d){
            $d->products->seller->owner->notify(new \App\Notifications\DeadlineAlert($d->products->seller->owner->name));
        }
    }
}
