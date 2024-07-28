<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class A_HomeController extends Controller
{
    //
    public function index(){
        return view('admin.home_admin');
    }
}
