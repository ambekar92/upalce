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

    <title>Student | Home</title>

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

    <link rel="icon" type="image/png" sizes="192x192" href="images/android-icon-192x192.png">
    <style>
        /* Let's get this party started */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: rgba(56, 116, 228, 0.8);
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(255, 0, 0, 0.4);
        }


        .x_panel {
            border: 1px solid #c5b7b7 !important;
            box-shadow: 1px 1px 6px 0px #736e6e;
        }

        .x_title {
            border-bottom: 1px solid #949090;
        }
    </style>


</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php" class="site_title">
                            <img src="images/icon_1.jpg" style="height:45px;width:45px;border-radius:10px;border:2px solid blue;" />
                            <span><b>UPLACE</b></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <?php 
				if(($stu_profile_img)=='')
				{?>
                            <img src="images/1.jpg" alt="..." class="img-circle profile_img">
                            </a>
                            <?php 
				}
				else
				{?>
                            <img src="<?php echo $stu_profile_img; ?>" alt="..." class="img-circle profile_img" style="height:55px;">
                            <?php
				}
				?>

                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>
                                <?php echo $stu_firstname; ?>
                            </h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3 style="margin-top: 80px;">General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i>Candidate Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <!--  <li><a href="index.php">Dashboard</a></li>-->
                                        <li><a href="index.php">Profile Quick Look</a></li>
                                        <li><a href="profile_summary.php">Profile Summary</a></li>
                                        <li><a href="stu_education.php">Education</a></li>
                                        <li><a href="stu_projects.php">Projects</a></li>
                                        <li><a href="skills.php">Skills</a></li>
                                        <li><a href="stu_prof_experience.php">Professional Experience</a></li>
                                        <li><a href="resume_upload.php">Attach/Update Resume</a></li>
                                        <li><a href="cover_letter.php">Cover Letter</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i>Invention / Project Link <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="links_projects.php">Add a Link</a></li>
                                        <!-- <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>-->
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-table"></i>Job Management <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="jobs.php">Jobs</a></li>
                                        <li><a href="interJob.php">Internships</a></li>
                                        <!--                    <li><a href="default.php">Saved Jobs</a></li> -->
                                        <li><a href="applied_jobs.php">Applied Jobs</a></li>
                                    </ul>
                                </li>
                                <li><a href="miscellaneous.php"><i class="fa fa-cubes"></i>Miscellaneous
                                        <!--<span class="fa fa-chevron-down"></span>--></a>
                                    <!--<ul class="nav child_menu">
                      <li><a href="chartjs.html">Languages Known</a></li>
                      <li><a href="chartjs2.html">Job Search Option</a></li>
                      <li><a href="morisjs.html">Desired Employement Type</a></li>
                      <li><a href="echarts.html">Physically Challenged (Description)</a></li>
                      <li><a href="other_charts.html">Work Authorization</a></li>
                    </ul>-->
                                </li>
                                <!--<li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>-->
                            </ul>
                        </div>
                        <!--<div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>
			  #2A3F54 (header)
			  
			  #F7F7F7(light color)
			  #EDEDED (dark)
-->
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