<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Lang;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $balance = WalletController::index()->balance;
        $arr = array();
        foreach($request->session()->get('cart_shopping') as $d) {
            $arr[] = $d['id'];
        }
        $order = Cart::with('user', 'jasa.seller.address')
        ->whereIn('cart_id', $arr)
        ->where('user_id', Auth::user()->id)->get();
        // $order = Cart::with('user', 'jasa.seller')->whereIn('cart_id', $arr)->first();
        // return response()->json($order);
        return view('buyer.order', ['balance' => $balance, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $f = $request->file('example');
        $f_name = 'example-from-order-' . $request->id . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();
        $r = Storage::putFileAs(Auth::user()->name . '/order/' . 'example/' . $request->id, $f, $f_name);

        $v = Cart::where('cart_id', $request->id)->update([
            'example' => asset('storage/' . $r),
            'example_ori' => $f->getClientOriginalName(),
        ]);
        if($v) {
            return response()->json(['status' => Lang::get('validation.cart.upload.success'), 'files' => $f->getClientOriginalName()]);
        } else {
            return response()->json(['status' => Lang::get('validation.cart.upload.failed'), 'files' => $f->getClientOriginalName()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        switch($request->type) {
            case 'Date':
                Cart::where('cart_id', $request->id)->update([
                    'deadline' => $request->content,
                ]);
                break;
            case 'Note':
                Cart::where('cart_id', $request->id)->update([
                    'note' => $request->content,
                ]);
                break;
            case 'File':
                Cart::where('cart_id', $request->id)->update([
                    'example' => '',
                    'example_ori' => '',
                ]);
                    return response()->json(['status' => Lang::get('validation.cart.deletefile.success'), 'type' => 'File']);
                break;
            default:
            //
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
