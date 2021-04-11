<?php 

namespace App\Helpers;

use App\Models\Studio;

class Studios {

    public function __consctruct()
    {
        return $this->middleware('auth');
    }
    public function studio() {
        return Studio::where('user_id', auth()->user()->id)->first();
    }
}

?>