<?php

namespace App\Http\Controllers\studio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studio;
use App\Models\StudioLogo;
use App\Models\Jasa;
use App\Models\JasaRevision;
use App\Models\JasaPicture;
use App\Models\JasaAdditional;
use App\Models\Category;
use App\Models\StudioAddress;

class StudioController extends Controller
{
    public function __construct() {
        return $this->middleware(['auth', 'studiocomplete'])->except('studios');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/mystudio/dashboard');
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
        $studio = Studio::where('user_id', auth()->user()->id)->first();
        $jasa = Jasa::create([
            'jasa_id' => date('ymd') . rand(),
            'studio_id' => $studio->id,
            'jasa_name' => $request->title,
            'jasa_deskripsi' => $request->description,
        ]);
        return redirect('manage/' . strtolower(str_replace(' ', '-', $request->title)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Studio::with(
            ['portfolio.subcategory.parent',
             'owner', 'logo',
             'address.province', 'address.district',
              'portfolio.cover', 'portfolio' => function($q) {
            $q->where('jasa_status', true);
        }])
        ->where([
            ['user_id', auth()->user()->id],
            ])
        ->first();
        $category = Category::all();
        switch($id) {
            case "dashboard":
                return view('seller.dashboard', ['seller' => $seller]);
                // return response()->json(['seller' => $seller]);
                break;
            case "upload":
                return view('seller.uploads.title', ['seller' => $seller, 'category' => $category]);
                // return response()->json(['seller' => $seller]);
                break;
            case "orders":
                return view('seller.orders', ['seller' => $seller]);
                // return response()->json(['seller' => $seller]);
                break;
        }
    }

    public function manage($id)
    {
        $category = Category::all();
        $studio = Studio::where('user_id', auth()->user()->id)->first();
        $slugs = str_replace('-', ' ', $id);
        $data = Jasa::with('seller', 'subcategory', 'revisi', 'additional', 'pictures')
        ->where([
            ['jasa_name', $slugs],
            ['studio_id', $studio->id],
            ])
        ->first();
        if($data) {
            return view('seller.uploads.index', ['products' => $data, 'category' => $category, 'seller' => $studio]);
            // return response()->json($data);
        } else {
            return back();
        }

    }

    public function share($id)
    {
        $category = Category::all();
        $studio = Studio::where('user_id', auth()->user()->id)->first();
        $slugs = str_replace('-', ' ', $id);
        $data = Jasa::with('seller', 'subcategory', 'revisi', 'additional', 'pictures')
        ->where([
            ['jasa_name', $slugs],
            ['user_id', $studio->id],
            ])
        ->first();
        if($data) {
            return view('seller.uploads.finish', ['products' => $data]);
            // return response()->json($data);
        } else {
            return back();
        }

    }

    public function studios($slug) {
        $slugs = str_replace('-', ' ', $slug);
        $seller = Studio::with(['portfolio.subcategory.parent', 'owner', 'logo', 'portfolio.cover', 'portfolio' => function($q) {
            $q->where('jasa_status', true);
        }])
        ->where([
            ['name', $slugs],
            ['is_complete', 1],
            ])
        ->first();
        if(! empty($seller)) {
            if($seller->user_id == auth()->user()->id ?? 0) {
                return redirect('/mystudio/dashboard');
            } else {
                return view('seller.dashboard', ['seller' => $seller]);
            }
        } else {
            abort(404);
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

    public function edit_profil(Request $request, $id)
    {
        $data = Studio::where('user_id', auth()->user()->id)->first();
        $data->update([
            'slogan' => $request->studio_slogan,
            'description' => $request->description,
            'logo_id' => ($request->studio_logo) ? $request->studio_logo : $data->logo_id,
        ]);

        // $address = StudioAddress::where('studio_id', $data->id);
        // if(! empty($address)) {
        //     $address->update([
        //         'studio_id' => $data->id,
        //         'address_name' => $request->address_name,
        //         'address' => $request->address,
        //         'state' => $request->province,
        //         'city' => $request->district,
        //         'subdistrict' => $request->subdistrict,
        //         'village' => $request->village,
        //     ]);
        // } else {
        //     $address->create([
        //         'studio_id' => $data->id,
        //         'address_name' => $request->address_name,
        //         'address' => $request->address,
        //         'state' => $request->province,
        //         'city' => $request->district,
        //         'subdistrict' => $request->subdistrict,
        //         'village' => $request->village,
        //     ]);
        // }
        StudioAddress::updateOrCreate([
            'studio_id' => $data->id,
        ],
        [
            'studio_id' => $data->id,
            'address_name' => $request->address_name,
            'address' => $request->address,
            'state' => $request->province,
            'city' => $request->district,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
        ]);
        return back();
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
        $jasa = Jasa::where('jasa_id', $id)->first();
        $studio = Studio::where('user_id', auth()->user()->id)->first();
        if(empty($request->info['rev_id'])) {
            $revision = JasaRevision::create([
                'count' => $request->info['revisi_count'],
                'price' => preg_replace(['/[Rp,.]/'],'',$request->info['revisi_price'] ?? 0),
                'add_day' => $request->info['revisi_waktu'],
            ]);
        } else {
            $revision = JasaRevision::where('id', $request->info['rev_id'])
            ->update([
                'count' => $request->info['revisi_count'],
                'price' => preg_replace(['/[Rp,.]/'],'',$request->info['revisi_price'] ?? 0),
                'add_day' => $request->info['revisi_waktu'],
            ]);
        }

        if($request->picture) {
            foreach($request->picture as $jp) {
                JasaPicture::where('id', $jp)->update([
                    'jasa_id' => $id,
                ]);
            }
        }

        Jasa::where('jasa_id', $id)->update([
            'jasa_name' => $request->info['title'],
            'jasa_deskripsi' => $request->info['description'],
            'jasa_subcategory' => $request->info['subcategory'],
            'jasa_price' =>  preg_replace(['/[Rp,.]/'],'',$request->info['price_start']),
            'jasa_thumbnail' => (! empty($request->picture)) ? $request->picture[0] : $jasa->jasa_thumbnail,
            'jasa_revision' => $revision->id ?? $jasa->jasa_revision,
            'jasa_status' => true,
        ]);
        $add = array();
        if($request->data) {
            foreach($request->data as $name) {
                if(isset($name['id'])) {
                    JasaAdditional::where('id', $name['id'])->update([
                        'title' => $name['add_name'],
                        'jasa_id' => $id,
                        'price' => preg_replace(['/[Rp,.]/'],'', $name['add_price'] ?? 0),
                        'add_day' => $name['add_day'],
                    ]);
                } else {
                    JasaAdditional::create([
                        'title' => $name['add_name'],
                        'jasa_id' => $id,
                        'price' => preg_replace(['/[Rp,.]/'],'', $name['add_price'] ?? 0),
                        'add_day' => $name['add_day'],
                    ]);
                }
            }
        }
        return response()->json(['status' => 200, 'url' => url('share/') . strtolower(str_replace(' ', '-', $request->title)) , 'message' => 'Berhasil Mengubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = JasaAdditional::where('id', $id)->delete();
    }

    public function destroy_product($id)
    {
        $data = Jasa::where('jasa_id', $id)->update([
            'jasa_status' => false,
        ]);
        return response()->json(['status' => 200, 'url' => '/', 'message' => 'Berhasil Menghapus']);
    }

    public function destroy_picture($id)
    {
        $jasa = Jasa::where('jasa_thumbnail', $id)->first();
        JasaPicture::where('id', $id)->delete();
        if(! empty($jasa)) {
            $pic = JasaPicture::where('jasa_id', $jasa->jasa_id)->first();
            $jasa = Jasa::where('jasa_thumbnail', $id)
            ->update([
                'jasa_thumbnail' => $pic->id ?? '',
                ]);
            }
    }
}
