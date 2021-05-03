<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use Lang;
use Image;
use Storage;
use App\Models\JasaVideos;
use App\Models\StudioLogo;
use App\Models\JasaPicture;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct() {
        $this->dimensions = ['75', '240', '480'];
    }

    public function logo_studio(Request $request) {
        $path = base_path('../assets/' . Auth::user()->id . '/studio/logo' . '/' . date('Y') . '/' . date('F'));
        $pathDB = asset('storage/' . Auth::user()->id . '/studio/logo') . '/' . date('Y') . '/' . date('F');
        $f = $request->file('studio_logo');
        $f_name = 'studio-logo-' . date('Ymdhis') . '-' . Auth::user()->id . '.' . strtolower($f->getClientOriginalExtension());
        $studio = StudioLogo::create([
            'prefix' => 'EX-' . date('his') . rand(0, 9999),
        ]);

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
                $studio->update([
                'small' =>  $pathDB . '/' . $row . '/' . $f_name,
                ]);
            } else if ($row == 240) {
                $studio->update([
                'medium' => $pathDB . '/' . $row . '/' . $f_name,
                ]);
            } else {
                $studio->update([
                'large' => $pathDB . '/' . $row . '/' . $f_name,
                ]);
            }
        }
        return $studio->id;
    }

    public function jasa_picture(Request $request) {
        $dimension = ['250', '720', '1440'];
        $ids = array();
        $path = base_path('../assets/' . Auth::user()->id . '/studio/products' . '/' . date('Y') . '/' . date('F'));
        $pathDB = asset('storage/' . Auth::user()->id . '/studio/products') . '/' . date('Y') . '/' . date('F');
        if($request->file('jasa_picture')) {
            $f = $request->file('jasa_picture');
        } else if($request->file('cover_picture')) {
            $f = $request->file('cover_picture');
        } else if($request->file('jasa_video')) {
            $f = $request->file('jasa_video');
        }
        $f_name = 'products-' . rand() . '-' . Auth::user()->id . '.' . strtolower($f->getClientOriginalExtension());
        if(in_array(strtolower($f->getClientOriginalExtension()), ['mp4', '3gp', 'mov', 'avi'])) {
            $jpid = JasaVideos::create([
                //
            ]);
            $videos = JasaVideos::where('id', $jpid->id);
        } else if(in_array(strtolower($f->getClientOriginalExtension()), ['png', 'jpg', 'jpeg'])) { 
            $jpid = JasaPicture::create([
                //
            ]);
            $picture = JasaPicture::where('id', $jpid->id);
         } else {
             return response()->json("Format File Salah", 400);
         }

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }
    if(in_array(strtolower($f->getClientOriginalExtension()), ['png', 'jpg', 'jpeg'])) {
        foreach($dimension as $row) {
            $resize = Image::make($f)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
            if (!File::isDirectory($path . '/' . $row)) {
                File::makeDirectory($path . '/' . $row);
            }

            $resize->save($path . '/' . $row . '/' . $f_name);
            if($row == 250) {
                $id = $picture->update([
                'small' =>  $pathDB . '/' . $row . '/' . $f_name,
                ]);
            } else if ($row == 720) {
                $id = $picture->update([
                'medium' => $pathDB . '/' . $row . '/' . $f_name,
                ]);
            } else {
                $id = $picture->update([
                'large' => $pathDB . '/' . $row . '/' . $f_name,
                ]);
            }
        }
    } else if(in_array(strtolower($f->getClientOriginalExtension()), ['mp4', '3gp', 'mov', 'avi'])) {
        $id = $videos->update([
            'path' => Auth::user()->id . '/studio/products/videos' . '/' . date('Y') . '/' . date('F') . '/' . $f_name,
        ]);
        Storage::putFileAs(Auth::user()->id . '/studio/products/videos' . '/' . date('Y') . '/' . date('F'), $f, $f_name);
    }
        return $jpid->id;
    }
}
