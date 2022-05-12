<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
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
        $lang = $request->lang;
        if ($lang == 'pl' || $lang == 'en' || $lang == 'de') {
            \App::setlocale($lang);
        }
        else {
            \App::setlocale('pl');
        }
        return $next($request);
    }
}
