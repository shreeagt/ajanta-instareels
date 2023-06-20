@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show Doctors</h1>
        <div class="lead">
            <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add Doctor</a>
        </div>
        
        <div class="container mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->id }}</td>
                            <td>{{ $doctor->firstname }}</td>
                            <td>{{ $doctor->lastname }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->role }}</td>
                            <td><a href="{{ route('doctors.link', ['doctor' => $doctor->id]) }}" class="btn btn-success">Link</td>
                            <td>
                                <a href="{{ route('doctors.edit', ['doctor' => $doctor->id]) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('doctors.destroy', ['doctor' => $doctor->id]) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $doctor->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $doctor->id }}" action="{{ route('doctors.destroy', ['doctor' => $doctor->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

