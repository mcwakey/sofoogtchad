<?php

use App\Models\Setting;

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
