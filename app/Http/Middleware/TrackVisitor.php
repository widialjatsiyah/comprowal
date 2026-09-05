<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && $request->routeIs('home', 'portfolio.index')) {
            try {
                Visit::query()->create([
                    'visitor_hash' => hash('sha256', $request->ip().'|'.$request->userAgent()),
                    'path' => $request->path(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 500),
                    'visited_at' => now(),
                ]);
            } catch (\Throwable) {
            }
        }

        return $response;
    }
}
