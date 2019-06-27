 <?php
 
// session_start();
//error_reporting(0);
include("db.php");
?>
 

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SuperAdmin | Home</title>


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



 <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">

	    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">	
	
	

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
	  
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Company</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
			  <?php 
				if(($su_profile_img)=='')
				{?>
					 <img src="images/1.jpg" alt="..." class="img-circle profile_img">
                  </a>
				 <?php 
				}
				else
				{?>
                    <img src="<?php echo $su_profile_img; ?>" alt="..." class="img-circle profile_img" style="height:55px;">
				<?php
				}
				?>
			 
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $su_username; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			
              <div class="menu_section">
                <h3 style="margin-top: 80px;">General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i>Admin Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Dashboard</a></li>
					  <li><a href="country.php">Country</a></li>
                      <li><a href="state.php">States</a></li>
                      <li><a href="web_notify.php">Website Notification</a></li>
                    </ul>
                  </li>
				
				   <li><a><i class="fa fa-university"></i>College <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                   	  <li><a href="branchs.php">List of Branch</a></li>
                      <li><a href="college.php">List of College</a></li>
                      <li><a href="active_clg.php">Activate College</a></li>
                      <li><a href="register_clg.php">Register Colleges</a></li>
                    </ul>
                  </li>
				  
          <li><a><i class="fa fa-building-o"></i>Companies <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="companies.php">List of Companies</a></li>
                      <li><a href="active_companies.php">Activate Companies</a></li>
                      <li><a href="register_companies.php">Register Companies</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i>Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="student.php">Student Records</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-users"></i>Experience<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="experience.php">Experience Records</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-book"></i>Details <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="college_info.php">College Info</a></li>
                      <li><a href="student_info.php?college_id=119875">Student Info</a></li>
                    </ul>
                  </li>


                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
             
              <a data-toggle="tooltip" data-placement="top">
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
              </a>
			  <a href="index.php" data-toggle="tooltip" data-placement="top">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
              </a>
              <a href="profile.php" data-toggle="tooltip" data-placement="top" title="Profile">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
			   <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>