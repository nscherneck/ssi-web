<?php

namespace App\Http\Controllers;

use App\Photo;
use App\System;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Traits\ManagesImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PhotosController extends Controller
{
    use ManagesImages;

    public function __construct()
    {
        $this->middleware('auth');
        $this->setImageDefaultsFromConfig('systemImage');
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

        return redirect($system->path());
    }

    public function showSystemPhoto(Photo $photo)
    {
        $photo = Photo::find($photo->id);
        $system = System::find($photo->photoable_id);

        return view('systems.photos.show', compact('system', 'photo'));
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

        return redirect($system->path());
    }
}
