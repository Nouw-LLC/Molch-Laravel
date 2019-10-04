<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if (auth()->check() && auth()->user()->banned && now()->lessThan(auth()->user()->banned)) {
            $banned_days = now()->diffInDays(auth()->user()->banned);
            $reason = auth()->user()->banned_reason;
            auth()->logout();
            $message = nl2br("Your account has been suspended for ".$banned_days." ".str_plural('day', $banned_days)." \n Reason:".$reason);



            return redirect()->route('banned')->withMessage($message);

//            return redirect()->route('banned')->with(compact('message', 'reason'));
        }

        return $next($request);
    }
}
