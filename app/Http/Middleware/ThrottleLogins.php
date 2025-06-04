<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThrottleLogins
{
    protected $rateLimiter;

    public function __construct(RateLimiter $rateLimiter)
    {
        $this->rateLimiter = $rateLimiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 5, $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        if ($this->rateLimiter->tooManyAttempts($key, $maxAttempts)) {
            return response()->json([
                'message' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.'
            ], 429);
        }

        $this->rateLimiter->hit($key, $decayMinutes * 60);

        $response = $next($request);

        return $response->header('X-RateLimit-Limit', $maxAttempts)
            ->header('X-RateLimit-Remaining', $maxAttempts - $this->rateLimiter->attempts($key));
    }

    protected function resolveRequestSignature(Request $request)
    {
        return Str::lower($request->ip()) . '|' . $request->input('email');
    }
}