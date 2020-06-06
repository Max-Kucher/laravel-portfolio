<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use App\Enums\Status;

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

        if (empty($available_languages)) {
            $lang = new Language();
            $available_langs = $lang->where('status', '=', Status::ACTIVE)->get();

            cache(['available_languages' => $available_langs]);
        }

        if (!is_null($available_languages) && in_array($req_lang, $available_languages)) {
            app()->setLocale($req_lang);
        }

        return $next($request);
    }
}
