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

.tile_stats_count{
	background-color: #1b3f63;
    padding: 10px !important;
    border-radius: 5px;    
    box-shadow: -1px 2px 14px 0px #080808;
}



.tile_count .tile_stats_count:before{
	border-left:0px;
}

.green {
    color: #fdfdfd;
}
.count1{
	font-size:30px !important;
}

</style>

<script type="text/javascript">

var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.home={

getOverview:function(){   
 debugger;  
  
  var url="ajax/getData.php";
  var myData={overviewReport:"overviewReport"};

       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){

			if(obj.data!=null){
				$('#fresher_count').html(obj.data.fresher);
				$('#experience_count').html(obj.data.experience);
				$('#internship_count').html(obj.data.internship);
				$('#college_count').html(obj.data.college);
			}else{
				$('#fresher_count').html(0);
				$('#experience_count').html(0);
				$('#internship_count').html(0);
				$('#college_count').html(0);
			}// else End here  

          }// ajax success ends
        });   
}

};


$(document).ready(function(){
  $('#comp_id').val(<?php echo $ad_com_id; ?>);
  tempData.home.getOverview();
});
</script>


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

 <!-- top tiles -->

          <div class="row tile_count headerCount">
         
            <div class="col-md-3 col-sm-3 col-xs-12 ">
			<div class="col-md-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-bell"></i> Fresher</span>
            <div>
			  <span id="fresher_count" class="count green"></span>
			  <!-- <span style="font-size:50px;">&#47;</span>
			  <span id="student_count" class="count1 green">19</span> -->
			</div>
              <span class="count_bottom">Job Posted</span>
            </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 ">
			<div class="col-md-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-bell"></i> Experience</span>
			<div>
			  <span id="experience_count" class="count green"></span>
			  <!-- <span style="font-size:50px;">&#47;</span>
			  <span id="student_count" class="count1 green">19</span> -->
			</div>
              <span class="count_bottom">Job Posted</span>
            </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 ">
			<div class="col-md-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-bell"></i> Internship</span>
			<div>
			  <span id="internship_count" class="count green"></span>
			  <!-- <span style="font-size:50px;">&#47;</span>
			  <span id="student_count" class="count1 green">19</span> -->
			</div>
              <span class="count_bottom">Job Posted</span>
            </div>
            </div>

			<div class="col-md-3 col-sm-3 col-xs-12 ">
			<div class="col-md-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-bell"></i> College</span>
			<div>
			  <span id="college_count" class="count green"></span>
			  <!-- <span style="font-size:50px;">&#47;</span>
			  <span id="student_count" class="count1 green">19</span> -->
			</div>
              <span class="count_bottom">Applied for Job</span>
            </div>
            </div>

			
          </div>
          <!-- /top tiles -->
   
		
	
	<div style="margin-bottom:0px;"></div>

	<?php include('sup_files/footer.php'); ?>	
	</div> <!-- End right_col -->
	
</body>
</html>
