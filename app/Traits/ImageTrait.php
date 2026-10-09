<?php
namespace App\Traits;
use Intervention\Image\ImageManager;

trait ImageTrait
{

protected $path="app/public/images/cover";
protected $hight=600;
protected $width=600;
    
    public function resizeImage($image)
    {
        
        $image_name=$this->renameImage($image);
        $resizedImage=ImageManager::gd()->read($image)->scale($this->width, $this->hight);
        //save the image
        $resizedImage->toJpeg()->save(storage_path($this->path."/".$image_name));
        return 'images/cover/'.$image_name;
    }

    public function renameImage($image){
        $originalName=$image->getClientOriginalName();
        return time()."-".$originalName;
    }
}
