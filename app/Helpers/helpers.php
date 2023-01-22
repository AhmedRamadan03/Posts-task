<?php

/**
 * upload file from request
 * @param $file File -> file from request
 * @param $path String -> the path of folder of the file
 */


if (!function_exists('uploadFile')) {

    function uploadFile($file, $path)
    {
        $realName = $file->getClientOriginalName();
        $filename = $file->hashName();
        $file->move($path, $filename);
        $fullpath =  $path . $filename;
        return $fullpath;
    }

}

if (!function_exists('isRtl')) {
    function isRtl()
    {
        return app()->getLocale() == 'ar'? true : false;
}


}
