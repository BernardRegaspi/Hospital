<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctor');
    }

    public function upload(Request $request)
    {
        $doctor = new doctor;
        $image = $request->file;
        $imagename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move('doctorimage', $imagename);
        $doctor->image = $imagename;
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->room = $request->room;
        $doctor->speciality = $request->speciality;
        $doctor->save();

        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }

    public function show_appointment()
    {
        $data = appointment::all();
        return view('admin.show_appointment', compact('data'));
    }

    public function approved($id)
    {
        $data = appointment::find($id);
        $data->status = 'Approved';
        $data->save();

        return redirect()->back();
    }

    public function canceled($id)
    {
        $data = appointment::find($id);
        $data->status = 'Canceled';
        $data->save();

        return redirect()->back();
    }

    public function show_doctor()
    {
        $data = doctor::all();
        return view('admin.show_doctor', compact('data'));
    }

    public function delete_doctor($id)
    {
        $data = doctor::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function update_doctor($id)
    {
        $data = doctor::find($id);

        return view('admin.update_doctor', compact('data'));
    }

    public function edit_doctor(Request $request, $id)
    {
        $doctor = doctor::find($id);
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $image = $request->file;

        if ($image) { 
            $image_name=time(). '.'.$image->getClientOriginalExtension();
            $request->file->move('doctorimage', $image_name);
            $doctor->image = $image_name;
        }

        $doctor->save();
        return redirect()->back()->with('message', 'Doctor Details Updated Successfully');
    }
}
