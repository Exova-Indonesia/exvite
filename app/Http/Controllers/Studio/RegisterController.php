<?php

namespace App\Http\Controllers\Studio;

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
        return redirect('studio/getting-started');
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
        $logo = StudioLogo::where('id', $request->studio_logo)->first();
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
                        if(empty($check->name) && ! isset($check->is_complete)) {
                            return view('seller.start.index');
                        } else {
                            return redirect('studio/description');
                        }
                        break;
                            case "description":
                        if(empty($check) || empty($check->name)) {
                            return redirect('studio/getting-started');
                        } else if(empty($check->description) && !empty($check->name) && !$check->is_complete) {
                            return view('seller.start.description');
                        } else {
                            return redirect('studio/agreement');
                        }
                        break;
                        //     case "domain":
                        // if(empty($check) || empty($check->description)) {
                        //     return redirect('studio/getting-started');
                        // } else if(empty($check->subdomain) && !empty($check->description) && !$check->is_complete) {
                        //     return view('seller.start.domain');
                        // } else {
                        //     return redirect('studio/agreement');
                        // }
                        // break;
                            case "agreement":
                        if(empty($check) || empty($check->description)) {
                            return redirect('studio/getting-started');
                        } else if(! empty($check->description) && !$check->is_complete) {
                            return view('seller.start.agreement');
                        } else {
                            return redirect('/mystudio');
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
        $data = Studio::where('user_id', auth()->user()->id)->first();
        Studio::where('user_id', auth()->user()->id)->update([
            'description' => $request->studio_description ?? $data->description,
            'slogan' => $request->studio_slogan ?? $data->slogan,
            'subdomain' => ($data->is_complete == 0) ? $request->studio_domain ?? $data->subdomain : $data->subdomain,
            'is_complete' => ($data->is_complete == 0) ? ($request->is_agree == 'on') ? true : false : $data->subdomain,
        ]);
        return redirect('studio/getting-started');
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
