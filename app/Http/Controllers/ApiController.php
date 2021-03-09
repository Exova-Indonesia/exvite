<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\State;

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
}
