<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Responsive Email Template</title>
                                                                                                                                                                                                                                                                                                                                                                                                        
<style type="text/css">
    .ReadMsgBody {width: 100%; background-color: #ffffff;}
    .ExternalClass {width: 100%; background-color: #ffffff;}
    body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
    table {border-collapse: collapse;}
    
    @media only screen and (max-width: 640px)  {
                    body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                    body[yahoo] .center {text-align: center!important;}  
            }
            
    @media only screen and (max-width: 479px) {
                    body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                    body[yahoo] .center {text-align: center!important;}  
            }
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">
<!-- Wrapper -->
<table width="" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:0px; border: 10px solid transparent;">
            
            <!--Start Header-->
            <table width="700" bgcolor="#fff" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tr>
                    <td style="padding: 15px 10px; background: #bc463a;">
                        <table width="680" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                            <tr>
                                <td width="100%" >
                                    <!--Start logo-->
                                    <table cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                        <tr>
                                            <td class="center" style="padding: 10px 0px 10px 0px">
                                                <a href="#"><img src="{{ asset("public/admin/images/logo-1660734957.png") }}"></a>
                                            </td>
                                        </tr>
                                    </table><!--End logo-->
                                </td>
                            </tr>
                        </table>
                   </td>
                </tr>
            </table> 
            <!--End Header-->

        
            <!--End Two Blocks -->
            <table width="700" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" align="left">
                <tr>
                    <td width="100%" bgcolor="#f5f5f5">
                        <!-- Left box  -->
                        <p style="font-size: 16px; color: #333; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 15px 0px 15px;">&nbsp;&nbsp;&nbsp;&nbsp;Hello {{$maildata['username']}},</p>
                        <p style="font-size: 16px; color: #333; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 15px 0px 15px;">&nbsp;&nbsp;&nbsp;&nbsp;You have requested for password change. Click below link for change passord.</p>
                        <table width="100%" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                            <tr>
                                <td class="left" style="padding: 30px 0px;">
                                    <table cellpadding="0" cellspacing="0" align="left"> 
                                        <tr>
                                            <td colspan="2" class="left" style="font-size: 16px; color: #333; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 15px 0px 15px; " >
                                                 Reset Password:  <a href="{{$maildata['reset_link']}}" target="_blank">Click Here</a>                          
                                           </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> <!--End left box-->
                    </td>
                </tr>
            </table>
            <table width="700" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tbody><tr>
                    <td width="100%" bgcolor="#f5f5f5" class="center">

                        <table cellpadding="0" cellspacing="0" align="left"> 
                            <tbody>
                                <tr>
                                    <td class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 15px 0px 15px; ">
                                        <strong>With Kind Regards,</strong>                       
                                    </td>
                                </tr>
                                   <tr><td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 20px; vertical-align: middle; padding: 5px 15px 20px 15px; ">
                                       {{ config()->get('settings.appname') }}                    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody></table>

            <!-- Footer -->
            <table width="700" cellpadding="0" cellspacing="0" align="center" class="deviceWidth"> 
                <tr>
                    <td  bgcolor="#ededed" class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 10px 10px 10px; " >
                       Copyright &copy; <?php echo date('Y');?> <a href="" style="color: #bc463a; text-decoration: none;">{{ config()->get('settings.appname') }}.</a> All Rights Reserved.                           
                    </td>
                </tr>
            </table>
            <!--End Footer-->

        </td>
    </tr>
</table> 
<!-- End Wrapper -->
</body>
</html>