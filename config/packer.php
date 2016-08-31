<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Current environment
    |--------------------------------------------------------------------------
    |
    | Set the current server environment. Leave empty to laravel autodetect
    |
    */

    'environment' => '',

    /*
    |--------------------------------------------------------------------------
    | App environments to not pack
    |--------------------------------------------------------------------------
    |
    | These environments will not be minified and all individual files are
    | returned
    |
    */

    'ignore_environments' => ['local'],

    /*
    |--------------------------------------------------------------------------
    | Public accessible path
    |--------------------------------------------------------------------------
    |
    | Set absolute folder path to public view from web. If you are using
    | laravel, this value will be set with public_path() function
    |
    */

    'public_path' => realpath(getenv('DOCUMENT_ROOT')),

    /*
    |--------------------------------------------------------------------------
    | Asset absolute location
    |--------------------------------------------------------------------------
    |
    | Set absolute URL location to asset folder. Many times will be same as
    | public_path but using absolute URL. If you are using laravel, this value
    | will be set with asset() function
    |
    */

    'asset' => 'http://'.getenv('SERVER_NAME').'/',

    /*
    |--------------------------------------------------------------------------
    | Cache folder to store packed files
    |--------------------------------------------------------------------------
    |
    | If you are using relative paths to second paramenter in css and js
    | commands, this files will be created with this folder as base.
    |
    | This folder in relative to 'public_path' value
    |
    */

    'cache_folder' => '/cache/',

    /*
    |--------------------------------------------------------------------------
    | Check if some file to pack have a recent timestamp
    |--------------------------------------------------------------------------
    |
    | Compare current packed file with all files to pack. If exists one more
    | recent than packed file, will be packed again with a new autogenerated
    | name.
    |
    */

    'check_timestamps' => false,

    /*
    |--------------------------------------------------------------------------
    | Check if you want minify css files or only pack them together
    |--------------------------------------------------------------------------
    |
    | You can check this option if you want to join and minify all css files or
    | only join files
    |
    */

    'css_minify' => true,

    /*
    |--------------------------------------------------------------------------
    | Check if you want minify js files or only pack them together
    |--------------------------------------------------------------------------
    |
    | You can check this option if you want to join and minify all js files or
    | only join files
    |
    */

    'js_minify' => true,

    /*
    |--------------------------------------------------------------------------
    | Use fake images stored in src/images/ when original image does not exists
    |--------------------------------------------------------------------------
    |
    | You can use fake images in your developments to avoid not existing
    | original images problems. Fake images are stored in src/images/ and used
    | with a rand
    |
    */

    'images_fake' => true,

    /*
    |--------------------------------------------------------------------------
    | Set resized images quality
    |--------------------------------------------------------------------------
    |
    | Valid values are from 0 to 100
    |
    */

    'quality' => 85
);
