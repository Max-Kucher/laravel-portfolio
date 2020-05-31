<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $req_lang = $request->segment(1);
        $available_languages = cache('available_languages');

        if (in_array($req_lang, $available_languages)) {
            app()->setLocale($req_lang);
        }

        return $next($request);
    }
}
