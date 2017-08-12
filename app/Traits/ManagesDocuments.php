<?php

namespace App\Traits;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManagesDocuments
{
    public $destinationFolder;
    public $extension;
    public $file;
    public $fileName;
    public $filePath;

    public function setFileAttributes($fileName, $folder)
    {
        // set file attributes for report file
        $this->fileName = $fileName;
        $this->destinationFolder = $folder;
        $this->filePath = $this->destinationFolder . '/' . $this->fileName . '.' . $this->extension;
    }

    public function getUploadedFile($file)
    {
        $this->file = $file;
        $this->extension = $this->file->getClientOriginalExtension();
    }

    public function saveFileToStorage()
    {
        Storage::putFileAs($this->destinationFolder,
            $this->file,
            $this->fileName . '.' . $this->extension
        );
        // Storage::setVisibility($this->filePath, 'public');
    }

    private function getShortTermAccessToFileFromS3($document)
    {
        $disk = Storage::disk('s3');
        $fileName = "{$document->file_name}.{$document->ext}";
        $filePath = "{$document->path}/{$document->file_name}.{$document->ext}";

        $command = $disk->getDriver()
            ->getAdapter()
            ->getClient()
            ->getCommand('GetObject', [
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $filePath,
                'ResponseContentDisposition' => 'inline; filename="' . $this->convertFilenameForSafeS3Response($fileName) . '"',
            ]);

        $request = $disk->getDriver()
            ->getAdapter()
            ->getClient()
            ->createPresignedRequest($command, '+5 minutes');

        return (string) $request->getUri();
    }

    private function convertFilenameForSafeS3Response($fileName)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $fileName);
    }

    private function deleteDocument($document)
    {
        Storage::delete($document->path . '/' . $document->file_name . '.' . $document->ext);
    }
}
