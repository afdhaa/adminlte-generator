<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Validator;
use Illuminate\Support\Facades\Auth;
use Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('api')->user()) {
            $request->merge(array("api" => auth('api')->user()));

            return $next($request);
        } else {
            return Response::json([
                'success' => false,
                'data' => [],
                'message' => 'Token not Verified'
            ], 400);
        }
    }
}
