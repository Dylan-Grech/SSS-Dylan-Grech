<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\College;

class StudentController extends Controller
{
    /**
     * Returns the data of all students in a table
     */
    public function index(Request $request)
    {
        //Gets data of all colleges
        $colleges = College::all();

        
        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');

        //If the suer requests to see students of a specific college and the id is not empty, the orderby function
        //will return the data according to the sortby (in this case name) and the direction (in this case ascending)
        if ($request->has('college_id') && $request->college_id != '') {
            $students = Student::where('college_id', $request->college_id)
                ->orderBy($sortBy, $sortDirection)
                ->get();
        } else {
            $students = Student::orderBy($sortBy, $sortDirection)->get();
        }

        return view('students.index', compact('students', 'colleges', 'sortBy', 'sortDirection'));
    }

    /**
     * Returns the view for creating students. The college data is also added within the view so as to be able
     * to sort the students to a college
     */
    public function create()
    {
        $colleges = College::all();
        return view('students.create', compact('colleges'));
    }

    /**
     * Validates the user's input
     * If validation is a success, the data is stored and a success message is returned
     */
    public function store(Request $request)
    {
        //Custom messages according to the validation error that might arise
        $customMessages = [
            'email.required' => 'The email field is mandatory.',
            'email.unique' => 'The email must be unique.',
            'email.email' => 'Please enter a valid email address.',
            'email.regex' => 'The email must end with .com.',
            'phone.required' => 'The phone number field is required.',
            'phone.digits' => 'The phone number must contain exactly 8 digits.',
            'college_id.required' => 'Please select a college.',
            'dob.required' => 'The date of birth is required.',
        ];
    
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'unique:students,email', 
                'email', 
                'regex:/^[\w\.]+@[a-zA-Z0-9.-]+\.(com)$/i'
            ],
            'phone' => [
                'required',
                'digits:8', 
            ],
            'dob' => 'required',
            'college_id' => 'required|exists:colleges,id'
        ], $customMessages); 
    
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'college_id' => $request->college_id
        ]);
    
        return back()->with('success', 'Student Added');
    }

    /**
     * Returns the edit view with the data of a specific college
     * College data is also sent to populate dropdown
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $colleges = College::all();

        return view('students.edit', compact('student', 'colleges'));
    }

    /**
     * Validates the user's input
     * If validation is a success, the data is stored and a success message is returned
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:students,email,' . $id,
            'phone' => 'required',
            'dob' => 'required',
            'college_id' => 'required|exists:colleges,id'
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'college_id' => $request->college_id
        ]);

        return back()->with('success', 'Student Updated');
    }

    /**
     * Deletes user by id
     * If success, a success message is sent
     */
    public function delete(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return back()->with('success', 'Student deleted successfully');
    }
}
