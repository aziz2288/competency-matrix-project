<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('user.index', ['users'=>$users]);
    }
    public function add(){
        return view('user.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'matricule' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        $user = new \App\Models\User();
        $user->id = $request->matricule;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('home')->with('status', 'User added successfully');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.update', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('home')->with('status', 'User updated successfully');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('home')->with('status', 'User deleted successfully');
    }
    public function showInformation($id)
    {
        $user = User::find($id);
        $userNotes = DB::table('usertechs')
            ->join('techs', 'usertechs.tech_id', '=', 'techs.id')
            ->where('usertechs.user_id', $id)
            ->select('usertechs.note', 'techs.name as tech_name')
            ->get();
    
        return view('user.information', compact('user', 'userNotes'));
    }
}
