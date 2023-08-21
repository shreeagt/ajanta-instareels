<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoModel;
use App\Models\Doctors;
use App\Models\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;  
use Aws\Exception\AwsException;

// use FFMpeg\Filters\Video\VideoFilters;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if (Auth::user()->hasRole('admin')) {
            $doctor_details = DB::select('SELECT doctors.firstname, videos.doctor_instruction, doctors.city, doctors.lastname, doctors.soid, videos.video_path, videos.dr_video_status FROM videos INNER JOIN doctors ON videos.drid = doctors.id WHERE videos.dr_video_status = "" OR videos.dr_video_status = "Download";');
            // $doctor_details = DB::select('SELECT doctors.firstname, videos.doctor_instruction, doctors.city, doctors.lastname, doctors.soid, videos.video_path FROM videos INNER JOIN doctors ON videos.drid = doctors.id WHERE videos.dr_video_status="Approved";');
            $so_details = DB::select('SELECT firstname, lastname, id FROM users');
            return view('video.index', compact('doctor_details', 'so_details'));
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->id;
            $videos = DB::select('SELECT * FROM doctors INNER JOIN videos ON doctors.id = videos.drid WHERE videos.so_id=?', [$id]);
            return view('video.index', compact('videos'));
        }   
    }

       

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    
        $video = $request->file('video');
        // Generate a custom name for the video
        $customName = 'video_' . time() . '.' . $video->getClientOriginalExtension();
        // Store the video in the public folder with the custom name
        // $video->storeAs('public/videos', $customName);    
        $destinationPath = 'uploads/videos';
        $video->move($destinationPath, $customName);
    
        $video_insert = VideoModel::create([
            "video_path" => $customName,
            "created_by" => auth()->id(),
            "created_at" => date("Y-m-d H:i:s")
        ]);
    
        $request->session()->flash('success', 'Data inserted successfully.');
        return redirect()->route('videocreate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        
       
        $status = $request->input("status");
       
        $video = VideoModel::where("video_id",$id)->first();
        $video->status=$status;
        $video->save();
        // $video->update($input);
       
        return redirect()->route('videoList')
                        ->with('success','Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updatevideo(request $id)
    {
        // echo $id->id;// dd($id);//DB::connection()->enableQueryLog();
        DB::table('videos')->where('id', $id->id)->update(array('dr_video_status' => 'Approved'));
        return redirect()->route('videoList');
        //$queries = \DB::getQueryLog();// dd($queries);
    }
    public function rject(request $id){
       // echo $id->id;// dd($id);//DB::connection()->enableQueryLog();
        DB::table('videos')->where('id', $id->id)->update(array('dr_video_status' => 'rject'));
        return redirect()->route('videoList');
        //$queries = \DB::getQueryLog();// dd($queries);
    }
}
