<?php
use Carbon\Carbon;

if (!function_exists('imageName')) {
    function imageName($name, $withExt = 1, $prefix = NULL, $suffix = NULL)
    {
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $name = preg_replace("/[\s]|\#|\$|\&|\@/", "_", pathinfo($name, PATHINFO_FILENAME));
        $name = $prefix . '_' . $name . '_' . $suffix;
        if ($prefix == NULL) {
            $name = substr($name, -170);
        } else {
            $name = substr($name, 0, 170);
        }

        $name .= ('_' . time());

        if ($withExt) {
            $name .= ('.' . $extension);
        }

        return $name;
    }
}

if (!function_exists('imageExtension')) {
    function imageExtension($name)
    {
        return pathinfo($name, PATHINFO_EXTENSION);
    }
}



if (!function_exists('isExist')) {
    function isExist($fileName, $folder = "")
    {
        if ($fileName != NULL && $fileName != '' && $fileName != '0' && file_exists(public_path().DIRECTORY_SEPARATOR.$fileName) && !is_dir($fileName)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('unlinkFile')) {
    function unlinkFile($fileName)
    {
        if(isExist($fileName)){
            unlink(public_path().DIRECTORY_SEPARATOR.$fileName);
        }
    }
}

