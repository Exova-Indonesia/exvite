<?php

namespace App\Http\Controllers;

use Lang;
use Auth;
use App\Models\Subscription;
use App\Models\Cart;
use App\Models\Jasa;
use App\Models\OrderDetails;
use App\Models\OrderJasa;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $balance = WalletController::index()->balance;
        $jasa = Cart::with('user', 'jasa.seller', 'plan')->where('user_id', Auth::user()->id)->get();
        return view('buyer.cart', ['balance' => $balance, 'data'=> $jasa]);
        // return response()->json($jasa);
    }
    public function cart_data() {
        $jasa = Cart::where('user_id', Auth::user()->id)->get();
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
                $type = Cart::where('cart_id', $c)->first();
                $order_id = date('hi').rand();
                $p = Cart::with('plan')->where('cart_id', $type->cart_id)->first();
                switch($type->product_type) {
                    case "Jasa" :
                        $p = Cart::with('user', 'jasa.seller')->where('cart_id', $type->cart_id)->first();
                        $carts = array(
                        'id'=>$p->cart_id,
                        'name' => $p->jasa->jasa_name,
                        'price' => $p->unit_price,
                        'picture' => $p->jasa->jasa_thumbnail,
                        'quantity' => $p->quantity,
                        'category' => $p->jasa->jasa_subcategory,
                        'type' => $p->product_type,
                        'note' => $p->note,
                        'deadline' => $p->deadline,
                        'example' => $p->example,
                        'example_ori' => $p->example_ori,
                    );
                    break;

                    case "Subscription" :
                        $carts = array(
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
                        $carts = array(
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
                }
                if(! in_array($request->session()->get('cart_shopping'), $carts)) {
                    return $request->session()->put('cart_shopping', $carts);
                }
            }
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
        switch($request->type) {
            case "Subscription":
                $check = Cart::where('user_id', Auth::user()->id)->where('product_type', $request->type)->first();
                if(!empty($check)) {
                    return response()->json(['status' => Lang::get('validation.cart.add.limit'), 'code' => 400]);
                }

                $data = Subscription::where('plan_id', $request->id)->first();
                Cart::create([
                    'product_id' => $data->plan_id,
                    'user_id' => Auth::user()->id,
                    'product_type' => $request->type,
                    'unit_price' => $data->price_per_year,
                    'quantity' => 1,
                    'note' => Lang::get('validation.cart.note.membership'),
                ]);
                break;
                //
        }
        return response()->json(['status' => Lang::get('validation.cart.add.success')]);
    }

}
