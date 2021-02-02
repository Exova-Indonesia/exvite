<?php

namespace App\Http\Controllers;

use App\Models\PayMethod;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    public function index() {
        $balance = WalletController::index()->balance;
        return view('/payments', ['balance' => $balance]);
    }
    public function data() {
        $data = PayMethod::all();
        return response()->json($data);
    }
}
