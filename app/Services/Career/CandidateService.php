<?php

namespace App\Services\Career;

use App\Enums\Candidte\CandidateStatus;
use App\Filters\Candidte\CandidateTranslatableFilter;
use App\Filters\Career\FilterCandidate;
use App\Models\Career\Candidate;
use App\Services\Upload\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CandidateService{

    private $candidate;
    private $uploadService;
    public function __construct(Candidate $candidate, UploadService $uploadService)
    {
        $this->candidate = $candidate;
        $this->uploadService = $uploadService;
    }

    public function allCandidates()
    {
        $candidates = QueryBuilder::for(Candidate::class)
        ->allowedFilters([
            AllowedFilter::custom('search', new FilterCandidate()), // Add a custom search filter
        ])
        ->get();

        return $candidates;

    }

    public function createCandidate(array $candidateData): Candidate
    {

        $path = null;

        if(isset($candidateData['cv']) && $candidateData['cv'] instanceof UploadedFile){
            $path =  $this->uploadService->uploadFile($candidateData['cv'], 'careers');
        }

        $candidate = Candidate::create([
            'name' => $candidateData['name'],
            'email' => $candidateData['email'],
            'phone' => $candidateData['phone'],
            'cv' => $path,
            'cover_letter' => $candidateData['coverLetter'],
            'career_id' => $candidateData['careerId'],

        ]);

        return $candidate;



    }

    public function editCandidate(int $candidateId)
    {
        return Candidate::find($candidateId);
    }

    /*public function updateCandidate(array $candidateData): Candidate
    {

        $blogCategory = Candidate::find($candidateData['blogCategoryId']);

        $blogCategory->update([
            'title' => $candidateData['title'],
            'description' => $candidateData['description'],
            'slug' => $candidateData['slug'],
            'is_active' => CandidateStatus::from($candidateData['is_active'])->value,
        ]);

        $blogCategory->country()->attach($candidateData['countryIds']);

        return $blogCategory;


    }*/


    public function deleteCandidate(int $candidateId)
    {

        $candidate = Candidate::find($candidateId);

        if($candidate->cv){
            Storage::delete($candidate->cv);
        }

        $candidate->delete();
    }

}
