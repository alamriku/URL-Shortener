<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Carbon\Carbon;
use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\RateLimiter;

class LinkTimer extends ThrottleRequests
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $maxAttempts
     * @param int $decayMinutes
     * @param string $prefix
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $maxAttempts = 2, $decayMinutes = 1, $prefix = '')
    {
        $link = Link::where('short_chars', request()->path())->first();

        if(blank($link)){
            abort(404);
        }

        if(Carbon::parse(now())->toDateTimeString() > $link->expire_at){
            abort(404);
        }

        $maxAttempts = $link->attempt;
        $decayMinutes = $link->time_frame;
        $block_duration = $link->block_duration;
        $key = $this->resolveRequestSignature($request);

        $maxAttempts = $this->resolveMaxAttempts($request, $maxAttempts);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            throw $this->buildException($request, $key, $maxAttempts, $responseCallback = null);
        }

        $this->limiter->hit($key, $block_duration * 60);

        $response = $next($request);

        return $this->addHeaders(

            $response, $maxAttempts,

            $this->calculateRemainingAttempts($key, $maxAttempts)

        );
    }
}
