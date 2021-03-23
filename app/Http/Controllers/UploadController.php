<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioLogo;
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
        $folder = uniqid() . '-' . now()->timestamp;
        $path = base_path('../assets/' . Auth::user()->id . '/studio/logo' . '/' . date('Y') . '/' . date('F') . $folder);
        $pathDB = asset('storage/' . Auth::user()->id . '/studio/logo') . '/' . date('Y') . '/' . date('F')  . $folder;
        $f = $request->file('studio_logo');
        $f_name = 'studio-logo-' . date('Ymdhis') . '-' . Auth::user()->id . '.' . $f->getClientOriginalExtension();
        StudioLogo::create([
            'prefix' => 'EX-' . date('his') . rand(0, 9999),
            'folder' => $folder,
        ]);
        $studio = StudioLogo::where('folder', $folder);

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
        return $folder;
    }
}
