<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Studios extends Facade {
    public static function getFacadeAccessor()
    {
        return 'studio';
    }
}

?>