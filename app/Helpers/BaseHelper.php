<?php

namespace App\Helpers;

class BaseHelper
{
    /**
     * @param $num
     * @param int $b
     *
     * @return mixed|string
     */
    public static function toBase($num, $b=62) {
        $base  = env('BASE');
        $r = $num  % $b;
        $res = $base[$r];
        $q = floor($num/$b);
        while ($q) {
            $r = $q % $b;
            $q = floor($q/$b);
            $res = $base[$r] . $res;
        }

        return $res;
    }

    /**
     * @param $num
     * @param int $b
     *
     * @return false|float|int
     */
    public static function toBase10($num, $b = 62)
    {
        $base  = env('BASE');
        $limit = strlen($num);
        $res   = strpos($base, $num[0]);
        for ($i = 1; $i < $limit; $i++) {
            $res = $b * $res + strpos($base, $num[$i]);
        }

        return $res;
    }
}
