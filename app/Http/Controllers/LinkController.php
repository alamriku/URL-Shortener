<?php

namespace App\Http\Controllers;

use App\Factories\LinkFactory;
use App\Helpers\ClickHelper;
use App\Http\Requests\ShortUrlRequest;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('timer')->only('forwarding');
    }

    public function store(ShortUrlRequest $request)
    {
        $long_url = $request->long_url;
        $optionals = $request->except('long_url', '_token');

        try {
           $short_url = LinkFactory::createLink($long_url, $optionals);
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect()->route('short_link.index');
    }

    public function forwarding(Request $request, $short_url, RateLimiter $limiter)
    {
        $link = Link::where('short_chars', $short_url)->first();
        $long_url = $link->long_url;
        $clicks = (int) $link->clicks;

        if(is_int($clicks)){
            $clicks += 1;
        }
        $link->clicks = $clicks;
        $link->save();

        ClickHelper::recordClick($link, $request);
        return redirect()->to($long_url, 301);
    }
}
