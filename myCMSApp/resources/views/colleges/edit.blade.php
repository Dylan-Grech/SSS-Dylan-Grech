@extends('layouts.app')

@section('content')
    <h2>Edit College</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <a class="" href="{{ route('colleges.index') }}">Go Back</a>
        </div>
    @endif

    <form action="{{ route('colleges.update', $college->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">College Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $college->name }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $college->address }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update College</button>
    </form>
@endsection
