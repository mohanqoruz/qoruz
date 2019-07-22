<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $account = $request->user()->account;

        if (! $account->isSubscriptionActive()) {
            return response()->jsson([
                'test' => 'jjjj'
            ]);
        }

        if (! $account->canCreatePlan()) {
            return response()->json([
                'test' => 'ok'
            ]);
        }

        return $next($request);
    }
}
 