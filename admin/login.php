	 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | Login</title>

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
	window.location='login.php';
}
</script>

<?php 
session_start();
error_reporting(0);

include('links_old.php'); 

include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');




// if login session - then redirect to dashboard page
		if (isset($_POST['submit']))
		{
			if (empty($_POST['email']) || empty($_POST['password'])) 
			{
			//$error = "Username or Password is invalid";
			
			?>

			<div class='alert alert-warning' style="margin-top:80px;margin-bottom:-60px;">
			<strong>Warning !!</strong> Enter Username and Password.
			</div>
			<?php
			}
			else
			{	
				$email = mysql_real_escape_string($_POST['email']);
				
				$p_num = mysql_query("SELECT * FROM su_active_clgs WHERE private_number=(SELECT private_number FROM ad_admin WHERE email='$email')") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
				while($row=mysql_fetch_array($p_num)) 
				{
					$status=$row['status']; 
				}
					
						$password=md5($_POST['password']);
						$query = mysql_query("select * from ad_admin where password='".$password."' AND email='".$email."'");
						if (mysql_num_rows($query) == 1) {
							
							if($status=='active')
							{
							$_SESSION['admin_email'] = $_POST['email'];
							echo "<script> window.location='index.php';</script>";	
							}	
							else {
							?>
								<div class='alert alert-info' role="alert" style="margin-top:80px;margin-bottom:-60px;">
								   <strong>Warning !!</strong> Your Account is not Activated.
							</div>
							<?php
							} 							
						}
						else {
						?>
							<div class='alert alert-danger' role="alert" style="margin-top:80px;margin-bottom:-60px;">
							   <strong>Warning !!</strong> Username or Password is invalid.
						</div>
						<?php
						}

						$query2 = mysql_query("select * from ad_admin where mobile_number='".$_POST['password']."' AND email='".$email."'");
						if (mysql_num_rows($query2) == 1) {		
							$_SESSION['admin_email'] = $_POST['email'];
							echo "<script> window.location='index.php';</script>";
						}
						
			}
		}
		
?>
      <script>
				window.setTimeout(function() {
				$(".alert").fadeTo(2000, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
		    </script>

				
				
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


 </style>
<script type = "text/javascript" language = "javascript">

function checkemail()
    {
	   var email=document.getElementById( "email" ).value;
	//alert(email);
	   if(email)
	   {
	       $.ajax({
			   type: 'post',
			   url: 'adminreg/condition.php',
			   data: {
			   user_email:email,
			   },
			   success: function (response) {
				  // alert(response);
			   $( '#email_status' ).html(response);
		       if(response=="OK")	
               {
                  return true;	
               }
               else
               {
                  return false;	
               }
             }
		   });


	    }
	    else
	    {
		//	alert('error');
		   $( '#email_status' ).html("");
		   return false;
	    }
	
	}
	
/* 	
function checkpnum()
    {
	   var p_num=document.getElementById( "private_number" ).value;
	//alert(email);
	   if(p_num)
	   {
	       $.ajax({
			   type: 'post',
			   url: 'adminreg/condition.php',
			   data: {
			   private_number:p_num,
			   },
			   success: function (response) {
				  // alert(response);
			   $( '#pnum_status' ).html(response);
		       if(response=="OK")	
               {
                  return true;	
               }
               else
               {
                  return false;	
               }
             }
		   });


	    }
	    else
	    {
		//	alert('error');
		   $( '#email_status' ).html("");
		   return false;
	    }
	
	}	
	 */
$(document).ready(function() {	
	//alert('asdasdsad');

  $('#country').on('change',function(){
//alert('s');    
    var countryID = $(this).val();
		//alert(countryID);
        //if(countryID){
            $.ajax({
                type:'POST',
                url:'adminreg/condition.php',
                data:'country_id='+countryID,
               
				success:function(data){
					// alert(data);
                    $('#state').html(data);
                  //  $('#city').html('<option value="">Select state first</option>'); 
                }
            });
		});	
	


$('#term_con').click(function() {
		//alert($('#term_con').is(":checked"));
		if($('#term_con').is(":checked") == true) {
			$("#register").prop('disabled', false);
		}
		else
		{
			$("#register").prop('disabled', true);
		}	
}); 
	  
$("form#register_form").submit(function(event){
	//alert('asd'); 
	 var formData = new FormData($(this)[0]);
 $.ajax({
    url: 'adminreg/adminreg.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
   // alert(returndata);
   $("#myModal").hide();
	$("#getCode").html(returndata);
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
	<link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
    <style>
	body {
		background: #e1c192 url(loginfiles/wood_pattern.jpg);
		height:100%;
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
				<br>
				<br><br><br>
<a href="doc/user_manual.pdf" target="_blank">
				<button class="col-md-2 btn btn-primary pull-right" style="margin-right:2%;"> User Manual &nbsp;&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i> </button>
				</a>
					<div class="col-md-12 col-xs-12">
					<p style="font-family: 'Russo One', sans-serif;font-size:40px;text-transform: uppercase;color:black;text-align: center;">
					<u>Admin Dashboard </u></p>
					</div>
				</div>
			
				<div class="col-sm-4 col-xm-12">
				</div>
				
				<div class="col-sm-4 col-md-12">
					<form class="form-2" method="post" action="login.php">
						<h1><span class="log-in">Log in</span></h1>
						<p class="float">
							<label for="login"><i class="icon-user"></i>Username</label>
							<!--<input type="text" name="email" placeholder="Username">-->
							<input type="email" class="form-control" name="email" placeholder="Email-ID" autofocus required>
						</p>
						<p class="float">
							<label for="password"><i class="icon-lock"></i>Password</label>
							<input class="showpassword" type="password" class="form-control" name="password" placeholder="Password" required>
						</p>
						<p class="clearfix"> 
								
							<input type="submit" name="submit" value="Log in">
							  <a href="#" data-toggle="modal" data-target="#myModal">
				  	<input type="submit" name="submit" value="Register"> </a>
								<!--<input type="submit" name="submit" value="Register">-->
						</p>
					</form>​​
				</div>
			</div>	
			
			

      
		
	 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-lg" >
      <!-- Modal content-->
      <div class="modal-content" style="background-color:#F7F7F7;">
        <div class="modal-header">
        <!--  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button> -->
			<div class="login_labler"> 
			<span style="font-size:30px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;color:white;letter-spacing: 8px;">
			Register   
			</span>
		  </div>
        </div>
        <div class="modal-body">

		
		

<!--<div id="fn"></div>-->
<!--action="stureg/stureg.php" method="POST"-->
    <form  id="register_form" method="POST" class="form-horizontal form-label-left">
     <!-- <input type="hidden" name="case" value="insert">-->
	  
	  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">College Name <span class="required">*</span></label>
                        <?php 
						//Get all country data
						$get_clg = "SELECT * FROM colleges  ORDER BY college_name ASC ";	
						$clg_d = mysql_query($get_clg) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
						
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select  name="clg_name" id="clg_name" class="form-control select2_single_clg" tabindex="-1" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100%;">
                            <option></option>
                            <?php
							
								while($row=mysql_fetch_array($clg_d)){ 
									echo '<option value="'.$row['id'].'|'.$row['college_name'].'">'.$row['college_name'].'</option>';
								}
							
							?>
                          </select>
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="email" type="email" onkeyup="checkemail();" id="email"  required="required" data-placement="right" data-toggle="tooltip" title="This field is required." class="form-control col-md-7 col-xs-12">
							<span id="email_status"></span>
						</div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Official Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="off_email" type="email" id="off_email"  required="required" data-placement="right" data-toggle="tooltip" title="This field is required." class="form-control col-md-7 col-xs-12">
							<span id="email_status"></span>
						</div>
                      </div>
					  
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Create Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="password" type="password" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Mobile number <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="mobile_number" maxlength="10" name="mobile_number" id="mobile" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Current location <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="current_location" required="required" class="form-control col-md-7 col-xs-12" type="text" data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					 
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Private Number<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="private_number" type="password" required="required" class="form-control col-md-7 col-xs-12" placeholder="Private Number"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        <!--<span id="pnum_status"></span> onkeyup="checkpnum();  id="private_number" "-->
						</div>
					
                      </div>
					  	
					<br>
					  
					  <div class="col-md-7 col-sm-12 col-xs-12">
                          <div class="term_lable"> 
							<span style="font-size:15px;">
							<div class="checkbox">

							<!--class="flat" -->
					<label> <input name="terms_cond" value="yes" type="checkbox" id="term_con" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:18px;height:18px;"/> </label> 
								<span class="text_font">
							 <a href="../t&c.html" target="_blank" style="color:blue;text-decoration:none;">Terms and conditions</a> 
							| <a href="../privacy_policy.html" target="_blank" style="color:blue;text-decoration:none;"> Privacy policy </a> 
								</span>

								
						  </div>
							</span>
							<span class="required">* Mandatory Fields</span>
							</div>
							
					  </div>
						
					
              
<!--			    <button class="btn btn-primary submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">Register Now</span></button>
				
				<button type="reset" class="btn btn-primary submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button	>
				
			 -->

              <div class="clearfix"></div>

	    </div> <!--END OF POPUP-->	
		        <div class="modal-footer">
		<div class="col-md-12 col-xs-12 text-center">
		<div class="col-md-2">
		</div>
		<div class="col-xs-12 col-md-4">
		<button type="submit" class="btn btn-primary submit" style="width:100%;" disabled="disabled" id="register" onclick="formdata();" data-toggle="modal" data-target="#myModal2">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">Register Now</span></button>
		</div>			
		<!--<div class="col-xs-12 col-md-4">
		<button type="reset" class="btn btn-primary submit" style="width:100%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button>
		</div>-->
		<div class="col-xs-12 col-md-4">		
	<a href="login.php" id="close" class="btn btn-primary" style="width:100%;margin-right:30px;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">Close
       </a>
		</div>
		</div>
		</div>
		
	</form>	
      </div>
      
    </div>
  </div>
  
  <div class="modal fade" id="commondialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
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
					 // alert();
					$("#mobile_number").val(this.value.match(/[0-9]*/));
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
          placeholder: "Select a College",
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


