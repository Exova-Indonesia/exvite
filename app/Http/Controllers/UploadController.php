<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioLogo;
use App\Models\JasaPicture;
use Auth;
use Lang;
use DB;
use Storage;
use Image;
use File;

class UploadController extends Controller
{
    public function __construct() {
        $this->dimensions = ['75', '240', '480'];
    }

    public function logo_studio(Request $request) {
        $path = base_path('../assets/' . Auth::user()->id . '/studio/logo' . '/' . date('Y') . '/' . date('F'));
        $pathDB = asset('storage/' . Auth::user()->id . '/studio/logo') . '/' . date('Y') . '/' . date('F');
        $f = $request->file('studio_logo');
        $f_name = 'studio-logo-' . date('Ymdhis') . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();
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
        $dimension = ['250', '720', '1080'];
        $ids = array();
        $path = base_path('../assets/' . Auth::user()->id . '/studio/products' . '/' . date('Y') . '/' . date('F'));
        $pathDB = asset('storage/' . Auth::user()->id . '/studio/products') . '/' . date('Y') . '/' . date('F');
        $f = $request->file('jasa_picture');
        $f_name = 'products-' . rand() . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();
        $jpid = JasaPicture::create([
            //
        ]);
        $picture = JasaPicture::where('id', $jpid->id);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

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
        return $jpid->id;
    }
}
