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

      // set the name of the file i.e.
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

      flash('Photo Added', 'Success');
      return redirect()->route('system_show', ['id' => $system->id]);
    }
    //
    // public function storeSystemPhoto(Request $request, System $system)
    // {
    //   $path = 'customer-data/';
    //   $path .= strtolower(str_replace(' ', '_', $system->site->customer->name)) . '/'; // customer dir
    //   $path .= 'sites/';
    //   $path .= strtolower(str_replace(' ', '_', $system->site->name)) . '/'; //site dir
    //   $path .= 'systems/';
    //   $path .= strtolower(str_replace(' ', '_', $system->name)) . '/'; //system dir
    //   $path .= 'photos'; //photos dir
    //
    //   $photo = new Photo;
    //   $photo->path = $request->file('image')->store($path);
    //   Storage::setVisibility($photo->path, 'public');
    //   $photo->caption = $request->caption;
    //   $photo->photoable_id = $system->id;
    //   $photo->photoable_type = 'App\System';
    //   $photo->added_by = Auth::id();
    //
    //   $photo->save();
    //
    //   flash('Photo Added', 'Success');
    //   return redirect()->route('system_show', ['id' => $system->id]);
    // }

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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
