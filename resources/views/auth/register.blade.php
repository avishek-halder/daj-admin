@extends('layouts.auth')
@section('title', 'Register')
@section('meta_description', 'My Experience With Homeopathy Register')
@section('meta_keyword', 'My Experience With Homeopathy, Register, Authentication, New Customer')
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
          <div class="col-xxl-9 col-xl-9 col-lg-10 col-md-12 col-sm-12 col-12">
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
                          <i class="icon icon-user-plus"></i>
                        </div>
                        <h1>New User Information</h1>
                      </div>
                    </div>
                  </div>
                  <div id="otp-message"></div>
                  <form method="POST" class="lform" action="{{ route('register') }}" autocomplete="off" name="registrationForm" id="registrationForm">
                {{ csrf_field() }}
                  <div class="row pt-3 justify-content-center">
                    <div class="col-xxl-11 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">First Name (H) (Maximum 30 letters)</label>
                            <div class="formgroupinner">
                              <i class="icon icon-user"></i>
                              <input type="text" class="form-control" value="{{ old('first_name') }}"  placeholder="First Name (H) (Maximum 30 letters)" name="first_name" id="first_name">
                            </div>
                             <div class="error" id="errFName" style="color:red">Please fill first name.</div>
                              @if ($errors->has('first_name'))
                              <span class="invalid" role="alert" style="color:red" id="serrFName">
                                  <strong>{{ $errors->first('first_name') }}</strong>
                              </span>
                              @endif
                            
                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Last Nam (H) ( Maximum 30 letters)</label>
                            <div class="formgroupinner">
                              <i class="icon icon-user"></i>
                              <input type="text" class="form-control" placeholder="Last Nam (H) ( Maximum 30 letters)" name="last_name" id="last_name" value="{{ old('last_name') }}">
                            </div>
                            <div class="error" id="errLName" style="color:red">Please fill last name.</div>
                            @if ($errors->has('last_name'))
                            <span class="invalid" role="alert" style="color:red" id="serrLName">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        
                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Email (H)</label>
                            <div class="formgroupinner">
                              <i class="icon icon-envelope-c"></i>
                              <input type="email" class="form-control" placeholder="Email (H)" name="email" id="email" value="{{ old('email') }}">
                            </div>
                             <div class="error" id="errEmail" style="color:red">Please fill email.</div>
                              @if ($errors->has('email'))
                              <span class="invalid" role="alert" style="color:red" id="serrEmail">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                              @endif
                            

                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="sendotpbx">
                            <a href="javascript:void(0);"  id="otpbtn">Send One Time Password (OTP) to my Email <i class="icon icon-paper-plane"></i></a>
                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Enter One Time Password</label>
                            <div class="formgroupinner">
                              <i class="icon icon-edit-pencil"></i>
                              <input type="text" class="form-control" placeholder="Enter One Time Password" name="otp" id="otp" >

                            </div>
                             <div class="error" id="errOtp" style="color:red">Please fill OTP.</div>
                          </div>
                        </div>
                         <input type="hidden" name="otp_verified" id="otp_verified" value="N">

                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                           <div class="form-group">
                            <label class="label_group">Select Country (O)</label>
                          <div class="formgroupinner">
                              <i class="icon icon-flag"></i>
                               <select class="form-control" name="country" id="country" title="Country (O)">
                                 <option value="">Select Country (O)</option>
                                @foreach($countries_list as $key=>$val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                               </select>
                              
                            </div>
                             <div class="error" id="errCountry" style="color:red">Please select country.</div>
                              @if ($errors->has('country'))
                              <span class="invalid" role="alert" style="color:red" id="serrCountry">
                                  <strong>{{ $errors->first('country') }}</strong>
                              </span>
                              @endif

                          </div>
                        </div>

                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Mobile No (H) (Maximum 10 characters)</label>
                            <div class="formgroupinner wticon">
                              <i class="icon icon-phone"></i>
                              <div class="input-group">
                                <div class="input-group-text ">
                                  <select class="form-control" name="phone_code" id="phone_code" required>
                                     <option value="">Country Code</option>
                                    @foreach($countries as $key=>$val)
                                    <option value="{{$val}}" >+{{$val}}</option>
                                    @endforeach
                                
                                  </select>
                                </div>
                                <input type="text" class="form-control" maxlength="10" placeholder="Mobile No (H) (Maximum 10 characters)" value="{{ old('mobile_no') }}" name="mobile_no" id="mobile">
                              </div>
                            </div>
                            <div class="error" id="errMobile" style="color:red">Please fill mobile no.</div>
                              @if ($errors->has('mobile_no'))
                              <span class="invalid" role="alert" style="color:red" id="serrMobile">
                                  <strong>{{ $errors->first('mobile_no') }}</strong>
                              </span>
                              @endif
                              <div class="error" id="errPhonecode" style="color:red">Please select country code.</div>
                              @if ($errors->has('phone_code'))
                              <span class="invalid" role="alert" style="color:red" id="serrPhonecode">
                                  <strong>{{ $errors->first('phone_code') }}</strong>
                              </span>
                              @endif
                               <div class="error" id="errCountrycodeAjax" style="color:red">This country code is not appropriate for selected country.</div>
                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Username (H) (Min: 5 and Max: 16 characters)</label>
                            <div class="formgroupinner">
                              <i class="icon icon-user"></i>
                              <input type="text" class="form-control" placeholder="Username (H) (Min: 5 and Max: 16 characters)" name="username" id="username" value="{{ old('username') }}" maxlength="16">
                            </div>
                            <div class="error" id="errUsernanme" style="color:red">Please fill username.</div>
                              @if ($errors->has('username'))
                              <span class="invalid" role="alert" style="color:red" id="serrUsernanme">
                                  <strong>{{ $errors->first('username') }}</strong>
                              </span>
                              @endif
                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Password (H) (Min: 8 and Max: 16 characters)</label>
                            <div class="formgroupinner">
                              <i class="icon icon-lock"></i>
                              <input type="password" class="form-control" placeholder="Password (H) (Min: 8 and Max: 16 characters)" id="password" name="password" maxlength="16" >
                             <i class="fa fa-eye togglePass changePass" aria-hidden="true"></i>
                            </div>
                             <div class="error" id="errPassword" style="color:red" >Please fill password.</div>
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
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <label class="label_group">Confirm Password (Min: 8 and Max: 16 characters)</label>
                            <div class="formgroupinner">
                              <i class="icon icon-lock"></i>
                              <input type="password" class="form-control" placeholder="Confirm Password (Min: 8 and Max: 16 characters)"  id="confirm_password" name="confirm_password" maxlength="16">
                            <i class="fa fa-eye togglePass toggleCPass" aria-hidden="true"></i>
                            </div>
                             <div class="error" id="errCPassword" style="color:red">Please fill confirm Password.</div>
                              @if ($errors->has('confirm_password'))
                              <span class="invalid" role="alert" style="color:red" id="serrCPassword">
                                  <strong>{{ $errors->first('confirm_password') }}</strong>
                              </span>
                              @endif
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
                        </div>
                        <input type="hidden" id="prev" value="share-experience">
                        <input type="hidden" name="role_id" value="1">
                         <input type="hidden" name="exist" value="">
                         <div class="clearfix"></div>
                        <div class="row btngrid">
                         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 bk">
                          <button class="default-btn" id="backButton" type="button">Back</button>
                          <div id="backButtonBx" class="backbtnbx">
                            <div class="formbhheading text-start">
                              <h3>Are you sure? All the information you entered is not saved.</h3>
                              <div class="radiouter">
                                <div class="radio">
                                  <input type="radio" id="Yes2" name="sureentered" value="Y">
                                  <label for="Yes2">Yes</label>
                                </div>
                                <div class="radio">
                                  <input type="radio" id="No2" name="sureentered" value="N">
                                  <label for="No2">No</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3 sb">
                          <button class="primary-btn" type="submit"  id="buttonsubmit">Submit</button>
                        </div>
                      </div>

                        
                      </div>
                    </div>
                  </div>


                </form>
                  <div class="row" id="hidop">
                    <div class="col-12">
                      <div class="textinfo">
                        <div class="infobt"><strong>H -</strong><span>Hidden from Public</span></div>
                        <div class="infobt"><strong>O -</strong><span>Open to Public</span></div>
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
   $('#country').select2();
    var validated = false;

    $('.error').hide();
    
    $('#mobile').on('keyup',function(){
        this.value = this.value.replace(/[^0-9]/g,'');
    });
    
    $('#otp').on('keyup',function(){
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    $('#username').on('keyup',function(){
        this.value = this.value.replace(/\s/g,'');
    });

    $('#buttonsubmit').on('click', function(e){

        e.preventDefault();
        $("#otp-message").html('');
        var errorFlagOne = 0; 
        
        var fname = $('#first_name').val();
        var lname = $('#last_name').val();
        var email = $('#email').val();
        var phone_code = $('#phone_code').val();
        var mobile = $('#mobile').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        var username = $('#username').val();
        var otp = $('#otp').val();
        var country = $('#country').val();
        var name_regex  = /^[a-zA-Z ]{2,30}$/;
        var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //var mobile_regex = /^[0-9]{10}$/;
        
        if(!fname) {
            $('#errFName').show();
            $('#serrFName').hide();
            errorFlagOne = 1;
        } else if(!name_regex.test(fname)) {
            $('#errFName').html('Please fill vaild first name.');
            $('#errFName').show();
            $('#serrFName').hide();
            errorFlagOne = 1;
        } else {
            $('#errFName').hide();
            $('#serrFName').show();
        }

        if(lname!='') {
         if(!name_regex.test(lname)) {
            $('#errLName').html('Please fill vaild last name.');
            $('#errLName').show();
             $('#serrLName').hide();
            errorFlagOne = 1;
        } else {
            $('#errLName').hide();
             $('#serrLName').show();
        }
      }
      else
      {
        $('#errLName').hide();
        $('#serrLName').show();
      }

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
                  $.ajax({
                  url: base_url+'/check-duplicate-email',
                  data: {email : email, _token : token},
                  dataType:'json',
                  type:'post',
                  beforeSend:function(){
                      //$("#buttonsubmit").html('Loading...');
                  },
                  success:function(result){

                          if(result.statusCode == 200){
                            if( result.is_duplicate==1)
                            {
                              $('#errEmail').html(result.msg);
                              $('#errEmail').show();
                              $('#serrEmail').hide();
                              errorFlagOne = 1;
                            }
                            else
                            {
                              $('#errEmail').hide();
                              $('#serrEmail').show();
                            }
                           
                          
                          }
                          


                  },
              });
            
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


           if (!country){
              errorFlagOne = 1;
              $('#errCountry').show();
              $('#serrCountry').hide();
              
          } else {
               $('#errCountry').hide();
               $('#serrCountry').show();
          }

         if (!phone_code){
              errorFlagOne = 1;
              $('#errPhonecode').show();
              $('#serrPhonecode').hide();
              
          } else {
               $('#errPhonecode').hide();
               $('#serrPhonecode').show();
          }

           if(phone_code!='')
           {
              if(!mobile) {
              $('#errMobile').show();
              $('#serrMobile').hide();
              errorFlagOne = 1;
              } /*else if(!mobile_regex.test(mobile)) {
                $('#errMobile').html('Please fill the mobile number with 10 digits.');
                errorFlagOne = 1;
              }*/ else if(mobile.length < 10 || mobile.length > 10) {
                $('#errMobile').html('Please fill the mobile number with 10 digits.');
                $('#errMobile').show();
                 $('#serrMobile').hide();
                errorFlagOne = 1;
              } else {
                      $.ajax({
                      url: base_url+'/check-duplicate-mobile',
                      data: {mobile_no : mobile, _token : token},
                      dataType:'json',
                      type:'post',
                      beforeSend:function(){
                          //$("#buttonsubmit").html('Loading...');
                      },
                      success:function(result){

                              if(result.statusCode == 200){
                                if( result.is_duplicate==1)
                                {
                                  $('#errMobile').html(result.msg);
                                  $('#errMobile').show();
                                  $('#serrMobile').hide();
                                  errorFlagOne = 1;
                                }
                                else
                                {
                                  $('#errMobile').hide();
                                  $('#serrMobile').show();
                                }
                               
                              
                              }
                              


                      },
                  });
                
            }

           }
           else
                {
                  $('#errMobile').hide();
                  $('#serrMobile').show();
                }
        



          if(!username) {
            $('#errUsernanme').show();
            $('#serrUsernanme').hide();
            errorFlagOne = 1;
        } else if(username.length>16) {
            $('#errUsernanme').html('Username must not be greater than 16 chracters.');
            $('#errUsernanme').show();
            $('#serrUsernanme').hide();
            errorFlagOne = 1;
        } else if(username.length<5) {
            $('#errUsernanme').html('Username must be at least 5 characters.');
            $('#errUsernanme').show();
            $('#serrUsernanme').hide();
            errorFlagOne = 1;
        }else {

              $.ajax({
                  url: base_url+'/check-duplicate-username',
                  data: {username : username, _token : token},
                  dataType:'json',
                  type:'post',
                  beforeSend:function(){
                      //$("#buttonsubmit").html('Loading...');
                  },
                  success:function(result){

                          if(result.statusCode == 200){
                            if( result.is_duplicate==1)
                            {
                              $('#errUsernanme').html(result.msg);
                              $('#errUsernanme').show();
                              $('#serrUsernanme').hide();
                              errorFlagOne = 1;
                            }
                            else
                            {
                              $('#errUsernanme').hide();
                              $('#serrUsernanme').show();
                            }
                           
                          
                          }
                          


                  },
              });
            
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
            $('#errCPassword').show();  
            $('#serrCPassword').hide(); 
            errorFlagOne = 1;
        }else if(confirm_password.length>16) {
            $('#errCPassword').html('Confirm password must not be greater than 16 chracters.');
            $('#errCPassword').show();
            $('#serrCPassword').hide();
            errorFlagOne = 1;
        }else if(confirm_password.length<8) {
            $('#errCPassword').html('Confirm password must be at least 8 characters.');
            $('#errCPassword').show();
            $('#serrCPassword').hide();
            errorFlagOne = 1;
        }
         else {
            if(confirm_password!=password) {
                $('#errCPassword').html('Password and confirm password does not match.');
                $('#errCPassword').show();
                $('#serrCPassword').hide(); 
                errorFlagOne = 1;
            } else {
                $('#errCPassword').hide();
                $('#serrCPassword').show(); 
            }
        }
         $('#errCountrycodeAjax').hide();
        if(errorFlagOne == 1) {
            return false;
        } else {
            //var country_code = '+91';
            //var mobilewith_country = country_code+mobile;

            $.ajax({
                url: base_url+'/check-valid-country-code',
                data: {country_id : country, country_code:phone_code, _token : token},
                dataType:'json',
                type:'post',
                beforeSend:function(){
                    $("#buttonsubmit").html('Loading...');
                },
                success:function(result){

                        if(result.statusCode == 200 && result.valid_country_code==0)
                        {
                          $('#errCountrycodeAjax').show();
                           if($('.error').length>0)
                          {
                             var pxl = $('.error:visible:first').offset().top;
                              pxl = pxl-150;
                             $('html, body').animate({
                              scrollTop: pxl
                              }, 1000);
                           }
                           $('#buttonsubmit').prop('disabled', false);
                          return false;
                          
                        }
                        else
                        {
                          $('#errCountrycodeAjax').hide();
                          $.ajax({
                            url: base_url+'/verifyotp',
                            data: {email : email, otp_val:otp, _token : token},
                            dataType:'json',
                            type:'post',
                            beforeSend:function(){
                                $("#buttonsubmit").html('Loading...');
                            },
                            success:function(result){

                                    if(result.statusCode == 200){
                                    $("#otp-message").show();
                                    $("#otp-message").html(result.msg);
                                    $("#otp-message").css('color','green');
                                    setTimeout(function() {
                                    $('#otp-message').fadeOut("slow");
                                  }, 3000 );
                           
                                    $('#otp_verified').val('Y');
                                   $("#registrationForm").submit();
                                }
                                else{
                                     $("#buttonsubmit").html('Submit');
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


                },
                complete: function() {
                        $("#buttonsubmit").html('Submit');
                     
                  }
            });


            
        }
    });
    
    $('#resendotp').on('click', function(e){
        e.preventDefault();
        $("#otp-message").html('');
      
        var mobile = $('#mobile').val();
        var country_code = '+91';
        var mobilewith_country = country_code+mobile;
        
      $.ajax({
            url: base_url+'/submitforotp',
            data: {mobile : mobilewith_country, _token : token, phone_no : mobile},
            dataType:'json',
            type:'post',
            beforeSend:function(){
                //$("#resendotp").html('Loading...');
            },
            success:function(result){
                if(result.statusCode == 200){
                    $("#otp-message").show();
                    $("#otp-message").html('OTP '+result.otp+' resent successfully to your mobile number.');
                    $("#otp-message").css('color','green');

                    /*setTimeout(function() {
              $('#otp-message').fadeOut("slow");
            }, 3000 );*/
                }
                else{
                    $('#otp-message').show();
                    $('#otp-message').html("Something wrong... please try later");

                    /*setTimeout(function() {
              $('#otp-message').fadeOut("slow");
            }, 3000 );*/
                }
            },
        });
    });
    
    $('#otpbtn').on('click', function(e){
        e.preventDefault();
         var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $("#otp-message").html('');
        var errorFlagTwo = 0;
        
        var email = $('#email').val();
        if(email!='' && email!=undefined)
        {
          if(!email_regex.test(email)) {
            $('#errEmail').html('Please fill the valid email.');
            $('#errEmail').show();
            $('#serrEmail').hide();
            errorFlagOne = 1;
          }
          else
          {
            $('#errEmail').hide();
            $('#serrEmail').show();
            
              $('#otp_verified').val('');
              
              $.ajax({
                  url: base_url+'/submitforotp',
                  data: {email : email, _token : token},
                  dataType:'json',
                  type:'post',
                  beforeSend:function(){
                     //$('#otpbtn').html('Loading...');
                     $('#otpbtn').html('Sending One Time Password (OTP)...');  
                     //$('#otpbtn').prop('disabled',true);
                      $('#otpbtn').addClass("disable-click");
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
                 
                          $('#otp_verified').val('Y');
                          //$("#registrationForm").submit();
                      }
                      else{
                        
                         if(otpResult.statusCode == 400){
                          $("#otp-message").show();
                          $("#otp-message").html(otpResult.msg);
                         }
                         else
                         {
                            $("#otp-message").show();
                            $("#otp-message").html('Sorry OTP not sent.Please try after some time.');
                         }
                         $("#otp-message").css('color','red');
                          setTimeout(function() {
                   $("#otp-message").fadeOut("slow");
                  }, 3000 );
                      }
                  },

                  error: function(xhr) { // if error occured
                      console.log(xhr.statusText + xhr.responseText);
                      
                  },
                  complete: function() {
                       $('#otpbtn').removeClass("disable-click");
                     
                  }
              });

          }

           

        }
        else
        {
              /*$("#otp-message").show();
                       $("#otp-message").html('Sorry OTP not sent.Please enter email address.');
                        $("#otp-message").css('color','red');
                        setTimeout(function() {
                 $("#otp-message").fadeOut("slow");
                }, 3000 );*/
                $('#errEmail').html('Please enter email address.');
                $('#errEmail').show();
                $('#serrEmail').hide();

        }
      
           
      
    });

/*$('#backButton').on('click', function(e){
  var prev_url_slug = $("#prev").val();
  var prev_url =  base_url+'/'+prev_url_slug;
 // window.location.href = prev_url;

});*/

var $selectAll = $( "input:radio[name=sureentered]" );
    $selectAll.on( "change", function() {

      if($(this).val()=='Y')
      {
        var prev_url_slug = $("#prev").val();
        var prev_url =  base_url+'/'+prev_url_slug;
        window.location.href = prev_url;
      }
      else
      {
        $('#backButton').trigger('click');
      }
         
    });
    
    
});

</script>

@endpush
