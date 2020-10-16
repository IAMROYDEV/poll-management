<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        if(auth()->user()) {
            if(auth()->user()->isAdmin()){
                return redirect('/polls');
            } else {
                return redirect('/home');
            }
        } else {
            return view('welcome');
        }


    }
}
