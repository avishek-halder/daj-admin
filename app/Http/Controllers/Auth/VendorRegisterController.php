<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VendorRegisterController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = 'Vendor Registration';
        $data['meta_description'] = 'Vendor Registration';
        $data['meta_keyword'] = 'Kudra,Home,Account';

        //$user_id = Auth::user()->id;
        //$data['user'] = User::Where('id',$user_id)->first();

        return view('auth.vendorragister')->with($data);
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_types' => ['required'],
            'vendor_category' => ['required'],
            'display_name' => ['required', 'string', 'max:255', 'unique:users'],
            'mobile_no' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:password'],

            /*'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'user_types' => 'required',
            'vendor_category' => 'required',
            'display_name' => 'required|string|max:20|unique:users',
            'mobile_no' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password|min:8',*/

        ]);
    }

    /**
     * Create a new vendor instance after a valid registration.
     *
     * @param  array  $request
     * @return \App\User
     */
    public function register(Request $request)
    {
        $data = array();

        //dd($request->all());
        
        $ValResult = $this->validator($request->all());

        $ValErrors = $ValResult->messages();
        if($ValResult->fails()){
            return redirect('/vendorregister')
                ->withErrors($ValResult)
                ->withInput($request->all());
        }

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'mobile_no' => $request->input('mobile_no'),
            'vendor_category' => $request->input('vendor_category'),
            'display_name' => $request->input('display_name'),
            'is_whatsapp' => ($request->input('is_whatsapp') ? 1 : 0),
            'user_types' => $request->input('user_types'),
            'is_mobile_varified' => 1,
            'password' => Hash::make($request->input('password')),
        ]);

        if($user){
            return redirect('/login')->with('success', 'Thank you, Your registration has been completed, now you can login!');
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    /*protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'user_types' => $data['user_types'],
            'password' => Hash::make($data['password']),
        ]);

        if($user){
            return redirect()->back()->with('success', 'Thank you, Your registration has been completed, now you can login!');
        }
    }*/
}
