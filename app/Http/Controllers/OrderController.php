<?php

namespace App\Http\Controllers;

use Auth;
use Lang;
use Storage;
use Validator;
use App\Models\Cart;
use App\Models\Jasa;
use App\Models\Studio;
use App\Models\Wallet;
use App\Models\OrderJasa;
use App\Models\JasaRating;
use App\Models\CartDetails;
use App\Models\OrderCancel;
use App\Models\StudioPoint;
use App\Events\OrderConfirm;
use App\Models\OrderSuccess;
use Illuminate\Http\Request;
use App\Models\OrderRevision;
use App\Events\OrderUnConfirm;
use App\Models\CartAdditional;

class OrderController extends Controller
{
    public function __construct() {
        return $this->middleware(['cartsession'])->except(['show', 'update', 'revisi', 'destroy', 'rating_view', 'rating_store']);
    }
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
        $data = OrderJasa::with(['customer', 'products.seller', 'details.payments', 
        'products.cover', 'details.additionals.additional', 'products' => function($q) {
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
            'batal_otomatis' => $countLimit->deadline,
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

            case 'accept':
                $order = OrderJasa::where('order_id', $request->id)->first();
                OrderJasa::where('order_id', $request->id)->update([
                    'status' => $request->status,
                    'batal_otomatis' => $order->deadline,
                ]);
                event(new OrderConfirm($order));
                return response()->json(['status' => 125, 'url' => '/']);
                break;

            case 'finish':
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

                    $studio = Studio::where('id', $order->products->studio_id)->first();
                    $wallet = Wallet::where('user_id', $studio->user_id)->first();
                    Wallet::where('user_id', $studio->user_id)->update([
                        'revenue' => $wallet->revenue + $total->setPaid(),
                        'balance' => $wallet->balance + $total->setPaid(),
                    ]);
                    Jasa::where('jasa_id', $order->products->jasa_id)->increment('jasa_sold');
                    StudioPoint::create([
                        'studio_id' => $order->products->studio_id,
                        'order_id' => $request->id,
                        'value' => 5,
                        'source' => 'Pesanan Selesai',
                    ]);
                }
                return response()->json(["url" => url('/reviews/' . $request->id . '/success')]);
                break;

            case 'reject':
                $order = OrderJasa::with('details', 'products')->where('order_id', $request->id)->first();
                OrderJasa::where('order_id', $request->id)->update([
                    'status' => $request->status,
                ]);
                Jasa::where('jasa_id', $order->products->jasa_id)->increment('jasa_cancel');
                $cc = OrderCancel::create([
                    'customer_id' => auth()->user()->id,
                    'studio_id' => $order->products->studio_id,
                    'order_id' => $request->id,
                    'status' => $request->status,
                ]);
                    $wallet = Wallet::where('user_id', $order->customer_id)->first();
                    $rf = Wallet::where('user_id', $order->customer_id)->update([
                        'fund' => $wallet->fund + $order->details['subtotal'],
                    ]);
                    $wallet = Wallet::where('user_id', $order->customer_id)->first();
                    Wallet::where('user_id', $order->customer_id)->update([
                        'balance' => $wallet->revenue + $wallet->fund,
                    ]);
                // event(new OrderUnConfirm($cc));
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


    public function rating_view($id, $status)
    {
        $osu = OrderSuccess::where('order_id', $id)->with('orders.products.seller', 'orders.products.cover', 'orders.details')->first();
        $rating = JasaRating::where('order_id', $id)->first();
        if($status == 'success' && !empty($osu) && empty($rating)) {
            return view('buyer.rating', ['order' => $osu]);
            // return $osu;
        } else {
            abort(404);
        }
    }


    public function rating_store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:125'],
            'rating' => ['required', 'max:5', 'integer'],
            'order_id' => ['required'],
        ]);

        $rating = intval($request->rating);
        if($rating > 5) {
            $rating = 5;
        }
        $jasa = OrderJasa::where('order_id', $request->order_id)->first();
        JasaRating::firstOrCreate([
            'order_id' => $request->order_id,
        ], [
            'user_id' => auth()->user()->id,
            'order_id' => $request->order_id,
            'jasa_id' => $jasa->product_id,
            'rating' => $rating,
            'content' => htmlentities($request->content),
        ]);
        return redirect('/')->with(['feedback' => true]);
    }
}
