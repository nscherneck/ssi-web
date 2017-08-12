<?php

namespace App\Http\Controllers\Documents;

use App\Document;
use App\Component;
use App\Traits\ManagesDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ComponentDocumentsController extends \App\Http\Controllers\Controller
{
    use ManagesDocuments;

    public function __construct()
    {
        $this->middleware('auth');
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
    public function store(Request $request, Component $component)
    {
        $folder = 'customer-data/component_documents';
        $this->getUploadedFile(Input::file('document'));
        $fileName = $this->generateFileName();
        $this->setFileAttributes($fileName, $folder);
        $this->saveFileToStorage();

        $document = new Document([
            'documentable_id' => $component->id,
            'documentable_type' => 'App\Component',
            'path' => $this->destinationFolder,
            'file_name' => $this->fileName,
            'ext' => $this->extension,
            'added_by' => Auth::id()
        ]);

        $document->save();

        flash('Success!', 'Document added.');

        return redirect()->route('component_show', ['id' => $component->id]);
    }

    private function generateFileName()
    {
        return pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $url = $this->getShortTermAccessToFileFromS3($document);
        return response()->redirectTo($url);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $component = $document->documentable;
        $this->deleteDocument($document);
        $document->delete();

        flash('Success!', 'Document deleted.', 'danger');

        return redirect()->route('component_show', ['id' => $component->id]);
    }
}
