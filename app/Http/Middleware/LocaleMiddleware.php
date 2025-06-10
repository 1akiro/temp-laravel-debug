<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    protected $availableLocales = ['en', 'lv']; // Fallback if config is missing
    
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = config('app.available_locales', $this->availableLocales);
        
        // Log locale detection
        Log::debug('LocaleMiddleware processing', [
            'session_locale' => Session::get('locale'),
            'user_locale' => auth()->check() ? auth()->user()->locale : null,
            'available_locales' => $availableLocales
        ]);
        
        // Set locale from user preferences
        if (auth()->check() && auth()->user()->locale) {
            $locale = auth()->user()->locale;
            App::setLocale($locale);
            Log::debug('Setting locale from user preference', ['locale' => $locale]);
        } 
        // Set locale from session
        elseif (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
            Log::debug('Setting locale from session', ['locale' => $locale]);
        } 
        // Set locale from browser
        else {
            $preferredLocale = $this->getPreferredLanguage($request, $availableLocales);
            $locale = $preferredLocale ?: config('app.locale', 'lv');
            App::setLocale($locale);
            Log::debug('Setting locale from browser or default', ['locale' => $locale]);
        }

        return $next($request);
    }

    /**
     * Get the preferred language from the Accept-Language header.
     */
    protected function getPreferredLanguage(Request $request, array $availableLocales): ?string
    {
        $acceptLanguage = $request->header('Accept-Language');
        
        if (!$acceptLanguage) {
            return null;
        }
        
        // Process Accept-Language header
        $languages = [];
        foreach (explode(',', $acceptLanguage) as $language) {
            $parts = explode(';', $language);
            $iso = trim($parts[0]);
            $q = isset($parts[1]) ? (float) str_replace('q=', '', $parts[1]) : 1.0;
            $languages[$iso] = $q;
        }
        
        arsort($languages);
        
        // Find matching locale
        foreach (array_keys($languages) as $language) {
            $shortLang = strtolower(substr(trim($language), 0, 2));
            
            if (in_array($shortLang, $availableLocales)) {
                return $shortLang;
            }
        }
        
        return null;
    }
}
