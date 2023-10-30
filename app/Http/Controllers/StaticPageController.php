<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Settings;
use App\Contact;
use CommonHelper;
use App\CmsPages;
class StaticPageController extends Controller
{
   //contact us view
    function contact_us()
    {
        $data = [];
        $data['page_title'] = 'Contact Us';
        $data['meta_description'] = 'Contact Us';
        $data['meta_keywords'] = 'Contact Us';
        $data['settings'] = Settings::first();
        //dd($data['settings']);
        return view('frontend.contactus')->with($data);

    }

    public function contact_us_save(Request $request)
    {
        $request->validate([
        'first_name' => 'required|string|max:30|min:2',
        'last_name' => 'required|string|max:30|min:2',
        'email' => 'required|email',
        'inquiry'=> 'required',
        'contact_no' => 'required|string|max:15'
    
        
        ]);
        Contact::insert([
        'first_name' =>trim($request->input('first_name')),
        'last_name' =>trim($request->input('last_name')),
        'email' => trim($request->input('email')),
        'contact_no'=> trim($request->input('contact_no')),
        'inquiry' => $request->input('inquiry'),
        'created_at'=>date('Y-m-d H:i:s')
        ]);
        $data = array(
        'name'=> trim($request->input('first_name')).' '.trim($request->input('last_name'))
        );

       CommonHelper::sendEmail(['to' =>  trim($request->input('email')), 'data' => $data, 'template' => 'user-inquiry-submission']); 
        $setting_dtls = Settings::find(1);
        $data_admin = array(
        'name'=> trim($request->input('first_name')).' '.trim($request->input('last_name')),
        'email'=>trim($request->input('email')),
        'contact_no'=>trim($request->input('contact_no')),
        'inquiry'=> $request->input('inquiry')
        );
        $site_email = $setting_dtls->site_email;
        
        CommonHelper::sendEmail(['to' =>   $site_email , 'data' => $data_admin, 'template' => 'admin-contact-email']); 
        return redirect('/contact-us')->with('success', 'Your inquiry has been submitted successfully!');
       
    }
    public function about_us()
    {

        $data = [];
        
        $page_dtls = CmsPages::where('page_slug','about-us')->first();
        $data['page_dtls'] = $page_dtls;
        $data['page_title'] =$page_dtls->meta_title;
        $data['meta_description'] = $page_dtls->meta_description;
        $data['meta_keywords'] = $page_dtls->meta_keywords;
        $data['setting'] = Settings::Where('id','1')->first();
        //dd($data['page_dtls']);        
        return view('frontend.staticpage')->with($data);
    }
}
