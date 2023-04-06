<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\TimeLog;
use Carbon\Carbon;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
      // Get the authenticated user's time logs, ordered by start time in descending order

        //$timelogs = auth()->user()->timelogs()->orderBy('start_time', 'desc')->paginate(10);
        $timelogs = TimeLog::with('task.project')->orderBy('created_at', 'desc')->get();

        // Return the timelogs index view with the timelogs data
        return view('timelogs.index', compact('timelogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $projects = Project::all();
        return view('timelogs.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $validatedData = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $timeLog = new TimeLog;
        $timeLog->start_time = $validatedData['start_time'];
        $timeLog->end_time = $validatedData['end_time'];
        $timeLog->user_id = auth()->user()->id;
        $timeLog->project_id = $validatedData['project_id'];
        $timeLog->save();

        $notification = array(
                'message' => 'Time Log Created Successfully',
                'alert-type' => 'success'
            );

            
        // Redirect to the timelogs index page with a success message
        return redirect()->back()->with($notification);
    
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
    public function edit(string $id)
    {
        //
         $timelog = TimeLog::findOrFail($id);

        return view('timelogs.edit', compact('timelog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $timelog = TimeLog::findOrFail($id);

        $validatedData = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $timelog->start_time = $validatedData['start_time'];
        $timelog->end_time = $validatedData['end_time'];
        $timelog->save();


         $notification = array(
                'message' => 'Time log updated successfully',
                'alert-type' => 'success'
            );

            
        // Redirect to the timelogs index page with a success message
        return redirect()->route('timelogs.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $timelog = Timelog::findOrFail($id);
        $timelog->delete();

        $notification = array(
                'message' => 'Timelog deleted successfully!',
                'alert-type' => 'success'
            );

            
        // Redirect to the timelogs index page with a success message
        return redirect()->back()->with($notification);
    }

    private function getTimeLogs($user, $period)
    {
        $start = Carbon::now()->startOfWeek();
        if ($period === 'month') {
            $start = Carbon::now()->startOfMonth();
        }

        return $user->timeLogs()->whereBetween('start_time', [$start, Carbon::now()])->get();
    }
}
