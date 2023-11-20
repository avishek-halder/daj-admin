<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\State;



class ManageState extends Controller
{
    function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage State';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        //dd($limit);
        $q = $request->get('q');
        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');

         if($filter_clumn!='')
        {
            $data['rows'] = State::whereIn('country_id',[38,231])->when($q, function($query) use ($q){                           
                            $query->whereRaw("( `name` like '%".$q."%')")
                            ->whereIn('country_id',[38,231]);
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = State::whereIn('country_id',[38,231])->when($q, function($query) use ($q){                           
                            $query->whereRaw("( `name` like '%".$q."%')")
                            ->whereIn('country_id',[38,231]);
                        })->latest()->paginate($limit);
        }
        
        //dd($data['rows']); 
           
        return view('admin.state.index', $data);
    }

    function addManage()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Add State';
        $data['country'] = DB::table('countries')->whereIn('id',[38,231])->get();
       return view('admin.state.add', $data);
    }

    function getStateByCountry(Request $request)
    {
       $country_id =  $request->input('country_id');
       $states = State::where('country_id',$country_id)->get();
       $node = '<option value="">State</option>';
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
       $node = '<option value="">City</option>';
       foreach ($cities as $key => $value) {
           # code...
         $node  =  $node .'<option value="'.$value->id.'">'.$value->name.'</option>';
       }
       echo $node;exit;
    }

    

    function postAddSave(Request $request)
    {
      
        $request->validate([
            'name' => 'required|max:30|min:2|regex:/^[\pL\s]+$/u|unique:states,name',                             
            'country_id' => 'required|numeric',                        
            'status' => 'required|numeric'
        ]);
    



        State::insert([
            'name' => $request->input('name'),            
            'country_id' => $request->input('country_id'),                        
            'status' => $request->input('status'),            
            //'created_by' => AdminHelper::myId(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath('admin').'/banner');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('State added successfully!');
        }else{
            return redirect()->back()->withSuccess('State added successfully!');
        }
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Edit State';
        $data['row'] = State::find($id);
        $data['country'] = DB::table('countries')->whereIn('id',[38,231])->get();        
        return view('admin.state.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
      
      $request->validate([
            'name' => 'required|max:30|min:2|regex:/^[\pL\s]+$/u|unique:states,name,'.$id,                            
            'country_id' => 'required|numeric',                        
            'status' => 'required|numeric'
        ]);
 
        
        $data = State::find($id);

        $data->name = $request->input('name');
        $data->country_id = $request->input('country_id');            
        $data->status = $request->input('status');
       
        $data->updated_at = date('Y-m-d H:i:s');
       // $data->updated_by = AdminHelper::myId();
        $data->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath('admin').'/categories');
        return redirect($return_url)->withSuccess('State updated successfully!');
    }
     function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Details State';
        $data['row'] = State::find($id);
        $data['country'] = DB::table('countries')->where('id',$data['row']->country_id)->first(); 
        return view('admin.state.detail', $data);
    }

    function deleteManageState($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        /*if(!empty($id))
        {
            $data = Homeopath::find($id);
            $data->is_delete = 1;
            $data->save();
            return redirect()->back()->withSuccess('Homeopath deleted successfully!');
        }*/
      if(!empty($id))
        {
            $categorie_dtls = State::where('id',$id)->first();
            if(!empty($categorie_dtls))
            {
                $categorie_dtls->delete();
                return redirect()->back()->withSuccess('State deleted successfully!');
            }
            else
            {
                return redirect()->back()->withError('Sorry!! some error occured.');
            }
            

            
        }
    }

    public function postActionSelected(Request $request)
    {        
        

        


        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        /*if ($button_name == 'delete') {  
            Homeopath::whereIn('id', $id_selected)->update(['is_delete' => 1]);;

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        } */ 

        if($button_name == 'active')      
        {
            State::whereIn('id', $id_selected)->update(['status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            State::whereIn('id', $id_selected)->update(['status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
    public function exportcsv_homeopath()
    {
        $delimiter = ","; 
        $filename = "homeopaths_" . date('Y-m-d') . ".csv"; 
     
        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 
         // Set column headers 
        $fields = array('First Name', 'Last Name', 'Email', 'Contact No.', 'Country', 'State', 'City', 'PIN Code', 'Status'); 
        fputcsv($f, $fields, $delimiter); 
        $homeopaths = Homeopath::where('is_delete',0)->where('approved',1)->where('is_temp',0)->get();
         // Output each row of the data, format line as csv and write to file pointer 
    foreach ($homeopaths as $key=>$homeopath) {

            $status = ($homeopath->status == 1)?'Active':'Inactive'; 
            $row['First Name']  = $homeopath->firstname;
            $row['Last Name']    = $homeopath->lastname;
            $row['Email']    = $homeopath->email;
            $row['Contact No']  = $homeopath->contact_no;
            $row['Country']  = $homeopath->getcountry->name;
            $row['State']  =  $homeopath->getstate->name;
            $row['City']  = ($homeopath->city_id>0)?$homeopath->getcity->name:'';
           
            
            $row['PIN Code']  = $homeopath->pin_code;
            $row['Status']  = $status;
            $lineData = array($row['First Name'], $row['Last Name'], $row['Email'], $row['Contact No'], $row['Country'], $row['State'], $row['City'], $row['PIN Code'], $row['Status']); 
            fputcsv($f, $lineData, $delimiter); 
        } 

        // Move back to beginning of file 
        fseek($f, 0); 
         
        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";'); 
         
        //output all remaining data on a file pointer 
        fpassthru($f); 
        exit;

    }
}