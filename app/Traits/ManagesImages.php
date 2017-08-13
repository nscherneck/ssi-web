<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManagesImages
{

    public $destinationFullSizeImageFolder;
    public $destinationThumbnailImageFolder;
    public $fullSizeImagePath;
    public $thumbnailImagePath;
    public $thumbnailImagePrefix;
    public $thumbnailImageHeight;
    public $thumbnailImageWidth;
    public $extension;
    public $file;
    public $imageDefaults;
    public $imageName;

    private function setImageDefaultsFromConfig($imageTypeKey)
    {
        $imageType = 'image-defaults.' . $imageTypeKey;

        $this->imageDefaults = Config::get($imageType);

        $this->setImageProperties();
    }

    private function setImageProperties()
    {
        foreach ($this->imageDefaults as $propertyName => $propertyValue) {
          if (property_exists($this, $propertyName)) {
              $this->$propertyName = $propertyValue;
          }
        }
    }

    private function setFileName($system)
    {
        $this->imageName = $this->processString($system->site->customer->name);
        $this->imageName .= $this->processString($system->site->name);
        $this->imageName .= $this->processString($system->name);
        $this->imageName .= date('Ymd_Gis');
    }

    private function processString($string)
    {
        // 1. strip special characters
        // 2. remove spaces
        // 3. convert to lower case
        return strtolower(str_replace(' ', '_', preg_replace('/[^a-zA-Z0-9 ]/', '', $string))) . '_';
    }

    private function setFileAttributes($model)
    {
        // $this->imageName = $model->file_name;
        $this->extension = $model->ext;
    }

    private function setImageFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    // NEW IMAGES

    private function getUploadedFile()
    {
      return $file = Input::file('image');
    }

    private function makeImageAndThumbnail()
    {
      $filePath = $this->file->getRealPath();
      $fullSizeImageInstance = Image::make($filePath)->orientate();
      $fullSizeImagePath = "{$this->destinationFullSizeImageFolder}/{$this->imageName}.{$this->extension}";
      $thumbnailImageInstance = Image::make($filePath)->resize(
          $this->thumbnailImageWidth,
          $this->thumbnailImageHeight
      )->orientate();
      $thumbnailImagePath = "{$this->destinationThumbnailImageFolder}/{$this->thumbnailImagePrefix}{$this->imageName}.{$this->extension}";

      $this->uploadFullSizeImage($fullSizeImageInstance, $fullSizeImagePath);
      $this->uploadThumbnailImage($thumbnailImageInstance, $thumbnailImagePath);
    }

    private function uploadFullSizeImage(InterventionImage $image, $path)
    {
        $this->uploadToStorage($image, $path);
    }

    private function uploadThumbnailImage(InterventionImage $image, $path)
    {
        $this->uploadToStorage($image, $path);
    }

    private function newFileIsUploaded()
    {
        if (empty(Input::file('image'))) {
          throw new Exception('Image upload was unsuccessful.');
        }
        return true;
    }

    private function saveImageFiles($model)
    {
        try {
          $this->newFileIsUploaded();
        } catch (Exception $e) {
          flash('Sorry!', 'Your image upload was unsuccessful.', 'warning');
          return back();
        }
        $file = $this->getUploadedFile();
        $this->setImageFile($file);
        $this->setFileAttributes($model);
        $this->makeImageAndThumbnail();
    }

    private function deleteExistingImages($photo)
    {
      $fullSizeImagePath = "{$photo->path}/{$photo->file_name}.{$photo->ext}";
      $this->deleteFromStorage($fullSizeImagePath);
      $thumbnailImagePath = "{$photo->path}/thumbnails/{$this->thumbnailImagePrefix}{$photo->file_name}.{$photo->ext}";
      $this->deleteFromStorage($thumbnailImagePath);
    }

    private function deleteFromStorage($path)
    {
      Storage::delete($path);
    }

    private function getFromStorage($path)
    {
        $fileFromStorage = Storage::get($path);
        return Image::make($fileFromStorage);
    }

    private function uploadToStorage(InterventionImage $image, $path)
    {
        $streamedImage = $image->stream();
        Storage::put(
            $path,
            $streamedImage->__toString()
        );
        Storage::setVisibility(
            $path,
            'public'
        );
    }

    private function rotateImages($system, $photo, $degrees)
    {
      $this->setFileName($system);
      $this->rotateFullSizeImage($photo, $degrees);
      $this->rotateThumbnailImage($photo, $degrees);
    }

    private function rotateFullSizeImage($photo, $degrees)
    {
        $fullFilePath = "{$photo->path}/{$photo->file_name}.{$photo->ext}";
        $fullFilePathWithUpdatedFileName = "{$photo->path}/{$this->imageName}.{$photo->ext}";
        $rotatedImageInstance = $this->getFromStorage($fullFilePath)->rotate($degrees);
        $this->uploadToStorage($rotatedImageInstance, $fullFilePathWithUpdatedFileName);
        $this->deleteFromStorage($fullFilePath);
    }

    private function rotateThumbnailImage($photo, $degrees)
    {
        $fullFilePath = "{$photo->path}/thumbnails/thumb-{$photo->file_name}.{$photo->ext}";
        $fullFilePathWithUpdatedFileName = "{$photo->path}/thumbnails/thumb-{$this->imageName}.{$photo->ext}";
        $rotatedImageInstance = $this->getFromStorage($fullFilePath)->rotate($degrees);
        $this->uploadToStorage($rotatedImageInstance, $fullFilePathWithUpdatedFileName);
        $this->deleteFromStorage($fullFilePath);
    }
}
