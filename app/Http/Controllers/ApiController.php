<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\State;

class ApiController extends Controller
{
    public function province($id) {
        $data = State::with('city')->where('province_code', $id)->take(100)->get();
        return response()->json($data);
    }
    public function city($id) {
        $data = DB::table('db_postal_code_data')->where('province_code', $id)->get();
        return response()->json($data);
    }
    public function postal($id) {
        $data = DB::table('db_postal_code_data')->where('city', 'LIKE', '%'.$id.'%')->get();
        return response()->json($data);
    }
    public function allAddress() {
        $data = State::with('city')->take(100)->get();
        return response()->json($data);
    }
}
