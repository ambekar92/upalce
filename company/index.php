<?php
  
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 
 include('links.php');

?>

        
<style>

.main{
	color:black;
	margin-bottom:8px;

	font-weight: bold;
	
}
.main1{
	color:black;
	margin-bottom:8px;
	text-transform:uppercase;
	font-weight: bold;
}


.notify{
	max-height: 450px;
	overflow-y:auto; 
}

			
.list_data:hover{
	background-color:#d6dbdc;
	border: 2px solid rgba(6, 6, 6, 0.35);
    box-shadow: 2px 2px 6px #bd9d9d;
    cursor: pointer;
}
.list_data{
	border: 1px solid rgba(6, 6, 6, 0.35);	
	box-shadow: 1px 1px 6px #bd9d9d;
}	
			
body .container.body .right_col {
    height: 680px;
}
</style>



  <!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>
	 <!--<h2>Overview of Profile</small></h2>-->


    <div class="x_panel">
        <div class="x_title">
            <h2>Company Details</h2>
            <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
			    <li><a href="profile.php">
			  		<button class="btn btn-warning btn-xs" style="width:90px;">
			  		<i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
			    </li>
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			</ul>
        	<div class="clearfix"></div>
        </div>
		<div class="x_content">
            <div class="col-md-12">
                <div class="row">
				    <div class="col-md-3">
						 <?php if($ad_com_profile_img != '') { ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="<?php echo $ad_com_profile_img; ?>" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						  
						 <?php } else {	 ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="images/1.jpg" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						 <?php } ?>
					</div>

					<div class="col-md-7" style="font-size:16px;">
						<div class="row">
						<div class="col-md-3 col-xs-12">Company Name</div>
						<div class="col-md-9 col-xs-12 main1"> <?php echo $ad_com_comp_name;?> </div>
						</div>
				
					<!-- 	<div class="row">
						<div class="col-md-3 col-xs-12">Mobile Number</div>
						<div class="col-md-6 col-xs-12 main"> <?php //echo $ad_mobile; ?></div>
						</div> -->
			
						<div class="row">
						<div class="col-md-3 col-xs-12">Email ID</div>
						<div class="col-md-6 col-xs-12 main" style="color:black;margin-bottom:8px;"> <?php echo $ad_com_email; ?></div>
						</div>
				
					<!-- 	<div class="row">
						<div class="col-md-3 col-xs-12">Official Email ID</div>
						<div class="col-md-6 col-xs-12 main" style="color:black;margin-bottom:8px;"> <?php echo $off_email; ?></div>
						</div> -->
				
						<div class="row">
						<div class="col-md-3 col-xs-12">Location</div>
						<div class="col-md-6 col-xs-12 main"> <?php echo "$ad_com_current_location, $ad_com_state, $ad_com_country"; ?></div>
						</div>
					</div>
                </div>
		    </div>   
        </div>
    </div><!-- End x_panel -->

   
		
	
	<div style="margin-bottom:0px;"></div>

	<?php include('sup_files/footer.php'); ?>	
	</div> <!-- End right_col -->
	
</body>
</html>