<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use App\Models\State;
use App\Models\OrderJasa;
use App\Models\OrderJasaResult;
use App\Models\OrderRevision;
use App\Models\SubCategory;
use App\Models\JasaPicture;
use App\Models\JasaRevision;
use App\Models\JasaAdditional;
use App\Models\Jasa;
use App\Models\JasaRating;

class ApiController extends Controller
{
    public static function regencies($id) {
        $data = DB::table('regencies')->where('province_id', $id)->get();
        return $data;
    }
    public static function provinces() {
        $data = DB::table('provinces')->get();
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


    public function penjualan($submenu, $search) {
        if($submenu == 'pesanan_masuk') {
            $submenu = 'menunggu_konfirmasi';
        }
        $value = auth()->user()->id;
        $data = OrderJasa::with(['products.cover', 'products.seller', 'products' => function($q) use($search) {
            ($search == 'null') ? $q->withTrashed() : $q->where('jasa_name', 'LIKE', '%'.$search.'%')->withTrashed();
        }])
        ->where('status', $submenu)
        ->where('seller_id', studio()->id)
        ->orderby('created_at', 'DESC')
        ->get();
        return response()->json($data);
    }
    public function pembelian($submenu, $search) {
        $value = auth()->user()->id;
        $data = OrderJasa::with(['customer', 'products.cover', 'details.payments', 'products' => function($q) use($search) {
            ($search == 'null') ? $q->withTrashed() : $q->where('jasa_name', 'LIKE', '%'.$search.'%')->withTrashed();
        }])
        ->where('customer_id', $value)
        ->where('status', $submenu)
        ->orderby('created_at', 'DESC')
        ->get();
        return response()->json($data);
    }
    public function dibatalkan($submenu, $search) {
        $data = OrderJasa::with(['customer', 'products.cover', 'products' => function($q) use($search) {
            ($search == 'null') ? $q->withTrashed() : $q->where('jasa_name', 'LIKE', '%'.$search.'%')->withTrashed();
        }])
        ->where('status', $submenu)
        ->orderby('created_at', 'DESC')
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
            $path = Auth::user()->id . '/studio/orders' . '/' . date('Y') . '/' . date('F');
            $pathDB = Auth::user()->id . '/studio/orders' . '/' . date('Y') . '/' . date('F');
            $f_name = 'order-' . date('Y-m-d') . '-' . rand(0, 9999) . '-' . strtolower($f->getClientOriginalName());
            Storage::putFileAs($path, $f, $f_name);
            $data = OrderJasaResult::create([
                'order_id' => $id,
                'path' =>  $pathDB . '/' . $f_name,
            ]);
            OrderJasa::where('order_id', $id)
            ->update([
                'status' => 'pesanan_dikirim',
                'batal_otomatis' => now()->addDays(1),
            ]);
        }
    }

    public function getSubCategory($id) {
        $return = SubCategory::where('category_id', $id)->get();
        return response()->json($return);
    }

    public function getPictures($id) {
        $return = Jasa::with('pictures', 'videos')->where('jasa_id', $id)->first();
        return response()->json($return);
    }
    public function getProducts($id) {
        $seller = Jasa::with('seller.logo', 
        'subcategory.parent', 'additional', 
        'revisi', 'cover', 'diskusi.comment.comment_child',
        'diskusi.users', 'diskusi.comment.users', 
        'diskusi.comment.comment_child.users')
        ->where([
            ['jasa_id', $id],
            ])
        ->first();
        return response()->json($seller);
    }
    public function getAdditional($id) {
        $additional = JasaAdditional::where([
            ['id', $id],
            ])
        ->first();
        if(! $additional) {
        $additional = JasaRevision::where([
            ['id', $id],
            ])
        ->first();
        }
        return response()->json($additional);
    }

    public function getRating($id) {
        $data = JasaRating::with('users.avatar')->where('jasa_id', $id)->get();
        return response()->json($data);
    }

}
