@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('meta_description', 'My Experience With Homeopathy Forgot Password')
@section('meta_keyword', 'My Experience With Homeopathy, Forgot Password')
@section('author', '')

@section('content')

<section class="homecontainer">
      <div class="ltimg lt1">
        <img src="{{ asset('public/front/images/lt1.png') }}" alt="">
      </div>
      <div class="ltimg lt2">
        <img src="{{ asset('public/front/images/lt2.png') }}" alt="">
      </div>
      <div class="ltimg lt3">
        <img src="{{ asset('public/front/images/lt3.png') }}" alt="">
      </div>
      <div class="ltimg lt4">
        <img src="{{ asset('public/front/images/lt4.png') }}" alt="">
      </div>
      <div class="ltimg lt5">
        <img src="{{ asset('public/front/images/lt5.png') }}" alt="">
      </div>
      <div class="ltimg lt6">
        <img src="{{ asset('public/front/images/lt6.png') }}" alt="">
      </div>
      <div class="ltimg lt7">
        <img src="{{ asset('public/front/images/lt7.png') }}" alt="">
      </div>
      <div class="ltimg lt8">
        <img src="{{ asset('public/front/images/lt8.png') }}" alt="">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-8 col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="homecircleouter">
              <div class="homecircleinner">
                <div class="homecirclebtxouter">
                  <div class="homecirclebtx noimagebx">
                   <img src="{{ asset('public/front/images/existing-user-img.jpg') }}" alt="">
                  </div>
                </div>
              </div>
              <div class="homecirclecontent">
             @if (session('success'))
                      <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('success') }}
                      </div>
                    @endif
                    @if (session('error'))
                      <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('error') }}
                      </div>
                    @endif
                <div class="userinfobx">
                  <div class="row justify-content-center">
                    <div class="col-xxl-11 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="formheading">
                        <div class="formtpicon">
                          <i class="icon icon-user-half"></i>
                        </div>
                        <h1>Reset Password</h1>
                      </div>
                    </div>
                  </div>
                   
                  <div class="row pt-3 justify-content-center">
                    <div class="col-xxl-11 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      
                  

                       
                          <form method="POST" action="{{ route('updatepassword',$token) }}" autocomplete="off" id="resetform">
                            {{ csrf_field() }}
                          <div class="row">
                            
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                <div class="formgroupinner">
                                  <i class="icon icon-envelope-c"></i>
                                  <input type="email" class="form-control" autocomplete="off" name="email" id="email" value="{{ (!empty(old('email'))?old('email'):$email) }}" required autofocus readonly>
                                </div>
                                <div class="error" id="errEmail" style="color:red">Please Fill Email</div>
                                 @if ($errors->has('email'))
                                <span class="invalid" role="alert" style="color:red" id="serrEmail">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                <div class="formgroupinner">
                                   <i class="icon icon-lock"></i>
                                  <input id="password" type="password" placeholder="Password (Min: 8 and Max: 16 characters)" class="form-control" name="password" required>
                                   <i class="fa fa-eye togglePass changePass" aria-hidden="true"></i>
                                </div>
                                <div class="error" id="errPassword" style="color:red">Please Fill Password</div>
                                @if ($errors->has('password'))
                              <span class="invalid" role="alert" id="serrPassword">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                              @endif
                                <script>
                                $(document).ready(function() {
                                    $(".changePass").click(function() {
                                        var passField = document.getElementById("password");
                                        
                                        if (passField.type == "password") {
                                            passField.type = "text";
                                            $(this).removeClass('fa-eye');
                                            $(this).addClass('fa-eye-slash');
                                        } else {
                                            passField.type = "password";
                                            $(this).addClass('fa-eye');
                                            $(this).removeClass('fa-eye-slash');
                                        }
                                    });
                                });
                          </script>
                              </div>
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="form-group">
                        <div class="formgroupinner">
                          <i class="icon icon-lock"></i>
                          <input id="confirm_password" type="password" placeholder="Confirm Password (Min: 8 and Max: 16 characters)" class="form-control" name="confirm_password" required>
                          <i class="fa fa-eye togglePass toggleCPass" aria-hidden="true"></i>
                         
                          <script>
                          $(document).ready(function() {
                              $(".toggleCPass").click(function() {
                                  var passField = document.getElementById("confirm_password");
                                  
                                  if (passField.type == "password") {
                                      passField.type = "text";
                                      $(this).removeClass('fa-eye');
                                      $(this).addClass('fa-eye-slash');
                                  } else {
                                      passField.type = "password";
                                      $(this).addClass('fa-eye');
                                      $(this).removeClass('fa-eye-slash');
                                  }
                              });
                          });
                          </script>
                        </div>
                            <div class="error" id="errCpassword" style="color:red">Please Fill Confirm Password</div>
                             @if ($errors->has('confirm_password'))
                              <span class="invalid" role="alert" id="serrCpassword">
                                  <strong>{{ $errors->first('confirm_password') }}</strong>
                              </span>
                          @endif

                      </div>
                    </div>
                            
                           
                             <!-- <div class="clearfix"></div> -->
                              <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <!-- <button class="default-btn" type="button" id="backButton">Back</button> -->
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 order-sm-3 mb-3">
                              <button class="primary-btn" type="submit" id="buttonsubmit">Submit</button>
                            </div>
                            
                            
                          </div>
                          </form>
                         
                        
                         
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
    </section>



@endsection
@push('bottom')

<script type="text/javascript">
$(document).ready(function(){

 $('.error').hide();

 $('#otp').on('keyup',function(){
        this.value = this.value.replace(/[^0-9]/g,'');
    });

   setTimeout(function() {
    $('.alert').fadeOut("slow");
  }, 3000 );

// For Back button
$('#backButton,#backButtonotp').on('click', function(e){
  
  var prev_url =  base_url+'/login';
 window.location.href = prev_url;

});

   
//login with email and password

$('#buttonsubmit').on('click', function(e){
  
        e.preventDefault();
       
        var errorFlagOne = 0; 
        
      
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
       
        var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //var mobile_regex = /^[0-9]{10}$/;
        
      
        if(!email) {
            $('#errEmail').show();
            $('#serrEmail').hide();
            errorFlagOne = 1;
        } else if(!email_regex.test(email)) {
            $('#errEmail').html('Please fill the valid email.');
            $('#errEmail').show();
            $('#serrEmail').hide();
            errorFlagOne = 1;
        } else {
            $('#errEmail').hide();
            $('#serrEmail').show();
        }

         if(!password) {
            $('#errPassword').show();
             $('#serrPassword').hide();   
            errorFlagOne = 1;
        } else if(password.length>16) {
            $('#errPassword').html('Password must not be greater than 16 chracters.');
            $('#errPassword').show();
            $('#serrPassword').hide();
            errorFlagOne = 1;
        }else if(password.length<8) {
            $('#errPassword').html('Password must be at least 8 characters.');
            $('#errPassword').show();
            $('#serrPassword').hide();
            errorFlagOne = 1;
        }else {
            $('#errPassword').hide();  
             $('#serrPassword').show();   
        }

        if(!confirm_password) {
            $('#errCpassword').show();
             $('#serrCpassword').hide();   
            errorFlagOne = 1;
        } else if(confirm_password.length>16) {
            $('#errCpassword').html('Confirm Password must not be greater than 16 chracters.');
            $('#errCpassword').show();
            $('#serrCpassword').hide();
            errorFlagOne = 1;
        }else if(confirm_password.length<8) {
            $('#errCpassword').html('Confirm Password must be at least 8 characters.');
            $('#errCpassword').show();
            $('#serrCpassword').hide();
            errorFlagOne = 1;
        }else {
          if(confirm_password!=password)
          {
              $('#errCpassword').html('Confirm Password must be same as password.');
              $('#errCpassword').show();
              $('#serrCpassword').hide();
          }
          else
          {
            $('#errCpassword').hide();  
            $('#serrCpassword').show();  
          }
             
        }


       



        if(errorFlagOne == 1) {
            return false;
        } else {
          $("#buttonsubmit").html('Loading...');
          $("#resetform").submit();
            
            
        }
    });
});
</script>

@endpush