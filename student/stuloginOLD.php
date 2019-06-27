<?php 
session_start();
error_reporting(0);

include('links_old.php'); 


include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');


if(isset($_POST['forgot_email']))
{
	$forgot_email = mysql_real_escape_string($_POST['login_forgot']);
	//echo $forgot_email;die;
	
	//$forgot_email=$_POST["forgot_email"];
	$sql = "SELECT c_pass,firstname FROM stu_student WHERE email = '$forgot_email'";
	//echo $sql;
	$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	$num_rows = mysql_num_rows($result);
 //echo $select;
 while ($row=mysql_fetch_array($result)) 
 {
	  $name=$row['firstname'];
	  $c_pass=$row['c_pass'];
 }	 
 
 //echo $name;
 //echo $c_pass;die;
		if ($num_rows) {
		   $to =''.$forgot_email.'';
		   $subject = "uPLACE - Forgot Password ";
		   $headers = "From: " . strip_tags('uplace_confirmation@uplace.in') . "\r\n";
		   //$headers .= 'CC:'.$cust_email2.''."\r\n";
		   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";
		   $headers .= "Reply-To: ". strip_tags('contact@uplace.in') . "\r\n";
		   $headers .= "MIME-Version: 1.0\r\n";
		   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		   $message = '<html><body>
		   <h3>Dear '.$name.'</h3>
		   <h4>Welcome to <a href="http://www.uplace.in">uPLACE</a>, <br> 
		   As per your request,We are sending your login credentials.</h4>
			<h4>
				Email id : '.$forgot_email.'<br><br>
				Password : '.$c_pass.'
			</h4>			
		   </body></html>';
		  
			
		   if(mail($to, $subject, $message, $headers))
		   {
			  ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<h3 style=font-size:16px;>Login Credentials Sent to Your Email Id.</h3>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
		   }
	}
	else
	{
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<h3 style=font-size:16px;> Your Email Id is Incorrect .. !! </h3>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	
}

// if login session - then redirect to dashboard page
		if(isset($_POST['submit']))
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
			{	//$username =$_POST['username'];
				$email = mysql_real_escape_string($_POST['email']);
				//$password = mysql_real_escape_string($_POST['password']);
				$password=md5($_POST['password']);
				$query = mysql_query("select * from stu_student where password='".$password."' AND email='".$email."'");
				/* while ($row=mysql_fetch_array($query)) 
                {                            
                 $_SESSION['email']= $row['email'];
				} */
				if (mysql_num_rows($query) == 1) {
				$_SESSION['email'] = $_POST['email'];
				echo "<script> window.location='index.php';</script>";
				}
				else {
				//echo md5($_POST['password'];
				?>
					<div class='alert alert-danger' role="alert" style="margin-top:80px;margin-bottom:-60px;">
					   <strong>Warning !!</strong> Username or Password is invalid.
				</div>
				<?php
				} 
				// Closing Connection
			}
		}
		
?>
      <script>
				window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
		    </script>

			  	  <style>
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
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student | Login </title>
<link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
<script type = "text/javascript" language = "javascript">

/* function forgot_pass()
{debugger;
	 //var forgot_e=document.getElementById( "login_forgot" ).value;
	var forgot_e=$('#login_forgot').val();
	 //alert(forgot_e);
	  $.ajax({
			   type: 'post',
			   url: 'stureg/forgot_email.php',
			   data: {
			   forgot_email:forgot_e,
			   },
			   success: function (response) {
				  // alert(response);
			   	$("#getCode").html(response);
				$("#commondialog").modal({backdrop:'static'});
             }
		   });
} */
function checkemail()
{
	
	   var email=document.getElementById( "email" ).value;
	//alert(email);
	   if(email)
	   {
	       $.ajax({
			   type: 'post',
			   url: 'stureg/condition.php',
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
	
	function checkPass()
    {
		//alert();
	   var pass=document.getElementById( "password" ).value;
	   var Cpass=document.getElementById( "Cpassword" ).value;
		if(pass==Cpass){
			$( '#pass_status' ).html("<p style=color:green;>Confirmed</p>");
			return false;
	    }
	    else{
		   $( '#pass_status' ).html("<p style=color:red;>Miss Match Password !!</p>");
		   return false;
	    }
	
	}
	
		function AlertFilesize()
		{		
			var sizeinbytes = document.getElementById('resume_name').files[0].size;
			var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
			fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}
			//alert((Math.round(fSize*100)/100)+' '+fSExt[i]);
			var size=((Math.round(fSize*100)/100));//+' '+fSExt[i]);
			//alert(size);
			if(fSExt[i] =='KB'){
			$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
			}
			else if(size < 3 && fSExt[i] =='MB'){
			$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
			}
			else{
			$('#size').html("<p style='color:red;font-size:14;'><b>File size : "+size+" "+fSExt[i]+" , ( File size must be excately 3 MB )<b></p>");
			}
		}


$(document).ready(function() {		
//alert();
  $('#country').on('change',function(){
//alert('s');    
    var countryID = $(this).val();
		//alert(countryID);
        //if(countryID){
            $.ajax({
                type:'POST',
                url:'stureg/condition.php',
                data:'country_id='+countryID,
                success:function(data){
					//alert(data);
                    $('#state').html(data);
                  //  $('#city').html('<option value="">Select state first</option>'); 
                }
            });
		});	
	
$('#close').click(function() {
		$('#size').hide();
}); 	

/* $('#fn').click(function() {
		$('#fn').hide();
});  */

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
	  
//alert($("form#register_form").val());
	
	//form submiting
$("form#register_form").submit(function(event){
	debugger;
	//alert('asd'); 
	 var formData = new FormData($(this)[0]);
 $.ajax({
    url: 'stureg/stureg.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
		debugger;
    // alert(returndata);
	$("#myModal").hide();
	$("#getCode").html(returndata);
    $("#commondialog").modal({backdrop:'static'});
    }
  });
 
  return false;
});
	 
});
		
		
function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='stulogin.php';
}	


function AlertFilesize()
{		
	var sizeinbytes = document.getElementById('resume_name').files[0].size;
	var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
	
		
	fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}
	//alert((Math.round(fSize*100)/100)+' '+fSExt[i]);
	var size=((Math.round(fSize*100)/100));//+' '+fSExt[i]);
	//alert(size);
	if(fSExt[i] =='KB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	}
	else if(size < 3 && fSExt[i] =='MB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	}
	else{
	$('#size').html("<p style='color:red;font-size:14;'><b>File size : "+size+" "+fSExt[i]+" , ( File size must be excately 3 MB )<b></p>");
	}
		
			var allowedFiles = [".doc", ".docx", ".pdf"];
            var fileUpload = document.getElementById("resume_name");
            var lblError = document.getElementById("lblError");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.value.toLowerCase())) {
                lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                return false;
            }
			else{
            lblError.innerHTML = "";
            return true;
			}
}

      </script>		
		
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
</script>		
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy6mCPYfhsRfisDvH8QlYwETCV4uC4dJs&libraries=places"></script>
	<script>
    function initialize() {
   var input = document.getElementById('curr_loccc');
   var autocomplete = new google.maps.places.Autocomplete(input);
   }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>-->	
 <style>
#create_act:hover  {
 background-color:rgba(255, 165, 0, 0.45);
 font-weight: 900;
}

.login_lable{
padding: 2px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 6px;
    border: 1px solid #192e44;
    background-color: #2A3F54;
    border-radius: 8px;
    <!-- box-shadow: 4px 4px 4px #c58f8f; -->
	margin-bottom:50px;
}

.login_page_lable{
	padding: 2px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 6px;
    border: 2px solid #192e44;
    background-color: rgba(237, 237, 237, 0.67);
    border-radius: 8px;
    box-shadow: 4px 4px 4px #000000;
	margin-bottom:50px;
	width:90%;
	text-align:center;
	margin: auto;
	margin-top:20px; 
}

.login_page_lable1{
	padding: 2px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 6px;
    border: 2px solid #192e44;
    background-color: rgba(17, 208, 20, 0.76);;
    border-radius: 8px;
    box-shadow: 4px 4px 4px #000000;
	margin-bottom:50px;
	width:50%;
	text-align:center;
	margin: auto;
	margin-top:30px; 
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

.term_lable{
    padding-left: 70px;
}
.login_page_labler{
	padding: 2px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 6px;
    border: 2px solid #192e44;
    background-color: rgba(170, 220, 255, 0.74);
    border-radius: 8px;
    box-shadow: 4px 4px 4px #000000;
	margin-bottom:-20px;
	width:90%;
	text-align:center;
	margin: auto;
	margin-top:30px; 
}

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
 </style>


</head>
<!--
<a href="http://www.uplace.in" class="navbar-left hidden-xs"><img src="images/logo.jpg" style="width:130px;border-radius:5px;box-shadow: 1px 1px 18px white;"></a>
-->
  <body class="login" style="background-image: url(images/stu_back.jpg);height:100%">
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
				<div id="Clock_time" style="font-size: 25px;background-color: white;font-family: -webkit-pictograph;color: black;">&nbsp; </div>
			</div>
		</div>
</nav>

<br><br><br>
<a href="doc/student_manual.pdf" target="_blank">
<button class="col-md-2 btn btn-warning pull-right" style="margin-right:2%;margin-top:1%;"> User Manual &nbsp;&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i> </button>
</a>
    <div style="height:auto;">
	  
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

	 
      <div class="login_wrapper">
	  
	   <div class="animate login_form col-md-12 hidden-md" style="margin-top:-10px;"> <!-- background-color:rgba(165, 132, 61, 0.42); -->
          <section class="login_content" 
		  style="box-shadow: 0px 0px 40px white;border:2px solid black;padding-left:20px;padding-right:20px;border-radius:10px;background-color:#F7F7F7;">
		
		<div class="login_lable"> 
			<span style="font-size:30px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;color:white;letter-spacing: 8px;">STUDENT LOGIN </span>
		  </div>
            <form action="stulogin.php" method="post" enctype="multipart/form-data">
			
				<div style="margin-bottom: 18px;width:80%;margin-left:30px;" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="login-username" type="email" class="form-control" name="email" value="" placeholder="Email-ID" autofocus required>                                        
				 </div>
                                
				<div style="margin-bottom: 25px;width:80%;margin: auto;" class="input-group">
							<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
							<input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
							
				</div>  
				
				<br><a class="reset_pass" href="#signup">Forgot Password ?</a><br><br>
              
			    <button type="submit" class="btn btn-default submit" name="submit" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none; text-transform:uppercase;">LOGIN</span></button>
				
				<button type="reset" class="btn btn-default submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button	>
				
			 

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site? </p>
                <!--   <a href="#signup" class="to_register"> Create Account </a> --><br>
				<!--StuSignup.php-->
				  <a class="btn btn-default" href="#" style="width:80%;" id="create_act" data-toggle="modal" data-target="#myModal">
				  <span style="font-size:25px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;">Create Account</span></a>
                </p>

                <div class="clearfix"></div>
                <br />

	
				
				
             <!--    <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
        </div>
		
		
        <div class="animate form login_form hidden-xs" style="width:150%;margin-left:-90px;margin-top:-30px;"> <!-- background-color:rgba(165, 132, 61, 0.42); -->
          <section class="login_content" 
		  style="box-shadow: 0px 0px 40px white;border:2px solid black;padding-left:20px;padding-right:20px;border-radius:10px;background-color:#F7F7F7;height: 530px; !important;">
		
		<div class="login_lable"> 
			<span style="font-size:30px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;color:white;letter-spacing: 8px;">STUDENT LOGIN </span>
		  </div>
            <form action="stulogin.php" method="post" enctype="multipart/form-data">
			
				<div style="margin-bottom: 18px;width:60%;margin-left:20%;" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="login-username" type="email" class="form-control" name="email" value="" placeholder="Email-ID" autofocus required>                                        
				 </div>
                                
				<div style="margin-bottom: 25px;width:60%;margin: auto;" class="input-group">
							<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
							<input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
							
				</div>  
				
				<br><a class="reset_pass" href="#signup">Forgot Password ?</a><br><br>
              
			    <button type="submit" class="btn btn-default submit" name="submit" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none; text-transform:uppercase;">LOGIN</span></button>
				
				<button type="reset" class="btn btn-default submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button	>
				
			 

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site? </p>
                <!--   <a href="#signup" class="to_register"> Create Account </a> --><br>
				<!--StuSignup.php-->
				  <a class="btn btn-default" href="#" style="width:80%;" id="create_act" data-toggle="modal" data-target="#myModal">
				  <span style="font-size:25px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;">Create Account</span></a>
                </p>

                <div class="clearfix"></div>
                <br />

	
				
				
             <!--    <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="fname" type="text"  required="required" data-placement="right" data-toggle="tooltip" title="This field is required." class="form-control col-md-7 col-xs-12" autofocus>
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">University / College Name <span class="required">*</span></label>
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Student USN <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="usn" required="required" class="form-control col-md-7 col-xs-12" type="text"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					  
					  <!--<div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="username" type="text" id="first-name" required="required" placeholder="Login username" class="form-control col-md-7 col-xs-12" data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>-->
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="password" id="password" type="password" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="Cpassword" onkeyup="checkPass();" id="Cpassword" type="password" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
							<span id="pass_status"></span>
						</div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Mobile number <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="mobile" id="mobile" maxlength="10" required="required" class="form-control col-md-7 col-xs-12"  data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons" style="float:left;">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" required="required" value="male" data-placement="right" data-toggle="tooltip" title="This field is required."> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="female"> Female
                            </label>
                          </div>
                        </div>
                      </div>
					  
                   
                     <!-- <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div> -->
                      
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
                          <input name="curr_loc" required="required" class="form-control col-md-7 col-xs-12" type="text" data-placement="right" data-toggle="tooltip" title="This field is required.">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Upload Resume <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <!--  <input type="file" name="resume_name"   id="resume_name" required="required" class="form-control col-md-7 col-xs-12" onchange="AlertFilesize();"/>
						  (upload only .pdf, .docx and .doc)  <div id="size"></div>-->
						  
						   <input type="file" name="resume_name" value="<?php echo $stu_resume_name; ?>"  id="resume_name" class="form-control col-md-7 col-xs-12" onchange="AlertFilesize();"/>
						<span>(upload only .doc, .docx and .pdf)  </span>
							 <div id="size"></div>
							  <span id="lblError" style="color:red;font-size:13px;"></span>
                        </div>
                      </div>
					  
					<br>
					  
					  <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="term_lable"> 
							<span style="font-size:15px;">
							<div class="checkbox">

							<!--class="flat" -->
				<label> <input name="term_con" value="yes" type="checkbox" id="term_con" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:18px;height:18px;"/> </label> 
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
		<button type="submit" class="btn btn-primary submit" style="width:100%;" disabled="disabled" id="register" data-toggle="modal" data-target="#myModal2">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">Register Now</span></button>
		</div>			
		<!--<div class="col-xs-12 col-md-4">
		<button type="reset" class="btn btn-primary submit" style="width:100%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button>
		</div>-->
		<div class="col-xs-12 col-md-4">		
	<a href="stulogin.php" id="close" class="btn btn-primary" style="width:100%;margin-right:30px;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">Close
       </a>
		</div>
		</div>
		</div>
		
	</form>	
      </div>
      
    </div>
  </div>				
		
		
<!-- popup message display here -->
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

	<div id="register" class="animate form registration_form">
         <section class="login_content" 
		  style="box-shadow: 0px 0px 40px white;border:2px solid black;padding-left:20px;padding-right:20px;border-radius:10px;background-color:white;">
		
			<div class="login_lable"> 
			<span style="font-size:30px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;color:white;letter-spacing: 8px;">
			Forgot Password </span>
		  </div>
		  
             <form action="stulogin.php" method="post">
			<br>
				<div style="margin-bottom: 18px;width:80%;margin-left:10%;" class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" id="login_forgot"  name="login_forgot" placeholder="Enter your Email-ID" autofocus required>                                        
				 </div>
                                
				    
			    <button type="submit" class="btn btn-default submit" name="forgot_email" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">SUMBIT</span></button>
				  
				  <button type="reset" class="btn btn-default submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button	>
			<!-- 	
				<button type="reset" class="btn btn-default submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;">CLEAR</span></button	>
				 -->
			 

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link"><!-- New to site? -->
                <!--   <a href="#signup" class="to_register"> Create Account </a> --><br>
				
				  <a class="btn btn-default submit" href="#signin" style="width:80%;" id="create_act">
				  <span style="font-size:25px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;">Back to Login</span></a>
				
				  
                </p>

                <div class="clearfix"></div>
                <br />
					
             <!--    <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
        </div>
      
	  
		<!-- Forgot Password -->
        <div id="register" class="animate form registration_form hidden-xs" style="width:150%;margin-left:-90px;">
         <section class="login_content" 
		  style="box-shadow: 0px 0px 40px white;border:2px solid black;padding-left:20px;padding-right:20px;border-radius:10px;background-color:white;height: 410px; !important;">
		
			<div class="login_lable"> 
			<span style="font-size:30px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;color:white;letter-spacing: 8px;">Forgot Password </span>
		  </div>
		  
               <form action="stulogin.php" method="post">
			<br>
				<div style="margin-bottom: 18px;width:80%;margin-left:10%;" class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" id="login_forgot"  name="login_forgot" placeholder="Enter your Email-ID" autofocus required>                                        
				 </div>
                                
				    
			    <button type="submit" class="btn btn-default submit" name="forgot_email" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">SUMBIT</span></button>
				  
				  <button type="reset" class="btn btn-default submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;text-transform:uppercase;">CLEAR</span></button	>
			<!-- 	
				<button type="reset" class="btn btn-default submit"  href="index.html" style="width:30%;">
				  <span style="font-size:15px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;">CLEAR</span></button	>
				 -->
			 

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link"><!-- New to site? -->
                <!--   <a href="#signup" class="to_register"> Create Account </a> --><br>
				
				  <a class="btn btn-default submit" href="#signin" style="width:80%;" id="create_act">
				  <span style="font-size:25px;font-family:Palatino Linotype,Book Antiqua, Palatino, serif;text-shadow: none;">Back to Login</span></a>
				
				  
                </p>

                <div class="clearfix"></div>
                <br />
					
             <!--    <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
        </div>
		
		
		
    </div>
	</div>
	

		
		
		 <!-- Select2 -->
    <script>
      $(document).ready(function() {
		  
	   $("#mobile").keyup(function() {
			 // alert();
			$("#mobile").val(this.value.match(/[0-9]*/));
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
      });
    </script>

    <script>
      $(document).ready(function() {
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
      });
    </script>
		
		    <script>
      $(document).ready(function() {
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
      });
    </script>
    <!-- /Select2 -->	
	
  </body>
</html>