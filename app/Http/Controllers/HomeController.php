<?php

namespace App\Http\Controllers;

use DB;
use App;
use auth;
use App\Models\Wallet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*if (! in_array($locale, ['en', 'id'])) {
            abort(400);
        }
        App::setLocale($locale);
        */
        if(Auth::user()) {
            $balance = Wallet::where('user_id', Auth::user()->id)->first();
            return view('home', ['balance' => $balance]);
        } else {
            return view('home');
        }
    }
    public function autocomplete(Request $request)  {
       $query = $request->get('query');
       $data = DB::table('templates')->where('templates_name', 'LIKE', "%{$query}%")->get();
       $data2 = DB::table('users')->where('name', 'LIKE', "%{$query}%")->get();
       if((count($data) || count($data2)) >= 1) {
        $output = '<ul class="autocomplete" style="display:block;">';
        foreach($data as $row)
        {
        $output .= '
        <li class="nav-link text-capitalize"><a href="'.$row->templates_name.'">'.$row->templates_name.'</a></li>
        ';
        }
        foreach($data2 as $row)
        {
        $output .= '
        <li class="nav-link text-capitalize"><a href="'.$row->user_id.'">'.$row->name.'</a></li>
        ';
        }
        $output .= '</ul>';
        return $output;
    } else {
        $output = '<ul class="autocomplete" style="display:none;">';
        $output .= '</ul>';
        return $output;
        }
    }
}
