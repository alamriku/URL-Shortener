<?php

namespace App\Factories;

use App\Helpers\LinkHelper;
use App\Models\Link;
use Illuminate\Support\Str;

class LinkFactory
{
    const MAXIMUM_LINK_LENGTH = 74453;

    public static function formatLink($link_ending)
    {
        return env('APP_PROTOCOL') . env('APP_ADDRESS') . '/' . $link_ending;
    }

    public static function createLink($long_url, $optionals)
    {
        if (strlen($long_url) > self::MAXIMUM_LINK_LENGTH) {
            throw new \Exception('Sorry, but your link is longer than the
                maximum length allowed.');
        }

        $isLongEqualShort = LinkHelper::checkIfLongIsShort($long_url);
        if($isLongEqualShort){
            throw new \Exception('Sorry, but your link is already shorten.');
        }

        $short_url   = LinkHelper::longLinkExists($long_url);
        $link_length = Str::length($short_url);

        if ($short_url && $link_length < 6) {
            $extended_link = LinkHelper::addExtra($short_url, $link_length);

            return self::formatLink($extended_link);
        }

        if ($short_url) {
            return self::formatLink($short_url);
        }

        $link_ending = LinkHelper::findSuitableTininess();

        $link_length   = Str::length($link_ending);
        $extended_link = false;
        if ($link_length < 6) {
            $extended_link = LinkHelper::addExtra($link_ending, $link_length);
        }

        $link            = new Link();
        $link->short_url = $link_ending;
        $link->long_url  = $long_url;

        if ($extended_link) {
            $link->short_chars = $extended_link;
        } else {
            $link->short_chars = $link_ending;
        }

        $link->fill($optionals);
        $link->save();

        if ($extended_link) {
            return self::formatLink($extended_link);
        }

        return self::formatLink($link_ending);
    }
}
