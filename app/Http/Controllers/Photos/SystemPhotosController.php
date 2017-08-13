<?php

namespace App\Http\Controllers\Photos;

use App\Photo;
use App\System;
use Illuminate\Http\Request;
use App\Traits\ManagesImages;
use Illuminate\Support\Facades\Auth;

class SystemPhotosController extends \App\Http\Controllers\Controller
{
    use ManagesImages;

    public function __construct()
    {
        $this->middleware('auth');
        $this->setImageDefaultsFromConfig('systemImage');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, System $system)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        // set the name of the file
        $this->setFileName($system);

        $photo = new Photo([
            'path'            => $this->destinationFullSizeImageFolder,
            'file_name'       => $this->imageName,
            'ext'             => $request->file('image')->getClientOriginalExtension(),
            'caption'         => $request->caption,
            'photoable_type'  => 'App\System',
            'photoable_id'    => $system->id,
            'added_by'        => Auth::id()
        ]);

        // save model
        $photo->save();

        // $file = $this->getUploadedFile();
        $this->saveImageFiles($photo);

        flash('Success!', 'Photo added.');

        return redirect($system->path() . '#photos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        $photo = Photo::find($photo->id);
        $system = System::find($photo->photoable_id);

        return view('systems.photos.show', compact('system', 'photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $photo->caption = $request->caption;
        $photo->save();

        flash('Success!', 'Photo updated.', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $system = System::find($photo->photoable_id);

        $this->deleteExistingImages($photo);
        $photo->delete();

        flash('Success!', 'Photo deleted.', 'danger');

        return redirect($system->path() . "#photos");
    }

    public function rotateLeft(Photo $photo)
    {
        $system = System::find($photo->photoable_id);

        $this->rotateImages($system, $photo, 90);

        $photo->file_name = $this->imageName;
        $photo->save();

        return back();
    }

    public function rotateRight(Photo $photo)
    {
        $system = System::find($photo->photoable_id);

        $this->rotateImages($system, $photo, -90);

        $photo->file_name = $this->imageName;
        $photo->save();

        return back();
    }
}
