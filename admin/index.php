<?php
  
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 
 include('links.php');

?>

<link rel="stylesheet" href="../build/amcharts/style.css" type="text/css">
<script src="../build/amcharts/amcharts.js" type="text/javascript"></script>
<!-- Clock -->
<script src="../build/amcharts/gauge.js" type="text/javascript"></script>
<!-- pie Chart-->
<script src="../build/amcharts/pie.js" type="text/javascript"></script>
<!-- Cylinder-->
<script src="../build/amcharts/serial.js" type="text/javascript"></script>
	<!-- Export plugin includes and styles -->
<script src="../build/amcharts/plugins/export/export.js"></script>
<link  type="text/css" href="../build/amcharts/plugins/export/export.css" rel="stylesheet">
        

<script type="text/javascript">

function checkStatusAll(){
	debugger;
   var barnchName= $("#branchs :selected").text();
	if(barnchName=='All'){  // 138 id = refers in For All Branchs
		$('#notify_year').prop('disabled', true);
		$('#notify_year').val('0')
	}else{
		$('#notify_year').prop('disabled', false);
	}
}	

function loadGraph(){
		debugger;
	var year=document.getElementById("year").value;
	var ad_clg_id=<?php echo $ad_clg_id; ?>;

	var url='adminreg/graphDetails.php';
      var myData = {graph_one:1122,year:year,ad_clg_id:ad_clg_id};
        $.ajax({
          type:"POST",
          url:url,
          async: false,
          dataType: 'json',
          data:myData,
          success: function(obj){
				
				//alert(chartData);
			var chart;
            var legend;
			var chartData =obj;
			debugger;
			//alert(chartData);
				setTimeout(function(){ 
			if(chartData==0){
				//alert(chartData);
				$('#chart_empty').hide();
				$('#chart_info').show();
			}else{
				$('#chart_empty').show();
				$('#chart_info').hide();
				
							
						var chart = AmCharts.makeChart( "chartdiv_2", {
							"type": "pie",
							"titles": [{
								"text": "Branchs and Students Analytical Graph",
								"size": 20
							}],
							"dataProvider":chartData,
							"valueField": "Students",
							"titleField": "Branch",
							"startEffect": "elastic",
							"startDuration": 2,
							"labelRadius": 15,
							"innerRadius": "50%",
							"depth3D": 10,
							"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
							"angle": 15,
							"legend": {
								"position": "right"
							},
							"export": {
								"enabled": true,
								"menu": [ {
									"class": "export-main",
									"menu": [ {
										"label": "Download",
										"menu": [ "PNG", "JPG", "CSV" ]
									}, {
										"label": "Annotate",
										"action": "draw",
										"menu": [ {
											"class": "export-drawing",
											"menu": [ "PNG", "JPG", "CANCEL" ]
										} ]
									} ]
								} ]
							}
						});
						
						}
			}, 200);			
			            
			
			}
		  });
		}

//Sent Notification Lists
function load_notify(){
	//alert();
$.ajax({
    url: 'adminreg/notification.php?notify_list=data&admin_id='+<?php echo $ad_id?>,
    type: 'GET',
    success: function (returndata) {
	//	alert(returndata);
     /*function is call to header.php (Bootstrap model popup)*/
	$("#notify_list").html(returndata);
  
    }
  });
}

function loadYears(){
	debugger;
	//var year=document.getElementById("year").value;
 			var date = new Date();
			var year = date.getFullYear();

	var url='adminreg/graphDetails.php';
      var myData = {getYears:1122,year:year};
        $.ajax({
          type:"POST",
          url:url,
          async: false,
          dataType: 'json',
          data:myData,
          success: function(obj){
          	debugger;
          	for(var i=0;i<obj.years.length;i++)
            {
                var opt = new Option(obj.years[i]);
                 $("#year").append(opt);

                 var opt2 = new Option(obj.years[i]);
                 $("#notify_year").append(opt2);
             }

			$('#year').val(year);
			$('#notify_year').val(year);

          }
      });
}

$(document).ready(function() {
debugger;

loadYears();
load_notify();
//loadGraph();

	  $('#notify_form').submit(function(e) {
                e.preventDefault();
		debugger;
		 var formData = new FormData(this);
		var sub=$('#notify_subject').val();
		var msg=$('#notify_msg').val();;
console.log(formData);

		if(sub != '' && msg !='')
		{
		$(".progress").show();
		 $.ajax({
		    url: 'adminreg/notification.php',
		    type: 'POST',
		    data: formData,
		    //async: false,
		    cache: false,
            contentType: false,
            processData: false,
		    success: function (returndata) {
			    //alert(returndata);
				load_notify();
				$(".progress").hide(); 
				$('#notify_subject').val('');
				$('#notify_msg').val('');
				$("#getCode_Dreload").html("<p style='color:green'>"+returndata+"</p>");
			    $("#commondialog_Dreload").modal({backdrop:'static'});
		    }
		  });
		 

		}else{
			$("#status").html('<p style="color:red;font-size:12px;"><b>*Text field is Mandatory</b></p>');
		}
	});

});

function validate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
       $('#img_status').html('&nbsp;&nbsp;&nbsp; <img src=images/delete.png style="height:20px;"> &nbsp;&nbsp;File Extension Error : jpg, png, gif.');
       $("#attchFile").val("");
    }else{
    	$('#img_status').html('&nbsp;&nbsp;&nbsp; <img src=images/confirm.png style="height:20px;">');
    }
}
	 
</script>


<div class="modal fade" id="commondialog_project" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <h5 class="modal-title" id="myModalLabel">Notification Details</h5>
		   </div>
				 <div class="modal-body">
				 <div id="getCode_project"></div>
				  <!-- passing value form script-->

				 </div>
				 <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;border-top: none !important;">
				 <!-- <input type="button" class="btn btn-default" data-dismiss="modal" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/> -->
				</div>
		  
    </div>
  </div>
</div>

<div class="modal fade" id="commondialog_Dreload" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Notification Details</h5>
		   </div>
				 <div class="modal-body" id="getCode_Dreload">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
		 
			<input type="button" class="btn btn-default" data-dismiss="modal" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>


  <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

                 <!--<div class="row top_tiles">
                        
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cube"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>Devices</h3>
                                <p>Number of Devices</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cube"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>Devices</h3>
                                <p>Number of Devices</p>
                            </div>
                        </div>
                       
                    </div>-->

    <div class="clearfix"></div>
	 <!--<h2>Overview of Profile</small></h2>-->

            <div class="x_panel">
                  <div class="x_title">
                    <h2>University / College Details</small></h2>
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
				     <li><a href="profile.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content">
               
			   <div class="col-md-12">
                     <div class="row">
						 <div class="col-md-3">
						 <?php if($ad_profile_img != '') { ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="<?php echo $ad_profile_img; ?>" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						  
						 <?php } else {	 ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="images/1.jpg" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						 <?php } ?>
						  </div>
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
			
		</style>

<!--			    <span class="more">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </span>
-->
			<div class="col-md-7" style="font-size:16px;">
				<div class="row">
				<div class="col-md-3 col-xs-12">College Name</div>
				<div class="col-md-9 col-xs-12 main1"> <?php echo $ad_clg_name;?> </div>
				</div>
				
				
				
				<div class="row">
				<div class="col-md-3 col-xs-12">Mobile Number</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo $ad_mobile; ?></div>
				</div>
	
				<div class="row">
				<div class="col-md-3 col-xs-12">Email ID</div>
				<div class="col-md-6 col-xs-12 main" style="color:black;margin-bottom:8px;"> <?php echo $ad_email; ?></div>
				</div>
				
				<div class="row">
				<div class="col-md-3 col-xs-12">Official Email ID</div>
				<div class="col-md-6 col-xs-12 main" style="color:black;margin-bottom:8px;"> <?php echo $off_email; ?></div>
				</div>
				
				<div class="row">
				<div class="col-md-3 col-xs-12">Location</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo "$ad_current_loc, $ad_state, $ad_country"; ?></div>
				</div>
			</div>
                    
					</div>
		       </div>   
            </div>
        </div><!-- End one -->
		
		
		 <!-- <div class="x_panel">
                  <div class="x_title">
                    <h2>Student Information</small></h2>
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
						<li>
							<div class="col-md-12 col-sm-12 col-xs-12">
							<b style="vertical-align: -webkit-baseline-middle;">Select Year :</b>
							</div>
						</li>
						<li>
							<div class="col-md-12 col-sm-12 col-xs-12">
							   <select name="year"  id="year" class="form-control" style="width:100% !important;" onchange="loadGraph()">
							  </select>
							 </div>
						 </li>
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						
					</ul>
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content">
				<div class="row" id="chart_empty">
					<div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
						<div id="chartdiv_2" style="width: 100%; height: 450px;"></div>
						
						
					</div>
				</div>	
				
				<div class="row" id="chart_info" style="display:none;">
					<div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
						<div  style="width: 100%; height: 100px;">
						<p style="color:#2a5aca;text-align:center;font-size:24px;">Data is Not Available for this Year !!</p>
						</div>						
					</div>
				</div>
            </div>
        </div> -->
		
		<div class="row">
		 <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Send Notification</small></h2>
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
				<div class="x_content">
				
					<form id="notify_form" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
							<input type="hidden" name="ad_id" value=<?php echo $ad_id?>> 

							<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<label class="col-md-12 col-sm-12 col-xs-12">Select Branch
								</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
							<select multiple="multiple" name="branchs[]" id="branchs" 
							class="form-control select_branch" tabindex="-1" data-placement="right" data-toggle="tooltip" style="width:100% !important;" >
                           <!-- Data is fetching form Ajax call (Branchs)  onchange="checkStatusAll();" -->
                          </select>
                   			 </div>
							</div>		
							<div class="col-md-6 col-sm-6 col-xs-6">
								<label class="col-md-12 col-sm-12 col-xs-12">Select Year
								</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
							  <select name="notify_year"  id="notify_year" class="form-control" style="width:100% !important;">
									<!-- <option value="all">All</option> -->
							  </select>

								  </div>
							</div>	
<br><br><br><br>							
							<div class="row">
								<label class="col-md-12 col-sm-12 col-xs-12">Attachment ( Image ) <span id="img_status"></span> </label>
									<div class="col-md-12 col-sm-12 col-xs-12">
									<input type="file" id="attchFile" name="attchFile" class="form-control" onChange="validate(this.value)"/>		
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-12 col-sm-12 col-xs-12">*Subject
								</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
								  <input type="text" name="notify_subject" id="notify_subject" required="required" placeholder="Notification Subject" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-12 col-sm-12 col-xs-12">*Message  (500 Words Only)
								</label>	
								<div class="col-md-12 col-sm-12 col-xs-12">
								<textarea name="notify_msg" id="notify_msg" class="form-control" placeholder="Enter Message Discription" style="height:200px;" maxlength="2000"></textarea>
								</div>
							</div>	
							
							</div>
							<span id="status"></span>
					 <div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-4 col-xs-offset-3">
				  			   <!-- <button type="button" class="btn btn-primary" name="notify_submit" id="notify_submit" 
				  			   onclick="publishNotification();"><i class="fa fa-check"></i>&nbsp;&nbsp;Publish Notification</button> -->
				  			   <input type="submit" class="btn btn-primary" name="notify_submit" value="Publish Notification"/>
						</div>
					</div>

				</form>
				
					
				</div>	
	</div>
</div> <!-- 6 row ends-->
            		
		<div class="col-md-6 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Notification Sent</h2>

					<span class="badge bg-blue" style="margin-left:1%;"><span id="notify_count" style="color:yellow;"></span></span>
                  
					<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content" style="height:531px;">
				<div class="row">
					<div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
						 <div class="notify">        
							  <ul id="menu1" class="list-unstyled msg_list" role="menu">
								<div id="notify_list"></div>
							  </ul>
						</div> 		 
					</div>
				</div>
            </div>
        </div>
        </div>
		
		
        </div><!--ends row-->
		<!--<div class="row top_tiles">	
		  <div class="animated fadeIn col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="tile-stats">
				<div class="x_title">
					<h2 style="padding:10px;">Branch Information </small></h2>
					<div class="clearfix"></div>
				</div>
					 
			<div id="chartdiv_3" style="width: 100%; height: 400px;"></div>
			</div>
		</div>			
		</div>-->
		<div style="margin-bottom:0px;"></div>
       
	<?php include('sup_files/footer.php'); ?>	

    </div>
    </div>
	
  <script>

function delete_notify(data){
$.ajax({
    url: 'adminreg/notification.php?delete_notify=data123&notify_id='+data+'&admin_id='+<?php echo $ad_id?>,
    type: 'GET',
    success: function (returndata) {
	//alert(returndata);
   // <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode_project").html(returndata);
    $("#commondialog_project").modal({backdrop:'static'});
			
				$.ajax({
					url: 'adminreg/notification.php?notify_list=data&admin_id='+<?php echo $ad_id?>,
					type: 'GET',
					success: function (returndata) {
					//	alert(returndata);
					//<!-- function is call to header.php (Bootstrap model popup)-->
					$("#notify_list").html(returndata);
				  
					}
				  });
    }
  });
}


function list_data_get(data){
//alert(data)
$.ajax({
    url: 'adminreg/notification.php?load_data=loaded&notify_id='+data+'&admin_id='+<?php echo $ad_id?>,
    type: 'GET',
    success: function (returndata) {
		//alert(returndata);	 
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode_project").html(returndata);
    $("#commondialog_project").modal({backdrop:'static'});
	  
    }
  });
}  
  
$(document).ready(function() {
//alert();
debugger;

$.ajax({
	type:'POST',
	url:'adminreg/branch_data.php',
	success:function(data){
		//alert(data);
		$('#branchs').html(data);
	}
});

		$(".select_branch").select2({
          maximumSelectionLength: 10,
          placeholder: "Select a Branch",
          allowClear: true
        });


});
   </script>
    <!-- /Starrr -->
</body>

</html>
