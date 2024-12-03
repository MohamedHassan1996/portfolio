<?php

namespace App\Services\Task;

use App\Filters\TaskTimeLog\FilterTaskTimeLog;
use App\Models\Task\TaskTimeLog;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskTimeLogService{

    private $TaskTimeLog;
    public function __construct(TaskTimeLog $TaskTimeLog)
    {
        $this->TaskTimeLog = $TaskTimeLog;
    }

    public function allTaskTimeLogs()
    {
        $TaskTimeLogLogs = QueryBuilder::for(TaskTimeLog::class)
            ->allowedFilters([
                //AllowedFilter::custom('search', new FilterTaskTimeLog()), // Add a custom search filter
                AllowedFilter::exact('taskId', 'task_id'),
                //AllowedFilter::exact('importance'),
            ])->get();

        return $TaskTimeLogLogs;

    }

    public function createTaskTimeLog(array $taskTimeLogData): TaskTimeLog
    {

        $taskTimeLog = TaskTimeLog::create([
            'task_id' => $taskTimeLogData['taskId'],
            'user_id' => $taskTimeLogData['userId']??null,
            'start_time' => $taskTimeLogData['startTime'],
            'end_time' => $taskTimeLogData['endTime'],
            'note' => $taskTimeLogData['note'],
        ]);

        return $taskTimeLog;

    }

    public function editTaskTimeLog(int $taskTimeLogId)
    {
        return TaskTimeLog::find($taskTimeLogId);
    }

    public function updateTaskTimeLog(array $taskTimeLogData): TaskTimeLog
    {

        $taskTimeLog = TaskTimeLog::find($taskTimeLogData['taskTimeLogId']);

        $taskTimeLog->update([
            'task_id' => $taskTimeLogData['taskId'],
            'user_id' => $taskTimeLogData['userId']??null,
            'start_time' => $taskTimeLogData['startTime'],
            'end_time' => $taskTimeLogData['endTime'],
            'note' => $taskTimeLogData['note'],
        ]);

        return $taskTimeLog;


    }


    public function deleteTaskTimeLog(int $taskTimeLogId)
    {

        return TaskTimeLog::find($taskTimeLogId)->delete();

    }


}
