<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    public function index()
    {
        $colleges = College::all();
        return view('colleges.index', compact('colleges'));
    }

    public function create()
    {
        return view('colleges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colleges,name',
            'address' => 'required'
        ]);

        College::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return back()->with('success', 'College Added');
    }

    public function show(string $id)
    {
        $college = College::findOrFail($id);
        return view('colleges.show', compact('college'));
    }

    public function edit(string $id)
    {
        $college = College::findOrFail($id);
        return view('colleges.edit', compact('college'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:colleges,name,' . $id,
            'address' => 'required',
        ]);

        $college = College::findOrFail($id);
        $college->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return back()->with('success', 'College updated successfully!');
    }
}
