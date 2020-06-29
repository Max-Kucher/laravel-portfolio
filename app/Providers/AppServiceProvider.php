<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Language;
use App\Enums\Status;

use App\Console\Commands\ModelMakeCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \Exception
     */
    public function boot()
    {
        $available_languages = Cache::get('available_languages');

        if (empty(cache('available_languages'))) {
            if (empty($available_languages)) {
                $available_languages = Language::where('status', Status::ACTIVE)->pluck('name', 'lang_code')->all();

                Cache::put('available_languages', $available_languages);
            }
        }

        $session = new Session();
        if ($session->has('language')) {
            $language = $session->get('language');
        } elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $best_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            $language = in_array($best_language, array_keys($available_languages)) ? $best_language : config('app.locale');
        } else {
            $language = config('app.locale');
        }

        set_user_language($language);
        View::share('available_languages', $available_languages);
    }
}
