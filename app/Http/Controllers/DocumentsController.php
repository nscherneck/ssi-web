<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response;

use App\Traits\ManagesReports;
use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Test;
use App\Document;
use DB;

class DocumentsController extends Controller
{

    use ManagesReports;

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function storeCustomerDocument(Request $request, Customer $customer)
    {
        //
    }

    public function storeSiteDocument(Request $request, Site $site)
    {
        //
    }

    public function storeSystemDocument(Request $request, System $system)
    {
        //
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

      flash('Report Added', 'Success');
      return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function showReport(Test $test, Document $document)
    {
      // return view('tests.reports.show', compact('test', 'document'))
      // return response()->file("https://s3-us-west-2.amazonaws.com/ssiwebstorage" . $document->path . '/' . $document->file_name . '.' . $document->ext)
      //   ->header('Content-Type', 'application/pdf')
      //   ->header('Content-Disposition', 'inline');
      // $file_path = $document->path . '/' . $document->file_name . '.' . $document->ext;
      // if (1 === 1)
      // {
      //   $file = Storage::get($file_path);
      //   $response = Response::make($file, 200);
      //   $response->header('Content-Type', 'application/pdf');
      //
      //   return $response;
      // } else {
      //   echo "NOPE";
      // }

        $file = $document->path . '/' . $document->file_name . '.' . $document->ext;
        $disk = Storage::disk('s3');

        $command = $disk->getDriver()->getAdapter()->getClient()->getCommand('GetObject', [
            'Bucket'                     => config('filesystems.disks.s3.bucket'),
            'Key'                        => $file,
            'ResponseContentDisposition' =>  'inline; filename="' . $this->safeFilenameForS3Response($document->file_name . '.' . $document->ext) . '"',
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

      flash('Report Description Updated', 'Success');
      return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function destroyTestReport(Test $test, Document $document)
    {
        $this->deleteDocument($document);
        $document->delete();

        flash('Report Deleted', 'Error');
        return redirect()->route('test_show', ['id' => $test->id]);
    }
}
