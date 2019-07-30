<?php

namespace App\Http\Middleware;

use Closure;
use ErrorType;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $feature = '')
    {
        $account = $request->user()->account;

        if ($account->subcription == '') {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::NO_SUBSCRIPTION
            ]);
        }

        if (! $account->isSubscriptionActive()) {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::SUBSCRIPTION_ENDED
            ]);
        }

        if ($feature == 'profile_view') {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::SUBSCRIPTION_ENDED
            ]);
        }

        if ($feature == 'create_report') {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::SUBSCRIPTION_ENDED
            ]);
        }

        if ($feature == 'referesh_report') {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::SUBSCRIPTION_ENDED
            ]);
        }

        if ($feature == 'create_plan') {
            if (! $account->canCreatePlan()) {
                return response()->json([
                    'ok' => false,
                    'error' => ErrorType::PLAN_LIMIT_EXCEEDED
                ]);
            }
        }

        if ($feature == 'create_user') {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::SUBSCRIPTION_ENDED
            ]);
        }

        if ($feature == 'use_brand') {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::SUBSCRIPTION_ENDED
            ]);
        }

        return $next($request);
    }
}
 