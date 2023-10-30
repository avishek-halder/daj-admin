<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use App\Category;
use App\AdminUser;

class ManageCategory extends Controller
{
	function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$request = request();
        $data = [];
        $data['page_title'] = 'Manage Categorys';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        //dd($limit);
        $q = $request->get('q');
        $filter_clumn = ($request->get('filter_column'))?$request->get('filter_column'):'created_at';
        $sorting = ($request->get('sorting'))?$request->get('sorting'):'desc';

        $data['rows'] = Category::when($q, function($query) use ($q){                           
                            $query->whereRaw("( `title` like '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);
        
        //dd($data['rows']); 
           
        return view('admin.category.index', $data);
    }

    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Add Category';        
       
        return view('admin.category.add', $data);
    }


    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $s_id = $request->input('seller_id');
        $request->validate([
            'name' => 'required|max:50|min:2|unique:categories,title|string',
            'status' => 'required|numeric'
        ]);
    
        $isdata = Category::where('title' ,$request->input('name'))->get();
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Category Already Exists!'); 
        }

        Category::insert([
            'title' => $request->input('name'),            
            'status' => $request->input('status'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getCategoryIndex'));
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Category added successfully!');
        }else{
            return redirect()->back()->withSuccess('Category added successfully!');
        }
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Edit Category';
        $data['row'] = Category::find($id);        

        return view('admin.category.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
      if (!AdminHelper::isUpdate()) {
        return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
      }
      $request->validate([
            'name' => 'required|max:50|min:2|unique:categories,title,'.$id.'|string',
            'status' => 'required|numeric'
        ]);
 
        $isdata = Category::where('title' ,$request->input('name'))->where('id','!=',$id)->get();
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Category Already Exists!'); 
        }
        $category = Category::find($id);

        $category->title = $request->input('name');        
        $category->status = $request->input('status');
        $category->updated_at = date('Y-m-d H:i:s');       
        $category->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getCategoryIndex'));
        return redirect($return_url)->withSuccess('Category updated successfully!');
    }

    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Category Details';
        $data['row'] = Category::find($id);
        //$data['sellers'] = DB::table('admin_users')->where('id',$data['row']->seller_id)->first();

        return view('admin.category.detail', $data);
    }

    function deleteCategory($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        if(!empty($id))
        {
            Category::where('id',$id)->delete();
            return redirect()->back()->withSuccess('Category deleted successfully!');
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
            Category::whereIn('id', $id_selected)->update(['status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Category::whereIn('id', $id_selected)->update(['status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'delete')      
        {
            Category::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data deleted successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}