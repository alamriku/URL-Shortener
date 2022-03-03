<?php

namespace App\Helpers;

use App\Models\Click;
use App\Models\Link;
use Illuminate\Http\Request;

class ClickHelper
{
    public static function getCity($ip)
    {
        return geoip()->getLocation($ip)->city;
    }

    public static function getLat($ip)
    {
        return geoip()->getLocation($ip)->lat;
    }

    public static function getLon($ip)
    {
        return geoip()->getLocation($ip)->lon;
    }

    static private function getHost($url)
    {
        return parse_url($url, PHP_URL_HOST);
    }

    public static function recordClick(Link $link, Request $request)
    {
        $ip         = $request->ip();
        $user_agent = $request->header('User-Agent');

        $click = new Click();
        $click->ip = $ip;
        $click->link_id = $link->id;
        $click->referer    = $request->server('HTTP_REFERER');
        $click->location   = self::getCity($ip);
        $click->latitude   = self::getLat($ip);
        $click->longitude  = self::getLon($ip);
        $click->os_platform         = AgentHelper::get_os($user_agent);
        $click->device     = AgentHelper::get_device($user_agent);
        $click->browser    = AgentHelper::get_browsers($user_agent);
        $click->save();

        return true;
    }
}
