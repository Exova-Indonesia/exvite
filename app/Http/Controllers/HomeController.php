<?php

namespace App\Http\Controllers;

use DB;
use App;
use auth;
use App\Models\Bank;
use App\Models\Jasa;
use App\Models\Plan;
use App\Models\Studio;
use App\Models\Wallet;
use App\Models\ChMessage;
use App\Models\Highlight;
use App\Models\JasaFavorit;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SearchHistory;
use Chatify\Http\Models\Message;


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
        $seller = Jasa::with('seller.logo', 'subcategory', 'cover')
        ->get();
        $official = Studio::where('is_official', 1)->with('portfolio.cover', 'portfolio.subcategory', 'portfolio.seller.logo')
        ->get();
        $balance = Wallet::where('user_id', Auth::user()->id)->first();
        $bank = Bank::where('user_id', Auth::user()->id)->get();
        $messages = ChMessage::where([
            ['to_id', Auth::user()->id],
            // ['seen', 0],
            ])->count();
        $category = SubCategory::all()->random(12);
        } else {
        $balance = '';
        $bank = '';
        }
        $highlight = Highlight::with('product')->get();
        $subs = Plan::all();
        return view('landing', [
            'balance' => $balance,
            'subs' => $subs,
            'bank' => $bank, 
            'highlight' => $highlight,
            'seller' => $seller,
            'category' => $category,
            'messages' => $messages,
            'official' => $official,
        ]);
        // return response()->json([
        //     'highlight' => $highlight,
        // ]);
    }
    public function autocomplete(Request $request)  {
       $query = $request->get('query');
       $data = DB::table('jasa_products')
       ->where('jasa_name', 'LIKE', "%{$query}%")
       ->get();

       $data2 = DB::table('search_history')
       ->where('user_id', auth()->user()->id)
       ->where('content', 'LIKE', "%{$query}%")
       ->get();
       if((count($data) || count($data2)) >= 1) {
        $output = '<ul class="autocomplete" style="display:block;">';
        foreach($data2 as $row)
        {
        $output .= '
        <li class="nav-link text-capitalize">
        <a class="text-primary" href="'.url('search/' . str_replace(' ', '-', strtolower($row->content))).'">'.$row->content.'</a>
        <!-- <span role="button" class="float-right"><i class="text-danger fas fa-times"></i></span> -->
        </li>
        ';
        }
        foreach($data as $row)
        {
        $output .= '
        <li class="nav-link text-capitalize"><a href="'.url('search/' . str_replace(' ', '-', strtolower($row->jasa_name))).'">'.$row->jasa_name.'</a></li>
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
    public function search(Request $request, $title) {
        $balance = WalletController::index()->balance;
        $title = str_replace('-', ' ', $title);

        $check = SearchHistory::where('user_id', auth()->user()->id)
        ->where('content', 'LIKE', "%{$title}%")
        ->first();
        // return response()->json($check);
        if(empty($check)) {
            SearchHistory::create([
                'user_id' => auth()->user()->id,
                'content' => htmlentities($title),
                'availability' => (Auth::user()->notif->pencarian == 1) ? 1 : 0,
            ]);
        }
        $data = Jasa::with('seller')->where('jasa_name', 'LIKE', "%{$title}%")->get();
        if(isset($request->price)) {
            $data = Jasa::with('seller')->where('jasa_price', '<=', $request->price)->get();
        }
        if($request->sort == 'terlaris') {
            $data = Jasa::with('seller')->orderBy('jasa_sold', 'DESC')->get();
        } else if($request->sort == 'terbaru') {
            $data = Jasa::with('seller')->orderBy('created_at', 'DESC')->get();
        } else if($request->sort == 'termurah') {
            $data = Jasa::with('seller')->orderBy('jasa_price', 'ASC')->get();
        }

        return view('search', ['products' => $data, 'balance' => $balance, 'title' => $title]);
    }
    public function favorit() {
        $data = JasaFavorit::with('products.seller', 'products.rating')->where('user_id', auth()->user()->id)->get();
        return view('products.favorite', ['favorite' => $data]);
        // return response()->json(['products' => $data]);
    }
}
