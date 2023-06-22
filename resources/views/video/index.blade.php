@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Video</h1>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            
            @if(Auth::user()->hasRole('so'))
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Clinick Name</th>  
                    <th>Button</th>
                    <th>Video status</th> 
                    <th>Play</th>                   
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{$video->drid}}</td>
                        <td>{{$video->firstname}}</td>
                        <td>{{$video->lastname}}</td>
                        <td>
                            @if($video->dr_video_status=="")
                            <a href ="{{ route('videoList.update', $column_id=$video->id)}}" class="btn btn-success">Approve</a>
                            <a href ="{{ route('videoLiist.reject', $column_id=$video->id)}}" class="btn btn-danger btn-info">Reject</a>
                            @else
                            <a href ="#" class="btn btn-secondary ">Approve</a>
                            <a href ="#" class="btn btn-secondary ">Reject</a>
                            @endif
                        </td>
                        <td>
                            @if($video->dr_video_status=="")
                            <a href ="#" class="btn btn-warning">Pending</a>
                            @elseif($video->dr_video_status=="Approved")
                            <a href ="#" class="btn btn-primary">Approve</a>
                            @else
                            <a href ="#" class="btn btn-dark">Rjected</a>
                            @endif
                        </td>
                        <td><a href ="#" class="btn btn-info">Play</a></td>
                    </tr>
                @endforeach
            </tbody>

            @else          
            <thead>
                <tr>
                    <th>So Name</th>
                    <th>Doctor Name</th>
                    <th>Clinick Name</th> 
                    <th>Clinick Address</th> 
                    <th>Play</th>                   
                </tr>
            </thead>
            <tbody>
                @foreach($doctor_details as $details)
                    <tr>

                        @foreach($so_details as $so_detail)
                        @if($so_detail->id==$details->soid)
                        <td>{{$so_detail->firstname}}</td>
                        @endif
                        @endforeach
                        <td>{{$details->firstname}}</td>
                        <td>{{$details->lastname}}</td>
                        <td>{{$details->city}}</td>
                        <td><a href ="#" class="btn btn-info">Play</a></td>
                    </tr>
                @endforeach
            </tbody>
            @endif 

           
            
        </table>
    </div>
@endsection
