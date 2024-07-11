<?php

use Illuminate\Support\Facades\File;

if (! function_exists('imageExists')) {
    function imageExists($image)
    {
        if(File::exists(config('constants.PROFILE_PATH') . '/' . $image)) {
            return true;
        } 
        return false;
    }
}