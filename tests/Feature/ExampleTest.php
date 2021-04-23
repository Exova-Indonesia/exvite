<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\Ordered;
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
    Event::fake();
    Event::assertDispatched(function (Ordered $event) {
        return $event->order_id;
    });
    }
}
