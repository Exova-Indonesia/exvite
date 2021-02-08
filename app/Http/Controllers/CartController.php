<?php

namespace App\Http\Controllers;

use Lang;
use Auth;
use App\Models\Subscription;
use App\Models\Cart;
use App\Models\Jasa;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index() {
        $balance = WalletController::index()->balance;
        $jasa = Cart::with('user', 'jasa.seller')->where('user_id', Auth::user()->id)->where('product_type', 'Jasa')->get();
        return view('/cart', ['balance' => $balance, 'jasa'=> $jasa]);
    }
    public function cart_data() {
        $jasa = Cart::with('user', 'jasa.seller')->where('user_id', Auth::user()->id)->where('product_type', 'Jasa')->get();
        return response()->json($jasa);
    }

    public function delete(Request $request) {
        Cart::whereIn('cart_id', explode(",", $request->id))->delete();
        return response()->json(['status' => Lang::get('validation.cart.delete.success')]);
    }
    public function update(Request $request) {
        Cart::where('cart_id', $request->id)->update([
            'quantity' => $request->qty,
            'note' => $request->note,
        ]);
        return response()->json(['status' => Lang::get('validation.cart.delete.success')]);
    }

    public function data($type, $id) {
        Cart::where('product_type', $type)->whereIn('cart_id', explode(",", $id))->delete();
        return response()->json(['status' => Lang::get('validation.cart.delete.success')]);
    }

    public function cart(Request $request, $id) {
        $data = Subscription::where('plan_id', $id)->first();
            $products = array([
                'id'=>$data->plan_id,
                'name' => $data->plan_name,
                'price' => $data->price_per_year,
                'picture' => '',
                'quantity' => 1,
                'category' => 'Subscription',
                'type' => 'Subscription',
                'note' => '',
                ]);
        $request->session()->put('cart_shopping', $products);
        // $data = array();
        // $products = array();
        // foreach($products as $d) {
        //     $data[] = Subscription::where('plan_id', $d['id'])->get();
        // }
        // $products = array();
        // foreach($data as $d) {
        //     $products[] = array(
        //         'name' => $d->plan_name,
        //         'price' => $d->price_per_year,
        //         'quantity' => 1,
        //         'category' => 'a',
        //         'type' => '',
        //     );
        // }
        // if(empty($data)) {
        //     $request->session()->put('cart_shopping', $products);
        //         return response()->json(['status' => 'Ditambahkan']);
        //     } else {
        //             $array_keys = array_keys($request->session()->get('cart_shopping'));
        //             if(in_array($key, $array_keys)) {
        //                 return response()->json(['status' => 'Produk sudah ada']);
        //             } else {
        //                 $request->session()->put('cart_shopping', array_merge($request->session()->get('cart_shopping'), $cart));
        //             }
        //         return response()->json(['status' => 'Ditambahkan']);
        //         $request->session()->flush();
        //     }
        // $data = $request->session()->get('cart_shopping');
        // return response()->json($products);
        return redirect('/payments');
    }
}
