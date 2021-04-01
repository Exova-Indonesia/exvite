<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slugs = str_replace('-', ' ', $id);
        $seller = Jasa::with('seller.logo', 'subcategory.parent', 'additional', 'revisi', 'cover')
        ->where([
            ['jasa_name', $slugs],
            ['jasa_status', 1]
            ])
        ->first();
        $similliar = Jasa::with('seller.logo', 'subcategory', 'cover')
        ->where([
            ['jasa_status', true],
            ['jasa_name', 'LIKE', '%' . explode(' ', $seller->name)[0] . '%'],
            ])
        ->get();
        return view('products.show', ['seller' => $seller, 'similliar' => $similliar]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
