<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Storage;

class Picture extends Model
{
    public static $thumbPixels  = 200;
    public static $thumbQuality = 70;
    public static $imagePath    = 'images/';
    public static $thumbPath    = 'thumbs/';

    public static function store($requestData, $type='')
    {
        //get file extension
        if (!isset($requestData['image']))
            return null;

        $imageFile = $requestData['image'];
        $extension = $imageFile->getClientOriginalExtension();

        //filename to store
        $pathname  = $type; // the piece in between [photo/thumb path] and [fileName]
        
        $filePath  = Storage::disk('public')->putFile(Picture::$imagePath.$pathname, $imageFile);
        
        // Store thumbnail
        if ($filePath)
        {
            $fileName      = substr($filePath, strlen(Picture::$imagePath) + strlen($pathname) + 1); // only file name
            $filePath      = Storage::disk('public')->putFileAs(Picture::$thumbPath.$pathname, $imageFile, $fileName);
            $imageFilePath = public_path('/storage/'.$filePath);
            //die(print_r([$fileName, $filePath, $imageFilePath]));
            Image::make($imageFilePath)->resize(Picture::$thumbPixels, Picture::$thumbPixels, function($constraint) { $constraint->aspectRatio(); })->save($imageFilePath, Picture::$thumbQuality);
        
            return '/storage/'.$filePath;
        }
        return null;
    }

    public static function remove($file)
    {
        // delete all related photos 
        $pathImage = Picture::$imagePath.$this->file;
        if (Storage::disk('public')->exists($pathImage));
            Storage::disk('public')->delete($pathImage);

        $pathThumb = Picture::$thumbPath.$this->file;
        if (Storage::disk('public')->exists($pathThumb));
            Storage::disk('public')->delete($pathThumb);

    }
}
