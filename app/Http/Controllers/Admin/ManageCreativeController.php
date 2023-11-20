<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManageCreativeController extends Controller
{
	function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$request = request();
        $data = [];
        $data['page_title'] = 'Manage Creatives';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        //dd($limit);
        $q = $request->get('q');
        $filter_clumn = ($request->get('filter_column'))?$request->get('filter_column'):'created_at';
        $sorting = ($request->get('sorting'))?$request->get('sorting'):'desc';

        $data['rows'] = User::when($q, function($query) use ($q){                           
                            $query->whereRaw("( `fname` like '%".$q."%' or `lname` like '%".$q."%' or `uname` like '%".$q."%' or `email` like '%".$q."%' or `phone_number` like '%".$q."%')");
                        })->where('user_type', 2)->orderBy($filter_clumn,$sorting)->paginate($limit);        
           
        return view('admin.creative.index', $data);
    }

    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Add Creatives';        
       
        return view('admin.creative.add', $data);
    }


    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        
        $request->validate([
            'first_name' => 'required|alpha|max:150|min:2',
            'last_name' => 'required|alpha_spaces|max:150|min:2',
            'username' => 'required|string|max:150|min:2|unique:users,uname',
            'email' => 'required|string|email|max:255|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'phone_number' => 'required|digits_between:6,11',
            'password' => 'required|string|min:6|max:16',
            'status' => 'required|numeric'
        ]);        

        User::insert([
            'fname' => $request->input('first_name'),
            'lname' => $request->input('last_name'),
            'uname' => $request->input('username'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
            'status' => $request->input('status'),
            'user_type' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getUserIndex'));
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Creatives added successfully!');
        }else{
            return redirect()->back()->withSuccess('Creatives added successfully!');
        }
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Edit Creatives';
        $data['row'] = User::find($id);        

        return view('admin.creative.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
      if (!AdminHelper::isUpdate()) {
        return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
      }
        $request->validate([
            'first_name' => 'required|alpha|max:150|min:2',
            'last_name' => 'required|alpha_spaces|max:150|min:2',
            'username' => 'required|string|max:150|min:2|unique:users,uname,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id.'|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'phone_number' => 'required|digits_between:6,11',
            'password' => 'string|min:6|max:16|nullable',
            'status' => 'required|numeric'
        ]);   
        
        $user = User::find($id);

        $user->fname = $request->input('first_name');
        $user->lname = $request->input('last_name');
        $user->uname = $request->input('username');
        $user->phone_number = $request->input('phone_number');
        if(!empty($request->input('password')))
        {
            $user->password = Hash::make($request->input('password'));
        }
        $user->status = $request->input('status');
        $user->updated_at = date('Y-m-d H:i:s');       
        $user->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getUserIndex'));
        return redirect($return_url)->withSuccess('Creatives updated successfully!');
    }

    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'User Details';
        $data['row'] = User::find($id);
        //$data['sellers'] = DB::table('admin_users')->where('id',$data['row']->seller_id)->first();

        return view('admin.creative.detail', $data);
    }

    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        if(!empty($id))
        {
            User::where('id',$id)->delete();
            return redirect()->back()->withSuccess('Creatives deleted successfully!');
        }
    }

    public function postActionSelected(Request $request)
    {        
        
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        
        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        if($button_name == 'active')      
        {
            User::whereIn('id', $id_selected)->update(['status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            User::whereIn('id', $id_selected)->update(['status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'delete')      
        {
            User::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data deleted successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}