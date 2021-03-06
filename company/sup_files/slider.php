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

    <title>Company | Admin</title>

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
    <!-- date picker -->
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">

	    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">	
	
	
	
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

.table > thead > tr >th{
  background-color: #2a3f54;
  color: white;
}
  </style>
	
  </head>

  <body class="nav-sm">
    <div class="container body">
      <div class="main_container">
	  
<div class="col-md-3 left_col hidden-print">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title">
        <img src="images/icon_1.jpg" style="height:45px;width:45px;border-radius:10px;border:2px solid blue;"/> 
        <b>UPLACE</b></a>
            </div>

            <div class="clearfix"></div>

          <div class="profile">
              <div class="profile_pic">
			  <?php 
				if(($ad_com_profile_img)=='')
				{?>
					 <img src="images/1.jpg" alt="..." class="img-circle profile_img">
                  </a>
				 <?php 
				}
				else
				{?>
              <img src="<?php echo $ad_com_profile_img; ?>" alt="..." class="img-circle profile_img" style="height:55px;">
				<?php
				}
				?>
			 
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
              </div>
            </div>
      
            <br />

         <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			
              <div class="menu_section">
                <h3 style="margin-top: 80px;">General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i>Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Dashboard</a></li>
                      <li><a href="college_list.php">List of College</a></li>
                    </ul>
                  </li>

                  <li>
                    <a><i class="fa fa-briefcase"></i>Post Job <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fresher.php">Freshers</a></li>
                      <!-- <li><a href="graduated.php">Graduated</a></li> -->
                      <!-- <li><a href="experience.php">Experienced</a></li> -->
                      <li><a href="internship.php">Internship</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-database"></i>Database <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="student.php">Freshers & Graduated</a></li>
                     <!--  <li><a href="index6.php">Experienced </a></li> -->
                    </ul>
                  </li>

                  <li><a><i class="fa fa-file-text"></i>Job Application <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fresherApp.php">Jobs Details</a></li>
                      <!-- <li><a href="graduatedApp.php">Graduated</a></li> -->
                      <!-- <li><a href="experienceApp.php">Experience</a></li> -->
                      <!-- <li><a href="internshipApp.php">Internship</a></li> -->
                    </ul>
                  </li>

                  <!-- <li><a><i class="fa fa-user"></i>Placement Officer <span class="fa fa-chevron-down"></span> </a>
                    <ul class="nav child_menu">
                      <li><a href="college_hr.php">List</a></li>
                      <li><a href="index8.php">Request</a></li>
                    </ul>
                  </li> -->

                </ul>
              </div>
            </div>
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
         </div>
        </div>