<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DetectSuspiciousActivity
{
    protected $suspiciousPatterns = [
        '/\<script\>/i',
        '/\%27/i', // Single quote
        '/\-\-/i', // SQL comment
        '/\/\*/i', // SQL comment
        '/union\s+select/i',
        '/exec\s+xp_/i',
    ];

    public function handle(Request $request, Closure $next)
    {
        $input = json_encode($request->all());
        $url = $request->fullUrl();
        
        foreach ($this->suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $input) || preg_match($pattern, $url)) {
                Log::channel('securityEvents')->warning('Suspicious activity detected', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $url,
                    'input' => $input,
                    'pattern_matched' => $pattern,
                    'timestamp' => now()->toDateTimeString(),
                ]);
                
                if (strpos($pattern, 'script') !== false) {
                    return response()->json(['message' => 'Permintaan ditolak karena alasan keamanan.'], 403);
                }
            }
        }
        
        return $next($request);
    }
}