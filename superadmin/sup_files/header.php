
 <?php
 
// session_start();
//error_reporting(0);
include("db.php");
?>



<link href="css/editor.css" type="text/css" rel="stylesheet"/>


	
	<style>
.fileinput-button {
    background: none repeat scroll 0 0 #eeeeee;
    border: 1px solid #e6e6e6;
	   
}

.attachment-mail {
    margin-top: 30px;
}
.attachment-mail ul {
    display: inline-block;
    margin-bottom: 30px;
    width: 100%;
}
.attachment-mail ul li {
    float: left;
    margin-bottom: 10px;
    margin-right: 10px;
    width: 150px;
}
.attachment-mail ul li img {
    width: 100%;
}
.attachment-mail ul li span {
    float: right;
}
.attachment-mail .file-name {
    float: left;
}
.attachment-mail .links {
    display: inline-block;
    width: 100%;
}

.fileinput-button {
    float: left;
    margin-right: 4px;
    overflow: hidden;
    position: relative;
}
.fileinput-button input {
    cursor: pointer;
    direction: ltr;
    font-size: 23px;
    margin: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    transform: translate(-300px, 0px) scale(4);
}
.fileupload-buttonbar .btn, .fileupload-buttonbar .toggle {
    margin-bottom: 5px;
}
.files .progress {
    width: 200px;
}
.fileupload-processing .fileupload-loading {
    display: block;
}

</style>

<script>

$("#txtEditor").Editor();

</script>



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
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridModalLabel">New Message</h4>
		</div>
		<div class="modal-body">
		<form class="form-horizontal" role="form">
           <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">To :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="text" placeholder="To" class="form-control">
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">CC :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="text" placeholder="Cc" class="form-control">
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">BCC :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="text" placeholder="Bcc" class="form-control">
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Subject :</label>
            <div class="col-sm-10 col-xs-12">
              <input type="text" placeholder="Subject" class="form-control">
            </div>
          </div>
		  
		   <div class="form-group">
			   <label class="col-sm-2 control-label" for="textinput">Message :</label>
				<div class="col-sm-10 col-xs-12">
				   <textarea rows="10" cols="30" placeholder="Message" class="form-control" id="txtEditor" name="txtEditor"></textarea>
				</div>
				
           </div>
		
		    <div class="form-group">
				  <div class="col-lg-offset-2 col-lg-10">
					  <span class="btn green fileinput-button">
						<i class="fa fa-plus fa fa-white"></i>
						<span> Attachment</span>
						<input type="file" name="files[]" multiple="">
					  </span>
					  
				  </div>
			  </div>
		  
         
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<input type="reset" class="btn btn-warning" value="Reset" >
			<button type="submit" class="btn btn-primary">Send Mail</button>
		</div>
		 </form>
    </div>
  </div>
</div>


 <!-- top navigation -->
        <div class="top_nav hidden-print">
          <div class="nav_menu">
            <nav>
			
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
               <!-- <a href="<?php //echo $_SERVER['REQUEST_URI']; ?>">sd</a>-->
				
              </div>
			
			
			 <ul class="nav navbar-nav hidden-xs">
                    <!--<li><a href="javascript:void(0);" onclick="toggleFullScreen();">	<i class="fa fa-expand"></i>  </a></li>-->
					<!--<li><a href="index.php">	<i class="fa fa-home"></i>  </a></li>-->
					<li> <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-lg">	<i class="fa fa-envelope"></i>  </a> </li>
			 </ul>		
		
			
			
              <ul class="nav navbar-nav navbar-right">
                <li class="">
				<?php 
				if(($su_profile_img)=='')
				{?>
					 <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/1.jpg" alt=""> <b><?php echo $su_username;?> </b> &nbsp;
                    <span class=" fa fa-angle-down"></span>
                  </a>
				 <?php 
				}
				else
				{?>
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $su_profile_img; ?>" alt="" style="border:1px solid black;"> <b><?php echo $su_username;?> </b> &nbsp;
                    <span class=" fa fa-angle-down"></span>
                  </a>
				<?php
				}
				?>
				
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li> <a href="profile.php"><i class="fa fa-user  pull-right"></i> Profile</a></li>
					<li class="hidden-lg hidden-md"> <a href="index.php">	<i class="fa fa-home  pull-right"></i> Home </a> </li>
					<li class="hidden-lg hidden-md"> <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-lg">	<i class="fa fa-envelope  pull-right"></i> Write Mail </a> </li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!--<li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li> --> 
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->