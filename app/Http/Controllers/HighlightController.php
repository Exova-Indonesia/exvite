<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index() {
        $balance = WalletController::index()->balance;
        return view('/highlight', ['balance' => $balance]);
    }
    public function all() {
        $highlight = Highlight::with('product')->get();
        // return view('/highlight', ['balance' => $balance]);
        return response()->json($highlight);
    }
}
