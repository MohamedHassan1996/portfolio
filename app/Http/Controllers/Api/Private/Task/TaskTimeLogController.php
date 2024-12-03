<?php

namespace App\Http\Controllers\Api\Private\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskTimeLogRequest;
use App\Http\Resources\Task\TaskTimeLog\AllTaskTimeLogCollection;
use App\Http\Resources\Task\TaskTimeLog\TaskTimeLogResource;
use App\Services\Task\TaskTimeLogService;
use App\Services\Upload\UploadService;
use App\Utils\PaginateCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TaskTimeLogController extends Controller
{
    protected $taskTimeLogService;

    public function index(Request $request)
    {
        $allTasks = $this->taskTimeLogService->allTaskTimeLogs();

        return response()->json(
            new AllTaskTimeLogCollection(PaginateCollection::paginate($allTasks, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    public function __construct(TaskTimeLogService $taskTimeLogService)
    {
        $this->taskTimeLogService = $taskTimeLogService;
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateTaskTimeLogRequest $createTaskTimeLogRequest)
    {

        try {
            DB::beginTransaction();

            $taskData = $createTaskTimeLogRequest->validated();

            $task = $this->taskTimeLogService->createTaskTimeLog($taskData);

            DB::commit();

            return response()->json([
                'message' => 'task time log has been stopped'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function edit(Request $request)
    {
        $task = $this->taskTimeLogService->editTaskTimeLog($request->taskTimeLogId);

        return new TaskTimeLogResource($task);
    }

    public function delete(Request $request)
    {
        $this->taskTimeLogService->deleteTaskTimeLog($request->taskTimeLogId);
        return response()->json([
            'message' => 'timer has been deleted!'
        ], 200);
    }


}
