<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Component;
use App\Test;
use App\Document;
use App\Http\Controllers\Controller;
use App\Traits\ManagesReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class DocumentsController extends Controller
{
    use ManagesReports;
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function storeTestReport(Request $request, Test $test)
    {
        $this->getUploadedFile();    
        $this->setFileAttributes($test);    
        $this->saveFile();
        
        $report = new Document([    
            'documentable_id' => $test->id,
            'documentable_type' => 'App\Test',
            'description' => $request->description,
            'path' => $this->destinationFolder,
            'file_name' => $this->reportName,
            'ext' => $this->extension,
            'added_by' => Auth::id()    
            ]);
        
        $report->save();
        
        flash('Success!', 'Report added.');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
    
    public function storeComponentDocument(Request $request, Component $component)
    {
    
        // save file to storage (S3)
        $file = Input::file('document');
        $extension = $file->getClientOriginalExtension();
        $documentName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $componentDocumentFolder = 'customer-data/component_documents';
        
        Storage::putFileAs($componentDocumentFolder, $file, $documentName . '.' . $extension);
        Storage::setVisibility($componentDocumentFolder . '/' . $documentName . '.' . $extension, 'public');

        $document = new Document([        
            'documentable_id' => $component->id,
            'documentable_type' => 'App\Component',
            'path' => $componentDocumentFolder,
            'file_name' => $documentName,
            'ext' => $extension,
            'added_by' => Auth::id()        
            ]);

        $document->save();
    
        flash('Success!', 'Document added.');

        return redirect()->route('component_show', ['id' => $component->id]);
    }

    public function showReport(Test $test, Document $document)
    {
        $file = $document->path . '/' . $document->file_name . '.' . $document->ext;
        $disk = Storage::disk('s3');
    
        $command = $disk->getDriver()->getAdapter()->getClient()->getCommand('GetObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $document->path . '/' . $document->file_name . '.' . $document->ext,
            'ResponseContentDisposition' => 'inline; filename="' . $this->safeFilenameForS3Response($document->file_name . '.' . $document->ext) . '"',
            ]);

        $request = $disk->getDriver()->getAdapter()->getClient()->createPresignedRequest($command, '+5 minutes');
        $url = (string) $request->getUri();

        return response()->redirectTo($url);
    }

    private function safeFilenameForS3Response($filename)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $filename);
    }

    public function updateTestReport(Request $request, Test $test, Document $document)
    {
        $document->description = $request->description;
        $document->save();
        
        flash('Success!', 'Report Description updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
    
    public function destroyTestReport(Test $test, Document $document)
    {
        $this->deleteDocument($document);
        $document->delete();
        
        flash('Success!', 'Report deleted.', 'danger');
        
        return redirect()->route('test_show', ['id' => $test->id]);
    }

}
