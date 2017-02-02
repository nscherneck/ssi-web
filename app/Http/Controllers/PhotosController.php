<?php

namespace App\Http\Controllers;

use App\Traits\ManagesImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Photo;
use DB;

class PhotosController extends Controller
{

  use ManagesImages;

    public function __construct()
    {
      $this->middleware('auth');
      $this->setImageDefaultsFromConfig('systemImage');
    }

    public function index()
    {
        //
    }

    public function storeSystemPhoto(Request $request, System $system)
    {

      $this->validate($request, [
        'image' => 'required|mimes:jpg,jpeg,png,bmp'
      ]);

      // set the name of the file
      $this->setFileName($system);

      $photo = new Photo([
                  'path'            => $this->destinationFolder,
                  'file_name'       => $this->imageName,
                  'ext'             => $request->file('image')->getClientOriginalExtension(),
                  'caption'         => $request->caption,
                  'photoable_type'  => 'App\System',
                  'photoable_id'    => $system->id,
                  'added_by'        => Auth::id()
              ]);

      // save model
      $photo->save();

      // get instance of file
      $file = $this->getUploadedFile();

      // pass in the file and the model
      $this->saveImageFiles($file, $photo);

      flash('Success!', 'Photo added.');
      return redirect()->route('system_show', ['id' => $system->id]);
    }

    public function store(Request $request)
    {
        //
    }

    public function showSystemPhoto(Photo $photo)
    {
        $photo = Photo::find($photo->id);
        $photo_size = round(Storage::size($photo->path . "/" . $photo->file_name . "." . $photo->ext) / 1000000, 2);
        $system = System::find($photo->photoable_id);
        return view('systems.photos.show', compact('system', 'photo', 'photo_size'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Photo $photo)
    {
      $photo->caption = $request->caption;
      $photo->save();

      flash('Success!', 'Photo updated.', 'success');
      return redirect()->route('system_photo_show', ['id' => $photo->id]);
    }

    public function rotateLeft(System $system, Photo $photo)
    {
      $this->rotateImage($system, $photo, 90);
      $photo->file_name = $this->imageName;
      $photo->save();
      return back();
    }

    public function rotateRight(System $system, Photo $photo)
    {
      $this->rotateImage($system, $photo, -90);
      $photo->file_name = $this->imageName;
      $photo->save();
      return back();
    }

    public function destroy(System $system, Photo $photo)
    {
      $this->deleteExistingImages($photo);
      $photo->delete();

      flash('Success!', 'Photo deleted.', 'danger');
      return redirect()->route('system_show', ['id' => $system->id]);
    }
}
