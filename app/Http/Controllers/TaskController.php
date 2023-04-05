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
        $tasks = $project->tasks;
        return view('tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $project = Project::all();
        return view('projects.tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
        ]);

        $task = new Task($validated);
        $task->project()->associate($project);
        $task->save();

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
