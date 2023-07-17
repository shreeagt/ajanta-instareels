@extends('layouts.app-master')

@section('content')

    <link rel="stylesheet" href="{{ asset('theme/css/video.css') }}">

    <div class="bg-light p-4 rounded">
        <h1>Video</h1>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            @php
                $i = 1;
            @endphp
            @if (Auth::user()->hasRole('so'))
                <!-- So Role View -->
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Clinic Name</th>
                        <th>Button</th>
                        <th>Video status</th>
                        <th>Doctor Instruction</th>
                        <th>Play</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($videos) && count($videos) > 0)
                        @foreach ($videos as $video)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $video->firstname }}</td>
                                <td>{{ $video->lastname }}</td>
                                <td>
                                    @if ($video->dr_video_status == '')
                                        <a href="{{ route('videoList.update', $column_id = $video->id) }}"
                                            class="btn btn-success">Approve</a>
                                        <a href="{{ route('videoLiist.reject', $column_id = $video->id) }}"
                                            class="btn btn-danger">Reject</a>
                                    @else
                                        <a href="#" class="btn btn-secondary ">Approve</a>
                                        <a href="#" class="btn btn-secondary ">Reject</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($video->dr_video_status == '')
                                        <a href="#" class="btn btn-warning">Pending</a>
                                    @elseif ($video->dr_video_status == 'Approved')
                                        <a href="#" class="btn btn-primary">Approve</a>
                                    @else
                                        <a href="#" class="btn btn-dark">Rejected</a>
                                    @endif
                                </td>
                                <td>{{ $video->doctor_instruction }}</td>
                                <td><a href="#" class="btn btn-info playbtn_video" data-url="{{ $video->video_path }}">Play</a></td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan='6'>
                                <h1>No videos to show</h1>
                            </td>
                        </tr>
                    @endif
                </tbody>
            @else
                <!-- Admin Role View -->
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>So Name</th>
                        <th>Doctor Name</th>
                        <th>Clinic Name</th>
                        <th>Doctor Instruction</th>
                        <th>Play</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($doctor_details) && count($doctor_details) > 0)
                        @foreach ($doctor_details as $details)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $details->firstname }}</td>
                                <td>{{ $details->lastname }}</td>
                                <td>{{ $details->city }}</td>
                                <td>{{ $details->doctor_instruction }}</td>
                                <td><a href="#" class="btn btn-info playbtn_video" data-url="{{ $details->video_path }}">Play</a></td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan='6'>
                                <h1>No videos to show</h1>
                            </td>
                        </tr>
                    @endif
                </tbody>
            @endif
        </table>
    </div>

    <!-- Modal for the video player -->
    <div id="videoModal" class="modal open_video">
        <div class="modal-content">
            <span class="close close_video">&times;</span>
            <video id="videoPlayer" controls style="justify-content: center; align-items: center;"></video>
        </div>
    </div>

    <script>
        var playButtons = document.getElementsByClassName("playbtn_video");
        var videoModal = document.getElementById("videoModal");
        var videoPlayer = document.getElementById("videoPlayer");
        var closeModal = document.getElementsByClassName("close_video");

        for (let i = 0; i < playButtons.length; i++) {
            playButtons[i].addEventListener("click", function() {
                var videoURL = this.getAttribute("data-url");
                videoPlayer.src = videoURL;
                videoModal.style.display = "flex";
            });
        }

        for (let i = 0; i < closeModal.length; i++) {
            closeModal[i].addEventListener("click", function() {
                videoPlayer.pause();
                videoModal.style.display = "none";
            });
        }
    </script>
@endsection