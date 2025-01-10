<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->route('lang') ?? 'en'; // Default to 'en'

        if (!in_array($lang, ['ar','en'])) {
            $lang = 'en';
        }

        App::setLocale($lang);

        return $next($request);
    }
}
