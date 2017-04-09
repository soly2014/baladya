<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//        if(!Auth::user())

        return view('landing');
//        else
//            return redirect()->to('dashboard');
    }


    public function login($type) {

        if (!Sentinel::check())

            return view('auth.login',compact('type'));

        else

            return redirect()->to('admin');
    }
}
