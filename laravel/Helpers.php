<?php 

class Helpers {

    public static function uploadFile($file) 
    {
        $dir = "uploads/";
        $fileName = $dir.str_random(20).".".$file->getClientOriginalExtension();
        $file->move($dir,$fileName);
        return url($fileName);
    }

}