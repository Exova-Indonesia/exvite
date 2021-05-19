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
use App\Events\OrderUnConfirm;
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
        $data = OrderCancel::create([
            'customer_id' => 2021022120422715,
            'studio_id' => 3,
            'order_id' => 9181174500848,
            'status' => 'pesanan_dibatalkan',
        ]);

        // event(new OrderUnConfirm($data));
    }
}
