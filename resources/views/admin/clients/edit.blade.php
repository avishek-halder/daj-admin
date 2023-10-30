@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('getManageClients') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="{{ route('postUpdateClient', $row->id) }}" method="post" enctype="multipart/form-data"> 
        	@csrf
        	<input type="hidden" name="return_url" value="{{ route('getManageClients') }}">
        	<div class="mb-3 ">
                <label for="first_name" class="form-label">First Name <span class="text-danger" title="This field is required">*</span></label>
                <input type="text" title="First Name" class="form-control" name="first_name" id="first_name" value="{{ (old('first_name'))?old('first_name'):$row->fname }}" placeholder="Enter First Name" required>                          
                @error('first_name')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted"></p>
            </div>
            <div class="mb-3 ">
                <label for="last_name" class="form-label">Last Name <span class="text-danger" title="This field is required">*</span></label>
                <input type="text" title="Last Name" class="form-control" name="last_name" id="last_name" value="{{ (old('last_name'))?old('last_name'):$row->lname }}" placeholder="Enter Last Name" required>                          
                @error('last_name')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted"></p>
            </div>
            <div class="mb-3 ">
                <label for="username" class="form-label">Username <span class="text-danger" title="This field is required">*</span></label>
                <input type="text" title="Username" class="form-control" name="username" id="username" value="{{ (old('username'))?old('username'):$row->uname }}" placeholder="Enter Username" required>                          
                @error('username')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted"></p>
            </div>
            <div class="mb-3 ">
                <label for="email" class="form-label">Email <span class="text-danger" title="This field is required">*</span></label>
                <input type="email" title="Email" class="form-control" name="email" id="email" value="{{ (old('email'))?old('email'):$row->email }}" placeholder="Enter Email" required>                          
                @error('email')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted"></p>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number <span class="text-danger" title="This field is required">*</span></label>
                <input type="text" title="Phone Number" class="form-control" name="phone_number" id="phone_number" value="{{ (old('phone_number'))?old('phone_number'):$row->phone_number }}" placeholder="Enter Phone Number" required>                          
                @error('phone_number')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted"></p>
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Password </label>
                <input type="password" title="Password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password">                          
                @error('password')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted">Please leave empty if you do not want to change password.</p>
            </div>           
            <div class="mb-3 ">
                <label class="form-label">Status <span class="text-danger" title="This field is required">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="">Select a Status</option>                    
                    <option value="1" {{ ($row->status==1)?'selected':'' }}>Active</option>
                    <option value="0" {{ ($row->status==0)?'selected':'' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <p class="text-muted"></p>
            </div>
        	<div class="row g-3">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                        	<a href="{{ route('getManageClients') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        	<input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
        	</form>
            </div>
		</div>
	</div>
</div>
@endsection