<?php
 
// session_start();
//error_reporting(0);
include("db.php");


?>

<style>
    .list_data:hover{
	background-color:#d6dbdc;
	height: 100px; 
	border: 2px solid rgba(6, 6, 6, 0.35);
    box-shadow: 2px 2px 6px #bd9d9d;
    cursor: pointer;
}
.list_data{
	border: 1px solid rgba(6, 6, 6, 0.35);	
	box-shadow: 1px 1px 6px #bd9d9d;
}	
			
</style>
<div class="modal fade" id="commondialog_project11" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h5 class="modal-title" id="myModalLabel">Notification Details</h5>
            </div>
            <div class="modal-body" id="getCode_project11">
                <!-- passing value form script-->
            </div>
            <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">

                <input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;"
                    value="Close" />
                <!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="commondialog_project112" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h5 class="modal-title" id="myModalLabel">Notification Details</h5>
            </div>
            <div class="modal-body" id="getCode_project112">
                <!-- passing value form script-->
            </div>
            <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">

                <input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;"
                    value="Close" />
                <!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="commondelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h5 class="modal-title" id="myModalLabel">Message</h5>
            </div>
            <div class="modal-body">
                <!-- passing value form script-->
                Are You Sure To Delete This Record !!
            </div>
            <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">

                <div id="seldelete"></div>
                <!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="commondialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h5 class="modal-title" id="myModalLabel">Message</h5>
            </div>
            <div class="modal-body" id="getCode">
                <!-- passing value form script-->
            </div>
            <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
                <input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;"
                    value="Close" />
                <!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
            </div>
        </div>
    </div>
</div>



<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                <!-- <a href="<?php //echo $_SERVER['REQUEST_URI']; ?>">sd</a>-->

            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <?php 
				if(($stu_profile_img)=='')
				{?>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/1.jpg" alt=""> <b>
                            <?php echo $stu_firstname;?> </b> &nbsp;
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <?php 
				}
				else
				{?>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $stu_profile_img; ?>" alt="" style="border:1px solid black;"> <b>
                            <?php echo $stu_firstname;?> </b> &nbsp;
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <?php
				}
				?>
                    <?php if($type=='student') {?>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="profile.php"> Profile</a></li>
                        <!--<li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>-->
                        <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <!-- Notification is in Links.php page -->

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span class="badge bg-blue"><span id="notify_count"></span></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="height:500%;overflow-y:scroll;">
                        <div id="notify_list"></div>
                    </ul>
                </li>
                <?php } else { ?>

                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php"> Profile</a></li>
                    <!--<li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>-->
                    <li><a href="exp_logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
                </li>

                <!-- Notification is in Links.php page -->

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span class="badge bg-blue"><span id="notify_count_exp"></span></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="height:500%;overflow-y:scroll;">
                        <div id="notify_list_exp"></div>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->