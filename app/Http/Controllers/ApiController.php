<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use App\Models\State;
use App\Models\OrderJasa;
use App\Models\OrderJasaMedia;

class ApiController extends Controller
{
    public static function regencies($id) {
        $data = DB::table('regencies')->where('province_id', $id)->get();
        return $data;
    }
    public static function provinces($id) {
        $data = DB::table('provinces')->where('id', $id)->get();
        return $data;
    }
    public static function districts($id) {
        $data = DB::table('districts')->where('regency_id', $id)->get();
        return $data;
    }
    public static function villages($id) {
        $data = DB::table('villages')->where('district_id', $id)->get();
        return $data;
    }


    public static function province($id) {
        $data = DB::table('provinces')->where('id', $id)->first();
        return $data;
    }
    public static function regencie($id) {
        $data = DB::table('regencies')->where('id', $id)->first();
        return $data;
    }
    public static function district($id) {
        $data = DB::table('districts')->where('id', $id)->first();
        return $data;
    }
    public static function village($id) {
        $data = DB::table('villages')->where('id', $id)->first();
        return $data;
    }
    // public function allAddress() {
    //     $data = State::with('city')->take(100)->get();
    //     return response()->json($data);
    // }


    public function penjualan($submenu) {
        $value = auth()->user()->id;
        $data = OrderJasa::with(['products.seller'])
        ->whereHas('products.seller', function($q) use($value) {
            $q->where('id', $value);
        })
        ->where('status', $submenu)
        ->get();
        return response()->json($data);
    }
    public function pembelian($submenu) {
        $value = auth()->user()->id;
        $data = OrderJasa::with(['customer', 'products'])
        ->where('customer_id', $value)
        ->where('status', $submenu)
        ->get();
        return response()->json($data);
    }
    public function update() {
        return response()->json("submenu");
    }
    public function pesan() {
        return response()->json("submenu");
    }

    public function store_order_files(Request $request, $id, $label) {
        if(in_array($label, ['pesanan_diproses', 'permintaan_revisi'])) {
            $f = $request->file("order_files");
            $f_name = $f->getClientOriginalName();
            Storage::putFileAs('/', $f, $f_name);
            if($label == 'pesanan_diproses') {
                $data = OrderJasaMedia::create([
                    'order_id' => $id,
                    'result' =>  $f_name,
                ]);
            } else if($label == 'permintaan_revisi') {
                $data = OrderJasaMedia::create([
                    'order_id' => $id,
                    'revisi' =>  $f_name,
                ]);
            }
            // OrderJasa::where('order_id', $id)
            // ->update([
            //     'status' => 'pesanan_dikirim',
            // ]);
        }
    }


}
