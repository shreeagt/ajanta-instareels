@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show Doctors</h1>
        <div class="lead">
            <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add Doctor</a>
        </div>
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>
        <div class="container mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dr. Name</th>
                        <th>Clinic Name</th>
                        <th>Contact No</th>
                        <th>City</th>
                        <th>Logo</th>
                        <th>Email</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @if (isset($doctors[0]->firstname) != '')
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $doctor->firstname }}</td>
                                <td>{{ $doctor->lastname }}</td>
                                <td>{{ $doctor->contacno }}</td>
                                <td>{{ $doctor->city }}</td>
                                <td>
                                    @if ($doctor->logo)
                                        <img src="{{ asset('logos/' . $doctor->logo) }}" alt="Logo" width="50"
                                            height="50">
                                    @else
                                        No Logo
                                    @endif
                                </td>
                                <td>{{ $doctor->email }}</td>
                                <td><a href="{{ route('doctors.link', ['doctor' => $doctor->id]) }}"
                                        class="btn btn-success">Link</td>
                                <td>
                                    <a href="{{ route('doctors.edit', ['doctor' => $doctor->id]) }}"
                                        class="btn btn-info">Edit</a>
                                    <a href="{{ route('doctors.destroy', ['doctor' => $doctor->id]) }}"
                                        class="btn btn-danger"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $doctor->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $doctor->id }}"
                                        action="{{ route('doctors.destroy', ['doctor' => $doctor->id]) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan='6'>
                                <h1>Please add your doctors</h1>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
