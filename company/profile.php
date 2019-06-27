<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* $resaa=mysql_query("select * from super_admin_profile");
    while ($row=mysql_fetch_array($resaa))
	{
    $username=$row['username'];
    $email=$row['email'];
   }
 */
?>

<script type = "text/javascript" language = "javascript">
	
function changeProfile()
{
	var img_file = document.getElementById('profile').value;
	//alert(img_file);
	$("#sub_btn").show().fadeIn(); 
	
}

function editProfile()
{
	
	$("#info_edit").show();	 
	$("#info").hide();	 

	$("#info_edit1").show();	 
	$("#info1").hide();
	
	$("#edit_btn").hide();	

}


function check_new_old()
{
    var new_pass=document.getElementById( "new_pass" ).value;
	var confirm_pass=document.getElementById( "confirm_pass" ).value;
	
		if(new_pass == confirm_pass && new_pass !='' && confirm_pass != '')
		{			
			 $("#password_match").html('<p style="color:green;"> New and Confirm Password is Correct.</p>');
			 $("#submit_pass").prop('disabled', false);
		}
		else
		{
			 $("#password_match").html('<p style="color:red;"> New and Confirm Password is Incorrect !!</p>');
			 $("#submit_pass").prop('disabled', true);
		}		
}

function checkpass()
    {
	 var old_pass=document.getElementById( "old_pass" ).value;

	//alert('<?php echo $ad_com_id; ?>');
	   if(old_pass)
	   {
	       $.ajax({
			   type: 'post',
			   url: 'adminreg/condition.php',
			   data: {
			  ad_com_id:'<?php echo $ad_com_id; ?>', 
			   user_pass:old_pass,
			   },
			   success: function (response) {
				//alert(response);
			
		       if(response==0)	
               {
					$('#pass_status').html('<img src=images/confirm.png>');
				    $("#submit_pass").prop('disabled', false);
                  return true;	
               }
               else
               {
				    $('#pass_status').html('<img src=images/delete.png>');
				    $("#submit_pass").prop('disabled', true);
                  return false;	
               }
             }
		   });


	    }
	    else
	    {
		//	alert('error');
		   $( '#email_status' ).html("");
		   return false;
	    }
	
	}



$(document).ready(function() {	
	debugger;
	//img upload func
$("form#upload_img").submit(function(event){
	//alert('asd'); 
 $(".progress").show();
	 var formData = new FormData($(this)[0]);
	$.ajax({
    url: 'adminreg/condition.php',
    type: 'POST',
    data: formData,
    //async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
		 //alert(returndata);
		 $(".progress").hide();
     // function is call to header.php (Bootstrap model popup)
	   $("#getCode").html(returndata);
     $("#commondialog").modal({backdrop:'static'});
	   //window.location.reload(true);   
    }
  });
 
  return false;
});	


$("form#password_form").submit(function(event){
	//alert('asd'); 
	//alert(confirm_pass);
 var formData = new FormData($(this)[0]);
 $.ajax({
    url: 'adminreg/condition.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
	//alert(returndata);
	
		<!-- function is call to header.php (Bootstrap model popup)-->
   $("#getCode").html(returndata);
    $("#commondialog").modal({backdrop:'static'});
	
		
		
    }
  });
});
	
//alert();
/* 
  $.ajax({
	   type: 'post',
	   url: 'adminreg/condition.php',
	   data: {
	   details:"get",   
	   su_id:'<?php echo $su_id ?>',   
	   },
	   dataType : 'json',
	   success: function (d) {
		alert(d);
		 
	   if(d[0].profile_img =='')
	   {
			$('#profile1').show();
			 $('#profile2').hide();
	   }
	   else
	   {
		   $('#profile1').hide();
	    $('#profile_img').html('<img class="img-responsive avatar-view img-thumbnail" src="'+ d[0].profile_img +'" value="'+d[0].profile_img+'" alt="profile_img" style="height:230px;width:230px;border-radius:20px;"/>');
	   }
	 }//end of success
		 
   }); */
	
	
$("form#info_edit").submit(function(event){
  debugger; 
	 //var formData = new FormData($(this)[0]);   
  var myData = $("#info_edit").serialize();
  var url='adminreg/updateprofile.php';
  $.ajax({
    type:"POST",
    url:url,
    async: false,
    dataType:'json',
    data:myData,
    success: function (obj) {
    debugger;

//function is call to header.php (Bootstrap model popup)
	  $("#getCode").html(obj.data);
    $("#commondialog").modal({backdrop:'static'}); 
		
  	 $("#info_edit").hide(); 
  	 $("#info").show();
  	 $("#edit_btn").show();
  		
    }
  });
 
  return false;
});
	

$("form#info_edit1").submit(function(event){
	//alert('test'); 
	 var formData = new FormData($(this)[0]);
 $.ajax({
    url: 'adminreg/updateprofile.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
	// alert(returndata);
	 
	<!-- function is call to header.php (Bootstrap model popup)-->	
	$("#getCode").html(returndata);
    $("#commondialog").modal({backdrop:'static'}); 
	
	
	 $("#info_edit1").hide(); 
	 $("#info1").show();
	 $("#edit_btn").show();
		
	  /* $("#popupYesNoBasic").show(); */
    }
  });
 
  return false;
});
	
   
});

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='profile.php';
}
				   
</script>
<style type="text/css"> 
.imageHolder {
    position: relative;
   height:230px;
   width:230px;
}
.imageHolder .caption {
    opacity: 0;
    position: absolute;
    height:50px;
	width:230px;
    bottom: 0px;
    left: 0px;
    padding: 6px 0px;
    color: white;
    background: black;
    text-align: center;
    font-weight: bold;
}
.imageHolder:hover .caption {
    opacity: 0.7;
}
</style> 

<link rel="stylesheet" href="./comm/bootstrap-iso.css" />
<!--<script type="text/javascript" src="./comm/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript" src="./comm/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="./comm/bootstrap-datepicker3.css"/>

<div class="progress" style="width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #004C8C;
   z-index: 9045;
   text-align: center;
   display:none;">
   
   <div style="position: relative; 
   width: 100%;">
   <img src="images/loader.gif" style="margin-top:18%;width:100px;">
   
   <h2 style="position: absolute; 
   top: 350px; 
   left: 0; 
   width: 100%;
   color:white;
   font-size:16px;">Uploading..</h2>
   </div>
</div>   

	
            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
             <!-- <div class="title_left">
                <h3>sdfUser Profile</h3>
              </div>-->

            <!--  <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>-->
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Profile</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
						  
						 <form id="upload_img" method="post" action="profile.php"> 
						 <input type="hidden" name="ad_com_id" value="<?php echo $ad_com_id;  ?>" />
						 <input type="hidden" name="pro_img" value="<?php echo $ad_com_profile_img;  ?>" />
						 
						 <?php 
						 if($ad_com_profile_img=='')
						{?>
						  <div class="imageHolder" id="profile1">
							  <label for="profile">
							  <img class="img-responsive avatar-view img-thumbnail" src="images/1.jpg" alt="profile_img" style="height:230px;width:230px;border-radius:20px;">
							  <div class="caption" style="border-bottom-left-radius:20px; border-bottom-right-radius:20px">Change Profile <br>	( upload only .jpg and .png )	</div>			</label>
						  </div><br>
						<?php } 
						else
						{?> 
						
						  <div class="imageHolder" id="profile2">
							 <label for="profile">
							 
								  <img class="img-responsive avatar-view img-thumbnail" src="<?php echo $ad_com_profile_img;?>" alt="profile_img" style="height:230px;width:230px;border-radius:20px;">
							 
							 <div class="caption" style="border-bottom-left-radius:20px; border-bottom-right-radius:20px">
							 Change Profile<br>	( upload only .jpg and .png )						 
							 </div></label> 
							 </div>
							 <br>
						<?php 
						} 
						?>
						<input type="file" id="profile" name="profile" style="display:none;" onchange="changeProfile();">
						
						<input type="submit" class="btn btn-primary" value="Upload Image" id="sub_btn" name="submit" style="display:none;">
						</form>
						
						
						<div>
						
						</div>
						</div>
                      </div>
               <ul class="list-unstyled user_data">
						<br />
                      <a class="btn btn-success" onclick="editProfile();" id="edit_btn"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

             
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Information</a>
                          </li>
                         <!-- <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Personal Information</a>
                          </li>-->
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Change Password</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
							
				<div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-hover table-responsive" id="info">
                    <tbody>
					             <tr>
                        <td>Registered ID</td>
                        <td><b><?php echo $ad_com_reg_number; ?></b></td>
                      </tr>
                      <tr>
                        <td>Company Name</td>
                        <td><b><?php echo $ad_com_comp_name; ?></b></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><b><?php echo $ad_com_email; ?></b></td>
                      </tr>
                       
					            <tr>                        
                        <td>Contact Person</td>
                        <td><b><?php echo $ad_com_contact_person_1; ?></b></td>
                      </tr> 
                      <tr>
                        <td>Designation</td>
                        <td><b><?php echo $ad_com_designation_1; ?></b></td>
                      </tr>
                      <tr>
                        <td>Mobile</td>
                        <td><b><?php echo $ad_com_mobile_number_1; ?></b></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><b><?php echo $ad_com_email_1; ?></b></td>
                      </tr>
                       <tr>
                        <td>Office Address</td>
                        <td><b><?php echo $ad_com_office_add; ?></b></td>
                      </tr>
					             <tr>
                        <td>Country</td>
                        <td><b><?php echo $ad_com_country; ?></b></td>
                      </tr>
                      <tr>
                        <td>State</td>
                        <td><b><?php echo $ad_com_state; ?></b></td>
                      </tr>
                      <tr>
                        <td>Current Location</td>
                        <td><b><?php echo $ad_com_current_location; ?> - <?php echo $ad_com_pinCode; ?></b></td>
                      </tr>
                      <tr>
                        <td>GST</td>
                        <td><b><?php echo $ad_com_gst_val; ?></b></td>
                      </tr>
					  
                    </tbody>
                  </table>
                  
				  <form id="info_edit" style="display:none;" action="adminreg/updateprofile.php" method="POST" enctype="multipart/form-data">
				  
					 <input type="hidden" name="ad_com_id" value="<?php echo $ad_com_id;  ?>" />
				  <table class="table table-hover table-responsive">
                  <tbody>
					          <tr>
                        <td width="30%">Company Name</td>
                        <td>
            						      <input type="text" class="form-control" name="ad_com_comp_name" placeholder="Company Name" 
                              value="<?php echo $ad_com_comp_name; ?>" disabled ="disabled"/>
            						</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
              						<input type="text" class="form-control" name="ad_com_email" placeholder="Emial id" 
                          value="<?php echo $ad_com_email; ?>" disabled ="disabled"/>
              					</td>
                    </tr>
					          <tr>
                        <td>Contact Person</td>
                        <td>
            						  <input type="text" class="form-control" name="contact_person_1" placeholder="Contact Person" 
                          value="<?php echo $ad_com_contact_person_1; ?>"/>
            						</td>
                    </tr>

                    <tr>
                        <td>Designation</td>
                        <td>
                          <input type="text" class="form-control" name="designation_1" placeholder="Designation" 
                          value="<?php echo $ad_com_designation_1; ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Mobile</td>
                        <td>
                          <input type="text" class="form-control" name="mobile_number_1" placeholder="Mobile Number" 
                          value="<?php echo $ad_com_mobile_number_1; ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>
                          <input type="text" class="form-control" name="email_1" placeholder="Email" 
                          value="<?php echo $ad_com_email_1; ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Office Address</td>
                        <td>
                          <input type="text" class="form-control" name="office_add" placeholder="Office Address" 
                          value="<?php echo $ad_com_office_add; ?>"/>
                        </td>
                    </tr> 
                    <tr>
                        <td>Country</td>
                        <td>
                          <input type="text" class="form-control" name="country" placeholder="Country" 
                          value="<?php echo $ad_com_country; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>
                          <input type="text" class="form-control" name="state" placeholder="State" 
                          value="<?php echo $ad_com_state; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Location</td>
                        <td>
						              <input type="text" class="form-control" name="current_location" placeholder="Current Location" 
                          value="<?php echo $ad_com_current_location; ?>"/>
						            </td>
                    </tr>
                    <tr>
                        <td>Pin Code</td>
                        <td>
                          <input type="text" class="form-control" name="pinCode" placeholder="Pin Code" 
                          value="<?php echo $ad_com_pinCode; ?>"/>
                        </td>
                    </tr>                    
                    <tr>
                        <td>GST</td>
                        <td>
                          <input type="text" class="form-control" name="gst_val" placeholder="GST Numbder" 
                          value="<?php echo $ad_com_gst_val; ?>"/>
                        </td>
                    </tr>
	
                    </tbody>
                  </table>
				<div class="row">
					 <div class="col-md-2 col-sm-4 col-xs-12">
					 </div>
					  <div class="col-md-4 col-sm-4 col-xs-12">
					  <input type="submit" class="btn btn-primary"  name="submit_update" id="submit_update" value="Update Changes">
					</div>	

					<div class="col-md-4 col-sm-8 col-xs-12">
				 
				  	<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel">
					</div>	
					
					</div>						
				
				</form>
				  
                </div>	
                          

                          </div> <!--End of Info-->
						  
					
						  
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
							
						  <form  id="password_form" method="POST" class="form-horizontal form-label-left">
						   
						   <input type="hidden" name="ad_com_id" value="<?php echo $ad_com_id;  ?>" />
						   
							<div class=" col-md-9 col-lg-9 "> 
							<div class="row">
								<div class="col-md-4 col-xs-12">
									Old Password
								</div>
								<div class="col-md-6 col-xs-12">
									<input id="old_pass" onkeyup="checkpass();" type="text" class="form-control" name="old_pass" value="" placeholder="Old Password" autofocus required>  
								</div>
								<div class="col-md-2 col-xs-2" id="pass_status"></div>
							</div>
							<br/>
							<div class="row">
								<div class="col-md-4 col-xs-12">
									New Password
								</div>
								<div class="col-md-6 col-xs-12">
									<input id="new_pass" type="text" class="form-control" onkeyup="check_new_old();" name="new_pass" value="" placeholder="New Password" required>  
								</div>
							</div>
								<br/>
							<div class="row">
								<div class="col-md-4 col-xs-12">
									Confirm Password
								</div>
								<div class="col-md-6 col-xs-12">
									<input id="confirm_pass" type="text" onkeyup="check_new_old();" class="form-control" name="confirm_pass" value="" placeholder="Confirm Password" required> 
								</div>
								<div class="col-md-6 col-xs-12" id="password_match"></div>
							</div>
							
							<br/>
							<div class="row">
								<div class="col-md-3 col-xs-12">
									
								</div>
								<div class="col-md-6 col-xs-12">
									<input type="submit" class="btn btn-primary" disabled="disabled" name="submit_pass" id="submit_pass" value="Change Password">
								</div>
							</div>
							<br/><br/>
							<!--<div class="row">
								<div class="col-md-1 col-xs-12">
									
								</div>

								<div class="col-md-6 col-xs-12" id="changepass">
								</div>
							</div>-->
							
						</div>	
						  </form>
						  
                          </div><!--End of 3rd Tab-->
						  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		<br/>&nbsp;

		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

	<script>
	/*$(document).ready(function(){
		var date_input=$('input[name="dob"],input[name="duration_to"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso span').length>0 ? $('.bootstrap-iso span').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})*/
</script>

 <script>
      /*$(function() {
        Morris.Bar({
          element: 'graph_bar',
          data: [
            { "period": "Jan", "Hours worked": 80 }, 
            { "period": "Feb", "Hours worked": 125 }, 
            { "period": "Mar", "Hours worked": 176 }, 
            { "period": "Apr", "Hours worked": 224 }, 
            { "period": "May", "Hours worked": 265 }, 
            { "period": "Jun", "Hours worked": 314 }, 
            { "period": "Jul", "Hours worked": 347 }, 
            { "period": "Aug", "Hours worked": 287 }, 
            { "period": "Sep", "Hours worked": 240 }, 
            { "period": "Oct", "Hours worked": 211 }
          ],
          xkey: 'period',
          hideHover: 'auto',
          barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
          ykeys: ['Hours worked', 'sorned'],
          labels: ['Hours worked', 'SORN'],
          xLabelAngle: 60,
          resize: true
        });

        $MENU_TOGGLE.on('click', function() {
          $(window).resize();
        });
      });*/
    </script>

    <!-- datepicker -->
    <script type="text/javascript">
      /*$(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
        }

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });*/
    </script>
    <!-- /datepicker -->
</body>

</html>