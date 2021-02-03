<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class CartController extends Controller
{
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
