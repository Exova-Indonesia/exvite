<?php

namespace App\Http\Controllers;

\Midtrans\Config::$serverKey = config('app.md_secret');
\Midtrans\Config::$isProduction = config('app.md_production');
\Midtrans\Config::$isSanitized = config('app.md_sanitized');

use Auth;
use Lang;
use App\Models\Cart;
use App\Models\Jasa;
use App\Models\OrderJasa;
use App\Models\PayMethod;
use App\Models\SubsOrder;
use App\Models\OrderDetails;
use App\Models\OrderExample;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Models\CartAdditional;
use App\Models\OrderAdditional;
use Illuminate\Support\Facades\Http;

class PaymentsController extends Controller
{
    public function __construct() {
        $this->payment_id = $payment_id = rand();
    }
    public function index(Request $request) {
        // $request->session()->flush();
        $balance = WalletController::index()->balance;
        return view('buyer.payments', ['balance' => $balance]);
    }
    public function data(Request $request) {
        $data = PayMethod::all();
        $products = $request->session()->get('cart_shopping');
        return response()->json([$data, $products]);
    }

    public function pay(Request $request) {
        // $cart = Cart::where('cart_id', $request->cart_id);
        $user = Auth::user();
        $data = $request->session()->get('cart_shopping');
        switch($request->method) {
            case "QRIS":
                $subtotal = 0;
                $subtotal_adm = 0;
                $method = 'QRIS';
                foreach($data as $d) {
                    foreach($d['additional'] as $a) {
                        $subtotal_adm += $a['price'] * $a['quantity'];
                    }
                    $subtotal_adm += $d['price'] * $d['quantity'];
                }
                $fee = array(
                    'id'=>rand(),
                    'price'=>round($subtotal_adm*0.02),
                    'name'=>'Biaya Layanan',
                    'quantity'=>1,
                );
                $item_details = array($fee);
                foreach($data as $d) {
                    $add_total = 0;
                    foreach($d['additional'] as $a) {
                        $item_details[] = array(
                            'id'=>$a['additional_id'],
                            'price'=>$a['price'],
                            'name'=>$a['title'],
                            'quantity'=>$a['quantity'],
                        );
                    $add_total += $a['price'] * $a['quantity'];
                    }
                    $item_details[] = array(
                        'id'=>$d['id'],
                        'price'=>$d['price'],
                        'name'=>$d['name'],
                        'quantity'=>$d['quantity'],
                    );
                    $subtotal += $d['price'] * $d['quantity'];
                    $subtotal = $add_total + $subtotal;
                    PaymentsController::createOrders($d, $subtotal, $add_total, $method, $subtotal*0.02, $this->payment_id);
                }
                $billing_address = array(
                    'address'       => $user->address->address,
                    'city'          => $user->address->city,
                    'postal_code'   => $user->address->postal,
                    'phone'         => $user->phone,
                    'country_code'  => 'IDN'
                );
                $customer_details = array(
                    'first_name'    => $user->name,
                    // 'last_name'     => $user->address->address,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'billing_address'  => $billing_address,
                );
                $total = $subtotal + $subtotal*0.02;
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $this->payment_id,
                        'gross_amount' => $total,
                    ),
                    'item_details' => $item_details,
                    'payment_type' => 'gopay',
                    'customer_details' => $customer_details,
                );
                $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
                $pay = new PaymentDetail;
                $pay->payment_id = $this->payment_id;
                $pay->customer_id = Auth::user()->id;
                $pay->path = $paymentUrl;
                $pay->payment_method = $method;
                $pay->discount = $discount ?? 0;
                $pay->admin_fee = $adm_fee;
                $pay->amount = $subtotal;
                $pay->status = 'pending';
                $pay->setTotal();
                $pay->save();

                PaymentDetail::where('payment_id', $this->payment_id)
                ->update([
                    'invoice' => orderInvoice($this->payment_id),
                ]);
                $request->session()->forget('cart_shopping');
                return response()->json(["link" => $paymentUrl, "method" => $request->method]);
                break;

            case "Mandiri":
                $method = "echannel";
                return PaymentsController::banks($data, $method);
                break;

            case "BNI":
                $method = "bni_va";
                return PaymentsController::banks($data, $method);
                break;

            case "Permata":
                $method = "permata_va";
                return PaymentsController::banks($data, $method);
                break;

            case "Bank Lainnya":
                $method = "bank_transfer";
                return PaymentsController::banks($data, $method);
                break;
            default:
                return back()->with(['error' => Lang::get('validation.pay.nomethod')]);
        }
    }
    function banks($data, $method) {
        $user = Auth::user();
        $adm_fee = 4000;
            $fee = array(
                'id'=>rand(),
                'price'=>$adm_fee,
                'name'=>'Biaya Layanan',
                'quantity'=>1,
            );
            $item_details = array($fee);
            $subtotal = 0;
            $add_total = 0;
                foreach($data as $d) {
                    $add_total = 0;
                    foreach($d['additional'] as $a) {
                        $item_details[] = array(
                            'id'=>$a['additional_id'],
                            'price'=>$a['price'],
                            'name'=>$a['title'],
                            'quantity'=>$a['quantity'],
                        );
                    $add_total += $a['price'] * $a['quantity'];
                    }
                    $item_details[] = array(
                        'id'=>$d['id'],
                        'price'=>$d['price'],
                        'name'=>$d['name'],
                        'quantity'=>$d['quantity'],
                    );
                    $subtotal += $d['price'] * $d['quantity'];
                    $subtotal = $add_total + $subtotal;
                    PaymentsController::createOrders($d, $subtotal, $add_total, $method, $adm_fee, $this->payment_id);
                }

                $billing_address = array(
                    'address'       => $user->address->address,
                    'city'          => $user->address->city,
                    'postal_code'   => $user->address->postal,
                    'phone'         => $user->phone,
                    'country_code'  => 'IDN'
                );
                $customer_details = array(
                    'first_name'    => $user->name,
                    // 'last_name'     => $user->address->address,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'billing_address'  => $billing_address,
                );
            $total = $subtotal + $adm_fee;
            $params = array(
                'transaction_details' => array(
                    'order_id' => $this->payment_id,
                    'gross_amount' => $total,
                ),
                'item_details' => $item_details,
                'payment_type' => $method,
                'customer_details' => $customer_details,
            );
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            $pay = new PaymentDetail;
            $pay->payment_id = $this->payment_id;
            $pay->customer_id = Auth::user()->id;
            $pay->path = $paymentUrl;
            $pay->payment_method = $method;
            $pay->discount = $discount ?? 0;
            $pay->admin_fee = $adm_fee;
            $pay->amount = $subtotal;
            $pay->status = 'pending';
            $pay->setTotal();
            $pay->save();
            
            PaymentDetail::where('payment_id', $this->payment_id)
            ->update([
                'invoice' => orderInvoice($this->payment_id),
            ]);
            request()->session()->forget('cart_shopping');
            // $response = \Midtrans\CoreApi::charge($params);
            return redirect($paymentUrl);
            // return response()->json($paymentUrl);
    }

    function createOrders($d, $subtotal, $add_total, $method, $adm_fee, $payment_id) {
        $data = Cart::with('details', 'additional.additional')->where('cart_id', $d['id'])->first();
        $dataAdd = CartAdditional::with(['additional' => function($q) {
            $q->where('title', 'Revisi');
        }])
        ->where('cart_id', $d['id'])->first();
        $order_id = date('hi').rand();
        switch($d['type']) {
            case "Subscription":
                SubsOrder::create([
                    'order_id' => $order_id,
                    'product_id'  =>$data->product_id,
                    'customer_id' =>Auth::user()->id,
                    'type' => $data->product_type,
                    'invoice' => '',
                ]);
                OrderDetails::create([
                    'order_id' =>$order_id,
                    'payment_id' => $payment_id,
                    'quantity' => $data->quantity,
                    'unit_price' => $data->unit_price,
                    'subtotal' => $data->unit_price,
                ]);
                break;
            case "Jasa":
        $seller = Jasa::where('jasa_id', $data->product_id)->first();
                OrderJasa::create([
                    'order_id' => $order_id,
                    'product_id'  =>$data->product_id,
                    'customer_id' =>Auth::user()->id,
                    'seller_id' => $seller->seller_id,
                    'type' => $data->product_type,
                    'status' => 'menunggu_pembayaran',
                    'revision' => $dataAdd->additional['quantity'] ?? 0,
                    'note' => $data->details['notes'],
                    'deadline' => $data->details['deadline'],
                    'batal_otomatis' => now()->addDays(1),
                ]);
                OrderExample::create([
                    'order_id' => $order_id,
                    'path' => $d['example'],
                ]);
                $details = OrderDetails::create([
                    'order_id' =>$order_id,
                    'payment_id' => $payment_id,
                    'quantity' => $data->quantity,
                    'unit_price' => $data->unit_price,
                    'subtotal' => $data->unit_price*$data->quantity + $add_total,
                    'additional' => count($data->additional),
                ]);
                foreach($data->additional as $d) {
                    OrderAdditional::create([
                        'orders_detail_id' =>$details->orders_detail_id,
                        'additional_id' => $d->additional['id'],
                        'quantity' => $d['quantity'],
                        'price' => $d->additional['price'],
                        'title' => $d->additional['title'],
                    ]);
                }
                break;
                default:
                //
            }
        }
        public function repay($id)
        {
            $data = PaymentDetail::where('payment_id', $id)->first();
            return response()->json(['url' => $data->path]);


            // $response = array();
            // $url = 'https://api.sandbox.midtrans.com/v2/' . $id . '/status';
            // $res = Http::withBasicAuth(config('app.md_secret'), '')->get($url);
            // if($res['payment_type'] == 'gopay') {
            //     $response[] = array(
            //         'name' => 'generate-qr-code',
            //         'url' => 'https://api.sandbox.midtrans.com/v2/gopay/' . $res['transaction_id'] . '/qr-code',
            //     );
            // } else if($res['payment_type'] == 'echannel') {
            //     $response[] = array('bill_key' => $res['bill_key'], 'biller_code' => $res['biller_code']);
            // } else {
            //     $response[] = array('bank' => $res['va_numbers'][0]['bank'],
            //     'va_number' => $res['va_numbers'][0]['va_number']);
            // }

            // return response()->json([
            //     'payment_type' => $res['payment_type'],
            //     'actions' => $response,
            //     'transaction_status' => $res['transaction_status'],
            //     'transaction_time' => $res['transaction_time'],
            //     'gross_amount' => $res['gross_amount'],
            // ]);
        }
    }
