<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
// Thư viện cho phép sử dụng Session
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //
    public function index(){
        return view('layout');
    }
}
