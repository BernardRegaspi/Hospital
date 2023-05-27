<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {
                $doctors = doctor::all();

                return view('user.home', compact('doctors'));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }

    public function index()
    {
        if (Auth::id()) {
            
            return redirect('home');
        } else {
            $doctors = doctor::all();
    
            return view('user.home', compact('doctors'));
        }
    }

    public function appointment(Request $request)
    {
        $data = new appointment;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->date = $request->date;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->doctor = $request->doctor;
        $data->status = 'In progress';
        
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        }

        $data->save();

        return redirect()->back()->with('message', 'Appointment Request Successful. We will Contatct with you soon');
    }

    public function my_appointment()
    {
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $appointments = appointment::where('user_id', $userid)->get();
            return view('user.my_appointment', compact('appointments'));
        } else {
            return redirect()->back();
        }
    }
    
    public function cancel_appointment($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
}
