<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    /**
     * Gets all college data from database and returns it
     */
    public function index()
    {
        $colleges = College::all();
        return view('colleges.index', compact('colleges'));
    }

    /**
     * Returns the create view
     */
    public function create()
    {
        return view('colleges.create');
    }

    /**
     * Validates the user's inputs, which are then afterwards saved. If the storing of the data is successfull
     * a success message is returned.
     * Name is unique and required, and address is required.
     */
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

    /**
     * Finds the college by id, and the data of that college is then returned in the view
     */
    public function edit(string $id)
    {
        $college = College::findOrFail($id);
        return view('colleges.edit', compact('college'));
    }

    /**
     * Validates the user's input.
     * Name is required and unique
     * Address is required
     * If validation check is correct the specified college is updated and a success message is returned
     */
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
