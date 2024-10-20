<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.register');
    }

    public function welcome()
    {
        return view('pages.welcome');
    }
    public function post(Request $request)
    {
        $first_name = $request->input('fname');
        $last_name = $request->input('lname');
        return view('pages.welcome', ['fname' => $first_name, 'lname' => $last_name]);
    }
}
