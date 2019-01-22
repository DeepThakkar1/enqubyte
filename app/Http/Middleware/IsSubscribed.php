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
            if(auth()->user()->lastSubscription() != null && auth()->user()->lastSubscription()->isPendingCancellation()) {
                 return $next($request);
            }

            if(auth()->user()->lastSubscription() != null)
            {
                return redirect('billing');
            }

            return redirect('redirecting');
            
        }
        return $next($request);
    }
}
