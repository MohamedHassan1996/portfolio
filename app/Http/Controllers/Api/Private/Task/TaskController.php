    <?php

namespace App\Http\Controllers\Api\Private\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\task\UpdateTaskRequest;
use App\Http\Resources\Task\AllTaskCollection;
use App\Http\Resources\Task\TaskResource;
use App\Mail\TaskDetails;
use App\Models\Task\Task;
use App\Services\Task\TaskService;
use App\Services\Upload\UploadService;
use App\Utils\PaginateCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    protected $taskService;

    protected $uploadService;
    public function __construct(TaskService $taskService, UploadService $uploadService)
    {
        $this->taskService = $taskService;
        $this->uploadService = $uploadService;
    }

    /**
     * Show the form for creating a new resource.
     */

    public function index(Request $request)
    {
        $allTasks = $this->taskService->allTasks();

        return response()->json(
            new AllTaskCollection(PaginateCollection::paginate($allTasks, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    public function create(CreateTaskRequest $createTaskRequest)
    {

        try {
            DB::beginTransaction();

            $taskData = $createTaskRequest->validated();

            $task = $this->taskService->createTask($taskData);


            $taskAttachments = $taskData['attachments']??[];


            foreach ($taskAttachments as $key => $attachmentData) {

                $attachment = $this->uploadService->uploadFile($attachmentData, "tasks/$task->id");

                $task->attachments()->create([
                    'path' => $attachment
                ]);
            }

            /*$content = [
                'subject' => $subject,
                'body' => $task->description
            ];

            Mail::to('mr10dev10@gmail.com')->send(new TaskDetails($content));*/


            DB::commit();

            return response()->json([
                'message' => 'task has been created!'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function edit(Request $request)
    {
        $task = $this->taskService->editTask($request->taskId);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $updateTaskRequest)
    {

        try {
            DB::beginTransaction();

            $taskData = $updateTaskRequest->validated();

            $task = $this->taskService->updateTask($taskData);


            //$taskAttachments = $taskData['attachments']??[];


            /*foreach ($taskAttachments as $key => $attachmentData) {

                $attachment = $this->uploadService->uploadFile($attachmentData, "tasks/$task->id");

                $task->attachments()->create([
                    'path' => $attachment
                ]);
            }*/

            /*$content = [
                'subject' => $subject,
                'body' => $task->description
            ];

            Mail::to('mr10dev10@gmail.com')->send(new TaskDetails($content));*/


            DB::commit();

            return response()->json([
                'message' => 'task has been updated!'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function delete(Request $request)
    {
        $this->taskService->deleteTask($request->taskId);
        return response()->json([
            'message' => 'task has been deleted!'
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $task = Task::find($request->taskId);
        if($request->status == 1){
            $task->status = 2;
        }

        if($request->status == 0){
            if($task->timeLogs()->count() > 0){
                $task->status = 1;
            }else{
                $task->status = 0;
            }
        }
        return response()->json([
            'message' => 'task status has been changed!'
        ], 200);
    }


}
