<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManagesImages
{

    public $destinationFolder;
    public $destinationThumbnail;
    public $extension;
    public $file;
    public $imageDefaults;
    public $imageName;
    public $imagePath;
    public $thumbHeight;
    public $thumbPrefix;
    public $thumbnailPath;
    public $thumbWidth;




    // DELETE EXISTING IMAGES

    /**
     * @param $modelImage
     * hand in the model
     */
    private function deleteExistingImages($modelImage)
    {

     // delete old images before saving new

      $this->deleteImage($modelImage, $this->destinationFolder);

      $this->deleteThumbnail($modelImage, $this->destinationThumbnail);

    }

    Private function deleteImage($modelImage, $destination)
    {

      File::delete(public_path($destination) . $modelImage->image_name . '.' . $modelImage->image_ext);

    }

    Private function deleteThumbnail($modelImage, $destination)
    {

      File::delete(public_path($destination) . $this->thumbPrefix . $modelImage->image_name . '.' . $modelImage->image_ext);

    }




    // NEW IMAGES

    private function getUploadedFile()
    {

      return $file = Input::file('image');

    }


    private function makeImageAndThumbnail()
    {

      $image = Image::make($this->file->getRealPath())->orientate()->stream();
      $image_thumb = Image::make($this->file->getRealPath())->resize($this->thumbWidth, $this->thumbHeight)->orientate()->stream();

      // save image to S3
      Storage::put($this->destinationFolder . '/' . $this->imageName . '.' . $this->extension, $image->__toString());
      // set image permissions to make viewable
      Storage::setVisibility($this->destinationFolder . '/' . $this->imageName . '.' . $this->extension, 'public');

      // save thumbnail to S3
      Storage::put($this->destinationThumbnail . '/' . $this->thumbPrefix . $this->imageName . '.' . $this->extension, $image_thumb->__toString());
      // set thumbnail permissions to make viewable
      Storage::setVisibility($this->destinationThumbnail . '/' . $this->thumbPrefix . $this->imageName . '.' . $this->extension, 'public');

    }


    /**
     * @return bool
     */
    private function newFileIsUploaded()
    {
        return !empty(Input::file('image'));
    }


    private function saveImageFiles(UploadedFile $file, $model)
    {

        $this->setImageFile($file);

        $this->setFileAttributes($model);

        $this->makeImageAndThumbnail();

    }


    private function setImageDefaultsFromConfig($imageTypeKey)
    {

        $imageType = 'image-defaults.' . $imageTypeKey;

        $this->imageDefaults = Config::get($imageType);

        $this->setImageProperties();

    }


    private function setFileAttributes($model)
    {

        // $this->imageName = $model->file_name;
        $this->extension = $model->ext;

    }


    private function setFileName($system)
    {

      // $this->imageName = $model->file_name;
      // $this->extension = $model->extension;
      date_default_timezone_set('America/Los_Angeles');
      $this->imageName = strtolower(str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\-]/', '', $system->site->customer->name))) . '_';
      $this->imageName .= strtolower(str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\-]/', '', $system->site->name))) . '_';
      $this->imageName .= strtolower(str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\-]/', '', $system->name))) . '_';
      $this->imageName .= date('Ymd_Gis');

    }


    private function setImageProperties()
    {

        foreach ($this->imageDefaults as $propertyName => $propertyValue){

          if ( property_exists( $this , $propertyName) ){

              $this->$propertyName = $propertyValue;

          }

        }

    }


    private function setImageFile(UploadedFile $file)
    {

        $this->file = $file;

    }

    // IMAGE UPDATES

    private function rotateImage($photo, $degrees)
    {
      $rawPhoto = Image::make(Storage::get($photo->path . '/' . $photo->file_name . '.' . $photo->ext));
      $photoToSave = $rawPhoto->rotate($degrees)->stream();
      Storage::delete($photo->path . '/' . $photo->file_name . '.' . $photo->ext);
      Storage::put($photo->path . '/' . $photo->file_name . '.' . $photo->ext, $photoToSave->__toString());
      Storage::setVisibility($photo->path . '/' . $photo->file_name . '.' . $photo->ext, 'public');

      $rawThumb = Image::make(Storage::get($photo->path . '/' . 'thumbnails' . '/' . 'thumb-' . $photo->file_name . '.' . $photo->ext));
      $thumbToSave = $rawThumb->rotate($degrees)->resize($this->thumbWidth, $this->thumbHeight)->stream();
      Storage::delete($photo->path . '/' . 'thumbnails' . '/' . 'thumb-' . $photo->file_name . '.' . $photo->ext);
      Storage::put($photo->path . '/' . 'thumbnails' . '/' . 'thumb-' . $photo->file_name . '.' . $photo->ext, $thumbToSave->__toString());
      Storage::setVisibility($photo->path . '/' . 'thumbnails' . '/' . 'thumb-' . $photo->file_name . '.' . $photo->ext, 'public');

    }


}
