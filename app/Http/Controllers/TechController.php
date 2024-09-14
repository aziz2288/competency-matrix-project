<?php

namespace App\Http\Controllers;
use App\Models\Tech;

use Illuminate\Http\Request;

class TechController extends Controller
{
    public function index(){
        $techs = Tech::all();
        return view('tech.index',['techs'=>$techs]);
    }
    public function add(){
        return view('tech.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $tech = new \App\Models\Tech();
        $tech->name = $request->name;
        $tech->description = $request->description;
        $tech->save();
        return redirect()->route('home')->with('status', 'Technology added successfully');
    }
    public function edit($id)
    {
        $tech = Tech::findOrFail($id);
        return view('tech.update', compact('tech'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $tech = Tech::findOrFail($request->id);
        $tech->name = $request->name;
        $tech->description = $request->description;
        $tech->save();
        return redirect()->route('home')->with('status', 'Technology updated successfully');
    }
    public function destroy($id)
    {
        $tech = Tech::findOrFail($id);
        $tech->delete();
        return redirect()->route('home')->with('status', 'Technology deleted successfully');
    }
}
