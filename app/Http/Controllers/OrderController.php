<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Lang;
use Validator;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\CartAdditional;
use App\Models\OrderJasa;
use App\Models\OrderCancel;
use App\Models\Jasa;
use App\Models\OrderSuccess;
use App\Models\StudioPoint;
use App\Models\OrderRevision;
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
        $order = Cart::with('user', 'jasa.seller.address.district', 'jasa.cover', 'plan')
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

        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = OrderJasa::with(['customer', 'products.seller',
        'products.cover', 'details.additional.additional', 'products' => function($q) {
            $q->withTrashed();
        }])->where('order_id', $id)->first();
        return response()->json($data);
    }

    public function revisi(Request $request)
    {
        $countRevision = OrderRevision::where('order_id', $request->id)->count();
        $countLimit = OrderJasa::where('order_id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'reason' => ['required'],
        ]);
        if($validator->fails()) {
            return response()->json(['statusMessage' => 'Isi data dengan benar!'], 400);
        } else if($countRevision >= $countLimit->revision) {
            return response()->json(['statusMessage' => 'Batas revisi terlampaui!'], 400);
        }

        OrderRevision::create([
            'order_id' => $request->id,
            'detail' => $request->reason,
        ]);
        OrderJasa::where('order_id', $request->id)->update([
            'status' => 'permintaan_revisi',
        ]);
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
                CartDetails::updateOrCreate([
                    'cart_id' => $request->id,
                ],
                [
                    'deadline' => $request->content,
                ]);
                break;

            case 'Note':
                CartDetails::updateOrCreate([
                    'cart_id' => $request->id,
                ],
                [
                    'notes' => $request->content,
                ]);
                break;

            case 'Additional':
                $data = explode('-', $request->content);
                CartAdditional::updateOrCreate([
                    'cart_id' => $request->id,
                    'additional_id' => $data[0],
                ],
                [
                    'additional_id' => $data[0],
                    'quantity' => $data[1],
                ]);
                if($data[1] == 0) {
                    CartAdditional::where([
                        ['cart_id', $request->id,],
                        ['additional_id', $data[0]],
                    ])->delete();
                }
                break;

            case 'orderan':
                OrderJasa::where('order_id', $request->id)->update([
                    'status' => $request->status,
                ]);
                $order = OrderJasa::with('details', 'products')->where('order_id', $request->id)->first();
                if($request->status == 'pesanan_selesai') {
                    $total = new OrderSuccess;
                    $total->order_id = $request->id;
                    $total->studio_id = $order->products->studio_id;
                    $total->amount = $order->details->subtotal;
                    $total->setPaid();
                    $total->save();

                    Jasa::where('jasa_id', $order->products->jasa_id)->increment('jasa_sold');
                    StudioPoint::create([
                        'studio_id' => $order->products->studio_id,
                        'order_id' => $request->id,
                        'value' => 10,
                        'source' => 'Pesanan Selesai',
                    ]);
                }
                return response()->json(['status' => 125, 'url' => '/']);
                break;

            case 'reject':
                $order = OrderJasa::with('details', 'products')->where('order_id', $request->id)->first();
                OrderJasa::where('order_id', $request->id)->update([
                    'status' => $request->status,
                ]);
                Jasa::where('jasa_id', $order->products->jasa_id)->increment('jasa_cancel');
                OrderCancel::create([
                    'customer_id' => auth()->user()->id,
                    'studio_id' => $order->products->studio_id,
                    'order_id' => $request->id,
                    'status' => $request->status,
                ]);
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
        OrderJasa::where('order_id', $id)->delete();
    }
}
