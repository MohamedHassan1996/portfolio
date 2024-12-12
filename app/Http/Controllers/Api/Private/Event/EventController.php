<?php

namespace App\Http\Controllers\Api\Private\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\Event\AllEventCollection;
use App\Http\Resources\Event\EventResource;
use App\Utils\PaginateCollection;
use App\Services\Event\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = $this->eventService->allEvents();

        return response()->json(
            new AllEventCollection(PaginateCollection::paginate($events, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateEventRequest $createEventRequest)
    {

        try {
            DB::beginTransaction();

            $this->eventService->createEvent($createEventRequest->validated());

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
        $event  =  $this->eventService->editEvent($request->eventId);

        return response()->json(
            new EventResource($event)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $updateEventRequest)
    {

        try {
            DB::beginTransaction();
            $this->eventService->updateEvent($updateEventRequest->validated());
            DB::commit();
            return response()->json([
                 'message' => __('messages.success.updated')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $this->eventService->deleteEvent($request->eventId);
            DB::commit();
            return response()->json([
                'message' => __('messages.success.deleted')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function changeStatus(Request $request)
    {
        $this->eventService->changeStatus($request->eventId, $request->isPublished);
        return response()->json([
            'message' => __('messages.success.updated')
        ], 200);
    }


}
