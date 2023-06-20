<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctors;
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
}
