<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;  
use Aws\Exception\AwsException;
use App\Models\User;
use App\Models\Doctors;
use App\Models\Videos;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import the Storage facade
use DB;


class DoctorsController extends Controller
{
    public function create()
    {
        return view('doctors.create');
    }
    public function insertdoctors(Request $request)
   {
    // $folderPath = public_path('logos');
    // if (!file_exists($folderPath)) {
    //     mkdir($folderPath, 0777, true);
    // }

    // $FolderPath = public_path('photos');
    // if (!file_exists($FolderPath)) {
    //     mkdir($FolderPath, 0777, true);
    // }
   

    $idoctor = new Doctors;
    $idoctor->firstname = $request->input('firstname');
    $idoctor->lastname = $request->input('lastname');
    $idoctor->email = $request->input('email');
    $idoctor->contacno = $request->input('contacno');
    $idoctor->city = $request->input('city');
    $idoctor->speciality = $request->input('speciality');
    $idoctor->mci = $request->input('mci');

    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:5242880', // Maximum file size is 5MB
    ]);
    $request->validate([
        'logo' => 'required|image|mimes:jpeg,png,jpg|max:5242880', // Maximum file size is 5MB
    ]);
    $bucket = env('AWS_BUCKET');
    $folder = 'ajanta/Inta_reels/Instadoctors/profile';

    // Generate a unique filename for the video
    $filename = uniqid().'.'.$request->file('photo')->getClientOriginalExtension();

    // Store the video in Amazon S3
    $filePath = $folder.'/'.$filename;
    Storage::disk('s3')->put($filePath, file_get_contents($request->file('photo')));

    // Set the video path to the S3 URL
    $photoPath = env('AWS_URL').'/'.$filePath;
    $idoctor->photo = $photoPath; 

    //logos
    $bucket = env('AWS_BUCKET');
    $folder = 'ajanta/Inta_reels/Instadoctorsclinic/logos';

    // Generate a unique filename for the video
    $filename = uniqid().'.'.$request->file('logo')->getClientOriginalExtension();

    // Store the video in Amazon S3
    $filePath = $folder.'/'.$filename;
    Storage::disk('s3')->put($filePath, file_get_contents($request->file('logo')));

    // Set the video path to the S3 URL
    $logoPath = env('AWS_URL').'/'.$filePath;
    $idoctor->logo = $logoPath; 
    
    // Retrieve the soid from the users table and assign it to the soid column of the Doctors model
    $soid = Auth::id();
    $idoctor->soid = $soid;

    $idoctor->save();
    return redirect()->route('doctors.show')->with('success', 'Doctor Successfully added');
    }

    public function showdoctors()
    {
        // Retrieve the currently logged-in user's SO ID
        $soid = Auth::id();

        // Retrieve only the doctors created by the logged-in user
        $doctors = Doctors::where('soid', $soid)->get();

        
        // $logoPath = 'https://shreeagt-prod.s3.ap-south-1.amazonaws.com/ajanta/Inta_reels/Instadoctorsclinic/logos/';
        // $photoPath = 'https://shreeagt-prod.s3.ap-south-1.amazonaws.com/ajanta/Inta_reels/Instadoctors/profile/';

        return view('doctors.show', [
            'doctors' => $doctors,
            ]);
    }
    public function destroy(Doctors $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.show');
    }
    public function edit(Doctors $doctor)
    {
        // Retrieve the doctor from the database and pass it to the view
        return view('doctors.edit', ['doctor' => $doctor]);
    }
    
    public function update(Request $request, Doctors $doctor)
    {
        
        // Update the doctor's details based on the form input
        $doctor->firstname = $request->input('firstname');
        $doctor->lastname = $request->input('lastname');
        $doctor->email = $request->input('email');
        // $doctor->role = $request->input('role');
        $doctor->contacno = $request->input('contacno');
        $doctor->city = $request->input('city');
        $doctor->mci = $request->input('mci');

        if ($request->has('speciality')) {
            $doctor->speciality = $request->input('speciality');
        }


      
    $request->validate([
        'photo' => '|image|mimes:jpeg,png,jpg|max:5242880', // Maximum file size is 5MB
    ]);
    $request->validate([
        'logo' => '|image|mimes:jpeg,png,jpg|max:5242880', // Maximum file size is 5MB
    ]);
     // Upload and update the photo if a file is selected
     if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('ajanta/Inta_reels/Instadoctors/profile', 's3');
        $doctor->photo = Storage::disk('s3')->url($photoPath);
    }

    // Upload and update the logo if a file is selected
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoPath = $logo->store('ajanta/Inta_reels/Instadoctorsclinic/logos', 's3');
        $doctor->logo = Storage::disk('s3')->url($logoPath);
    }
        // Retrieve the soid from the users table and assign it to the soid column of the Doctors model
        $soid = Auth::id();
        $doctor->soid = $soid;
        
        $doctor->save();
    
        // Redirect the user to the show page or any other appropriate page
        return redirect()->route('doctors.show', ['doctor' => $doctor->id]);
    }
    public function link(Doctors $doctor)
    {
        return view ('home', ['doctor' => $doctor]);
    }
    public function upload(Request $request)
{
    $video = new Videos();
    // Validate the file
    $request->validate([
        'video_path' => 'required|mimetypes:video/mp4,video/avi,video/quicktime|max:5242880', // Maximum file size is 5MB
    ]);

    // Specify the S3 bucket and folder where you want to store the video
    $bucket = env('AWS_BUCKET');
    $folder = 'ajanta/inta_reels/insta_videos/gallery';

    // Generate a unique filename for the video
    $filename = uniqid().'.'.$request->file('video_path')->getClientOriginalExtension();

    // Store the video in Amazon S3
    $filePath = $folder.'/'.$filename;
    Storage::disk('s3')->put($filePath, file_get_contents($request->file('video_path')));

    // Set the video path to the S3 URL
    $videoPath = env('AWS_URL').'/'.$filePath;
    $video->video_path = $videoPath; // Save the video to the public/videos/gallery folder

    // Assign the 'drid' value to the 'drid' column of the 'Videos' model
    $video->drid = $request->dr_id; 
    $video->so_id = $request->so_id;
    $video->doctor_instruction=$request->instruction;
    $video->save();
    // $queries = DB::getQueryLog();// dd($queries);

    // You can perform additional actions here, such as sending notifications or processing the video further
    // return redirect()->back()->with('success', 'Video uploaded successfully.');
    return redirect('/thankyou')->with('success', 'Video uploaded successfully.');

}
}
