<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $userdata = auth()->user();

        if($userdata->role != "admin"){
            return response()->json([
                "status" => false,
                "message" => "Unauthorized"
            ]);
        }

        return $next($request);
    }
}
