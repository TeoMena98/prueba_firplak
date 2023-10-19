<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Role;
class HomeController
{
    public function index()
    {      
            return view('home');
      
       
    }
}
