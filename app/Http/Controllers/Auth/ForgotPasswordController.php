<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\CmsPages;
use App\Settings;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    //dd(1);
    //use SendsPasswordResetEmails;
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
        $data = [];

        $data['setting'] = Settings::Where('id','1')->first();
        $all_pages = CmsPages::where('status',1)->get();
        $data['active_pages'] = array();
        foreach($all_pages as $key=>$val)
        {
            $data['active_pages'][] = $val->page_slug;
        }

         return view('auth.passwords.email')->with($data);
      }
}
