<?php

namespace App\Helpers;

class AppHelper
{

    public static function vnd_format($number, $suffix = 'đ')
    {
        return number_format($number, 0, ',', '.') . "{$suffix}";
    }
}
