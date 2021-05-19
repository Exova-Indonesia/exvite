<?php

namespace App\Http\Controllers;

use Lang;
use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\JasaView;
use App\Models\JasaFavorit;
use App\Models\JasaDiskusi;
use App\Models\JasaDiskusiComment;
use App\Models\JasaDiskusiCommentChild;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.show');
    }


    public function views(Request $request)
    {
        JasaView::create([
            'jasa_id' => $request->jasid,
            'user_id' => $request->id,
        ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_diskusi(Request $request)
    {
        switch($request->label) {
            case "diskusi":
                JasaDiskusi::create([
                    'user_id' => auth()->user()->id,
                    'jasa_id' => $request->id,
                    'content' => htmlentities($request->content),
                ]);
            break;
            case "comment":
                JasaDiskusiComment::create([
                    'user_id' => auth()->user()->id,
                    'diskusi_id' => $request->id,
                    'content' => htmlentities($request->content),
                ]);
            break;
            default:
            return response()->json(['statusMessage' => 'Terjadi tindakan illegal!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Jasa::with(['seller.logo', 'seller.address', 
        'subcategory.parent', 'additional', 'revisi', 'cover', 
        'rating.users', 'seller.portfolio' => function($q) {
            $q->take(4);
        }])
        ->where([
            ['slugs', $id],
            ])
        ->first();
        if($seller) {
            $similliar = Jasa::with('seller.logo', 'subcategory', 'cover')
            ->where([
                ['jasa_name', 'LIKE', '%' . explode(' ', $seller->name)[0] . '%'],
                ])
            ->get();
            return view('products.show', ['seller' => $seller, 'similliar' => $similliar]);
        } else {
            abort(404);
        }
        // return response()->json($seller);
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
        //
    }

    /**
     * Add Favorite the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_favorite(Request $request)
    {
        $data = Jasa::where('jasa_id', $request->id)->first();
        if($data->studio_id == (studio()->id ?? 0)) {
            return response()->json(['statusMessage' => Lang::get('validation.favorit.failed')], 400);
        }
        $fav = JasaFavorit::query();
        if($fav->first()) {
            $fav->delete();
            return response()->json(['statusMessage' => 'Berhasil menghapus']);
        } else {
        $fav->create([
            'user_id' => auth()->user()->id,
            'jasa_id' => $request->id,
        ]);
            return response()->json(['statusMessage' => 'Berhasil menambah ke favorit']);
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
        Jasa::where('jasa_id', $id)->delete();
        return response()->json(['message' => 'Berhasil menghapus', 'url' => "{{ url('/mystudio') }}"]);
    }
}
