<?php
namespace App\Http\Services;

use App\Media;
use URL;
use Image;

class FileService{

  public static function upload_image($file,$publisher_id){
    $userFolder = public_path('sources/images/private/USER_ID_'.$publisher_id);
    if(!file_exists($userFolder)){
      //create a new one for this user
      mkdir($userFolder);
    }

    $imageExtension = $file->getClientOriginalExtension();
    $imageName = uniqid('img_').'_'.time().'.'.$imageExtension;
    $file->move($userFolder,$imageName);

    $img = Image::make($userFolder.'/'.$imageName);

    $image = new Media;
    $image->size = $img->filesize();
    $image->url = URL::asset('sources/images/private/USER_ID_'.$publisher_id.'/'.$imageName);
    $image->type = 'img/'.$imageExtension;
    $image->width = $img->width();
    $image->height = $img->height();
    $image->save();

    return $image;
  }


  public static function upload_file($file){

  }

}
