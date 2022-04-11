<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        if(Auth::check()){

           // return view('admin.index');
           return redirect()->route('dashboard');
        }

       // return view('auth.login');
        return redirect()->route('login');
    }
}
