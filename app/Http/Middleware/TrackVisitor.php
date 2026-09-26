<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && $request->routeIs('home', 'portfolio.index', 'products.show')) {
            try {
                $ip = $request->ip();

                Visit::query()->create([
                    'visitor_hash' => hash('sha256', $ip.'|'.$request->userAgent()),
                    'path' => $request->path(),
                    'ip' => $ip,
                    'user_agent' => substr((string) $request->userAgent(), 0, 500),
                    'visited_at' => now(),
                ]);

                if ($request->routeIs('products.show')) {
                    Product::query()->whereKey($request->route('id'))->increment('views_count');
                }
            } catch (\Throwable) {
                // Tracking must never break the response.
            }
        }

        return $next($request);
    }
}
