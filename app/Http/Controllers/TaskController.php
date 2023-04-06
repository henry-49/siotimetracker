<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $project = Project::all();
        $tasks = $project->tasks;
        return view('tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        //
        $projects = Project::all();
        return view('projects.tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'hours' => 'required|numeric|min:1'
        ]);

        // Create a new task with the submitted data
            $task = new Task([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'hours' => $validatedData['hours'],
            ]);

        // Get all tasks for a project
        $project = Project::find(1);
        $tasks = $project->tasks;
    
        // Associate the task with the appropriate project
       // $project = Project::find($request->project_id);
       // $task->project()->associate($project);

        // Save the task to the database
        $task->save();

        // Redirect the user to the task's details page
        //return redirect()->route('task.show', $task->id);

        return redirect()->route('projects.tasks.index', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        $projects = Project::all();
         return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
        ]);

        $task->update($validated);

        return redirect()->route('projects.tasks.index', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('projects.tasks.index', $project);
    }
}
