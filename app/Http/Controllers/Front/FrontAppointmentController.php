<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class FrontAppointmentController extends Controller
{
    
public function bookAppointment(Request $req)
{
    $req->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email',
        'number'   => 'required|string|max:20',
        'select'   => 'required|string',
        'date'     => 'required|date',
        'slot'     => 'required|string',
        'location' => 'required|string',
    ]);

    $exists = Appointment::where('date', $req->date)
        ->where('slot', $req->slot)
        ->exists();

    if ($exists) {
        return redirect()->back()
            ->withInput()
            ->with('error', "Sorry, this slot on {$req->date} is already booked. Please choose another one.");
    }

    $appointment = new Appointment();
    $appointment->name     = $req->name;
    $appointment->email    = $req->email;
    $appointment->number   = $req->number;
    $appointment->select   = $req->select;
    $appointment->date     = $req->date;
    $appointment->location = $req->location;
    $appointment->slot     = $req->slot;
    $appointment->status   = 'pending';

    if ($appointment->save()) {
        return redirect()->back()
            ->with('success', 'Your appointment has been booked successfully. We will contact you soon.');
    } else {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Something went wrong. Please try again later.');
    }
}

    
}