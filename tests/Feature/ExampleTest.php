<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\Ordered;
use App\Models\OrderJasa;
use App\Events\OrderResult;
use App\Models\OrderCancel;
use App\Events\OrderConfirm;
use App\Events\OrderSucceed;
use App\Models\OrderSuccess;
use App\Models\OrderRevision;
use App\Models\PaymentDetail;
use App\Models\OrderJasaResult;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_send_order_created()
    {
        // $pay = PaymentDetail::find(1903280994);
        // $pay->customer_id = 2021022120422715;
        // $pay->status = 'success';
        // $pay->save();
        $order = OrderJasa::where('order_id', 810652513728)->first();
        event(new OrderConfirm($order));
        $this->assert(true);
    }
}
