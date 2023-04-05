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
        //
        //  $user = $request->user();
        // $weekLogs = $this->getTimeLogs($user, 'week');
        // $monthLogs = $this->getTimeLogs($user, 'month');
        // $allLogs = $user->timeLogs()->orderByDesc('start_time')->get();

        // return view('timelogs.index', [
        //     'weekLogs' => $weekLogs,
        //     'monthLogs' => $monthLogs,
        //     'allLogs' => $allLogs,
        // ]);

      // Get the authenticated user's time logs, ordered by start time in descending order
        $timelogs = auth()->user()->timelogs()->orderBy('start_time', 'desc')->paginate(10);

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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
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

        return redirect()->route('timelogs.index')->with('success', 'Time log updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
