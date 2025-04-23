<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (Auth::guest()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.',
            ], 401);
        }

        if (!$request->user()->hasPermissionTo($permission)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You do not have the required permission.',
            ], 403);
        }

        return $next($request);
    }
} 