@extends('layouts.app')

@section('content')
    <h2>Add College</h2>

    <form action="{{ route('colleges.store') }}" method="POST">
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
            <label for="name" class="form-label">College Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3 text-light">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Add College</button>
    </form>

    <!-- Display success message if any -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
            <a class="nav-link" href="{{ route('colleges.index') }}">Go back</a>
        </div>
    @endif
@endsection
