<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class EvaluatorMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$request->user()->isEvaluator()) {
                throw new AuthorizationException('You are not allowed to access this resource.');
            }
        } catch (AuthorizationException $e) {
            abort(401, $e->getMessage());
        }

        return $next($request);
    }
}
