<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avatar;
use App\Models\State;
use Illuminate\Http\Request;
use Auth;
use DB;
use Storage;
use Image;
use File;

class ProfileController extends Controller
{

    public function __construct() {
        $this->dimensions = ['75', '240', '480'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state = file_get_contents("https://dev.farizdotid.com/api/daerahindonesia/provinsi");
        $balance = WalletController::index()->balance;
        return view('profile', ['balance' => $balance, 'user' => Auth::user(), 'state' => json_decode($state)]);
        // return response()->json(['balance' => $balance, 'user' => Auth::user()->id, 'state' => json_decode($state)->nama]);
    }
    public function data()
    {
        $user = User::with('address', 'sexType', 'avatar')->where('id', Auth::user()->id)->first();
        return response()->json($user);
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
        $path = base_path('../assets/' . Auth::user()->id . '/profile/avatar');
        $pathDB = asset('storage/' . Auth::user()->id . '/profile/avatar');
        $avatar =  Avatar::where('user_id', Auth::user()->id);
        $f = $request->file('content');
        $f_name = 'user-profile-' . date('Ymdhis') . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        foreach($this->dimensions as $row) {
            $resize = Image::make($f)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
            if (!File::isDirectory($path . '/' . $row)) {
                File::makeDirectory($path . '/' . $row);
            }
            $resize->save($path . '/' . $row . '/' . $f_name);
            if($row == 75) {
                $avatar->update([
                'small' =>  $pathDB . '/' . $row . '/' . $f_name,
                ]);
            } else if ($row == 240) {
                $avatar->update([
                'medium' => $pathDB . '/' . $row . '/' . $f_name,
                ]);
            } else {
                $avatar->update([
                'large' => $pathDB . '/' . $row . '/' . $f_name,
                ]);
            }
        }
        // $r = Storage::putFileAs(Auth::user()->id . '/profile' . '/', $f, $f_name);
        return response()->json(['status' => 'Berhsil Mengubah Foto Profil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function check(Request $request, $id)
    {
        $user = User::where('email', $request->content)->whereNotIn('id', [Auth::user()->id])->first();
        if($user) {
            return response()->json(['status' => 'Email telah digunakan', 'code' => 400]);
        } else {
            return response()->json(['status' => 'Email belum digunakan', 'code' => 200]);
        }
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
        $update =  User::where('id', Auth::user()->id);
        $address =  State::where('user_id', Auth::user()->id);
        switch($request->type) {
            case 'Tanggal Lahir':
               $update->update([
                    'birthday' => $request->content,
                    ]);
                return response()->json(['status' => 'Berhail Mengubah Tanggal Lahir']);
            break;
            case 'Nama':
                $update->update([
                    'name' => $request->content,
                ]);
                return response()->json(['status' => 'Berhail Mengubah Nama']);
                break;
            case 'Jenis Kelamin':
                $update->update([
                    'sex' => $request->content,
                ]);
                return response()->json(['status' => 'Berhail Mengubah Jenis Kelamin']);
                break;
            case 'Alamat':
                $state = file_get_contents("https://dev.farizdotid.com/api/daerahindonesia/provinsi/" . $request->province);
                $city = file_get_contents("https://dev.farizdotid.com/api/daerahindonesia/kota/" . $request->city);
                $disrict = file_get_contents("https://dev.farizdotid.com/api/daerahindonesia/kecamatan/" . $request->district);
                $address->update([
                    'address' => $request->address,
                    'city' => json_decode($city)->nama,
                    'state' => json_decode($state)->nama,
                    'district' => json_decode($disrict)->nama,
                    'address_name' => $request->name,
                ]);
                return response()->json(['status' => 'Berhail Mengubah Alamat']);
                break;
            case 'Email':
                $check = User::where('email', $request->content)->whereNotIn('id', [Auth::user()->id])->first();
                if($check) {
                    return response()->json(['status' => 'Email telah digunakan']);
                } else {
                    $update->update([
                        'email' => $request->content,
                    ]);
                    return response()->json(['status' => 'Berhail Mengubah Email']);
                }
                break;
            case 'Phone':
                $update->update([
                    'phone' => $request->content,
                ]);
                return response()->json(['status' => 'Berhail Mengubah No. Telepon']);
                break;
            case 'File':
                $f = $request->file('content');
                $f_name = 'user-profile-' . date('Ymdhi') . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();
                $r = Storage::putFileAs(Auth::user()->id . '/profile/', $f, $f_name);
                $update->update([
                    'avatar' => asset('storage/' . $r),
                ]);
                return response()->json(['status' => 'Berhsil Mengubah Foto Profil']);
                break;
            default:
            //
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
        //
    }
}
