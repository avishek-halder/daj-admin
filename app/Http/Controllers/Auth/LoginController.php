<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\CmsPages;
use App\Settings;
use App\Country;
use Session;
use App\UserOtp;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function login(Request $request)
    {
        //dd($request);
        if($request->input('otp_login')=='Y')
        {
             $request->validate([
            'email' => 'required|email'
            
            ]);
             $email = trim($request->input('email'));
            $user_dtls = User::where('email',trim($request->input('email')))->first();
            if(!empty($user_dtls))
            {
                if($user_dtls->status==0)
                {
                      return back()->with('error','Your account is not active.');
                }
                else
                {
                    $otp = trim($request->input('otp'));
                    $getOtp = UserOtp::where('status','1')->where('email',$email)->where('otp_from','login')->orderBy('id','DESC')->limit(1)->first();
                    if($otp=='') {
                        return back()->with('error','OTP is not valid.');
                        } else {

                            if(!empty($getOtp))
                            {
                                if($otp == $getOtp->otp) {
                                
                              UserOtp::where('status','1')->where('email',$email)->where('otp_from','login')->update([
                                    'status'    =>  '0',
                                    'updated_at'=>  date('Y-m-d H:i:s'),
                                ]);
                                $this->guard()->login($user_dtls);
                                session()->put('is_logged_in', 1);
                                return redirect('/dashboard');
                                
                                
                                } else {
                                   
                                    return back()->with('error','OTP not match. Please try again.');
                                }

                            }
                            else
                            {
                                 
                                 return back()->with('error','Invalid OTP. Please try again.');
                            }
                            
                        }

                }

            }
            else
            {
                 return back()->with('error','Invalid email id. Please try another email adress.');
            }
        }
        else
        {

             $request->validate([
            'email_id' => 'required',
            'password' => 'required',
            ]);



            $user_dtls = User::where('email',trim($request->input('email_id')))->first();
            if(!empty($user_dtls))
            {
                 if($user_dtls->status==0)
                {
                      return back()->with('error','Your account is not active.');
                }
                else
                {
                    $remember_me = $request->has('remember_me') ? true : false;
                    //$credentials = $request->only('email_id', 'password');
                    $credentials['email'] = $user_dtls->email;
                    $credentials['password'] =$request->input('password');
                    if (Auth::attempt($credentials,$remember_me)) {
                        session()->put('is_logged_in', 1);
                        return redirect('/dashboard');
                    }
                    else
                    {
                         return back()->with('error','Invalid credential. Please try another credential.');
                    }
                }
            }
            else
            {

                $user_dtls_username = User::where('username',trim($request->input('email_id')))->first();

                if(!empty($user_dtls_username))
                {

                    if($user_dtls_username->status==0)
                    {
                          return back()->with('error','Your account is not active.');
                    }
                    else
                    {

                        $remember_me = $request->has('remember_me') ? true : false;
                        $credentials['email'] = $user_dtls_username->email;
                        $credentials['password'] =$request->input('password');
                        //$credentials = $request->only('email', 'password');
                       
                        if (Auth::attempt($credentials,$remember_me)) {
                  
                            return redirect('/dashboard');
                        }
                        else
                        {
                             return back()->with('error','Invalid credential. Please try another credential.');
                        }
                    }

                }
                else
                {
                    return back()->with('error','Invalid email address or username. Please try another credential.');
                }
                

            }

        }
       
        
       
        
        //return back()->with('error','Your email and password are wrong.');

        //return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    public function showLoginForm()
    {
        return view('welcome');
        $data = [];

        $data['setting'] = Settings::Where('id','1')->first();
        $all_pages = CmsPages::where('status',1)->get();
        $data['countries'] = Country::distinct()->orderBy('phonecode','ASC')->pluck('phonecode');
        //dd($data['countries']);
        $data['active_pages'] = array();
        foreach($all_pages as $key=>$val)
        {
            $data['active_pages'][] = $val->page_slug;
        }
        return view('auth.login')->with($data);
    }
   
}
