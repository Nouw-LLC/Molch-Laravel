<?php
/**
 * Copyright (c) 2019.
 *
 * @Author Fabio Dijkshoorn nouw@nouw.xyz
 */

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class CheckWarnings
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
        if (auth()->check() && auth()->user()->warning >= 3) {
            $user = auth()->user();
            $date = Carbon::now()->addWeek()->toDateString();

            $user->banned = $date;
            $user->banned_reason = "Exceeded the limit of 3 warnings, \n Your warnings will be reset after 1 week.";
            $user->warning = 0;
            $user->save();

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
