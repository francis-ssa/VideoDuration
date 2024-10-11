<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('scorm');
    }

    public function storeUserData(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        // Store user data in session or database as needed
        session([
            'user_email' => $request->email,
            'user_first_name' => $request->first_name,
            'user_last_name' => $request->last_name,
        ]);

        return redirect()->route('scorm');
    }
}