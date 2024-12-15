<?php

namespace App\Http\Controllers\Api\Private\Career;

use App\Http\Controllers\Controller;
use App\Http\Requests\Career\Candidate\CreateCandidateRequest;
use App\Http\Resources\Career\Candidate\AllCandidateCollection;
use App\Http\Resources\Career\Candidate\CandidateResource;
use App\Utils\PaginateCollection;
use App\Services\Career\CandidateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->candidateService = $candidateService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $candidates = $this->candidateService->allCandidates();

        return response()->json(
            new AllCandidateCollection(PaginateCollection::paginate($candidates, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateCandidateRequest $createCandidateRequest)
    {

        try {
            DB::beginTransaction();

            $this->candidateService->createCandidate($createCandidateRequest->validated());

            DB::commit();

            return response()->json([
                'message' => __('messages.success.created')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $candidate  =  $this->candidateService->editCandidate($request->candidateId);

        return response()->json(
            new CandidateResource($candidate)//new UserResource($user)
        ,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $this->candidateService->deleteCandidate($request->candidateId);
            DB::commit();
            return response()->json([
                'message' => __('messages.success.deleted')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

}
