<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Notification;

class SubscriberController extends Controller
{
    
public function insert(Request $req)
{
    $existing = Subscriber::where('email', $req->email)->first();
    if ($existing) {
        return redirect()->back()->with('info', 'You have already subscribed with this email.');
    }

    $req->validate([
        'firstname' => 'required|string|max:100',
        'lastname'  => 'nullable|string|max:100',
        'email'     => 'required|email',
    ]);

    $subscriber = new Subscriber();
    $subscriber->name = trim($req->firstname . " " . $req->lastname);
    $subscriber->email = $req->email;
    $subscriber->created_at = now()->setTimezone('America/New_York');

    if ($subscriber->save()) {

        $notification = new Notification();
        $notification->subject = 'New Subscriber';
        $notification->message = "A new subscriber has joined!  
            Name: {$subscriber->name} ";
        $notification->time = now()->setTimezone('America/New_York');
        $notification->save();

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    } else {
        return redirect()->back()->with('error', 'Oops! Something went wrong. Please try again later.');
    }
}


    
    
    public function index()
    {

        $sub = Subscriber::orderBy('id', 'desc')->get();

        return view('admin.subscribers', compact('sub'));
    }
    
    public function delete(Request $req)
    {

        $subscriber = Subscriber::findOrFail($req->id);

        if ($subscriber->delete()) {
            return redirect()->back()->with('success', 'Subscriber Deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
