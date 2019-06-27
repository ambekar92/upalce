<!DOCTYPE html>
<html>
<head>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>

<link href='https://fonts.googleapis.com/css?family=Amiri:400,700italic' rel='stylesheet' type='text/css'>

<i><div id="Clock" align="left" style="font-size:25px;margin-left:10px;font-family: 'Amiri', serif;color:white;">&nbsp; </div> </i>

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

  window.setTimeout("tick();", 100);
}

window.onload = tick;
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

			<div class='alert alert-warning'>
			<strong>Warning !!</strong> Enter Username and Password.
			</div>
			<?php
			}
			else
			{	//$username =$_POST['username'];
				$email = mysql_real_escape_string($_POST['email']);
				//$password = mysql_real_escape_string($_POST['password']);
				$password=$_POST['password'];
				$query = mysql_query("select * from su_admin where password='".$password."' AND email='".$email."'");
				/* while ($row=mysql_fetch_array($query)) 
                {                            
                 $_SESSION['email']= $row['email'];
				} */
				if (mysql_num_rows($query) == 1) {
				$_SESSION['super_email'] = $_POST['email'];
				echo "<script> window.location='index.php';</script>";
				}
				else {
				//echo md5($_POST['password'];
				?>
					<div class='alert alert-danger' role="alert">
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

				
				
<!DOCTYPE html>
<html lang="en">

<head>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Super Admin | Login</title>

    <!-- Custom styling plus plugins -->
    <link href="css/login_custom.css" rel="stylesheet">

   
   
     
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  
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

 </style>
  
  
  
</head>

<body style="background-image:url(images/a.jpg);">
  
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
				<p style="font-size:25px;font-family: 'Amiri', serif;color:white;text-transform: uppercase;">Super Admin Dashboard</p>
					<form action="login.php" method="post">
                       <br><br>
                      
						
						<div>
							<input type="email" class="form-control" name="email" placeholder="Email-ID" autofocus required>
						</div>
                        <div>
							<input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div>
                           	<input type="submit" class="btn btn-default submit" name="submit" value="Login" style="width:150px;margin-left:95px;">
                        </div>
                        <div class="clearfix"></div>
                       <!-- <div class="separator">
							
							<p class="change_link">
                                <a href="#toregister" class="to_register" style="font-size:20px;font-family: 'Amiri', serif;color:white;text-decoration: none;"> Forgotten your password? </a>
                            </p>
							
                            <div class="clearfix"></div>
                            <div><br><br>-->
							<h1></h1>
                            
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
				
                <!-- content -->
            </div>
			
			
			
			
			
            <div id="register" class="animate form">
                <section class="login_content">
                   <p style="font-size:25px;font-family: 'Amiri', serif;color:white;text-transform: uppercase;">Super Admin Dashboard</p>
					<form action="login.php#toregister" method="post">
                       <br><br>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Enter your Email ID" required="" />
                        </div>
                        <div>
                           	<input type="submit" class="btn btn-default submit" name="sub_email" value="Forgot Password">
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
							
							<p class="change_link">
                                <a href="#tologin" class="to_register" style="font-size:20px;font-family: 'Amiri', serif;color:white;text-decoration: none;"> Log in </a>
                            </p>
							
                            <div class="clearfix"></div>
                            <div><br><br>
							<h1></h1>
                            
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>