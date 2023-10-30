<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Settings;
use App\EmailSetting;
use App\Categorie;
use App\HomepageSetting;
use App\HomepageSettingCategory;
use App\CommissionSetting;

class SettingsController extends Controller
{
	function getGeneralSettings()
	{
		if (!AdminHelper::isView() && !AdminHelper::isUpdate() && !AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
		$data = [];
		$data['page_title'] = "General Settings";
		$data['row'] = Settings::find(1);
		//dd($data['row']);

		return view('admin.settings.general', $data);
	}

	function postSaveGeneralSettings(Request $request)
	{
		if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
		$request->validate([
			'site_title' => 'required|string|max:250',
			'logo' => 'mimes:jpeg,jpg,png,gif,svg|max:2000',
			'favicon' => 'mimes:jpeg,jpg,png,svg,ico|max:2000',
			'site_email' => 'email|max:255',
			'site_phone_number' => 'string|max:50',
			'site_address' => 'string|max:250',			
			'facebook_link' => 'url|max:250|max:250|nullable',
			'instagram_link' => 'url|max:250|max:250|nullable',
			'twitter_link' => 'url|max:250|max:250|nullable',
			'linkedin_link' => 'url|max:250|max:250|nullable',
			'app_link_android' => 'url|max:250|max:250|nullable',
			'app_link_ios' => 'url|max:250|max:250|nullable',
            'contact_email' => 'email|max:255',
            'contact_email_additional' => 'email|max:255',
            'contact_phone_number' => 'string|max:50',
            'contact_phone_number_additional'=>'string|max:50',
			//'youtube_link' => 'string|max:250',			
		]);

		$settings = Settings::find(1);
		$logo = '';
		$favicon = '';
		$created_by = AdminHelper::myId();
		$updated_by = AdminHelper::myId();
		$user_ip = $request->ip();
		$date = date('Y-m-d H:i:s');

		/*if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = 'logo-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/uploads/images/');
            $image->move($destinationPath, $name);
            $logo = 'storage/uploads/images/'.$name;
        }
*/
         
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = 'logo-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/site/logo/');
            $image->move($destinationPath, $name);
            $logo = 'uploads/site/logo/'.$name;
        }
         if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $name = 'favicon-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/site/favicon/');
            $image->move($destinationPath, $name);
            $favicon = 'uploads/site/favicon/'.$name;
        }

      /*  if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $name = 'favicon-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/uploads/images/');
            $image->move($destinationPath, $name);
            $favicon = 'storage/uploads/images/'.$name;
        }*/

		if(!empty($settings))
		{
			$settings->appname = $request->input('site_title');
			if(!empty($logo))
			{
				$settings->logo = $logo;	
			}
			if(!empty($favicon))
			{
				$settings->favicon = $favicon;
			}			
			$settings->site_email = $request->input('site_email');
			$settings->site_address = $request->input('site_address');
			$settings->map_link = $request->input('map_link');
			$settings->site_phone_number = $request->input('site_phone_number');
			$settings->facebook_link = $request->input('facebook_link');
			$settings->twitter_link = $request->input('twitter_link');
			$settings->instagram_link = $request->input('instagram_link');
			$settings->linkedin_link = $request->input('linkedin_link');
			//$settings->youtube_link = $request->input('youtube_link');			
			$settings->app_link_ios = $request->input('app_link_ios');			
			$settings->app_link_android = $request->input('app_link_android');	
            $settings->contact_email_additional = $request->input('contact_email_additional');	
            $settings->contact_phone_number = $request->input('contact_phone_number'); 	
            $settings->contact_phone_number_additional = $request->input('contact_phone_number_additional');
            $settings->contact_email = $request->input('contact_email');
			$settings->updated_by = $updated_by;
			$settings->updated_at = $date;
			$settings->save();
		}else{
			Settings::insert([
				'appname' => $request->input('site_title'),
				'logo' => $logo,
				'favicon' => $favicon,
				'site_email' => $request->input('site_email'),
				'site_address' => $request->input('site_address'),
				'map_link' => $request->input('map_link'),
				'site_phone_number' => $request->input('site_phone_number'),
				'site_about' => NULL,
				'facebook_link' => $request->input('facebook_link'),
				'twitter_link' => $request->input('twitter_link'),
				'instagram_link' => $request->input('instagram_link'),
				'linkedin_link' => $request->input('linkedin_link'),
                'contact_email'=>$request->input('contact_email'),
                'contact_email_additional'=>$request->input('contact_email_additional'),
                'contact_phone_number'=>$request->input('contact_phone_number'),
                'contact_phone_number_additional'=>$request->input('contact_phone_number_additional'),
				//'youtube_link' => $request->input('youtube_link'),				
				'maintenance_mode' => 0,
				'created_by' => $created_by,
				'user_ip' => $user_ip,
				'created_at' => $date
			]);
		}

		return redirect()->back()->withSuccess('Settings updated successfully!');
	}

	function getEmailSettings()
	{
		if (!AdminHelper::isView() && !AdminHelper::isUpdate() && !AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
		$data = [];
		$data['page_title'] = "Email Settings";
		$data['row'] = EmailSetting::find(1);

		return view('admin.settings.email', $data);
	}

	function postSaveEmailSettings(Request $request)
	{
		if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
		$request->validate([
			'email_sender' => 'required|email|max:250',			
			'mail_driver' => 'required|max:250',			
			'smtp_host' => 'required|max:250',			
			'smtp_port' => 'required|max:250',			
			'smtp_username' => 'required|max:250',			
			'smtp_password' => 'required|max:250',						
		]);

		$email_settings = EmailSetting::find(1);				
		$date = date('Y-m-d H:i:s');

		if(!empty($email_settings))
		{
			$email_settings->email_sender = $request->input('email_sender');
			$email_settings->mail_driver = $request->input('mail_driver');
			$email_settings->smtp_host = $request->input('smtp_host');
			$email_settings->smtp_port = $request->input('smtp_port');
			$email_settings->smtp_username = $request->input('smtp_username');
			$email_settings->smtp_password = $request->input('smtp_password');
			
			$email_settings->updated_at = $date;
			$email_settings->save();
		}else{
			EmailSetting::insert([
				'email_sender' => $request->input('email_sender'),								
				'mail_driver' => $request->input('mail_driver'),								
				'smtp_host' => $request->input('smtp_host'),								
				'smtp_port' => $request->input('smtp_port'),								
				'smtp_username' => $request->input('smtp_username'),								
				'smtp_password' => $request->input('smtp_password'),								
				'created_at' => $date
			]);
		}

		return redirect()->back()->withSuccess('Email settings updated successfully!');
	}

	function getHomeSettings()
    {
        if (!AdminHelper::isView() && !AdminHelper::isUpdate() && !AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = "Home Settings";
        $data['categories'] = Categorie::where('status', 1)->get();
        $data['row'] = HomepageSetting::first();
        //dd($data['row']);

        return view('admin.settings.home', $data);
    }

    function postSaveHomeSettings(Request $request)
    {
    	$request->validate([
    		'top_banner_add_image1' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'top_banner_add_image2' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'flash_sale_image' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'banner_add_content2_image1' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'banner_add_content2_image2' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'banner_add_content3_image1' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'banner_add_content3_image2' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable',
    		'category_list_image.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2000|nullable'
    	],[
    		'top_banner_add_image1.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'top_banner_add_image1.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'top_banner_add_image2.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'top_banner_add_image2.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'flash_sale_image.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'flash_sale_image.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'banner_add_content2_image1.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'banner_add_content2_image1.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'banner_add_content2_image2.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'banner_add_content2_image2.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'banner_add_content3_image1.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'banner_add_content3_image1.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'banner_add_content3_image2.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'banner_add_content3_image2.max' => 'Failed to upload an image. The image maximum size is 2MB.',
    		'category_list_image.*.mimes' => 'The type of the uploaded file should be an image. The image should be JPG/JPEG/PNG format only.',
    		'category_list_image.*.max' => 'Failed to upload an image. The image maximum size is 2MB.'
    	]);

    	//homepage_settings
    	$top_banner_add_image1_file='';
    	$top_banner_add_image2_file='';
    	$flash_sale_content_img='';
    	$banner_add_content2_image1_file='';
    	$banner_add_content2_image2_file='';
    	$banner_add_content3_image1_file='';
    	$banner_add_content3_image2_file='';
    	$category_list_image_file=[];

    	if ($request->hasFile('top_banner_add_image1')) {
            $top_banner_add_image1 = $request->file('top_banner_add_image1');        
            $name = time().rand().'.'.$top_banner_add_image1->getClientOriginalExtension();    
            $top_banner_add_image1->move(public_path('uploads/site/banner/'), $name);
            $top_banner_add_image1_file = 'uploads/site/banner/'.$name;
        }
        if ($request->hasFile('top_banner_add_image2')) {
            $top_banner_add_image2 = $request->file('top_banner_add_image2');        
            $name = time().rand().'.'.$top_banner_add_image2->getClientOriginalExtension();    
            $top_banner_add_image2->move(public_path('uploads/site/banner/'), $name);
            $top_banner_add_image2_file = 'uploads/site/banner/'.$name;
        }
        if ($request->hasFile('flash_sale_image')) {
            $flash_sale_image = $request->file('flash_sale_image');        
            $name = time().rand().'.'.$flash_sale_image->getClientOriginalExtension();    
            $flash_sale_image->move(public_path('uploads/site/banner/'), $name);
            $flash_sale_content_img = 'uploads/site/banner/'.$name;
        }
        if ($request->hasFile('banner_add_content2_image1')) {
            $banner_add_content2_image1 = $request->file('banner_add_content2_image1');        
            $name = time().rand().'.'.$banner_add_content2_image1->getClientOriginalExtension();    
            $banner_add_content2_image1->move(public_path('uploads/site/banner/'), $name);
            $banner_add_content2_image1_file = 'uploads/site/banner/'.$name;
        }
        if ($request->hasFile('banner_add_content2_image2')) {
            $banner_add_content2_image2 = $request->file('banner_add_content2_image2');        
            $name = time().rand().'.'.$banner_add_content2_image2->getClientOriginalExtension();    
            $banner_add_content2_image2->move(public_path('uploads/site/banner/'), $name);
            $banner_add_content2_image2_file = 'uploads/site/banner/'.$name;
        }
        if ($request->hasFile('banner_add_content3_image1')) {
            $banner_add_content3_image1 = $request->file('banner_add_content3_image1');        
            $name = time().rand().'.'.$banner_add_content3_image1->getClientOriginalExtension();    
            $banner_add_content3_image1->move(public_path('uploads/site/banner/'), $name);
            $banner_add_content3_image1_file = 'uploads/site/banner/'.$name;
        }
        if ($request->hasFile('banner_add_content3_image2')) {
            $banner_add_content3_image2 = $request->file('banner_add_content3_image2');        
            $name = time().rand().'.'.$banner_add_content3_image2->getClientOriginalExtension();    
            $banner_add_content3_image2->move(public_path('uploads/site/banner/'), $name);
            $banner_add_content3_image2_file = 'uploads/site/banner/'.$name;
        }
        
        $category_images = $request->file('category_list_image');
        $categories = $request->input('category');
        if(!empty($category_images) && !empty($categories))
        {
        	foreach($category_images as $img)
        	{
        		if(!empty($img))
        		{        			
		            $name = time().rand().'.'.$img->getClientOriginalExtension();    
		            $img->move(public_path('uploads/site/banner/'), $name);
		            $category_list_image_file[] = 'uploads/site/banner/'.$name;
        		}
        	}
        }
        
    	
    	if(!empty(HomepageSetting::first()))
    	{
    		// DB::table('homepage_settings')->where('id', $id)->update([
    		// 	'top_banner_add_image' => json_encode($top_banner_add_image),
    		// 	'updated_at' => date('Y-m-d H:i:s')
    		// ]);
    		$setting = HomepageSetting::find(HomepageSetting::first()->id);
    		if(!empty($top_banner_add_image1_file)){
    			$setting->top_banner_add_image1 = $top_banner_add_image1_file;	
    		}
    		if(!empty($top_banner_add_image2_file)){
    			$setting->top_banner_add_image2 = $top_banner_add_image2_file;	
    		}
    		$setting->top_banner_add_image1_url = $request->input('top_banner_add_image1_url');
    		$setting->top_banner_add_image2_url = $request->input('top_banner_add_image2_url');
    		$setting->top_banner_add_image_display = 1;

    		if(!empty($flash_sale_content_img)){
    			$setting->flash_sale_image = $flash_sale_content_img;	
    		}
    		$setting->flash_sale_url = $request->input('flash_sale_image_url');
    		$setting->flash_sale_date_time = ($request->input('flash_sale_time'))?date('Y-m-d H:i:s', strtotime($request->input('flash_sale_time'))):null;
    		$setting->flash_sale_display = 1;

    		if(!empty($banner_add_content2_image1_file)){
    			$setting->banner_add2_image1 = $banner_add_content2_image1_file;	
    		}
    		if(!empty($banner_add_content2_image2_file)){
    			$setting->banner_add2_image2 = $banner_add_content2_image2_file;	
    		}
    		$setting->banner_add2_image1_url = $request->input('banner_add_content2_image1_url');
    		$setting->banner_add2_image2_url = $request->input('banner_add_content2_image2_url');
    		$setting->banner_add2_display = 1;

    		if(!empty($banner_add_content3_image1_file)){
    			$setting->banner_add3_image1 = $banner_add_content3_image1_file;	
    		}
    		if(!empty($banner_add_content3_image2_file)){
    			$setting->banner_add3_image2 = $banner_add_content3_image2_file;	
    		}
    		$setting->banner_add3_image1_url = $request->input('banner_add_content3_image1_url');
    		$setting->banner_add3_image2_url = $request->input('banner_add_content3_image2_url');
    		$setting->banner_add3_display = 1;    		

    		$setting->updated_at = date('Y-m-d H:i:s');
    		$setting->save();
    	}else{    		
	    	
    		$id = HomepageSetting::insertGetId([
    			'top_banner_add_image1' => $top_banner_add_image1_file,
    			'top_banner_add_image2' => $top_banner_add_image2_file,
    			'top_banner_add_image1_url' => $request->input('top_banner_add_image1_url'),
    			'top_banner_add_image2_url' => $request->input('top_banner_add_image2_url'),
    			'top_banner_add_image_display' => 1,
    			'flash_sale_image' => $flash_sale_content_img,
    			'flash_sale_url' => $request->input('flash_sale_image_url'),
    			'flash_sale_date_time' => ($request->input('flash_sale_time'))?date('Y-m-d H:i:s', strtotime($request->input('flash_sale_time'))):null,
    			'flash_sale_display' => 1,
    			'banner_add2_image1' => $banner_add_content2_image1_file,
    			'banner_add2_image2' => $banner_add_content2_image2_file,
    			'banner_add2_image1_url' => $request->input('banner_add_content2_image1_url'),
    			'banner_add2_image2_url' => $request->input('banner_add_content2_image2_url'),
    			'banner_add2_display' => 1,
    			'banner_add3_image1' => $banner_add_content3_image1_file,
    			'banner_add3_image2' => $banner_add_content3_image2_file,
    			'banner_add3_image1_url' => $request->input('banner_add_content3_image1_url'),
    			'banner_add3_image2_url' => $request->input('banner_add_content3_image2_url'),
    			'banner_add3_display' => 1,
    			'created_at' => date('Y-m-d H:i:s')
    		]);

    		// if(!empty($categories))
    		// {
    		// 	foreach($categories as $key=>$category)
    		// 	{
    		// 		HomepageSettingCategory::insert([
    		// 			'homepage_settings_id' => $id,
    		// 			'category_image' => (!empty($category_list_image_file[$key]))?$category_list_image_file[$key]:null,
    		// 			'category_id' => $category,
    		// 			'created_at' => date('Y-m-d H:i:s')
    		// 		]);
    		// 	}
    		// }
    	}


    	return redirect()->back()->withSuccess('Homepage settings updated successfully!');
    }


    function commissionSettings()
    {
        if (!AdminHelper::isView() && !AdminHelper::isUpdate() && !AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = "Commission Settings";
        $data['row'] = CommissionSetting::find(1);
        //dd($data['row']);

        return view('admin.settings.commission', $data);
    }

    function postSaveCommissionSettings(Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request->validate([
            'commission_own_product' => 'required|numeric|max:100|min:0',
            'commission_imart_product' => 'required|numeric|max:100|min:0',
            
        ]);

        $settings = CommissionSetting::find(1);
    
        $created_by = AdminHelper::myId();
        $updated_by = AdminHelper::myId();
        $user_ip = $request->ip();
        $date = date('Y-m-d H:i:s');

        

        if(!empty($settings))
        {
            $settings->commission_own_product = $request->input('commission_own_product');
            $settings->commission_imart_product = $request->input('commission_imart_product');
            $settings->user_ip = $user_ip;
            $settings->updated_by = $updated_by;
            $settings->updated_at = $date;
            $settings->save();
        }else{
            Settings::insert([
                'commission_own_product' => $request->input('commission_own_product'),
                'commission_imart_product' => $request->input('commission_imart_product'),
                'created_by' => $created_by,
                'user_ip' => $user_ip,
                'created_at' => $date
            ]);
        }

        return redirect()->back()->withSuccess('Commission settings updated successfully!');
    }

}