<?php

namespace App\Http\Controllers;

use Lang;
use Auth;
use App\Models\Subscription;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\CartAdditional;
use App\Models\Jasa;
use App\Models\OrderDetails;
use App\Models\OrderJasa;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $balance = WalletController::index()->balance;
        $jasa = Cart::with('user', 'jasa.seller', 'plan', 'jasa.cover', 'additional.additional')->where('user_id', Auth::user()->id)->get();
        return view('buyer.cart', ['balance' => $balance, 'data'=> $jasa]);
        // return response()->json($jasa);
    }
    public function cart_data() {
        $jasa = Cart::with('additional.additional')->where('user_id', Auth::user()->id)->get();
        return response()->json($jasa);
    }

    public function delete(Request $request) {
        Cart::whereIn('cart_id', explode(",", $request->id))->delete();
        return response()->json(['status' => Lang::get('validation.cart.delete.success')]);
    }
    public function update(Request $request) {
        //
    }
    public function finish(Request $request) {
        if(empty($request->cart_id)) {
            return response()->json(['status' => Lang::get('validation.cart.next.failed'), 'code' => 401]);
        } else {
            $carts = array();
            foreach($request->cart_id as $c) {
                $additional = array();
                $type = Cart::where('cart_id', $c)->first();
                $order_id = date('hi').rand();
                $p = Cart::with('plan')->where('cart_id', $type->cart_id)->first();
                switch($type->product_type) {
                    case "Jasa" :
                        $p = Cart::with('user', 'jasa.seller', 'jasa.cover', 'jasa.subcategory', 'details', 'additional.additional')->where('cart_id', $type->cart_id)->first();
                        foreach($p->additional as $a) {
                            $additional[] = array(
                                'additional_id' => $a->additional['id'],
                                'quantity' => $a->quantity,
                                'price' => $a->additional['price'],
                                'title' => $a->additional['title'],
                            );
                        }

                        $carts[] = array(
                            'id'=>$p->cart_id,
                            'name' => $p->jasa->jasa_name,
                            'price' => $p->unit_price,
                            'picture' => $p->jasa->cover['small'],
                            'quantity' => $p->quantity,
                            'category' => $p->jasa->subcategory['parent']['name'],
                            'type' => $p->product_type,
                            'note' => $p->details['note'],
                            'deadline' => $p->details['deadline'],
                            'example' => $p->details['example'],
                            'additional' => $additional,
                        );
                    break;

                    case "Subscription" :
                        $carts[] = array(
                        'id'=>$p->cart_id,
                        'name' => $p->plan->plan_name,
                        'price' => $p->unit_price,
                        'picture' => 'https://assets.exova.id/img/1.png',
                        'quantity' => $p->quantity,
                        'category' => 'Membership',
                        'type' => $p->product_type,
                        'note' => $p->note,
                    );
                    break;

                    case "Create" :
                        // Belum selesai
                        $p = Cart::with('user', 'jasa.seller')->where('cart_id', $type->cart_id)->first();
                        $carts[] = array(
                        'id'=>$p->cart_id,
                        'name' => $p->jasa->jasa_name,
                        'price' => $p->unit_price,
                        'picture' => $p->jasa->jasa_thumbnail,
                        'quantity' => $p->quantity,
                        'category' => $p->jasa->jasa_subcategory,
                        'type' => $p->product_type,
                        'note' => $p->note,
                    );
                    break;
                    default: 
                    return back();
                }
            }
            return $request->session()->put('cart_shopping', $carts);
        }
    }
    public function tes_session(Request $request) {
        $data = $request->session()->get('cart_shopping');
        return response()->json($data);
    }
    public function data($type, $id) {
        Cart::where('product_type', $type)->whereIn('cart_id', explode(",", $id))->delete();
        return response()->json(['status' => Lang::get('validation.cart.delete.success')]);
    }

    public function add(Request $request) {
        $data = Jasa::where('jasa_id', $request->id)->first();
        if($data->studio_id == auth()->user()->studio->id) {
            return response()->json(['statusMessage' => Lang::get('validation.cart.add.failed')], 400);
        }
        $cart = Cart::firstOrCreate([
            'product_id' => $data->jasa_id,
            'user_id' => Auth::user()->id,
            'product_type' => "Jasa",
            'unit_price' => $data->jasa_price,
            'quantity' => 1,
        ]);
        CartDetails::updateOrCreate([
            'cart_id' => $cart->cart_id,
        ],
        [
            'cart_id' => $cart->cart_id,
            'notes' => $request->notes ?? '',
            'example' => $request->example ?? '',
            'deadline' => $request->deadline ?? null,
        ]);
        if(! empty($request->add)) {
            foreach($request->add as $a) {
                CartAdditional::updateOrCreate([
                    'cart_id' => $cart->cart_id,
                    'additional_id' => $a[0],
                ],
                [
                    'cart_id' => $cart->cart_id,
                    'additional_id' => $a[0],
                    'quantity' => $a[1],
                ]);
                if($a[1] == 0) {
                    CartAdditional::where([
                        ['cart_id', $cart->cart_id],
                        ['additional_id', $a[0]],
                    ])->delete();
                }
            }
        }
        return response()->json(['statusMessage' => Lang::get('validation.cart.add.success')]);
    }

}
