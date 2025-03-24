@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Students</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Filter Form -->
    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="form-group">
            <label for="college_id">Filter by College:</label>
            <select name="college_id" id="college_id" class="form-control" onchange="this.form.submit()">
                <option value="">All Colleges</option>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" {{ request('college_id') == $college->id ? 'selected' : '' }}>
                        {{ $college->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>
                    <!-- Sorting Link for Name -->
                    <a href="{{ route('students.index', [
                        'sort_by' => 'name', 
                        'sort_direction' => (request('sort_by') == 'name' && request('sort_direction') == 'asc') ? 'desc' : 'asc'
                    ]) }}">
                        Name 
                        @if(request('sort_by') == 'name')
                            @if(request('sort_direction') == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>Email</th>
                <th>Phone</th>
                <th>D.O.B</th>
                <th>College</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>{{ $student->college->name }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('students.delete', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
