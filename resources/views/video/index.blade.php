@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Video</h1>
        <div class="lead">
            Video List
            {{-- <a href="{{ route('videocreate') }}" class="btn btn-primary btn-sm float-right">Add video</a> --}}
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Last Name</th>               
                    <th>Thumbnail</th>
                    <th>Status</th>
                    @if(Auth::user()->hasRole('so'))
                        <th>Action</th>
                    @elseif(Auth::user()->hasRole('admin'))
                        <th>Approve By</th>   
                    @endif    
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->firstname }}</td>
                        <td>{{ $video->lastname }}</td>
                        <td>{{ $video->email }}</td>
                        <td>{{ $video->role }}</td>
                        @if(Auth::user()->hasRole('so'))
                            <td>Action</td>
                        @elseif(Auth::user()->hasRole('admin'))
                            <td>Approve By</td>   
                        @endif    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
