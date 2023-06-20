@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
        <h1>Add Doctors</h1>
        <div class="lead">
            Add Doctors and assign role.
        </div>

        <div class="container mt-4">
        <form action="{{ route('doctors.update', ['doctor' => $doctor->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $doctor->firstname }}">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $doctor->lastname }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $doctor->email }}">
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" name="role" id="role" class="form-control" value="{{ $doctor->role }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        </div>

    </div>


@endsection