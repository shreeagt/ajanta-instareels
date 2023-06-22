@extends('layouts.app-master')

@section('content')

<link rel="stylesheet" href="{{asset('theme/css/video.css')}}">


    <div class="bg-light p-4 rounded">
        <h1>Video</h1>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Clinick Name</th>  
                    <th>Path</th>   
                    {{-- <th>Button</th>
                    <th>Video status</th>  --}}
                    <th>Play</th>
                    <!-- @if(Auth::user()->hasRole('so'))
                    <th>Path</th>
                    <th>video_statu</th>
                    @endif  
                    @if(Auth::user()->hasRole('admin'))
                    <th>Approve By</th>     
                    @endif
                    @if(Auth::user()->hasRole('so'))
                    <th>Play</th>
                    @endif -->
                   
                </tr>
            </thead>
            <tbody>
               
                @foreach($videos as $video)
                    <tr>
                        <td>{{$video->drid}}</td>
                        <td>{{$video->firstname}}</td>
                        <td>{{$video->lastname}}</td>
                        <td>{{$video->video_path}}</td>
                        {{-- <td>
                            @if($video->dr_video_status=="")
                            <a href ="{{ route('videoList.update')}}" class="btn btn-success">Approve</a>
                            <a href ="#" class="btn btn-danger btn-info">Reject</a>
                            @else
                            <a href ="#" class="btn btn-secondary ">Approve</a>
                            <a href ="#" class="btn btn-secondary ">Reject</a>
                            @endif
                        </td> --}}
                        {{-- <td>
                            @if($video->dr_video_status=="")
                            <a href ="#" class="btn btn-warning">Pending</a>
                            @elseif($video->dr_video_status=="approved")
                            <a href ="#" class="btn btn-primary">{{$video->dr_video_status}}</a>
                            @else
                            <a href ="#" class="btn btn-dark">{{$video->dr_video_status}}</a>
                            @endif
                        </td> --}}
                        {{-- <td><a href ="#" class="btn btn-info">Pay</a></td> --}}
                        <td><a href="#" class="btn btn-info" id="playButton">Pay</a></td>
                    <!-- @if(Auth::user()->hasRole('so'))
                    <td>{{ $video->drid }}</td>
                    @elseif(Auth::user()->hasRole('admin'))
                    <td>{{ $video->id }}</td> 
                    @endif 
                        <td>{{ $video->firstname }}</td>
                        <td>{{ $video->lastname }}</td>
                        @if(Auth::user()->hasRole('so'))
                        <td>{{ $video->video_path }}</td>
                        <td><a href ="#" class="btn btn-info">Pending</a></td>
                        <td><a href ="#" class="btn btn-info">Play</a></td>                          
                        @endif -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


     <!-- Modal for the video player -->
  <div id="videoModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <!-- Embed the video player here -->
      {{-- <video src="video_url.mp4" controls autoplay></video> --}}
      <video src="{{asset('assets/videos/sample-5s.mp4')}}" controls autoplay style="justify-content-center align-item-center"></video>
    </div>
  </div>

  <script>
    var playButton = document.getElementById("playButton");
    var videoModal = document.getElementById("videoModal");
    var closeModal = document.getElementsByClassName("close")[0];

    // Open the modal when the button is clicked
    playButton.addEventListener("click", function() {
      videoModal.style.display = "flex";
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener("click", function() {
      videoModal.style.display = "none";
    });
  </script>
@endsection
