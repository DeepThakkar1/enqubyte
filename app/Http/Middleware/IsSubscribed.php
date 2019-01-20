<?php

namespace App\Http\Middleware;

use Closure;
use Lubusin\Mojo\Mojo;
use Rennokki\Plans\Models\PlanModel;

class IsSubscribed
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
        if(!$request->user()->hasActiveSubscription())
        {
            $plan = PlanModel::where('name', 'All-in-one monthly')->first();
            if(env('APP_ENV') != 'local'){
                $instamojoFormUrl = 
                    Mojo::giveMeFormUrl($request->user(), $plan->price, 'Monthly Subscription', '9922367414');
                 return redirect($instamojoFormUrl);
            } else {
                $subscription = $request->user()->subscribeTo($plan, 30); // 30 days
                return redirect('subscribed');
            }
            
        }
        return $next($request);
    }
}
