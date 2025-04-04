<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLastVisitedTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
    
        if (auth()->check() && $request->route()->named('tasks.show')) {
            auth()->user()->update([
                'last_visited_task_id' => $request->route('task')->id
            ]);
        }
    
        return $response;
    }
}
