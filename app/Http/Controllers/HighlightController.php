<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index() {
        $balance = WalletController::index()->balance;
        return view('/highlight', ['balance' => $balance]);
    }
    public function all() {
        $balance = User::all();
        // return view('/highlight', ['balance' => $balance]);
        return response()->json($balance);
    }
}
