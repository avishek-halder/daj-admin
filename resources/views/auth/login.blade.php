@extends('layouts.auth')
@section('title', 'Login')
@section('meta_description', 'My Experience With Homeopathy Login')
@section('meta_keyword', 'My Experience With Homeopathy, Login, Authentication')
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
                <div class="userinfobx">
                  <div class="row justify-content-center">
                    <div class="col-xxl-11 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="formheading">
                        <div class="formtpicon">
                          <i class="icon icon-user-half"></i>
                        </div>
                        <h1>Existing User Log In</h1>
                      </div>
                    </div>
                  </div>
                   

                    @if(session('success'))
                   <div class="alert alert-success alert-dismissible" role="alert" id="success_msg">
                      {{ session('success') }}<br>
                     <a href="javascript:void(0);" class="close closebtn" data-bs-dismiss="alert" aria-label="close">Done</a>
                     </div>
                    @endif
                     @if(session('error'))
                     <div class="alert alert-danger alert-dismissible" role="alert" id="success_msg">
                     {{ session('error') }}<br>
                     <a href="javascript:void(0);" class="close closebtn" data-bs-dismiss="alert" aria-label="close">Done</a>
                     </div>
                     
                    @endif
                  <div class="row pt-3 justify-content-center">
                    <div class="col-xxl-11 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <ul class="nav nav-tabs nav-justified" id="userTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="LoginWithUser-tab" data-bs-toggle="tab" data-bs-target="#LoginWithUser" type="button" role="tab" aria-controls="LoginWithUser" aria-selected="true">Login With User Name</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="LoginwithOneTime-tab" data-bs-toggle="tab" data-bs-target="#LoginwithOneTime" type="button" role="tab" aria-controls="LoginwithOneTime" aria-selected="false">Login with One Time Password (OTP)</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="userTabContent">

                        <div class="tab-pane fade" id="LoginWithUser" role="tabpanel" aria-labelledby="LoginWithUser-tab">
                          <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" autocomplete="off" id="loginwithoutotp">
                            {{ csrf_field() }}
                          <div class="row">
                            
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                <div class="formgroupinner">
                                  <i class="icon icon-envelope-c"></i>
                                  <input type="text" class="form-control" placeholder="Email / Username" name="email_id" id="email_id">
                                </div>
                                <div class="error" id="errEmailid" style="color:red">Please Fill Email / Username</div>
                                 @if ($errors->has('email_id'))
                                <span class="invalid" role="alert" style="color:red" id="serrEmailid">
                                    <strong>{{ $errors->first('email_id') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                <div class="formgroupinner">
                                  <i class="icon icon-lock"></i>
                                  <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                  <i class="fa fa-eye togglePass changePass" aria-hidden="true"></i>
                                </div>
                                <div class="error" id="errPassword" style="color:red" >Please Fill Password.</div>
                                @if ($errors->has('password'))
                                <span class="invalid" role="alert" style="color:red"  id="serrPassword">
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
                             <input type="hidden" name="otp_login" value="N">
                             <div class="clearfix"></div>
                             <div class="row btngrid">
                             <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 bk">
                              <button class="default-btn" type="button" id="backButton">Back</button>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 order-sm-3 mb-3 sb">
                              <button class="primary-btn" type="submit" id="buttonsubmit">Submit</button>
                            </div>
                          </div>
                            
                            
                          </div>
                          </form>
                           <div class=" forgot"><a href="{{url('forgot-password')}}" class="forgotpwd">Forgot your password?</a></div>
                        </div>
                         <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" autocomplete="off" id="loginwithotp">
                          {{ csrf_field() }}
                        <div class="tab-pane fade show active" id="LoginwithOneTime" role="tabpanel" aria-labelledby="LoginwithOneTime-tab">
                          <div class="row">
                            <div id="otp-message"></div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="formgroupinner">
                                  <i class="icon icon-envelope-c"></i>
                                  <input type="eamil" class="form-control" placeholder="Email" name="email" id="email" required>
                                </div>
                                <div class="error" id="errEmail" style="color:red">Please Fill Email.</div>
                                @if ($errors->has('email'))
                                <span class="invalid" role="alert" style="color:red" id="serrEmail">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="sendotpbx">
                                <a href="javascript:void(0);" id="otpbtn">Send One Time Password (OTP) to my Email <i class="icon icon-paper-plane"></i></a>
                              </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="formgroupinner">
                                  <i class="icon icon-edit-pencil"></i>
                                  <input type="text" class="form-control" placeholder="Enter One Time Password" name="otp" id="otp" required>
                                </div>
                                 <div class="error" id="errOtp" style="color:red">Please Fill OTP.</div>
                              </div>
                            </div>
                            <input type="hidden" name="otp_login" value="Y">
                            <input type="hidden" id="prev" value="share-experience">
                            <div class="clearfix"></div>
                             <div class="row btngrid">
                             <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 bk">
                              <button class="default-btn" type="button" id="backButtonotp">Back</button>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3 sb">
                              <button class="primary-btn" type="submit" id="buttonsubmitotp">Submit</button>
                            </div>
                          </div>
                           
                            
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

  /* setTimeout(function() {
    $('.alert').fadeOut("slow");
  }, 3000 );*/

// For Back button
$('#backButton,#backButtonotp').on('click', function(e){
  var prev_url_slug = $("#prev").val();
  var prev_url =  base_url+'/'+prev_url_slug;
 window.location.href = prev_url;

});

    $('#buttonsubmitotp').on('click', function(e){

        e.preventDefault();
        $("#otp-message").html('');
        var errorFlagOne = 0; 
        
      
        var email = $('#email').val();
        var otp = $('#otp').val();
        
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

         if(!otp) {
            $('#errOtp').show();

            errorFlagOne = 1;
        } else if(otp.length>6) {
            $('#errOtp').html('Please fill the vaild OTP.');
            $('#errOtp').show();
            errorFlagOne = 1;
        } else {
            $('#errOtp').hide();
        }



        if(errorFlagOne == 1) {
            return false;
        } else {
            //var country_code = '+91';
            //var mobilewith_country = country_code+mobile;
            $.ajax({
                url: base_url+'/verifyotplogin',
                data: {email : email, otp_val:otp, _token : token},
                dataType:'json',
                type:'post',
                beforeSend:function(){
                    $("#buttonsubmitotp").html('Loading...');
                },
                success:function(result){

                        if(result.statusCode == 200){
                        $("#otp-message").show();
                        $("#otp-message").html(result.msg);
                        $("#otp-message").css('color','green');
                        setTimeout(function() {
                        $('#otp-message').fadeOut("slow");
                      }, 3000 );
               
                        
                        $("#loginwithotp").submit();
                    }
                    else{
                         $("#buttonsubmitotp").html('Submit');
                        $("#otp-message").show();
                       $("#otp-message").html(result.msg);
                        $("#otp-message").css('color','red');

                        setTimeout(function() {
                 $("#otp-message").fadeOut("slow");
                }, 3000 );
                    }


                },
            });
        }
    });
//Sending OTP
$('#otpbtn').on('click', function(e){
        e.preventDefault();
        $("#otp-message").html('');
        var errorFlagTwo = 0;
        var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email = $('#email').val();
        if(email!='' && email!=undefined)
        {
           
            if(!email_regex.test(email)) {

            $("#otp-message").show();
            $("#otp-message").html('Sorry OTP not sent.Please fill the valid email.');
            $("#otp-message").css('color','red');
                        setTimeout(function() {
                 $("#otp-message").fadeOut("slow");
                }, 3000 );
            
            errorFlagOne = 1;
          }
          else{
                  $.ajax({
                url: base_url+'/submitforotplogin',
                data: {email : email, _token : token},
                dataType:'json',
                type:'post',
                beforeSend:function(){
                   $('#otpbtn').html('Sending One Time Password (OTP)...'); 
                },
                success:function(otpResult){
                  $('#otpbtn').html('Send One Time Password (OTP) to my Email <i class="icon icon-paper-plane"></i>'); 
                    if(otpResult.statusCode == 200){
                        $("#otp-message").show();
                        $("#otp-message").html(otpResult.msg);
                        $("#otp-message").css('color','green');
                        setTimeout(function() {
                  $('#otp-message').fadeOut("slow");
                }, 3000 );
               
                        //$('#otp_verified').val('Y');
                        //$("#loginwithotp").submit();
                    }
                    else if(otpResult.statusCode == 400)
                    {
                       $("#otp-message").show();
                       $("#otp-message").html(otpResult.msg);
                        $("#otp-message").css('color','red');
                        setTimeout(function() {
                       $("#otp-message").fadeOut("slow");
                      }, 3000 );
                    }
                    else{
                        $("#otp-message").show();
                       $("#otp-message").html('Sorry OTP not sent.Please try after some time.');
                        setTimeout(function() {
                 $("#otp-message").fadeOut("slow");
                }, 3000 );
                    }
                },
            });

          }
            

        }
        else
        {
                      $("#otp-message").show();
                       $("#otp-message").html('Sorry OTP not sent.Please enter email aaderss.');
                        $("#otp-message").css('color','red');
                        setTimeout(function() {
                 $("#otp-message").fadeOut("slow");
                }, 3000 );

        }
      
           
      
    });
//login with email and password

$('#buttonsubmit').on('click', function(e){

        e.preventDefault();
       
        var errorFlagOne = 0; 
        
      
        var email = $('#email_id').val();
        var password = $('#password').val();
        
        var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //var mobile_regex = /^[0-9]{10}$/;
        
      
         if(!email) {
            $('#errEmailid').show();
             $('#serrEmailid').hide();   
            errorFlagOne = 1;
        } else {
            $('#errEmailid').hide();  
             $('#serrEmailid').show();   
        }


         if(!password) {
            $('#errPassword').show();
             $('#serrPassword').hide();   
            errorFlagOne = 1;
        } else {
            $('#errPassword').hide();  
             $('#serrPassword').show();   
        }



        if(errorFlagOne == 1) {
            return false;
        } else {
          $("#buttonsubmit").html('Loading...');
          $("#loginwithoutotp").submit();
            
            
        }
    });
});
</script>

@endpush