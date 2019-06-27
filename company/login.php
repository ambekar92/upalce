	 
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

				$Query="SELECT * FROM  su_active_companies WHERE private_number=(SELECT private_number FROM ad_companies WHERE email='$email')";
				$p_num = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
				while($row=mysql_fetch_array($p_num)) 
				{
					$status=$row['status']; 
				}
					
					if($status=='active'){
						$password=md5($_POST['password']);
						$query = mysql_query("select * from ad_companies where password='".$password."' AND email='".$email."'");
						if (mysql_num_rows($query) == 1) {
								$_SESSION['company_email'] = $_POST['email'];
								echo "<script> window.location='index.php';</script>";	
							} else {
								?>
								<div class='alert alert-danger' role="alert" style="margin-top:80px;margin-bottom:-60px;">
							 		 <strong>Warning !!</strong> Username or Password is invalid.
								</div>									
					<?php
							} 							
					}else {	?>		
						<div class='alert alert-info' role="alert" style="margin-top:80px;margin-bottom:-60px;">
							   <strong>Warning !!</strong> Your Account is not Activated.
						</div>
					<?php
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

$(document).ready(function() {	
	//alert('asdasdsad');

  
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
		background: #e1c192 url(loginfiles/wood_pattern.jpg);
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
					<div class="col-md-12 col-xs-12">
					<p style="font-family: 'Russo One', sans-serif;font-size:40px;text-transform: uppercase;color:black;text-align: center;">
					<u>Company Dashboard </u></p>
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
							  <a href="register.php" >
				  			<input type="button" name="submit" value="Register"> </a>
								<!--<input type="submit" name="submit" value="Register">-->
						</p>
					</form>​​
				</div>
			</div>	
			
			

		
		<!-- jQuery if needed -->
       <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
		<script type="text/javascript">
			$(function(){
					
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
  
	</script>

</body>

</html>


