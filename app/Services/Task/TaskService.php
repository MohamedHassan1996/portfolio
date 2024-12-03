<?php

namespace App\Services\Task;

use App\Enums\Task\TaskImportanceStatus;
use App\Enums\Task\TaskStatus;
use App\Enums\Task\TaskTestingStatus;
use App\Filters\Task\FilterTask;
use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskService{

    private $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function allTasks()
{
    $user = Auth::user();

    // Define allowed filters
    $filters = [
        AllowedFilter::custom('search', new FilterTask()), // Custom search filter
        AllowedFilter::exact('status'),
        AllowedFilter::exact('importance'),
    ];

    // Apply conditional logic for superAdmin role
    if (!$user->roles->contains('name', 'superAdmin')) {
        $query = QueryBuilder::for(Task::class)
        ->allowedFilters($filters);
        $query->where('user_id', $user->id); // Restrict to user's tasks
    } else {
        $filters[] = AllowedFilter::exact('userId', 'user_id');
        // Allow filtering by userId for superAdmin
        $query = QueryBuilder::for(Task::class)
        ->allowedFilters($filters);
    }

    // Return the filtered results
    return $query->get();

}


    public function createTask(array $taskData): Task
    {

        $task = Task::create([
            'status' => TaskStatus::from($taskData['status'])->value,
            'title' => $taskData['title'],
            'importance' => TaskImportanceStatus::from($taskData['importance'])->value,
            'is_tested' => TaskTestingStatus::from( $taskData['isTested'])->value,
            'description' => $taskData['description'],
            'project_id' => $taskData['projectId']??null,
            'user_id' => $taskData['userId']??null
        ]);

        return $task;

    }

    public function editTask(int $taskId)
    {
        return Task::with('attachments')->find($taskId);
    }

    public function updateTask(array $taskData): Task
    {

        $task = Task::find($taskData['taskId']);

        $task->update([
            'status' => TaskStatus::from($taskData['status'])->value,
            'importance' => TaskImportanceStatus::from($taskData['importance'])->value,
            'title' => $taskData['title'],
            'is_tested' => TaskTestingStatus::from( $taskData['isTested'])->value,
            'description' => $taskData['description'],
            'project_id' => $taskData['projectId']??null,
            'user_id' => $taskData['userId']??null
        ]);

        return $task;


    }


    public function deleteTask(int $taskId)
    {

        return Task::find($taskId)->delete();

    }


}
