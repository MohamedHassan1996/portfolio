<?php

namespace App\Services\Project;

use App\Enums\Project\ProjectStatus;
use App\Filters\Project\FilterEmployee;
use App\Filters\Project\FilterProject;
use App\Models\Project\Project;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectService{

    private $project;
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function allProjects()
{
    $user = Auth::user();

    // Start with the basic query
    $query = QueryBuilder::for(Project::class)
        ->allowedFilters([
            AllowedFilter::custom('search', new FilterProject()), // Custom search filter
            AllowedFilter::exact('status'),
            AllowedFilter::custom('employees', new FilterEmployee()), // Apply custom filter for employees
        ])
        ->with('employees'); // Eager load the employees relationship

    // Return the results
    return $query->get();
}



    public function createProject(array $projectData): Project
    {

        $project = Project::create([
            'name' => $projectData['name'],
            'status' => ProjectStatus::from($projectData['status'])->value,
            'description' => $projectData['description'],
        ]);

        if($projectData['employeeIds']){
            $project->employees()->sync($projectData['employeeIds']);
        };

        return $project;

    }

    public function editProject(int $projectId)
    {
        return Project::find($projectId);
    }

    public function updateProject(array $projectData): Project
    {

        $project = Project::find($projectData['projectId']);

        $project->update([
            'name' => $projectData['name'],
            'status' => ProjectStatus::from($projectData['status'])->value,
            'description' => $projectData['description']
        ]);

        if($projectData['employeeIds']){
            $project->employees()->sync($projectData['employeeIds']);
        };

        return $project;

    }


    public function deleteProject(int $projectId)
    {

        return Project::find($projectId)->delete();

    }


}
