<?php

define('DOCROOT', $_SERVER['DOCUMENT_ROOT']);

use \Illuminate\Support\Facades\Input;

if (!function_exists('resources_url')) {
    function resources_url($path)
    {
        return '/packages/sleepingowl/default/' . $path;
    }
}
