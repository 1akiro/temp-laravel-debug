<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;


class LangController extends Controller
{

    protected $availableLocales = ['en', 'lv']; // Fallback if config is missing

    public function switchLang(Request $request, $locale) {

        $availableLocales = Config::get('app.available_locales', $this->availableLocales);


        if (!in_array($locale, config('app.available_locales', ['en', 'lv']))) {
            $locale = config('app.fallback_locale', 'en');
            \Log::info('Invalid locale, falling back', ['fallback' => $locale]);
        }

        if (Auth::check()) {
            $user = Auth::user();
            $user->locale = $locale;
            $user->save();
        }

        Session::put('locale', $locale);
        return back();
    }
}
