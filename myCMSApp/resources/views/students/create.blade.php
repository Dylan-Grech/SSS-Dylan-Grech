@extends('layouts.app')

@section('content')
    <h2>Add Student</h2>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3 text-light">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3 text-light">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3 text-light">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-3 text-light">
            <label for="dob" class="form-label">D.O.B</label>
            <input type="text" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required>
        </div>

        <!-- College Dropdown -->
        <div class="mb-3">
            <label for="college_id" class="form-label">College</label>
            <select class="form-control" id="college_id" name="college_id" required>
                <option value="" disabled selected>Select a College</option>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" {{ old('college_id') == $college->id ? 'selected' : '' }}>
                        {{ $college->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Student</button>
    </form>

    <!-- Display success message if any -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
            <a class="nav-link" href="{{ route('students.index') }}">Go back</a>
        </div>
    @endif
@endsection
