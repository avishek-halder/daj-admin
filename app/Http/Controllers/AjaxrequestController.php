<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use File;
use App\User;
use App\ManageBanner;

use App\CmsPages;
use App\Settings;
use App\Country;
use App\State;
use App\City;
use App\Duration;
use App\Rules\WordCount;
use App\FilerExperience;
use App\UserFiler;
use AdminHelper;
use App\UserOtp;
use App\Product;
use Illuminate\Support\Facades\Hash;


class AjaxrequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

 
     function getStateByCountry(Request $request)
    {
        
            $country_id =  $request->input('country_id');
           $states = State::where('country_id',$country_id)->get();
           $node = '<option value="">Select State</option>';
           foreach ($states as $key => $value) {
               # code...
             $node  =  $node .'<option value="'.$value->id.'">'.$value->name.'</option>';
           }
           echo $node;exit;
       

       
    }
    function getCityByState(Request $request)
    {
       $state_id =  $request->input('state_id');
       $cities = City::where('state_id',$state_id)->get();
       $node = '<option value="">Select City</option>';
       foreach ($cities as $key => $value) {
           # code...
         $node  =  $node .'<option value="'.$value->id.'">'.$value->name.'</option>';
       }
       echo $node;exit;
    }
   
    
}
