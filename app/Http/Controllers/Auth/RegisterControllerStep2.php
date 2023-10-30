<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CmsPages;
use App\Settings;
use App\Country;
use Session;
use App\User;
use App\UserOtp;
use App\Rules\ReCaptcha;
use App\UserFiler;
use App\FilerExperience;
use DB;

class RegisterControllerStep2 extends Controller
{
    public function __construct()
    {
         //$this->middleware('guest');
            $this->middleware('auth');
    }

    public function form()
    {
        $data = [];
        $data['setting'] = Settings::Where('id','1')->first();
        $all_pages = CmsPages::where('status',1)->get();
        $data['countries'] = Country::distinct()->orderBy('phonecode','ASC')->pluck('phonecode');
        $data['countries_list'] =  Country::distinct()->orderBy('phonecode','ASC')->get();
        $user_id = auth()->user()->id;
        $user_dtls = User::where('id',$user_id)->first();
        $data['temp_filler'] = UserFiler::where('user_id',$user_id)->where('status',2)->orderBy('id','desc')->first();
        if(session()->get('share_for')!='')
        {
            
             $data['share_for_current'] = session()->get('share_for');
        }
        elseif(!empty($data['temp_filler']))
        {
             $data['share_for_current'] = $data['temp_filler']->share_for;

        }
        else
        {
            $data['share_for_current'] = 1; 
        }

        if( !empty($data['temp_filler']) && $data['temp_filler']->email==$user_dtls->email)
        {
            $data['temp_filler'] = array();
        }

        if(session()->get('is_logged_in')==1)
        {
            $data['is_back'] = 'dashboard';
        }
        else
        {
            $data['is_back'] = '';
        }
       
        
        //dd($data['temp_filler']);
        $data['active_pages'] = array();
        foreach($all_pages as $key=>$val)
        {
            $data['active_pages'][] = $val->page_slug;
        }
        $data['user_dtls'] = $user_dtls ;
       
        return view('auth.register_step2')->with($data);
    }

    public function saveData(Request $request)
    {
        if($request->input('whosharing')=='1')
        {
            $request->validate([
            
            'g-recaptcha-response' => ['required', new ReCaptcha]
            ],[
            'g-recaptcha-response.required' => 'The google recaptcha is required'
            
            ]);
            $user_id = auth()->user()->id;
            $user_dtls = User::where('id',$user_id)->first();
            DB::beginTransaction();
            try {
                


                $temp_filer = UserFiler::where('user_id',$user_id)->where('status',2)->orderBy('id','desc')->first();
                if(!empty($temp_filer))
                {
                    $temp_filer->first_name = $user_dtls->first_name;
                    $temp_filer->last_name = $user_dtls->last_name;
                    $temp_filer->email = $user_dtls->email;
                    $temp_filer->mobile_no = $user_dtls->mobile_no;
                    $temp_filer->country_code = $user_dtls->country_code;
                    $temp_filer->relationship = 'self';
                    $temp_filer->share_for = $request->input('whosharing');
                    $temp_filer->country_id = $user_dtls->country;
                    $temp_filer->state_id = $user_dtls->state;
                    $temp_filer->zip_code = $user_dtls->zipcode;
                    $temp_filer->display_name = $user_dtls->display_name;
                    $temp_filer->gender = $user_dtls->gender;
                    $temp_filer->status =2;
                    $temp_filer->updated_at =date('Y-m-d H:i:s');
                    //dd($temp_filer);
                    $temp_filer->save();

                }
                else
                {
                    $x = [
                    'user_id' => $user_id,
                    'first_name' => $user_dtls->first_name,
                    'last_name' =>$user_dtls->last_name,
                    'email' => $user_dtls->email,
                    'mobile_no'=>$user_dtls->mobile_no,
                    'country_code' => $user_dtls->country_code,
                    'relationship' => 'self',
                    'share_for' => $request->input('whosharing'),
                    'country_id'=> $user_dtls->country,
                    'state_id'=> $user_dtls->state,
                    'zip_code'=> $user_dtls->zipcode,
                    'display_name'=> $user_dtls->display_name,
                    'gender' => $user_dtls->gender,
                    'status'=>2,
                    'created_at'=>date('Y-m-d H:i:s')
                    ];
                    
                    UserFiler::insert($x);
                }
                
                 DB::commit();
                 //return redirect('/user-information')->with('success', 'Filler information has been submitted.');
                 return redirect('/user-information');
            }catch (\Exception $e) {
                DB::rollback();
                // something went wrong
            }
        


        }
        elseif($request->input('whosharing')=='2' || $request->input('whosharing')=='3')
        {
            $user_id = auth()->user()->id;
            $user_dtls = User::where('id',$user_id)->first();
            /*if($request->input('whosharing')=='3')
            {
                $fnamae = trim($request->input('first_name'));
                $lname = trim($request->input('last_name'));
                $mobile = trim($request->input('mobile_no'));
                $country_code = trim($request->input('phone_code'));
                $exist_filer = UserFiler::where('user_id',$user_id)->where('status','!=','2')->where('first_name',$fnamae)
                ->where('last_name',$lname)
                ->where('mobile_no',$mobile)
                ->where('country_code',$country_code)->first();

            }*/
            $temp_filer = UserFiler::where('user_id',$user_id)->where('status',2)->orderBy('id','desc')->first();
            if(!empty($temp_filer))
            {
                 $request->validate([
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:30',
                'email'=> 'nullable|string|email|max:255',
                'phone_code' => 'required',
                'country' => 'required',
                'mobile_no'=>'required|string|max:10|min:10',
                'relationship' => 'required|string|max:50|min:2',
                'g-recaptcha-response' => ['required', new ReCaptcha]
                
                ],[
                    'g-recaptcha-response.required' => 'The google recaptcha is required'
            
                ]);
                
            }
            else
            {
                $request->validate([
                'first_name' => 'required|regex:/^[\pL\s]+$/u|max:30',
                'last_name' => 'required|regex:/^[\pL\s]+$/u|max:30',
                'email'=> 'nullable|string|email|max:255',
                'mobile_no'=>'required|string|max:10',
                'country' => 'required',
                'relationship' => 'required|string|max:50|min:2',
                'g-recaptcha-response' => ['required', new ReCaptcha]
                
                ],[
                    'g-recaptcha-response.required' => 'The google recaptcha is required'
            
                ]);

                /*if($user_dtls->email==trim($request->input('email')))
                {
                    return redirect('/sharing-experience-for')->with('error', 'Please use another email.');
                }
                $user_mobile_with_country = $user_dtls->country_code.$user_dtls->mobile_no;
                $filer_mobile_with_country = trim($request->input('phone_code')).trim($request->input('mobile_no'));
                if($user_mobile_with_country==$filer_mobile_with_country)
                {
                    return redirect('/sharing-experience-for')->with('error', 'Please use another mobile number.');
                }*/
                
            }
             

           
            DB::beginTransaction();
            try {
               
                if(!empty($temp_filer))
                {

                    $temp_filer->first_name =  trim($request->input('first_name'));
                    $temp_filer->last_name = trim($request->input('last_name'));
                    $temp_filer->email =trim($request->input('email'));
                    $temp_filer->mobile_no = trim($request->input('mobile_no'));
                    $temp_filer->country_code = trim($request->input('phone_code'));
                    $temp_filer->relationship = trim($request->input('relationship'));
                    $temp_filer->share_for = $request->input('whosharing');
                    $temp_filer->country_id = $request->input('country');
                    $temp_filer->state_id = $user_dtls->state;
                    $temp_filer->zip_code = $user_dtls->zipcode;
                    $temp_filer->display_name =NULL;
                    $temp_filer->gender = NULL;
                    $temp_filer->status =2;
                    $temp_filer->updated_at =date('Y-m-d H:i:s');
                    $temp_filer->save();
                }
                else
                {
                    UserFiler::insert([
                    'user_id' => $user_id,
                    'first_name' => trim($request->input('first_name')),
                    'last_name' =>trim($request->input('last_name')),
                    'email' => trim($request->input('email')),
                    'mobile_no'=>trim($request->input('mobile_no')),
                    'country_code' => trim($request->input('phone_code')),
                    'relationship' => trim($request->input('relationship')),
                    'share_for' =>trim($request->input('whosharing')),
                    'country_id'=>$request->input('country'),
                    'state_id'=> $user_dtls->state,
                    'zip_code'=> $user_dtls->zipcode,
                    'status'=>2,
                    'created_at'=>date('Y-m-d H:i:s')
                    ]);
                }
               
                DB::commit();
                //return redirect('/user-information')->with('success', 'Filler information has been submitted.');
                 return redirect('/user-information');

            }catch (\Exception $e) {
                DB::rollback();
                // something went wrong
            }
            
             

        }
        else
        {
             return back()->with('error','Please fill all the data.');
        }
        

        

       // auth()->user()->update($request->only(['gender', 'biography']));

        //return redirect()->route('home');
    }
    public function setsahrefor(Request $request)
    {
        $share_for = $request->input('sfor');
        if($share_for>0)
        {
            session()->put('share_for', $share_for );
        }
    }

    function validateDuplicateLovedone(Request $request)
    {
        //dd($request);exit;
        $valid_filer = 1;

        $user_id = auth()->user()->id;
        $fnamae = trim($request->input('fname'));
        $lname = trim($request->input('lname'));
        $mobile = trim($request->input('mobile'));
        $country_code = trim($request->input('phone_code'));
        $exist_filer = UserFiler::where('user_id',$user_id)->where('status','!=','2')->where('first_name',$fnamae)
        ->where('last_name',$lname)
        ->where('mobile_no',$mobile)
        ->where('country_code',$country_code)->first();
        if($exist_filer)
        {
             $valid_filer = 0;
             $exist_filer_all = UserFiler::where('user_id',$user_id)->where('status','!=','2')->where('first_name',$fnamae)
            ->where('last_name',$lname)
            ->where('mobile_no',$mobile)
            ->where('country_code',$country_code)->get();
            $health_condition = array();
            
            foreach($exist_filer_all as $key=>$val)
            {
                if($val->id>0)
                {
                    $experience_dtls = FilerExperience::where('filer_id',$val->id)->first();
                    if(!empty($experience_dtls))
                    {
                        if($experience_dtls->hc_unknown==1)
                        {
                            $health_condition[] =  'Unknown';
                        }
                        else
                        {
                             if($experience_dtls->health_condition_id>0 )
                            {
                                 $health_condition[] =  $experience_dtls->gethealthcondition->title;
                            }
                        }
                    }
                    

                }
               
               
            }
           
            if(!empty($health_condition))
            {
                $health_condition = array_unique($health_condition);
                $health_condition_vals = array_values($health_condition);
                $health_condition_str = implode(",",$health_condition_vals);
                $msg = 'This Filer has experience of '.$health_condition_str;
                return json_encode(array('valid_filer'=>$valid_filer,'msg'=> $msg));
            }
            else
            {
                 $valid_filer = 1;
                $msg = 'valid filer details';
                return json_encode(array('valid_filer'=>$valid_filer,'msg'=> $msg));
            }
            
        }
        else
        {
             $valid_filer = 1;
            $msg = 'valid filer details';
            return json_encode(array('valid_filer'=>$valid_filer,'msg'=> $msg));
        }
    }

    public function validateCountrycode(Request $request)
     {
        $country_code =  $request->input('country_code');
        $country_id =  $request->input('country_id');
        $country_exist = Country::where('id',$country_id)->where('phonecode',$country_code)->first();
        if(!empty($country_exist))
        {
            return response()->json([
                            'statusCode'=>200,
                            'valid_country_code'=>1,
                            'msg'=>'Country code match found with selected country.'
                        ]);
        }
        else
        {
             return response()->json([
                            'statusCode'=>200,
                            'valid_country_code'=>0,
                            'msg'=>'Country code does not match with selected country.'
                        ]);
        }

     }


        
}