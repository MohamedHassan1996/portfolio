<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the language parameter from the route
        $lang = $request->route('lang', 'en');  // Default to 'en' if no language is provided

        // Validate the language (optional, handle unsupported languages)
        if (!in_array($lang, ['en', 'ar'])) {
            abort(404, 'Language not supported.');
        }

        // Set the application locale
        App::setLocale($lang);

        // Optionally, store the language in the session to persist it across requests
        Session::put('locale', $lang);

        $locale = $request->get('lang', config('app.locale')); // Default to app locale if not provided

        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}
