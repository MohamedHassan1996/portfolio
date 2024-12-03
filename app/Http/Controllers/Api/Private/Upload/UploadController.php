<?php

namespace App\Http\Controllers\Api\Private\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Upload\UploadMultipleProductImageRequest as UploadUploadMultipleProductImageRequest;
use App\Http\Requests\Product\Upload\UploadSingleProductImageRequest as UploadUploadSingleProductImageRequest;
use App\Http\Requests\Upload\Product\UploadSingleProductImageRequest;
use App\Http\Requests\Upload\Product\UploadMultipleProductImageRequest;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*use ZipArchive;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;*/

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function uploadimage(Request $request)
    {

        $path = $this->uploadService->uploadFile($request->validated());

        return response()->json([
            'path' => $path
        ], 200);

    }

    public function uploadmultipleimage(Request $request)
    {

        $paths = $this->uploadService->uploadMultipleFile($request->validated());

        return response()->json([
            'paths' => $paths
        ], 200);

    }

    public function uploadproductimage(UploadUploadSingleProductImageRequest $request)
    {

        $path = $this->uploadService->uploadFile($request->validated());

        return response()->json([
            'path' => $path
        ], 200);

    }

    public function uploadproductmultipleimage(UploadUploadMultipleProductImageRequest $request)
    {

        $paths = $this->uploadService->uploadMultipleFile($request->validated());

        return response()->json([
            'paths' => $paths
        ], 200);

    }
}
