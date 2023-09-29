<?php

namespace App\Traits;

use File;

/**
 *
 */
trait ImageUploadTrait
{
    public static function uploadImage($file, $path)
    {
        try {
            $destinationPath = public_path('backend/upload/' . $path);
            // prx();
            // if (!file_exists($destinationPath)) {
            //     mkdir($destinationPath."1.txt");
            // }

            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $path . '/' . $filename;
            $filename = str_replace(" ", "", $filename);
            $file->move($destinationPath, $filename);
            return $filename;
        } catch (\Exception $ex) {
            dd($ex);
            \Log::error($ex->getMessage());
            \Session::flash('error', 'Error - Something Went Wrong..');
        }
    }

    public static function updateImage($old_file_name, $file, $path)
    {
        try {
            $destinationPath = public_path('upload/' . $path);
            $old_file = $destinationPath . '/' . $old_file_name;

            if (file_exists($old_file)) {
                File::delete($old_file);
            }

            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $path . '/' . $filename;
            $file->move($destinationPath, $filename);
            return $filename;
        } catch (\Exception $ex) {
            dd($ex);
            \Log::error($ex->getMessage());
            \Session::flash('error', 'Error - Something Went Wrong..');
        }
    }
    public static function removeImage($filename, $path)
    {
        $destinationPath = public_path($path);
        $filename = $destinationPath . '/' . $filename;

        if (file_exists($filename)) {
            unlink($filename);
        }

        return true;
    }

    public static function uploadMedia($id, $file, $path)
    {
        try {
            $ext = $file->getClientOriginalExtension();
            // if($ext=="mp4" || $ext =="mkv" || $ext =="avi"){
            // 	$filename = $id."-".time().".mp4";
            // }else{
            $filename = $id . '-' . time() . '.' . $ext;
            // }
            $path = $path . '/' . $filename;
            $disk = \Storage::disk('media')->put($path, fopen($file, 'r+'));
            return $filename;
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            \Session::flash('error', 'Error - Something Went Wrong..');
            // return redirect()->back();
        }
    }

    public static function removeMedia($filename, $path)
    {
        \Storage::disk('media')->delete($path . '/' . $filename);
        // unlink(public_path('assets/uploads/'.$path.'/'.$filename));
        return true;
    }
}
