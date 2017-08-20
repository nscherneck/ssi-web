<?php

namespace App\Http\Controllers\Documents;

use App\Test;
use App\Document;
use Illuminate\Http\Request;
use App\Traits\ManagesDocuments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class TestDocumentsController extends \App\Http\Controllers\Controller
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

    public function store(Request $request, Test $test)
    {
        $folder = 'customer-data/test_reports';
        $this->getUploadedFile(Input::file('report'));
        $fileName = $this->generateFileName($test);
        $this->setFileAttributes($fileName, $folder);
        $this->saveFileToStorage();

        $report = new Document([
            'documentable_id' => $test->id,
            'documentable_type' => 'App\Test',
            'description' => $request->description,
            'path' => $this->destinationFolder,
            'file_name' => $this->fileName,
            'ext' => $this->extension,
            'added_by' => Auth::id()
        ]);

        $report->save();

        flash('Success!', 'Document added.');

        return redirect()->route('test_show', ['id' => $test->id]);
    }

    private function generateFileName($test)
    {
        $fileName = $test->test_date->format('Y_m_d') . '_';
        $fileName .= str_slug($test->system->site->customer->name, '_') . '_';
        $fileName .= str_slug($test->system->site->name, '_') . '_';
        $fileName .= str_slug($test->system->name, '_') . '_';
        $fileName .= str_slug($test->testType->name, '_') . '_';
        $fileName .= date('Ymd-Gis');
        return $fileName;
    }

    public function show(Document $document)
    {
        $url = $this->getShortTermAccessToFileFromS3($document);
        return response()->redirectTo($url);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        $test = $document->documentable;
        $document->description = $request->description;
        $document->save();

        flash('Success!', 'Document description updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function destroy(Document $document)
    {
        $test = $document->documentable;
        $this->deleteDocument($document);
        $document->delete();

        flash('Success!', 'Document deleted.', 'danger');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
}
