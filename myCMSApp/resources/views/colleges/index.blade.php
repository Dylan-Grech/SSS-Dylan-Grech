@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Colleges</h2>
        <a href="{{ route('colleges.create') }}" class="btn btn-primary">Add College</a>
    </div>
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colleges as $college)
                <tr>
                    <td>{{ $college->id }}</td>
                    <td>{{ $college->name }}</td>
                    <td>{{ $college->address }}</td>
                    <td>
                        <a href="{{ route('colleges.edit', $college->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
