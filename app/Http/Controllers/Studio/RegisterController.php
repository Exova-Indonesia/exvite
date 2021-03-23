<?php

namespace App\Http\Controllers\studio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studio;
use App\Models\StudioLogo;
use Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Studio::where('user_id', auth()->user()->id)
        ->first();
        if(empty($check)) {
            return redirect('studio/getting-started');
        }
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
        $logo = StudioLogo::where('folder', $request->studio_logo)->first();
        Studio::create([
            'prefix' => 'EX-' . date('his') . rand(0, 9999),
            'user_id' => auth()->user()->id,
            'logo_id' => $logo->id,
            'name' => $request->studio_name,
        ]);
        return redirect('/studio/description');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $check = Studio::where('user_id', auth()->user()->id)->first();
            switch($id) {
                case "getting-started":
                    if(empty($check->name)) {
                        return view('seller.start.index');
                    } else {
                        return redirect('studio/description');
                    }
                    break;
                        case "description":
                    if(empty($check->description)) {
                        return view('seller.start.description');
                    } else {
                        return redirect('studio/view');
                    }
                    break;
                default:
                return redirect('studio/getting-started');
            }
        }

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
