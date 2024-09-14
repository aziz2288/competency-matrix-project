<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tech;

class DashboardController extends Controller
{
    public function index()
    {
        $userIds = User::pluck('id')->toArray();
        $techIds = Tech::pluck('id')->toArray();

        $userNotes = [];

        foreach ($userIds as $id_user) {
            $user = User::find($id_user);
            $name = $user->name;
            $maxNote = DB::table('usertechs')->where('user_id', $id_user)->max('note');
            $nbNote = DB::table('usertechs')->where('user_id', $id_user)->count();
            $noteName = DB::table('usertechs')
                        ->join('techs', 'usertechs.tech_id', '=', 'techs.id')
                        ->where('usertechs.user_id', $id_user)
                        ->select('techs.name')
                        ->orderBy('usertechs.note', 'desc')
                        ->first();

            $notes = [];
            foreach ($techIds as $id_tech) {
                $noteS = DB::table('usertechs')
                        ->where('user_id', $id_user)
                        ->where('tech_id', $id_tech)
                        ->value('note');
                $noteN = DB::table('usertechs')
                        ->join('techs', 'usertechs.tech_id', '=', 'techs.id')
                        ->where('usertechs.user_id', $id_user)
                        ->where('usertechs.tech_id', $id_tech)
                        ->select('techs.name')
                        ->first();
                if ($noteN) {
                    $notes[] = ['note' => $noteS, 'tech_name' => $noteN->name];
                }
            }

            $userNotes[$name] = [
                'total_notes' => $nbNote,
                'notes' => $notes,
                'max_note' => $maxNote,
                'max_note_name' => $noteName ? $noteName->name : null
            ];
        }

        $nb_users = User::count();
        $nb_admin = User::where('role', 'ADM')->count();
        $nb_user = User::where('role', 'USER')->count();
        $nb_tech = Tech::count();
        $nb_project = Project::count();
        $notesCount = DB::table('usertechs')
                        ->select(DB::raw('note, COUNT(*) as count'))
                        ->groupBy('note')
                        ->pluck('count', 'note')->toArray();
        $techCount = DB::table('usertechs')
                        ->join('techs', 'usertechs.tech_id', '=', 'techs.id')
                        ->select('techs.name', DB::raw('COUNT(*) as count'))
                        ->groupBy('techs.name')
                        ->pluck('count', 'techs.name')->toArray();

        $projectDurations = DB::table('userprojects')
        ->join('projects', 'userprojects.project_id', '=', 'projects.id')
        ->select('projects.name', DB::raw('SUM(userprojects.duration) as total_duration'))
        ->groupBy('projects.name')
        ->get();

        return view('dashboard', compact('userNotes', 'nb_users', 'nb_admin', 'nb_user', 'nb_tech', 'nb_project', 'notesCount', 'techCount', 'projectDurations'));
    }
}
