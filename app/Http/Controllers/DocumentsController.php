<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

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
      return view('tests.reports.show', compact('test', 'document'));
    }

    public function edit($id)
    {
        //
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
