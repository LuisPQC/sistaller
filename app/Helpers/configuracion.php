<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('configuracion')) {
    function configuracion()
    {
        return DB::table('configuracions')->first();
    }
}
