<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\CmsPages;
use App\Settings;
use App\Country;
use Session;
use App\UserOtp;
use AdminHelper;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/login';
   protected $redirectTo = '/register-step2';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:30', 'min:2'],
                    'last_name' => ['nullable', 'string', 'max:30', 'min:2'],
                    'username' => ['required', 'string', 'max:16','min:5','unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'mobile_no' => ['required', 'string', 'max:15', 'unique:users'],
                    'phone_code'=>['required'],
                    'password' => ['required', 'string', 'min:8', 'max:16'],
                    'confirm_password' => ['required', 'string', 'min:8', 'max:16', 'same:password'],
                ]);

     
         
    }


    public function register(Request $request)
    {

        $msg = '';
        $email = $request->input('email');
        $otp = trim($request->input('otp'));
        $this->validator($request->all())->validate();
        $getOtp = UserOtp::where('status','1')->where('email',$email)->where('otp_from','register')->orderBy('id','DESC')->limit(1)->first();
        
        if($otp=='') {
            $msg= 'OTP not valid';
        }
        else {
            if($otp == $getOtp->otp) {
                
                UserOtp::where('status','1')->where('email',$email)->where('otp_from','register')->update([
                    'status'    =>  '0',
                    'updated_at'=>  date('Y-m-d H:i:s'),
                ]);
                
                
            } else {
                $msg= "OTP not match. Please try again.";
              
            }
        }
        if($msg!='')
        {
           return redirect()->back()->with('error', $msg);
        }

        DB::beginTransaction();
        try {
             event(new Registered($user = $this->create($request->all())));

            if($user){
                //session()->put('current_user_email', $request->input('email'));
                //return redirect()->back()->with('success', 'Thank you, Your registration has been completed, now you can login!');
                //Auth::loginUsingId($user->id);
                $config = [];
                $data = array(
                    'email'=>$email,
                    'firstname'=> $request->input('first_name')
                    );
                AdminHelper::sendEmail(['to' =>  $email, 'data' => $data, 'template' => 'user-registration']); 
                $this->guard()->login($user);
                DB::commit();
                session()->put('is_logged_in', '');
                 return redirect('/sharing-experience-for')->with('success', 'Thank you, Your have registerd successfully.');
                //$this->guard()->login($user);
                //
            }


        }
         catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

       
        
        
        /*return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());*/

        //return redirect('/login')->with('success', 'Thank you, Your registration has been completed, now you can login!');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
           'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'country'=>$data['country'],
            'country_code'=>$data['phone_code'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
            'is_email_varified' => 1,
            'username'=>$data['username'],
        ]);
       


        
    }

    public function showRegistrationForm()
    {
        $data = [];

        $data['setting'] = Settings::Where('id','1')->first();
        $all_pages = CmsPages::where('status',1)->get();
        $data['countries'] = Country::distinct()->orderBy('phonecode','ASC')->pluck('phonecode');
        $data['countries_list'] =  Country::distinct()->orderBy('phonecode','ASC')->get();
        //dd($data['countries']);
        $data['active_pages'] = array();
        foreach($all_pages as $key=>$val)
        {
            $data['active_pages'][] = $val->page_slug;
        }
       return view('auth.register')->with($data);
    }
     public function validateDuplicateEmail(Request $request)
     {
        $email =  $request->input('email');
        $user_exist = User::where('email',$email)->first();
        if(!empty($user_exist))
        {
            return response()->json([
                            'statusCode'=>200,
                            'is_duplicate'=>1,
                            'msg'=>'This email adderss already taken.'
                        ]);
        }
        else
        {
             return response()->json([
                            'statusCode'=>200,
                            'is_duplicate'=>0,
                            'msg'=>'Email adderss is unique'
                        ]);
        }

     }
     public function validateDuplicateUsername(Request $request)
     {
        $username =  $request->input('username');
        $user_exist = User::where('username',$username)->first();
         if(!empty($user_exist))
        {
            return response()->json([
                            'statusCode'=>200,
                            'is_duplicate'=>1,
                            'msg'=>'This username already taken.'
                        ]);
        }
        else
        {
             return response()->json([
                            'statusCode'=>200,
                            'is_duplicate'=>0,
                            'msg'=>'Username is unique'
                        ]);
        }

     }
     public function validateDuplicateMobile(Request $request)
     {
        $mobile_no =  $request->input('mobile_no');
        $user_exist = User::where('mobile_no',$mobile_no)->first();
         if(!empty($user_exist))
        {
            return response()->json([
                            'statusCode'=>200,
                            'is_duplicate'=>1,
                            'msg'=>'This mobile number already taken.'
                        ]);
        }
        else
        {
             return response()->json([
                            'statusCode'=>200,
                            'is_duplicate'=>0,
                            'msg'=>'Mobile number is unique'
                        ]);
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
