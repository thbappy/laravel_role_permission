<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Utlity extends Model
{
    public static function file_upload($request, $file_name, $upload_dir)
    {
        if ($request->hasFile($file_name)) {
            $file = $request->$file_name;
            $filename = time() . '_' . $file->getClientOriginalName();
            $up_path = "uploads/".date('Y-m')."/$upload_dir/";
            $path = $file->move($up_path, $filename);
            if ($file->getError()) {
                $request->session()->flash('warning', $file->getErrorMessage());

                return FALSE;
            }

            return $path;
        }
    }
    // file upload only uplod folder without date
    public static function file_upload_directory($request, $file_name, $upload_dir)
    {
        if ($request->hasFile($file_name)) {
            $file = $request->$file_name;
            $filename = time() . '_' . $file->getClientOriginalName();
            $up_path = "uploads"."/$upload_dir/";
            $file->move($up_path,$filename);
            $path = $filename;
            if ($file->getError()) {
                $request->session()->flash('warning', $file->getErrorMessage());

                return FALSE;
            }

            return $path;
        }
    }
}
