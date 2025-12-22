<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Get supported locales from config.
     */
    protected function getSupportedLocales(): array
    {
        return config('app.available_locales', ['fr', 'en', 'ar']);
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = $this->getSupportedLocales();

        // Check if locale is set in URL parameter
        if ($request->has('lang') && in_array($request->get('lang'), $supportedLocales)) {
            $locale = $request->get('lang');
            Session::put('locale', $locale);
        }
        // Check if locale is set in session
        elseif (Session::has('locale') && in_array(Session::get('locale'), $supportedLocales)) {
            $locale = Session::get('locale');
        }
        // Check browser preference
        elseif ($request->hasHeader('Accept-Language')) {
            $browserLocale = substr($request->header('Accept-Language'), 0, 2);
            $locale = in_array($browserLocale, $supportedLocales) ? $browserLocale : config('app.locale');
        }
        // Default to app locale
        else {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
