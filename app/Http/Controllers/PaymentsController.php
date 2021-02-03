<?php

namespace App\Http\Controllers;

\Midtrans\Config::$serverKey = config('md_secret');
\Midtrans\Config::$isProduction = config('md_production');
\Midtrans\Config::$isSanitized = config('md_sanitized');

use App\Models\Subscription;
use App\Models\PayMethod;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'cartsession']);
    }
    public function index(Request $request) {
        // $request->session()->flush();
        $balance = WalletController::index()->balance;
        return view('/payments', ['balance' => $balance]);
    }
    public function data(Request $request) {
        $data = PayMethod::all();
        $products = $request->session()->get('cart_shopping');
        return response()->json([$data, $products]);
    }

    public function pay(Request $request) {
        // $cart = Cart::where('cart_id', $request->cart_id);
        $data = $request->session()->get('cart_shopping');
        switch($request->method) {
            case "QRIS":
                $subtotal = 0;
                foreach($data as $d) {
                    $subtotal += $d['price'] * $d['quantity']; 
                }
                $fee = array(
                    'id'=>rand(),
                    'price'=>$subtotal*0.02,
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
                }
                $total = $subtotal + $subtotal*0.02;
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
            $fee = array(
                'id'=>rand(),
                'price'=>4000,
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
            }
            $total = $subtotal + 4000;
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
}
