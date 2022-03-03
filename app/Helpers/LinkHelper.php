<?php

namespace App\Helpers;

use App\Models\Link;

class LinkHelper
{
    const EXTRA = 'kHiLaF';
    /**
     * @param $long_url
     *
     * @return bool|[short_url]
     */
    static public function longLinkExists($long_url)
    {
        $link_base = Link::where('long_url', $long_url)->first();

        if (blank($link_base)) {
            return false;
        } else {
            return $link_base->short_url;
        }
    }

    /**
     * @param $link_ending
     *
     * @return bool
     */
    static public function linkExists($link_ending) {
        $link = Link::where('short_url', $link_ending)
            ->first();

        if ($link != null) {
            return $link;
        }
        else {
            return false;
        }
    }

    static public function findSuitableTininess()
    {
        $base = env('BASE_LENGTH');

        $link = Link::orderBy('created_at', 'desc')->first();

        if (is_null($link)) {
            $base10_val = 0;
            $base_x_val = 0;
        } else {
            $latest_link_ending = $link->short_url;
            $base10_val = BaseHelper::toBase10($latest_link_ending, $base);
            $base10_val++;
        }

        $base_x_val = null;

        while (self::linkExists($base_x_val) || $base_x_val == null) {
            $base_x_val = BaseHelper::toBase($base10_val, $base);
            $base10_val++;
        }

        return $base_x_val;
    }

    /**
     * @param $short_url
     * @param $link_length
     *
     * @return string
     */
    public static function addExtra($short_url, $link_length)
    {
        $garbage = substr(self::EXTRA, 0, (6 - $link_length));
        $short_url = $short_url.$garbage;

        return $short_url;
    }

    public static function checkIfLongIsShort($long_url)
    {
        $urlInfo = pathinfo($long_url);
        $link = Link::where('short_chars', $urlInfo['basename'])->first();
        if(blank($link)){
            return false;
        } else {
            return true;
        }
    }
}
