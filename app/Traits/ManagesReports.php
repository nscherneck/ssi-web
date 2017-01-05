<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Test;

trait ManagesReports
{

    public $destinationFolder = '/customer-data/test_reports';
    public $extension;
    public $file;
    public $reportName;
    public $reportPath;

    public function setFileName($test)
    {
      // set file name for report file
      date_default_timezone_set('America/Los_Angeles');
      $this->reportName = $test->test_date->format('Y_m_d') . '_';
      $this->reportName .= strtolower(str_replace(' ', '_', preg_replace('/[^a-zA-Z0-9 ]/', '', $test->system->site->customer->name))) . '_';
      $this->reportName .= strtolower(str_replace(' ', '_', preg_replace('/[^a-zA-Z0-9 ]/', '', $test->system->site->name))) . '_';
      $this->reportName .= strtolower(str_replace(' ', '_', preg_replace('/[^a-zA-Z0-9 ]/', '', $test->system->name))) . '_';
      $this->reportName .= strtolower($test->test_type->name) . '_';
      $this->reportName .= date('Ymd_Gis');
    }

    public function setFileAttributes($test)
    {
      // set file attributes for report file
      $this->setFileName($test);
      $this->reportPath = $this->destinationFolder . '/' . $this->reportName . '.' . $this->extension;

    }

    public function getUploadedFile()
    {
      // get uploaded report file
      $this->file = Input::file('report');
      $this->extension = $this->file->getClientOriginalExtension();
    }

    public function saveFile()
    {
      // save processed report file
      Storage::putFileAs($this->destinationFolder, $this->file, $this->reportName . '.' . $this->extension);
      Storage::setVisibility($this->reportPath, 'public');

    }

    private function deleteDocument($document)
    {

      Storage::delete($document->path . '/' . $document->file_name . '.' . $document->ext);

    }


}
