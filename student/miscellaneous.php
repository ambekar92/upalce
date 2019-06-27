<?php 
error_reporting(0);
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');

include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_miscellaneous';
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$miscellaneous_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
 while($row=mysql_fetch_array($miscellaneous_data)) 
	{
		$miss_id=$row['id']; 
		$job_srch=$row['job_srch'];
		$emp_type=$row['emp_type'];
		$physically_chall=$row['physically_chall'];
		$work_auth=$row['work_auth'];
		
	}

/* Fetching the initial data */
$table='stu_lang';
$whereCond="fk_stu_id='$stu_id'";	
$Query_lang = 'select * from '.$table.' where '.$whereCond;
$lang_data = mysql_query($Query_lang) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
/*  while($row=mysql_fetch_array($lang_data)) 
	{
		$lang_id=$row['id']; 
		$lang=$row['lang'];
		$read_lang=$row['read_lang'];
		$write_lang=$row['write_lang'];
		$speak_lang=$row['speak_lang'];
		$profi_level=$row['profi_level'];
		
	} */

	/* Delete the record by id */
if(isset($_GET['delete']))
{
 $delete =$_GET['delete'];
		if($delete != '')
		{
		?>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#commondialog").modal({backdrop:'static'});
						$("#getCode").html('<p style=color:red;>Record Successfully Deleted !!</p>');	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		$table='stu_lang';
		 $del ="DELETE FROM $table WHERE id='$delete'";
		 mysql_query($del) or die(mysql_error());
		}
		
}


/* Update the record by id */
if(isset($_POST['update']))
{
// $update_id =$_POST['update'];

	$lang = $_POST['lang'];
	$read_lang = $_POST['read_lang'];
	$write_lang = $_POST['write_lang'];
	$speak_lang = $_POST['speak_lang'];	
	$profi_level = $_POST['profi_level'];
	$user_id = $_POST['user_id'];
		
	$lang_id = $_POST['lang_id'];
	//echo $write_lang;die();
		$table='stu_lang';
		$Query ="update $table set lang='$lang',read_lang='$read_lang',write_lang='$write_lang',speak_lang='$speak_lang',profi_level='$profi_level'
		where fk_stu_id='$user_id' and id='$lang_id'";

		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Updated.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php

}

	
/* Add the record to DATABASE */

if(isset($_POST['save_lang']))
{
	//$lang = $_POST['lang'];
	
	
	if($_POST['lang']=='Others'){
		$lang = $_POST['lang_other'];
	}else{
		$lang = $_POST['lang'];
	}
	
	$read_lang = $_POST['read_lang'];
	$write_lang = $_POST['write_lang'];
	$speak_lang = $_POST['speak_lang'];	
	$profi_level = $_POST['profi_level'];
	$user_id = $_POST['user_id'];
	
	$lang_id = $_POST['lang_id'];
	
	//echo $read_lang;die;

		$table='stu_lang';
		$Query ="insert into $table (fk_stu_id,lang,read_lang,write_lang,speak_lang,profi_level) 
		values('$user_id','$lang','$read_lang','$write_lang','$speak_lang','$profi_level')";  

		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Added.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}



if(isset($_POST['submit_data']))
{

	$job_p = $_POST['temporary'];
	$job_t = $_POST['permanent'];
	$job_c = $_POST['contract'];
	$job_srch="$job_p.$job_t.$job_c";
	
	$emp_part = $_POST['part_time'];
	$emp_full = $_POST['full_time'];
	$emp_type="$emp_full.$emp_part";
	
	$phy_yes_no = $_POST['challenged'];
	$phy_dis = $_POST['physically_chall'];
	$physically_chall="$phy_yes_no.$phy_dis";
	
	$phy_yes_no = $_POST['work_auth'];
	
	$user_id = $_POST['user_id'];
	$miss_id = $_POST['miss_id'];
	
	
	if($miss_id =='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		$table = 'stu_miscellaneous';	
		$Query ="insert into $table (fk_stu_id,job_srch,emp_type,physically_chall,work_auth) 
		values('$user_id','$job_srch','$emp_type','$physically_chall','$phy_yes_no')";  
	
	//die($Query);
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Modified.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
			$table = 'stu_miscellaneous';
		$Query = "UPDATE $table set job_srch='$job_srch',emp_type='$emp_type',physically_chall='$physically_chall',work_auth='$phy_yes_no' 
		WHERE id = '$miss_id' and fk_stu_id='$user_id'";
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Modified.</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}

}

?>

<script type = "text/javascript" language = "javascript">
$(document).ready(function() {		
	$("#r1").change(function () {   
		var data=$('input:radio[name=challenged]:checked').val();
		//alert(data);
		if(data=='YES'){
			$("#physically_chall").prop('disabled', false);
		}
	});	
	$("#r2").change(function () {   
		var data=$('input:radio[name=challenged]:checked').val();
		//alert(data);
		if(data=='NO'){
			$("#physically_chall").prop('disabled', true);
		}
	});
	
});
function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='miscellaneous.php';
}


function Delete(data)
{
	//alert(data);
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=miscellaneous.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	
}

function checkLang()
{
	var lang_data=$('#lang').val();
	//alert(lang_data);
	if(lang_data=='Others'){
		
		$('#lang_other').show();
	}else{
		$('#lang_other').hide();
	}
}
</script>




            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Miscellaneous</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
			
				   
				   
				
					<?php 
					//echo $lang_k;
						
					$job_srch_values= explode(".",$job_srch);
					//print_r($job_srch_values);
					if($job_srch_values[0] == 'Temporary')
						$job_t='checked';
					if($job_srch_values[1] == 'Permanent')
						$job_p='checked';
					if($job_srch_values[2] == 'Contract')
						$job_c='checked';
					
					$emp_type_values= explode(".",$emp_type);
					//print_r($job_srch_values);
					if($emp_type_values[0] == 'Full Time')
						$emp_f='checked';
					if($emp_type_values[1] == 'Part Time')
						$emp_p='checked';
					
					if($work_auth == 'NO')
						$work_auth_no='checked';
					else
						$work_auth_yes='checked';
					
					$physically_chall_values= explode(".",$physically_chall);
					//print_r($job_srch_values);
					if($physically_chall_values[0] == 'YES')
					{	
						?>
						<script> 
						$(document).ready(function(){
						$("#physically_chall").prop('disabled', false);
						});
						</script>
						<?php
						$phy_yes='checked';
						$phy_dis=$physically_chall_values[1];
					}
					else
					{
						$phy_no='checked';
						$phy_dis='';
					}
					
					?>
					
					<div class="form-group">
                        <h4 class="control-label col-md-4 col-sm-2 col-xs-12" style="text-align: left;margin-bottom:12px;">Languages known</h4>
						
					<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          
                          <th>Languages</th>
                          <th>Read</th>
                          <th>Write</th>
                          <th>Speak</th>
                          <th>Proficiency Level</th>
                          <th>Action</th>
                         
                        </tr>
                      </thead>


                      <tbody>

						
			
					  
					<?php
						 while ($row=mysql_fetch_array($lang_data)) 
						   {   
					   ?> 
		<form id="Demo" data-parsley-validate class="form-horizontal form-label-left" action="miscellaneous.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="lang_id" value="<?php echo $row["id"];?>"> <!-- Get the ID from Update each record -->
		
						<tr>
						 <td>
						<select name="lang"  class="form-control" style="width:100% !important;">
								<option value="<?php echo $row['lang']; ?>"><?php echo $row['lang']; ?></option>
							<option value="Kannada">Kannada</option>
								<option value="English">English</option>
								<option value="Hindi">Hindi</option>
								<option value="Telugu">Telugu</option>
								<option value="Tamil">Tamil</option>
								<option value="Malayalam">Malayalam</option>
								<option value="Marathi">Marathi</option>
						</select>
						 </td>                                            
						 <td align="center">
						  <?php $r=$row['read_lang'];
					 // echo $r;
						if($r == 'Read') 
							$read_check='checked';	
						else
							$read_check='';
						?>
						<input type="checkbox" class="flata" name="read_lang" value="Read" class="form-control col-md-7 col-xs-12" style="height:20px;width:30px;" <?php echo $read_check; ?>>
						
						 </td>
						 <td align="center">
					    <?php $w=$row['write_lang'];
					// echo $w;
						if($w == 'Write') 
							$write_check='checked';	
						else
							$write_check='';
						?>
						<input type="checkbox" class="flata" name="write_lang" value="Write" class="form-control col-md-7 col-xs-12" style="height:20px;width:30px;" <?php echo $write_check; ?>>
						</td>
						 <td align="center">
						  <?php $s=$row['speak_lang'];
					  // echo $s;
						if($s== 'Speak') 
							$speak_check='checked';	
						else
							$speak_check='';
						?>
						<input type="checkbox" class="flata" name="speak_lang" value="Speak" class="form-control col-md-7 col-xs-12" style="height:20px;width:30px;" <?php echo $speak_check; ?>>
						
						 </td>
						 <td>
						 <select name="profi_level"  class="form-control" style="width:100% !important;">
								<option value="<?php echo $row['profi_level']; ?>"><?php echo $row['profi_level']; ?></option>
								<option value="Beginner">Beginner</option>
								<option value="Proficient">Proficient</option>
								<option value="Expert">Expert</option>
						</select>
						 </td>
						  <td align="center" style="vertical-align: middle;">
						
					<a class="btn btn-danger btn-sm" href="miscellaneous.php?delete=<?php echo $row["id"];?>">
						 <i class="glyphicon glyphicon-trash"></i>
						</a>
						 
						 <button class="btn btn-warning btn-sm" type="submit" name="update">
						 Save
						 </button>
					
						</td>
						 	</tr>
			</form>				
						<?php 
					
						   }?>
					
		<form id="Demo" data-parsley-validate class="form-horizontal form-label-left" action="miscellaneous.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="lang_id" value="<?php echo $lang_id;?>"> <!-- Get the ID from Update each record -->
					
					 <tr style="background-color:#c2f5eb;">
                        
                          <td>
						  <div class="col-md-12 col-sm-2 col-xs-12">
							  <select name="lang" id="lang" onChange="checkLang();" class="form-control" style="width:100% !important;">
							<option value="Kannada">Kannada</option>
								<option value="English">English</option>
								<option value="Hindi">Hindi</option>
								<option value="Telugu">Telugu</option>
								<option value="Tamil">Tamil</option>
								<option value="Malayalam">Malayalam</option>
								<option value="Marathi">Marathi</option>
								<option value="Others">Others</option>
							  </select>
							  
	 <input type="text" name="lang_other" id="lang_other" class="form-control" placeholder="Please Enter Languages" style="display:none;">
						  
							  <div id="error"></div>
							 </div>
						  </td>
                          <td align="center"> 
						  
						   <input type="checkbox" class="flata" name="read_lang" value="Read" class="form-control col-md-7 col-xs-12" style="height:20px;width:30px;">
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flata" name="write_lang" value="Write" class="form-control col-md-7 col-xs-12" style="height:20px;width:30px;">
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flata" name="speak_lang" value="Speak" class="form-control col-md-7 col-xs-12" style="height:20px;width:30px;">
						  </td>
                          
						  <td>
							<div class="col-md-12 col-sm-2 col-xs-12">
							  <select name="profi_level"  class="form-control" style="width:100% !important;">
								<option value="Beginner">Beginner</option>
								<option value="Proficient">Proficient</option>
								<option value="Expert">Expert</option>
							  </select>
							  <div id="error"></div>
							 </div>
							 </td>
							<td align="center" style="vertical-align: middle;">	
								<button type="submit" name="save_lang" id="save_lang" class="btn btn-success" style="width:90px;">Save</button>
							</td> 
                        </tr>
	</form>
				
					</tbody>
					</table>
					
                    </div>
					  
	<form id="Demo" data-parsley-validate class="form-horizontal form-label-left" action="miscellaneous.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="miss_id" value="<?php echo $miss_id;?>"> <!-- Get the ID from Update each record -->
									
					<div class="form-group">
                        <h4 class="control-label col-md-4 col-sm-2 col-xs-12" style="text-align: left;margin-bottom:12px;">Job Search Option</h4>
						
                    </div>
					<div class="row" style="margin-left:10px;">
						<div class="col-md-3">
						  <input type="checkbox" class="flat" name="permanent" value="Permanent" class="form-control col-md-7 col-xs-12" <?php echo $job_p; ?> > Permanent
						</div>
						<div class="col-md-3">
						  <input type="checkbox" class="flat" name="temporary" value="Temporary" placeholder="Total Experience" class="form-control col-md-7 col-xs-12" <?php echo $job_t; ?> > Temporary
						</div>
						<div class="col-md-3">
						  <input type="checkbox" class="flat" name="contract" value="Contract" placeholder="Total Experience" class="form-control col-md-7 col-xs-12" <?php echo $job_c; ?> > Contract
						</div>
					</div>
					
					<div class="form-group">
                         <h4 class="control-label col-md-4 col-sm-2 col-xs-12" style="text-align: left;margin-bottom:12px;margin-top:10px;">Desired Employment Type</h4>
                    </div>
					<div class="row" style="margin-left:10px;">
						<div class="col-md-3">
						  <input type="checkbox" class="flat" name="full_time" value="Full Time" class="form-control col-md-7 col-xs-12" <?php echo $emp_f;?>> Full Time
						</div>
						<div class="col-md-3">
						  <input type="checkbox" class="flat" name="part_time" value="Part Time" placeholder="Total Experience" class="form-control col-md-7 col-xs-12" <?php echo $emp_p;?> > Part Time
						</div>
					</div>
					
					<div class="form-group">
                         <h4 class="control-label col-md-4 col-sm-2 col-xs-12" style="text-align: left;margin-bottom:12px;margin-top:10px;">Physically Challenged</h4>
                    </div>
					<div class="row" style="margin-left:10px;">
						<div class="col-md-3">
						  <input type="radio" class="a" name="challenged" id='r1'  value="YES" class="form-control col-md-4 col-xs-12" style="height:20px;width:30px;" <?php echo $phy_yes;?>/>
						YES
						</div>  
						<div class="col-md-3">
						  <input type="radio" class="a" name="challenged" id='r2' value="NO" class="form-control col-md-4 col-xs-12" style="height:20px;width:30px;"<?php echo $phy_no;?>/>
						NO
						</div>
						<br>
						<br>
						<div class="col-md-8 col-sm-2 col-xs-12">
<textarea name="physically_chall" id="physically_chall" disabled="disabled" placeholder="Description" class="form-control col-md-7 col-xs-12" style="height:100px;" maxlength="1000"><?php echo $phy_dis;?></textarea> 
						</div>
					</div>
					
					
					<div class="form-group">
                         <h4 class="control-label col-md-4 col-sm-2 col-xs-12" style="text-align: left;margin-bottom:12px;">Work authorization</h4>
                    </div>
					 <div class="row" style="margin-left:10px;">
						<div class="col-md-3">
						Work Permit in India
						</div> 
						<div class="col-md-3">
						  <input type="radio" name="work_auth" value="YES" class="form-control col-md-4 col-xs-12" style="height:20px;width:30px;" <?php echo $work_auth_yes;?> />
								<p style="margin-top:5px">  YES </p>
						</div>  
						<div class="col-md-3">
						  <input type="radio" name="work_auth" value="NO" class="form-control col-md-4 col-xs-12" style="height:20px;width:30px;" <?php echo $work_auth_no;?>/> 
						  <p style="margin-top:5px">  NO </p>
						</div>
						
					</div>
					
					
					 <br><div class="ln_solid"></div>
					 
<div class="form-group">
<div class="col-md-4 col-sm-3 col-xs-12">
</div>
	<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
		<button type="submit" name="submit_data" id="submit_data" class="btn btn-success" style="width:250px;">Update</button>
	</div>
<!--	<div class="col-md-3 col-sm-3 col-xs-12">
		<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:150px;">
		</div>-->
  </div>
					  
                      <div class="ln_solid"></div>
				
				</form>
				  
                </div>
                </div>
              
			  
			  
			  </div> <!-- col-12 -->
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

	

	
	
	
</body>

</html>