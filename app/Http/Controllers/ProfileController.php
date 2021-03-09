<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Points;
use App\Models\UserNotif;
use App\Models\Avatar;
use App\Models\Activity;
use App\Models\SearchHistory;
use App\Models\State;
use Illuminate\Http\Request;
use Auth;
use Lang;
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
        $state = DB::table('provinces')->get();
        $balance = WalletController::index()->balance;
        return view('profile', ['balance' => $balance, 'user' => Auth::user(), 'state' => $state]);
        // return response()->json(['balance' => $balance, 'user' => Auth::user()->id, 'state' => json_decode($state), 'points' => $points]);
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
        $path = base_path('../assets/' . Auth::user()->id . '/profile/avatar/' . date('Y') . '/' . date('F'));
        $pathDB = asset('storage/' . Auth::user()->id . '/profile/avatar') . '/' . date('Y') . '/' . date('F');
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
        Activity::create([
            'user_id' => Auth::user()->id,
            'activity' => Lang::get('activity.user.profile.changepic'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
        ]);
        // $r = Storage::putFileAs(Auth::user()->id . '/profile' . '/', $f, $f_name);
        return response()->json(['status' => Lang::get('validation.user.profile.success.changepic')]);
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
        if(!empty($user)) {
            return response()->json(['status' => Lang::get('validation.user.profile.failed.uniqueEmail'), 'code' => 400, ]);
        } else {
            return response()->json(['code' => 200, 'content' => $request->content]);
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
        $notif =  UserNotif::where('user_id', Auth::user()->id);
        $address =  State::where('user_id', Auth::user()->id);
        switch($request->type) {
            case 'Tanggal Lahir':
               $update->update([
                    'birthday' => $request->content,
                    ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.birthday'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return response()->json(['status' => Lang::get('validation.user.profile.success.birthday')]);
            break;

            case 'Nama':
                $update->update([
                    'name' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.name') . $request->content,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return response()->json(['status' => Lang::get('validation.user.profile.success.name') . $request->content]);
                break;

            case 'Jenis Kelamin':
                $update->update([
                    'sex' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.sex'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return response()->json(['status' => Lang::get('validation.user.profile.success.sex')]);
                break;

            case 'Alamat':
                $state = ApiController::province($request->province);
                $city = ApiController::regencie($request->city);
                $disrict = ApiController::district($request->district);
                $address->update([
                    'address' => $request->address,
                    'state' => $state->name,
                    'city' => $city->name,
                    'district' => $disrict->name,
                    'address_name' => $request->name,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.address'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return response()->json(['status' => Lang::get('validation.user.profile.success.address')]);
                break;

            case 'Email':
                $check = User::where('email', $request->content)->whereNotIn('id', [Auth::user()->id])->first();
                if($check) {
                    return response()->json(['status' => Lang::get('validation.user.profile.failed.uniqueEmail'), 'code' => 400]);
                } else {
                    $update->update([
                        'email' => $request->content,
                        'email_verified_at' => NULL,
                    ]);
                    $request->user()->sendEmailVerificationNotification();
                    return response()->json(['status' => Lang::get('validation.user.profile.success.email')]);
                }
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.email'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'Phone':
                $update->update([
                    'phone' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.phone'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return response()->json(['status' => Lang::get('validation.user.profile.success.phone')]);
                break;

            case 'File':
                $f = $request->file('content');
                $f_name = 'user-profile-' . date('Ymdhi') . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();
                $r = Storage::putFileAs(Auth::user()->id . '/profile/', $f, $f_name);
                $update->update([
                    'avatar' => asset('storage/' . $r),
                ]);
                return response()->json(['status' => Lang::get('validation.user.profile.success.changepic')]);
                break;

            case 'pembelian':
                $notif->update([
                    'pembelian' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.pembelian'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'penjualan':
                $notif->update([
                    'penjualan' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.penjualan'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'promo':
                $notif->update([
                    'promo' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.promo'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'pengingat':
                $notif->update([
                    'pengingat' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.pengingat'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'aktivitas':
                $notif->update([
                    'aktivitas' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.aktivitas'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'deleteAktivitas':
                Activity::where('user_id', Auth::user()->id)->update([
                    'availability' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.delAktivitas'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => 1,
                ]);
                return response()->json(['status' => Lang::get('activity.user.profile.delAktivitas')]);
                break;

            case 'pencarian':
                $notif->update([
                    'pencarian' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.pencarian'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                break;

            case 'deletePencarian':
                SearchHistory::where('user_id', Auth::user()->id)->update([
                    'availability' => $request->content,
                ]);
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.user.profile.delPencarian'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return response()->json(['status' => Lang::get('activity.user.profile.delPencarian')]);
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
