<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects', compact('projects'));
    }
    
    public function saveDuration(Request $request)
    {
        $userId = Auth::id();
        $projectId = $request->input('project_id');
        $duration = $request->input('duration');
        $day = $request->input('day');

        $totalDuration = DB::table('userprojects')
                                ->where('user_id', $userId)
                                ->where('day', $day)
                                ->sum('duration'); 
        if ($totalDuration + $duration > 1) {
            return response()->json(['error' => 'Total duration for the day is more then 1.'], 400);
        }

        DB::table('userprojects')
            ->updateOrInsert(
                ['user_id' => $userId, 'project_id' => $projectId],
                ['duration' => $duration, 'day' => $day]
            );
        return response()->json(['success' => 'Duration saved successfully!']);
    }
}
