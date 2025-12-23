<?php

use App\Models\Setting;
use App\Services\VersionService;

if (!function_exists('app_version')) {
    /**
     * Get the application version information.
     *
     * @param  string|null  $key  Key to retrieve: 'version', 'tag', 'branch', 'is_stable', 'formatted', or null for full array
     * @return mixed
     */
    function app_version(?string $key = null): mixed
    {
        $service = app(VersionService::class);

        if ($key === 'formatted') {
            return $service->getFormattedVersion();
        }

        if ($key === null) {
            return $service->getVersionInfo();
        }

        $info = $service->getVersionInfo();

        return $info[$key] ?? null;
    }
}

if (!function_exists('setting')) {
    /**
     * Get or set a setting value.
     *
     * @param  string|array|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function setting(string|array|null $key = null, mixed $default = null): mixed
    {
        // Return all settings as array
        if (is_null($key)) {
            return Setting::allAsArray();
        }

        // Set multiple settings
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Setting::set($k, $v);
            }
            return true;
        }

        // Get a single setting
        return Setting::get($key, $default);
    }
}

if (!function_exists('settings')) {
    /**
     * Alias for setting() helper.
     *
     * @param  string|array|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function settings(string|array|null $key = null, mixed $default = null): mixed
    {
        return setting($key, $default);
    }
}

if (!function_exists('trans_setting')) {
    /**
     * Get a translatable setting value for the current locale.
     * If the value is an array with locale keys (fr, en, ar), it resolves to the current locale.
     * If the value is a JSON string with locale keys, it decodes and resolves it.
     * Otherwise, it returns the value as-is.
     *
     * @param  string  $key  The setting key
     * @param  mixed  $default  Default value if setting doesn't exist
     * @return mixed
     */
    function trans_setting(string $key, mixed $default = null): mixed
    {
        $value = setting($key, $default);

        // If value is a JSON string, try to decode it
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            }
        }

        return resolve_locale($value);
    }
}

if (!function_exists('resolve_locale')) {
    /**
     * Resolve a locale-specific value from a translatable array or return the value as-is.
     * Supports arrays with locale keys (fr, en, ar) and returns the current locale's value.
     * Also handles JSON strings containing translatable data.
     *
     * @param  mixed  $value  The value to resolve
     * @return mixed
     */
    function resolve_locale(mixed $value): mixed
    {
        // If value is a JSON string, try to decode it first
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            }
        }

        if (!is_array($value)) {
            return $value;
        }

        $locale = app()->getLocale();
        $fallbackLocale = config('app.fallback_locale', 'fr');

        // Check if it's a translatable array (has locale keys)
        $localeKeys = ['fr', 'en', 'ar'];
        $hasLocaleKeys = !empty(array_intersect(array_keys($value), $localeKeys));

        if ($hasLocaleKeys) {
            // Return current locale, fallback locale, or first available
            return $value[$locale] ?? $value[$fallbackLocale] ?? reset($value);
        }

        // It's a regular array (like features list), try to resolve each item
        return array_map(function ($item) {
            return resolve_locale($item);
        }, $value);
    }
}
