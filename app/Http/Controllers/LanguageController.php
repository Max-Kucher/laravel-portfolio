<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Session\Session;

class LanguageController extends Controller
{

    /**
     * @param string $language
     * @param string $redirect_url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage(string $language = '', string $redirect_url = '') : \Illuminate\Http\RedirectResponse
    {
        $available_languages = Cache::get('available_languages');
        if (!is_null($available_languages) && in_array($language, array_keys($available_languages))) {
            set_user_language($language);
        }

        return back();
    }
}
