<?php

namespace App\Services\Upload;

use App\DTOs\UploadFileDto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    private $defaultUploadPath = '';
    private $storageDisks = [
        "uploads" => "uploads",
        "images"  => "images",
        "files"  => "files",
        "public"  => "public"
    ];

    public function uploadFile(UploadedFile $uploadedFile, string $uploadPath = null, string $storageDisk = 'public'): string
    {
        $file = $uploadedFile;
        $uploadPath = $uploadPath??$this->defaultUploadPath;

        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileOnServerName = time() . '_' . $fileName;
        $fileExtension = $file->guessExtension();
        $filePath = Storage::disk($this->storageDisks[$storageDisk])->putFileAs($uploadPath, $file, $fileOnServerName . '.' . $fileExtension);
        
        return $filePath;
    }

    public function uploadMultipleFile(array $filesData): array
    {
        $uploadedPaths = [];
        $uploadPath = $filesData['uploadPath'] ?? $this->defaultUploadPath;
        $files = $filesData['files'];
        foreach ($files as $key => $file) {

            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileOnServerName = time() . '_' . $fileName;
            $fileExtension = $file->guessExtension();
            $filePath = Storage::disk('public')->putFileAs($uploadPath, $file, $fileOnServerName . '.' . $fileExtension);
            
            $uploadedPaths[] = $filePath;
        }

        return $uploadedPaths;
    }
}
