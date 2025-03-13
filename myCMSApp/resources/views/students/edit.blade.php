@extends('layouts.app')

@section('content')
    <h2>Edit Student</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <a href="{{ route('students.index') }}">Go Back</a>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $student->phone }}" required>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">D.O.B</label>
            <input type="text" class="form-control" id="dob" name="dob" value="{{ $student->dob }}" required>
        </div>

        <div class="mb-3">
            <label for="college_id" class="form-label">College</label>
            <select class="form-control" id="college_id" name="college_id" required>
                <option value="" disabled>Select a College</option>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" 
                        {{ old('college_id', $student->college_id) == $college->id ? 'selected' : '' }}>
                        {{ $college->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Student</button>
    </form>
@endsection
