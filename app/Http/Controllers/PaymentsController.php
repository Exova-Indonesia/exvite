<?php

namespace App\Http\Controllers;

\Midtrans\Config::$serverKey = config('app.md_secret');
\Midtrans\Config::$isProduction = config('app.md_production');
\Midtrans\Config::$isSanitized = config('app.md_sanitized');

use Auth;
use App\Models\Subscription;
use App\Models\SubsOrder;
use App\Models\OrderDetails;
use App\Models\PayMethod;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
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
        $data = $request->session()->get('cart_shopping');
        $adm_fee = 0.02;
        switch($request->method) {
            case "QRIS":
                $subtotal = 0;
                $method = 'QRIS';
                foreach($data as $d) {
                    $subtotal += $d['price'] * $d['quantity']; 
                }
                $fee = array(
                    'id'=>rand(),
                    'price'=>$subtotal*$adm_fee,
                    'name'=>'Biaya Layanan',
                    'quantity'=>1,
                );
                $item_details = array($fee);
                foreach($data as $d) {
                    $item_details[] = array(
                        'id'=>$d['id'],
                        'price'=>$d['price'],
                        'name'=>$d['name'],
                        'quantity'=>$d['quantity'],
                    );
                    PaymentsController::createOrders($d, $subtotal, $method, $subtotal*$adm_fee);
                }
                $total = $subtotal + $subtotal*$adm_fee;
                $params = array(
                    'transaction_details' => array(
                        'order_id' => rand(),
                        'gross_amount' => $total,
                    ),
                    'item_details' => $item_details,
                    'payment_type' => 'gopay',
                );
                $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
                return redirect($paymentUrl);
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
        $adm_fee = 4000;
            $fee = array(
                'id'=>rand(),
                'price'=>$adm_fee,
                'name'=>'Biaya Layanan',
                'quantity'=>1,
            );
            $item_details = array($fee);
            $subtotal = 0;
            foreach($data as $d) {
                $item_details[] = array(
                    'id'=>$d['id'],
                    'price'=>$d['price'],
                    'name'=>$d['name'],
                    'quantity'=>$d['quantity'],
                );
                $subtotal += $d['price'] * $d['quantity'];
                PaymentsController::createOrders($d, $subtotal, $method, $adm_fee);
            }
            $total = $subtotal + $adm_fee;
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $total,
                ),
                'item_details' => $item_details,
                'payment_type' => $method,
            );
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            // $response = \Midtrans\CoreApi::charge($params);
            return redirect($paymentUrl);
            // return response()->json($paymentUrl);
    }

    function createOrders($d, $subtotal, $method, $adm_fee) {
        $order_id = date('hi').rand();
        switch($d['type']) {
            case "Subscription":
                SubsOrder::create([
                    'order_id' => $order_id,
                    'product_id'  =>$d['id'],
                    'customer_id' =>Auth::user()->id,
                    'type' => $d['type'],
                    'invoice' => '',
                ]);
                OrderDetails::create([
                    'orders_details_id' => date('hi').rand(),
                    'order_id' =>$order_id,
                    'quantity' => $d['quantity'],
                    'unit_price' => $d['price'],
                    'discount' => 0,
                    'admin_fee' => $adm_fee,
                    'total_price' => $subtotal + $adm_fee,
                    'payment_type' => $method,
                    'invoice' => '',
                    'status' => 'pending',
                ]);
                break;
            case "Jasa":
                JasaOrder::create([
                    'order_id' => date('hi').rand(),
                    'product_id'  =>$d['id'],
                    'customer_id' =>Auth::user()->id,
                    'type' => $d['type'],
                    'invoice' => '',
                    'status' => '',
                    'note' => '',
                    'deadline' => '',
                ]);
                break;
            }
        }
    }
