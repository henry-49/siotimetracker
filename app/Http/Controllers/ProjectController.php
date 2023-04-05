<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

       if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->user_id = Auth::id();
        $project->save();

        $notification = array(
                'message' => 'Project created successfully',
                'alert-type' => 'success'
            );

            
        // Redirect to the timelogs index page with a success message
        return redirect()->route('projects.index')->with($notification);;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
         $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        // Validate the form input
    $validatedData = $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
    ]);

    // Find the project to update
    $project = Project::findOrFail($id);

    // Update the project with the new data
    $project->name = $validatedData['name'];
    $project->description = $validatedData['description'];
    $project->save();

        $notification = array(
                'message' => 'Project updated successfully.',
                'alert-type' => 'success',
            );

        // Redirect to the project's show page with a success message
            return redirect()->route('projects.index')->with($notification);

    
    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $project = Project::findOrFail($id);
        $project->delete();

        $notification = array(
            'message' => 'Project deleted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('projects.index')->with($notification);

    }
}
