<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $colleges = College::all();

    $sortBy = $request->get('sort_by', 'name');
    $sortDirection = $request->get('sort_direction', 'asc');

    if ($request->has('college_id') && $request->college_id != '') {
        $students = Student::where('college_id', $request->college_id)
            ->orderBy($sortBy, $sortDirection)
            ->get();
    } else {
        $students = Student::orderBy($sortBy, $sortDirection)->get();
    }

    return view('students.index', compact('students', 'colleges', 'sortBy', 'sortDirection'));
    }

    public function create()
    {
        $colleges = College::all();
        return view('students.create', compact('colleges'));
    }

    public function store(Request $request)
    {
        $customMessages = [
            'email.required' => 'The email field is mandatory.',
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

    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        $colleges = College::all();

        return view('students.show', compact('student', 'colleges'));
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $colleges = College::all();

        return view('students.edit', compact('student', 'colleges'));
    }

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

    public function delete(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return back()->with('success', 'Student deleted successfully');
    }
}
