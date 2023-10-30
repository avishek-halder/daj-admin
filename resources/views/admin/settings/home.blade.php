@extends('admin::layouts.admin_template')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> {{ $page_title }}
            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="{{ route('postSaveHomeSettings') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                             <fieldset>
                                 <legend>Advertisement Section 1</legend>                                 
                                 <div class="row">                 
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image 1</label>
                                            @if(!empty($row->top_banner_add_image1) && (Storage::exists($row->top_banner_add_image1) || file_exists(public_path($row->top_banner_add_image1))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->top_banner_add_image1) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->top_banner_add_image1}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->top_banner_add_image1}}&&id={{$row->id}}&&column=top_banner_add_image1&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="top_banner_add_image1" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('top_banner_add_image1')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                             
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image 1 URL</label>
                                            <input type="text" name="top_banner_add_image1_url" class="form-control" value="{{ (old('top_banner_add_image1_url'))?old('top_banner_add_image1_url'):((!empty($row->top_banner_add_image1_url))?$row->top_banner_add_image1_url:'') }}">
                                            @error('top_banner_add_image1_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image 2</label>
                                            @if(!empty($row->top_banner_add_image2) && (Storage::exists($row->top_banner_add_image2) || file_exists(public_path($row->top_banner_add_image2))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->top_banner_add_image2) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->top_banner_add_image2}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->top_banner_add_image2}}&&id={{$row->id}}&&column=top_banner_add_image2&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="top_banner_add_image2" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('top_banner_add_image2')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                                
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image 2 URL</label>
                                            <input type="text" name="top_banner_add_image2_url" class="form-control" value="{{ (old('top_banner_add_image2_url'))?old('top_banner_add_image2_url'):((!empty($row->top_banner_add_image2_url))?$row->top_banner_add_image2_url:'') }}">
                                            @error('top_banner_add_image2_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                             </fieldset>
                        </div>
                        <div class="row">                 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <fieldset>
                                         <legend>Advertisement Section 2</legend>
                                         <div class="form-group mb-3">
                                            <label>Image</label>
                                            @if(!empty($row->banner_add_content_img) && (Storage::exists($row->banner_add_content_img) || file_exists(public_path($row->banner_add_content_img))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->banner_add_content_img) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->banner_add_content_img}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->banner_add_content_img}}&&id={{$row->id}}&&column=banner_add_content_img&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="banner_add_content_img" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('banner_add_content_img')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                                
                                        </div>
                                     </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                             <fieldset>
                                 <legend>Flash Sale</legend>
                                 <div class="row">                 
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Image</label>
                                            @if(!empty($row->flash_sale_image) && (Storage::exists($row->flash_sale_image) || file_exists(public_path($row->flash_sale_image))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->flash_sale_image) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->flash_sale_image}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->flash_sale_image}}&&id={{$row->id}}&&column=flash_sale_image&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="flash_sale_image" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('flash_sale_image')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                                
                                        </div>                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Image URL</label>
                                            <input type="text" name="flash_sale_image_url" class="form-control" value="{{ (old('flash_sale_image_url'))?old('flash_sale_image_url'):((!empty($row->flash_sale_url))?$row->flash_sale_url:'') }}">
                                            @error('flash_sale_image_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Date & Time</label>
                                            <input type="datetime-local" name="flash_sale_time" class="form-control" value="{{ (old('flash_sale_time'))?old('flash_sale_time'):((!empty($row->flash_sale_date_time))?$row->flash_sale_date_time:'') }}">
                                            @error('flash_sale_time')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                             </fieldset>
                        </div>

                        <div class="form-group">
                             <fieldset>
                                 <legend>Advertisement Section 3</legend>
                                 <div class="row">                 
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image 1</label>
                                            @if(!empty($row->banner_add2_image1) && (Storage::exists($row->banner_add2_image1) || file_exists(public_path($row->banner_add2_image1))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->banner_add2_image1) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->banner_add2_image1}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->banner_add2_image1}}&&id={{$row->id}}&&column=banner_add2_image1&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="banner_add_content2_image1" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('banner_add_content2_image1')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                             
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image 1 URL</label>
                                            <input type="text" name="banner_add_content2_image1_url" class="form-control" value="{{ (old('banner_add_content2_image1_url'))?old('banner_add_content2_image1_url'):((!empty($row->banner_add2_image1_url))?$row->banner_add2_image1_url:'') }}">
                                            @error('banner_add_content2_image1_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image 2</label>
                                            @if(!empty($row->banner_add2_image2) && (Storage::exists($row->banner_add2_image2) || file_exists(public_path($row->banner_add2_image2))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->banner_add2_image2) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->banner_add2_image2}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->banner_add2_image2}}&&id={{$row->id}}&&column=banner_add2_image2&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="banner_add_content2_image2" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('banner_add_content2_image2')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                            
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image 2 URL</label>
                                            <input type="text" name="banner_add_content2_image2_url" class="form-control" value="{{ (old('banner_add_content2_image2_url'))?old('banner_add_content2_image2_url'):((!empty($row->banner_add2_image2_url))?$row->banner_add2_image2_url:'') }}">
                                            @error('banner_add_content2_image2_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                             </fieldset>
                        </div>

                        <div class="form-group">
                             <fieldset>
                                 <legend>Advertisement Section 4</legend>
                                 <div class="row">                 
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image 1</label>
                                            @if(!empty($row->banner_add3_image1) && (Storage::exists($row->banner_add3_image1) || file_exists(public_path($row->banner_add3_image1))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->banner_add3_image1) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->banner_add3_image1}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->banner_add3_image1}}&&id={{$row->id}}&&column=banner_add3_image1&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="banner_add_content3_image1" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('banner_add_content3_image1')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                               
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image 1 URL</label>
                                            <input type="text" name="banner_add_content3_image1_url" class="form-control" value="{{ (old('banner_add_content3_image1_url'))?old('banner_add_content3_image1_url'):((!empty($row->banner_add3_image1_url))?$row->banner_add3_image1_url:'') }}">
                                            @error('banner_add_content3_image1_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image 2</label>
                                            @if(!empty($row->banner_add3_image2) && (Storage::exists($row->banner_add3_image2) || file_exists(public_path($row->banner_add3_image2))))
                                            <div class="prev-img-thumb"><img src="{{ asset($row->banner_add3_image2) }}"></div>
                                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->banner_add3_image2}}"><i class="fa fa-download"></i> Download </a>
                                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->banner_add3_image2}}&&id={{$row->id}}&&column=banner_add3_image2&table=homepage_settings"><i class="fa fa-ban"></i> Delete </a></p>
                                            @else
                                            <input type="file" name="banner_add_content3_image2" accept="image/*" class="form-control">
                                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                                            @error('banner_add_content3_image2')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror       
                                            @endif                                            
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image 2 URL</label>
                                            <input type="text" name="banner_add_content3_image2_url" class="form-control" value="{{ (old('banner_add_content3_image2_url'))?old('banner_add_content3_image2_url'):((!empty($row->banner_add3_image2_url))?$row->banner_add3_image2_url:'') }}">
                                            @error('banner_add_content3_image2_url')
                                                <div class="text-danger mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                             </fieldset>
                        </div>
                        
                        <div class="form-group">
                             <fieldset>
                                 <legend>Category List</legend>
                                 <div id="categoryList_0">
                                     <div class="row">                 
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Image</label>
                                                <input type="file" name="category_list_image[0]" accept="image/*" class="form-control">
                                                <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div> 
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Category</label>
                                                <select name="category_list[cat_id][0]" class="form-control category_list">
                                                    <option value="">Select Category</option>
                                                    @if(!empty($categories))
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Products</label>
                                                <select name="category_list[products][0][]" class="form-control product_list" multiple>
                                                    <option value="" disabled>Select Products</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3 text-end">
                                            <button type="button" class="btn btn-primary btn-sm addMorebtn"><i class="fa fa-plus"></i> Add More Category</button>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="appendMore">
                                    @php $last_id=0; @endphp
                                    @if(!empty($category_lists) && count($category_lists))
                                    @foreach($category_lists as $cat_list)
                                    <?php 
                                    $last_id=$cat_list->id;
                                    $cat_items = [];
                                    $cat_items = $cat_list->getCatItems()->pluck('product_id')->toArray();
                                    if($cat_list->category_id)
                                    {            
                                        $product_ids = \App\ProductCategory::where('category_id', $cat_list->category_id)->pluck('product_id')->toArray();
                                        $cat_products = \App\Product::select('id','name')->when($product_ids, function($query) use ($product_ids){
                                                        $query->whereIn('products.id', $product_ids);
                                                    })->where('status', 1)->get();
                                    }
                                    ?>
                                    <div id="categoryList_{{$cat_list->id}}">
                                        <div class="row">
                                            <div class="col-md-4"> 
                                                <div class="form-group mb-3"> 
                                                    <label>Image</label> 
                                                    @if(!empty($cat_list->category_image) && (Storage::exists($cat_list->category_image) || file_exists(public_path($cat_list->category_image))))
                                                    <input type="hidden" name="category_list_image_old[{{$cat_list->id}}]" value="{{$cat_list->category_image}}">
                                                    <div class="prev-img-thumb"><img src="{{ asset($cat_list->category_image) }}"></div>
                                                    <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                                                    <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$cat_list->category_image}}"><i class="fa fa-download"></i> Download </a>
                                                    <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$cat_list->category_image}}&&id={{$cat_list->id}}&&column=category_image&table=homepage_setting_category_list"><i class="fa fa-ban"></i> Delete </a></p>
                                                    @else
                                                    <input type="file" name="category_list_image[{{$cat_list->id}}]" accept="image/*" class="form-control"> 
                                                    <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div> 
                                                    @endif
                                                </div> 
                                            </div> 
                                            <div class="col-md-4"> 
                                                <div class="form-group mb-3"> 
                                                    <label>Category</label> 
                                                    <select name="category_list[cat_id][{{$cat_list->id}}]" class="form-control category_list"> 
                                                        <option value="">Select Category</option> 
                                                        @if(!empty($categories)) 
                                                        @foreach($categories as $category) 
                                                        <option value="{{ $category->id }}" {{ ($cat_list->category_id==$category->id)?'selected':'' }}>{{ $category->name }}</option> 
                                                        @endforeach 
                                                        @endif 
                                                        </select> 
                                                </div>
                                            </div>                                             
                                            <div class="col-md-4"> 
                                                <div class="form-group mb-3"> 
                                                    <label>Products</label> 
                                                    <select name="category_list[products][{{$cat_list->id}}][]" class="form-control product_list" multiple> 
                                                        <option value="" disabled>Select Products</option> 
                                                        @if(!empty($cat_products))
                                                        @foreach($cat_products as $cat_p)
                                                        <option value="{{$cat_p->id}}" {{ (!empty($cat_items) && in_array($cat_p->id, $cat_items))?'selected':'' }}>{{$cat_p->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select> 
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-3 text-end">
                                                <button type="button" class="btn btn-danger btn-sm addMorebtn" onclick="removeDiv('{{$cat_list->id}}')"><i class="fa fa-times"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <input type="hidden" id="categoryListId" value="{{$last_id}}">
                             </fieldset>
                        </div>                        

                        <!-- <div class="form-group">
                             <fieldset>
                                 <legend>Category List 2</legend>
                                 <div class="row">                 
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image</label>
                                            <input type="file" name="category_list_image[]" accept="image/*" class="form-control">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Category</label>
                                            <select name="category[]" class="form-control">
                                                <option value="">Select Category</option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                             </fieldset>
                        </div>

                        <div class="form-group">
                             <fieldset>
                                 <legend>Category List 3</legend>
                                 <div class="row">                 
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Image</label>
                                            <input type="file" name="category_list_image[]" accept="image/*" class="form-control">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Category</label>
                                            <select name="category[]" class="form-control">
                                                <option value="">Select Category</option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                             </fieldset>
                        </div> -->
                         
                    </div><!-- /.box-body -->
                    <div class="card-footer">
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div><!-- /.box-footer-->
                </form>
            </div>
        </div>
	</div>
</div>
@endsection
@push('bottom')
<!-- <script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $("select.product_list").select2();
      /*$('#description').summernote({
        height: 300,
        placeholder: 'Type here...'
      });*/

      // CKEDITOR.replace('description',{
      //   allowedContent : true,
      // });

      /*ClassicEditor
        .create( document.querySelector( '#description' ) )
    .catch( error => {
        console.error( error );
    } );*/
        var id = $("#categoryListId").val();
        $(".addMorebtn").on('click', function(){   
            id = parseInt(id)+1;     
            var data = '<div class="col-md-4"> <div class="form-group mb-3"> <label>Image</label> <input type="file" name="category_list_image['+id+']" accept="image/*" class="form-control"><div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  </div> </div> <div class="col-md-4"> <div class="form-group mb-3"> <label>Category</label> <select name="category_list[cat_id]['+id+']" class="form-control category_list"> <option value="">Select Category</option> @if(!empty($categories)) @foreach($categories as $category) <option value="{{ $category->id }}">{{ $category->name }}</option> @endforeach @endif </select> </div> </div> <div class="col-md-4"> <div class="form-group mb-3"> <label>Products</label> <select name="category_list[products]['+id+'][]" class="form-control product_list" multiple> <option value="" disabled>Select Products</option> </select> </div> </div>';            
            var appendHtml = '<div id="categoryList_'+id+'"><div class="row">'+data+'</div><div class="row"><div class="col-12 mb-3 text-end"><button type="button" class="btn btn-danger btn-sm addMorebtn" onclick="removeDiv('+id+')"><i class="fa fa-times"></i> Remove</button></div></div></div>';
            $(".appendMore").append(appendHtml);
            $("#categoryList_"+id).find('select.product_list').html('<option value="" disabled>Select Products</option>');
            $("select.product_list").select2();
        });    

    });

    $(document).on('change', '.category_list', function(){        
        var parent = $(this).parents().eq(3).attr('id');        
        getProducts($(this).val(), parent);
    });

    function getProducts(cat_id, parent){
        console.log(parent);
        if(cat_id !=""){
            $.ajax({
                url : "{{ url('ajax/get-products-by-category') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "get",   
                data: {cat_id:cat_id},  
                dataType: 'json',
                success: function(response)
                {                    
                  var options = []; 
                  options.push('<option value="" disabled>Select Products</option>');        
                    $.each(response.data, function(i, item) {        
                     let selected = '';   
                     var newOption = '<option value="' + item.id + '">' + item.name + '</option>';
                     options.push(newOption);
                   });                    
                   $("#"+parent).find('select.product_list').html(options);
                   $("#"+parent).find('select.product_list').select2();
                }        
            });

        }
    }

    function removeDiv(id)
    {
        $("#categoryList_"+id).remove();
    }
</script>
@endpush