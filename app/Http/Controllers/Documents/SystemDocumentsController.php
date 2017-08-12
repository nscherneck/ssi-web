<?php

namespace App\Http\Controllers\Documents;

use App\System;
use App\Document;
use Illuminate\Http\Request;
use App\Traits\ManagesDocuments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SystemDocumentsController extends \App\Http\Controllers\Controller
{
    use ManagesDocuments;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function store(Request $request, System $system)
    {
        $folder = 'customer-data/system_documents';
        $this->getUploadedFile(Input::file('document'));
        $fileName = $this->generateFileName();
        $this->setFileAttributes($fileName, $folder);
        $this->saveFileToStorage();

        $document = new Document([
            'documentable_id' => $system->id,
            'documentable_type' => 'App\System',
            'description' => $request->description,
            'path' => $this->destinationFolder,
            'file_name' => $this->fileName,
            'ext' => $this->extension,
            'added_by' => Auth::id()
        ]);

        $document->save();

        flash('Success!', 'Document added.');

        return redirect($system->path());
    }

    private function generateFileName()
    {
        return pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
    }

    public function show(Document $document)
    {
        $url = $this->getShortTermAccessToFileFromS3($document);
        return response()->redirectTo($url);
    }

    public function update(Request $request, Document $document)
    {
        $system = $document->documentable;
        $document->description = $request->description;
        $document->save();

        flash('Success!', 'Document description updated.', 'success');

        return redirect($system->path());
    }

    public function destroy(Document $document)
    {
        $system = $document->documentable;
        $this->deleteDocument($document);
        $document->delete();

        flash('Success!', 'Document deleted.', 'danger');

        return redirect($system->path());
    }
}
