<?php

namespace App\Http\Controllers\Api\Private\Career;

use App\Http\Controllers\Controller;
use App\Http\Requests\Career\Candidate\CreateCandidateRequest;
use App\Http\Resources\Career\Candidate\AllCandidateCollection;
use App\Http\Resources\Career\Candidate\CandidateResource;
use App\Mail\SendCandidateCv;
use App\Models\Career\Candidate;
use App\Utils\PaginateCollection;
use App\Services\Career\CandidateService;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendCandidateController extends Controller
{
    protected $candidateService;
    protected $uploadService;

    public function __construct(CandidateService $candidateService, UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function create(Request $request)
    {


        try {
            DB::beginTransaction();
            $data=$request->all();
            $path = null;
            if(isset($data['cv']) && $data['cv'] instanceof UploadedFile){
                $path =  $this->uploadService->uploadFile($data['cv'], 'candidates');
            }
            $candidate = Candidate::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'cv' => $path,
                'cover_letter' => $data['coverLetter']??null,
                'career_id' => $data['careerId'],
            ]);

            Mail::to(env('MAIL_USERNAME'))->send(new SendCandidateCv($candidate));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
