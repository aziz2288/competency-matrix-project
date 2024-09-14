<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Tech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    
    public function index()
    { 
        $techs = Tech::all();
        return view('notes', compact('techs'));
    }
    public function saveNote(Request $request)
    {
        $userId = Auth::id();
        $techId = $request->input('tech_id');
        $note = $request->input('note');

        // Utiliser le Query Builder pour insérer ou mettre à jour la note
        DB::table('usertechs')
            ->updateOrInsert(
                ['user_id' => $userId, 'tech_id' => $techId],
                ['note' => $note]
            );

        return response()->json(['success' => 'Note saved successfully!']);
    }
}

