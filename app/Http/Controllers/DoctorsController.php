<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctors;
use App\Models\VideoModel;
use Auth;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function create()
    {
        return view('doctors.create');
    }
    public function insertdoctors(Request $request)
    {
    $idoctor = new Doctors;
    $idoctor->firstname = $request->input('firstname');
    $idoctor->lastname = $request->input('lastname');
    $idoctor->email = $request->input('email');
    $idoctor->role = $request->input('role');

    // Retrieve the soid from the users table and assign it to the soid column of the Doctors model
    $soid = Auth::id();
    $idoctor->soid = $soid;

    $idoctor->save();
    return redirect()->route('doctors.show')->with('success', 'Doctor added');
    }

    public function showdoctors()
    {
        // Retrieve the currently logged-in user's SO ID
        $soid = Auth::id();

        // Retrieve only the doctors created by the logged-in user
        $doctors = Doctors::where('soid', $soid)->get();

        return view('doctors.show', ['doctors' => $doctors]);
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
        $doctor->role = $request->input('role');
        $doctor->save();
    
        // Redirect the user to the show page or any other appropriate page
        return redirect()->route('doctors.show', ['doctor' => $doctor->id]);
    }
    public function link(Doctors $doctor)
    {
        return view ('home', ['doctor' => $doctor]);
    }
    // public function uploadvideo(Request $request)
    // {
    //     $uvideo = new VideoModel;
        
    //     if ($request->hasFile('video')) {
    //         $uvideo = $request->file('video');
    //         $customName = 'video_' . time() . '.' . $uvideo->getClientOriginalExtension();
    //         $destinationPath = 'uploads/videos';
    //         $uvideo->move($destinationPath, $customName);
    
    //         $video_insert = VideoModel::create([
    //             "video_path" => $customName,
    //             "created_by" => auth()->id(),
    //             "created_at" => date("Y-m-d H:i:s")
    //         ]);
    
    //         $request->session()->flash('success', 'Data inserted successfully.');
    //     } else {
    //         $request->session()->flash('error', 'No video file uploaded.');
    //     }
    
    //     return redirect()->route('doctors.upload');
    // }
}
