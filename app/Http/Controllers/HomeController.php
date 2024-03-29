<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Settings;

use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //Running home page
    function home()
    {
        $data = [];
        $data['page_title'] = 'Home';
        $data['meta_description'] = 'Home';
        $data['meta_keywords'] = 'Home';

        Mail::raw('Hi, welcome user!', function ($message) {
            $message->to("admin@freesmtpservers.com")
              ->subject("Yest");
          });

        // return view('frontend.home')->with($data);
    }
    
}
