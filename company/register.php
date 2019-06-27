	 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Company | Login</title>

  	  <style>
.term_lable{
    padding-left: 70px;
}

  /* Let's get this party started */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}
 
/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(56, 116, 228, 0.8); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
	background: rgba(255,0,0,0.4); 
}	

.errorMsg
{
  color:red;
  font-weight:bold;
  font-size: 12px;
}
  </style>
</head>


<script>
function tick() 
{
  var hours, minutes, seconds, ap;
  var intHours, intMinutes, intSeconds;
  var today;

  today = new Date();

  intHours = today.getHours();
  intMinutes = today.getMinutes();
  intSeconds = today.getSeconds();

  if (intHours == 0) 
{
     hours = "12:";
     ap = "A.M.";
  } 
else if (intHours < 12)
 { 
     hours = intHours+":";
     ap = "A.M.";
  } 
else if (intHours == 12) 
{
     hours = "12:";
     ap = "P.M.";
  } 
else 
{
     intHours = intHours - 12
     hours = intHours + ":";
     ap = "P.M.";
  }

  if (intMinutes < 10) 
{
     minutes = "0"+intMinutes+":";
  } 
else 
{
     minutes = intMinutes+":";
  }

  if (intSeconds < 10) 
{
     seconds = "0"+intSeconds+" ";
  } 
else 
{
     seconds = intSeconds+" ";
  } 

  timeString = hours+minutes+seconds+ap;

  Clock.innerHTML = timeString;
  Clock_time.innerHTML = timeString;

  window.setTimeout("tick();", 100);
}

window.onload = tick;

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='register.php';
}
</script>

<?php 
session_start();
error_reporting(0);

include('links_old.php'); 

include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');



?>
				
				
<style>
input:focus {
    background-color: #FFFFD4 !important;
	color:black !important;
}

label{
color:black !important;
}

input{
	color:black !important;
}
.text_font{
color:black;
font-family:Times New Roman;
font-size:17px;
}


.login_labler{
padding: 2px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 6px;
    border: 1px solid #192e44;
    background-color:#2A3F54;
    border-radius: 8px;
    <!-- box-shadow: 4px 4px 4px #c58f8f; -->
	margin-bottom:50px;
}

.select2-container--default .select2-selection--single{
	border-radius: 0px !important;
}
 </style>
<script type = "text/javascript" language = "javascript">

var registerData;
if(registerData===null||registerData===undefined){
   registerData={};
}
  
registerData.uDate=
{
  checkemail:function(){
    debugger;
  	var email=document.getElementById("email").value;
  	var myData = {checkemail:5532,email:email};
	var url='ajax/getData.php';

	   if(email)
	   {
	       $.ajax({
                type:"POST",
                url:url,
                async: false,
                dataType: 'json',
                data:myData,
                success: function(obj) {
				        debugger;
				   $('#email_status').html(obj.mailDesc);
         }
			      
		   });
	    }
	    else
	    {
		   $( '#email_status' ).html("");
		   return false;
	    } 
  },
  loadCompaData:function(){
    debugger;
    //var comp_id=$('#comp_id').val();
    var url= "ajax/getData.php";
    var myData = {loadCompaData:5532};

       		$.ajax({
                type:"POST",
                url:url,
                async: false,
                dataType: 'json',
                data:myData,
                success: function(obj) {
                    debugger;
                   $("#comp_name").html('');
                  if(obj.CompData != null){
                    
                   for(var i=0;i<obj.CompData.length;i++)
                    {
                        if(obj.CompData[i].comp_name != 'Undefined'){
                            $("#comp_name").append('<option value="'+obj.CompData[i].id+'|'+obj.CompData[i].comp_name+'">'+obj.CompData[i].comp_name+'</option>');
                        }
                    }
                     /* $("#comp_name").append('<option value="0">OTHER</option>');*/
                  }                      
                }
            });
  },
  loadIndusData:function(){
    debugger;
    //var comp_id=$('#comp_id').val();
    var url= "ajax/getData.php";
    var myData = {loadIndusData:5532};

       		$.ajax({
                type:"POST",
                url:url,
                async: false,
                dataType: 'json',
                data:myData,
                success: function(obj) {
                    debugger;
                   $("#indus_type").html('');
                  if(obj.industryData != null){
                    
                   for(var i=0;i<obj.industryData.length;i++)
                    {
                        if(obj.industryData[i].industry_name != 'Undefined'){
                           $("#indus_type").append('<option value="'+obj.industryData[i].industry_name+'">'+obj.industryData[i].industry_name+'</option>');
                        }
                    }
                     /* $("#indus_type").append('<option value="0">OTHER</option>');*/
                  }                      
                }
            });
  },
  checkGST:function(){
    var gst_not_reg = document.getElementById('gst_not_reg');
    var gst_reg = document.getElementById('gst_reg');

    if(gst_not_reg.checked){  
      $('#showGST').hide();
    }else{
      $('#showGST').show();
    }
  },
  check_new_old:function(){
    debugger;
  	var new_pass=document.getElementById('password').value;
    var confirm_pass=document.getElementById('c_password').value;
  
    if(new_pass == confirm_pass && new_pass !=null && confirm_pass != null)
    {     
       $("#password_match").html('<p class="errorMsg"> New and Confirm Password is Correct.</p>');
       $("#register").prop('disabled', false);
    }
    else
    {
       $("#password_match").html('<p class="errorMsg"> New and Confirm Password is Incorrect !!</p>');
       $("#register").prop('disabled', true);
    }   
  }

};


$(document).ready(function() {	
debugger;
registerData.uDate.loadCompaData();
registerData.uDate.loadIndusData();
registerData.uDate.checkGST();


  $('#country').on('change',function(){
  debugger;    
    var countryID = $(this).val();
            $.ajax({
                type:'POST',
                url:'adminreg/condition.php',
                data:'country_id='+countryID,
				        success:function(data){
                    $('#state').html(data);
                }
            });
		});	
	


$('#term_cond').click(function() {
		//alert($('#term_con').is(":checked"));
		if($('#term_cond').is(":checked") == true) {
			$("#register").prop('disabled', false);
		}
		else
		{
			$("#register").prop('disabled', true);
		}	
}); 
	  
$("form#register_form").submit(function(event){
	debugger;
	 var formData = $("#register_form").serialize();
   var url='adminreg/adminreg.php';
 $.ajax({
    type:"POST",
    url:url,
    async: false,
    dataType: 'json',
    data:formData,
    success: function (obj) {
      debugger;
        //alert(returndata);
       //$("#myModal").hide();
       
    	 $("#getCode").html(obj.data);
       $("#commondialog").modal();
    }
  });
 
  return false;
});
	 
});
		
		
	
</script>


    <!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="loginfiles/css/style.css" />
    <script src="loginfiles/js/modernizr.custom.63321.js"></script>
		
	<link href='https://fonts.googleapis.com/css?family=Russo+One' rel='stylesheet' type='text/css'>
	
    <style>
	body {
		/*background: #e1c192 url(loginfiles/wood_pattern.jpg);*/
		background-color: #0924ec6b;
	}

	.registerClass{
	    padding: 15px;
	    background: #fffaf6c2;
	    border-radius: 4px;
	    color: #7e7975;
	    box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4);
	}
	</style> 

<body>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid" style="background-color: white;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="background-color:white !important;">
                <div type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <div id="Clock" style="font-size:20px;background-color:white;">&nbsp; </div>
                </div>
				<a href="http://www.uplace.in" class="navbar-left"><img src="images/logo.jpg" style="width:100px;border-radius:2px;"></a>
			</div>
			<div class="nav navbar-nav navbar-right hidden-xs">
				<div id="Clock_time" style="font-size:35px;background-color:white;">&nbsp; </div>
			</div>
		</div>
</nav>		
<!--<a href="http://www.uplace.in" class="navbar-left hidden-xs"><img src="images/logo.jpg" style="width:130px;border-radius:5px;box-shadow: 1px 1px 18px white;"></a>
-->
            <div class="container">
				<div class="row">
					<br><br><br><br>
					<div class="col-md-8 col-xs-12 col-md-offset-2">
						<div class="login_labler"> 
							<span style="font-size:30px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;color:white;letter-spacing: 8px;">
							Register   
							</span>
				  		</div><br><br>
					</div>
				</div>
							
				<div class="col-sm-4 col-md-8 col-md-offset-2">

					<form  id="register_form" method="POST" class="registerClass form-horizontal form-label-left">
					<label class="btn btn-primary btn-sm"><a href="login.php" style="color:white;"><i class="fa fa-reply" aria-hidden="true"></i>  &nbsp; Back to Login !</a></label>
     				<!-- <input type="hidden" name="case" value="insert">-->
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Company name <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select  name="comp_name" id="comp_name" class="form-control select2_single_clg" tabindex="-1" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100%;">
                        </select>
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Login email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="email" type="email" onkeyup="registerData.uDate.checkemail();" id="email"  required="required" data-placement="right" data-toggle="tooltip" title="This field is required." class="form-control col-md-7 col-xs-12">
          							<span id="email_status"></span>
          						</div>
                      </div>
					  					  
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Password  <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="password" type="password" id="password" onkeyup="registerData.uDate.check_new_old();" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Confirm password  <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="c_password" type="password" id="c_password" onkeyup="registerData.uDate.check_new_old();" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                          <span id="password_match"></span>
                        </div>
                      </div>

					   <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Industry type <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select  name="indus_type" id="indus_type" class="form-control select2_single_clg" tabindex="-1" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100%;">
                        </select>
                        </div>
                      </div>

  					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Contact person name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact_person_1" name="contact_person_1" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Designation <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="designation_1" name="designation_1" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>

					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Mobile number <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="mobile_number_1" maxlength="10" name="mobile_number_1" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="email_1" type="email" id="email_1"  required="required" data-placement="right" data-toggle="tooltip" title="This field is required." class="form-control col-md-7 col-xs-12">
						</div>
                      </div>
					  		
<hr>


					 <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Secondary contact person name </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact_person_2" name="contact_person_2" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Designation </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="designation_2" name="designation_2" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Mobile number </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="mobile_number_2" maxlength="10" name="mobile_number_2" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Email ID </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="email_2" type="email" id="email_2" class="form-control col-md-7 col-xs-12">
						</div>
                      </div>
<hr>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Office address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="office_add" id="office_add" class="form-control col-md-7 col-xs-12" placeholder="Enter Office address" style="height:100px;" maxlength="1000"  data-placement="right" data-toggle="tooltip" title="This field is required."></textarea>
						</div>
                      </div>
					  		
					  <div class="form-group">
                       <label class="control-label col-md-4 col-sm-3 col-xs-12">Select Country <span class="required">*</span></label>
						<?php 
						//Get all country data
						$get_con = "SELECT * FROM countries  ORDER BY country_name ASC ";	
						$country_data = mysql_query($get_con) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
						
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select  name="country" id="country" class="form-control select2_single_country" tabindex="-1" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100%;">
                            <option></option>
                            <?php
							
								while($row=mysql_fetch_array($country_data)){ 
									echo '<option value="'.$row['country_id'].'.'.$row['country_name'].'">'.$row['country_name'].'</option>';
								}
							
							?>
                          </select>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Select State <span class="required">*</span></label>
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="state" id="state" class="form-control select2_single_state" tabindex="-1" required="required" style="width:100% !important;">
                            <option></option>
                            
                          </select>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="current_location" id="current_location" required="required" class="form-control col-md-7 col-xs-12" type="text" data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Pin Code <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="pinCode" maxlength="6" name="pinCode" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					 
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Security Code<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="private_number" type="password" required="required" class="form-control col-md-7 col-xs-12" placeholder="Security Code"  data-placement="right" data-toggle="tooltip" title="This field is required.">
						</div>					
                      </div>
					  	

					  <div class="form-group">
					  	<div class="col-xs-12 col-md-6 col-md-offset-4">
					  	  <input type="radio" name="gst" id="gst_not_reg" onclick="registerData.uDate.checkGST();"  />
				          <label>GST Not Registered</label>
				          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				          <input type="radio" name="gst" id="gst_reg" onclick="registerData.uDate.checkGST();" checked/>
				          <label>GST Registered</label>
				        </div>  
                      </div>	

 					  <div class="form-group"  id="showGST">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="gst_val" type="text" id="gst_val" class="form-control col-md-7 col-xs-12" placeholder="Enter 15 Digit GSTIN"  data-placement="right" data-toggle="tooltip" title="This field is required.">
						</div>				
                      </div>

					<br>
					  
					  <div class="col-md-7 col-sm-12 col-xs-12">
                          <div class="term_lable"> 

<span class="required">* Mandatory Fields</span>

				<span style="font-size:15px;">
				 <div class="checkbox">
					<label> <input name="terms_cond" value="yes" type="checkbox" id="term_cond" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:18px;height:18px;"/> </label> 
					<span class="text_font">
					<a href="#" style="color:blue;text-decoration:none;">I agree to terms and conditions </a> 
					</span>
				 </div>
				</span>


				<span style="font-size:15px;">
				 <div class="checkbox">
					<label> <input name="terms_cond_01" value="yes" type="checkbox" id="terms_cond_01" style="width:18px;height:18px;"/> </label> 
					<span class="text_font">
					<a href="#" style="color:blue;text-decoration:none;"> Receive emails from colleges & universities </a> 
					</span>
				 </div>
				</span>


				<span style="font-size:15px;">
				 <div class="checkbox">
					<label> <input name="terms_cond_02" value="yes" type="checkbox" id="terms_cond_02" style="width:18px;height:18px;"/> </label> 
					<span class="text_font">
					<a href="#" style="color:blue;text-decoration:none;"> Receive news letters and promotions from uplace</a> 
					</span>
				 </div>
				</span>	
			</div>
			
	  </div>


              <div class="clearfix"></div>


		<div class="col-md-12 col-xs-12 text-center">

		<div class="col-xs-12 col-md-4 col-md-offset-4">
			<br>
			<button type="submit" class="btn btn-success submit" style="width:100%;" disabled="disabled" id="register" ><span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">Register Now</span></button>
		</div>	

		</div>
		
	</form>	
	</div>
</div>	
<br><br><br><br>
      
  
  <div class="modal fade" id="commondialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body" id="getCode">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>
		
		
		<!-- jQuery if needed -->
       <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
		<script type="text/javascript">
			$(function(){
				
				$("#mobile_number").keyup(function() {
					$("#mobile_number").val(this.value.match(/[0-9]*/));
				}); 
				$("#mobile_number_1").keyup(function() {
					$("#mobile_number_1").val(this.value.match(/[0-9]*/));
				}); 
				$("#mobile_number_2").keyup(function() {
					$("#mobile_number_2").val(this.value.match(/[0-9]*/));
				});  
				$("#pinCode").keyup(function() {
					$("#pinCode").val(this.value.match(/[0-9]*/));
				}); 

				$("#gst_val").keyup(function() {
					$("#gst_val").val(this.value.toUpperCase());
				}); 

		
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' name='password' id='password' type='" + change + "' />")
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
			
	
        $(".select2_single_clg").select2({
          placeholder: "Select a Company",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });


  
        $(".select2_single_country").select2({
          placeholder: "Select a Country",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
  
		
	
        $(".select2_single_state").select2({
          placeholder: "Select a State",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });

		
	</script>

</body>

</html>


