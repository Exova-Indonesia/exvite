<?php

namespace App\Console\Commands;

use App\Models\Jasa;
use App\Models\Studio;
use App\Models\Wallet;
use App\Models\OrderJasa;
use App\Models\OrderCancel;
use App\Models\StudioPoint;
use App\Models\OrderSuccess;
use Illuminate\Console\Command;

class OrderDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    $data = OrderJasa::with('details', 'products.seller.owner')->whereDate('batal_otomatis', now()->format('Y-m-d'))->get();
        foreach($data as $d) {
            if(in_array($d->status, ['menunggu_konfirmasi', 'pesanan_diproses'])) {
                OrderJasa::where('order_id', $d->order_id)->update([
                    'status' => 'batal_otomatis',
                ]);
                Jasa::where('jasa_id', $d->products->jasa_id)->increment('jasa_cancel');
                OrderCancel::create([
                    'customer_id' => $d->customer_id,
                    'studio_id' => $d->products->studio_id,
                    'order_id' => $d->order_id,
                    'status' => 'batal_otomatis',
                ]);
                    $wallet = Wallet::where('user_id', $d->customer_id)->first();
                    $rf = Wallet::where('user_id', $d->customer_id)->update([
                        'fund' => $wallet->fund + $d->details['subtotal'],
                    ]);
                    $wallet = Wallet::where('user_id', $d->customer_id)->first();
                    Wallet::where('user_id', $d->customer_id)->update([
                        'balance' => $wallet->revenue + $wallet->fund,
                    ]);
            } else if(in_array($d->status, ['menunggu_pembayaran'])) {
                OrderJasa::where('order_id', $d->order_id)->update([
                    'status' => 'pembayaran_kedaluarsa',
                ]);
                Jasa::where('jasa_id', $d->products->jasa_id)->increment('jasa_cancel');
                OrderCancel::create([
                    'customer_id' => $d->customer_id,
                    'studio_id' => $d->products->studio_id,
                    'order_id' => $d->order_id,
                    'status' => 'pembayaran_kedaluarsa',
                ]);
            } else if(in_array($d->status, ['pesanan_dikirim', 'permintaan_revisi'])) {
                OrderJasa::where('order_id', $d->order_id)->update([
                    'status' => 'pesanan_selesai',
                ]);
                    $total = new OrderSuccess;
                    $total->order_id = $d->order_id;
                    $total->studio_id = $d->products->studio_id;
                    $total->amount = $d->details->subtotal;
                    $total->setPaid();
                    $total->save();

                    $studio = Studio::where('id', $d->products->studio_id)->first();
                    $wallet = Wallet::where('user_id', $studio->user_id)->first();
                    Wallet::where('user_id', $studio->user_id)->update([
                        'revenue' => $wallet->revenue + $total->setPaid(),
                        'balance' => $wallet->balance + $total->setPaid(),
                    ]);
                    Jasa::where('jasa_id', $d->products->jasa_id)->increment('jasa_sold');
                    StudioPoint::create([
                        'studio_id' => $d->products->studio_id,
                        'order_id' => $d->order_id,
                        'value' => 5,
                        'source' => 'Pesanan Selesai',
                    ]);
            }

        }
    }
}
