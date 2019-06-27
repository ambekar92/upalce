<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_miscellaneous';
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$miscellaneous_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
 while($row=mysql_fetch_array($miscellaneous_data)) 
	{
		$lang_id=$row['id']; 
		$lang_k=$row['lang_k']; 
		$lang_e=$row['lang_e']; 
		$lang_h=$row['lang_h']; 
		$job_srch=$row['job_srch'];
		$emp_type=$row['emp_type'];
		$physically_chall=$row['physically_chall'];
		$work_auth=$row['work_auth'];
		
	}

/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$kr = $_POST['kr'];
	$kw = $_POST['kw'];
	$ks = $_POST['ks'];
	$kp = $_POST['kp'];
	$lang_k="Kannada.$kr.$kw.$ks.$kp";
	
	$er = $_POST['er'];
	$ew = $_POST['ew'];
	$es = $_POST['es'];
	$ep = $_POST['ep'];
	$lang_e="English.$er.$ew.$es.$ep";
	
	$hr = $_POST['hr'];
	$hw = $_POST['hw'];
	$hs = $_POST['hs'];
	$hp = $_POST['hp'];
	$lang_h="Hindi.$hr.$hw.$hs.$hp";
	
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
	$lang_id = $_POST['lang_id'];
	
	
	if($lang_id =='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_skills;	
		$Query ="insert into $table (fk_stu_id,lang_k,lang_e,lang_h,job_srch,emp_type,physically_chall,work_auth) 
		values('$user_id','$lang_k','$lang_e','$lang_h','$job_srch','$emp_type','$physically_chall','$phy_yes_no')";  
	
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
		$Query = "UPDATE $table set lang_k='$lang_k',lang_e='$lang_e',lang_h='$lang_h',job_srch='$job_srch',emp_type='$emp_type',physically_chall='$physically_chall',work_auth='$phy_yes_no' 
		WHERE id = '$lang_id' and fk_stu_id='$user_id'";
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
			
				<form id="Demo" data-parsley-validate class="form-horizontal form-label-left" action="miscellaneous.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="lang_id" value="<?php echo $lang_id;?>"> <!-- Get the ID from Update each record -->
					
					<?php 
					//echo $lang_k;
					$k_values= explode(".",$lang_k);
					if($k_values[1] == 'Read')
						$k_read='checked';
					if($k_values[2] == 'Write')
						$k_write='checked';
					if($k_values[3] == 'Speak')
						$k_speak='checked';
					
					$e_values= explode(".",$lang_e);
					if($e_values[1] == 'Read')
						$e_read='checked';
					if($e_values[2] == 'Write')
						$e_write='checked';
					if($e_values[3] == 'Speak')
						$e_speak='checked';
					
					$h_values= explode(".",$lang_h);
					if($h_values[1] == 'Read')
						$h_read='checked';
					if($h_values[2] == 'Write')
						$h_write='checked';
					if($h_values[3] == 'Speak')
						$h_speak='checked';
					
					
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
                         
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                        
                          <td>Kannada</td>
                          <td align="center"> 
						  
						   <input type="checkbox" class="flat" name="kr" value="Read" class="form-control col-md-7 col-xs-12" <?php echo $k_read;?> >
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flat" name="kw" value="Write" class="form-control col-md-7 col-xs-12" <?php echo $k_write;?>>
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flat" name="ks" value="Speak" class="form-control col-md-7 col-xs-12" <?php echo $k_speak;?>>
						  </td>
                          
						  <td>
							<div class="col-md-12 col-sm-2 col-xs-12">
							  <select name="kp"  class="form-control" style="width:100% !important;">
								<option value="<?php echo $k_values[4]; ?>"><?php echo $k_values[4]; ?></option>
								<option value="Beginner">Beginner</option>
								<option value="Proficient">Proficient</option>
								<option value="Expert">Expert</option>
							  </select>
							  <div id="error"></div>
							 </div>
							 </td>
                        </tr>
						
						<tr>
                        
                          <td>English</td>
                          <td align="center"> 
						   <input type="checkbox" class="flat" name="er" value="Read" class="form-control col-md-7 col-xs-12" <?php echo $e_read;?>>
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flat" name="ew" value="Write" class="form-control col-md-7 col-xs-12" <?php echo $e_write;?>>
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flat" name="es" value="Speak" class="form-control col-md-7 col-xs-12" <?php echo $e_speak;?>>
						  </td>
                          
						  <td>
							<div class="col-md-12 col-sm-2 col-xs-12">
							  <select name="ep"  class="form-control" style="width:100% !important;">
								<option value="<?php echo $e_values[4]; ?>"><?php echo $e_values[4]; ?></option>
								<option value="Beginner">Beginner</option>
								<option value="Proficient">Proficient</option>
								<option value="Expert">Expert</option>
							  </select>
							  <div id="error"></div>
							 </div>
							 </td>
                        </tr>
						
						<tr>
                        
                          <td>Hindi</td>
                          <td align="center"> 
						   <input type="checkbox" class="flat" name="hr" value="Read" class="form-control col-md-7 col-xs-12" <?php echo $h_read;?>>
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flat" name="hw" value="Write" class="form-control col-md-7 col-xs-12" <?php echo $h_write;?>>
						  </td>
                          <td align="center">
						   <input type="checkbox" class="flat" name="hs" value="Speak" class="form-control col-md-7 col-xs-12" <?php echo $h_speak;?>>
						  </td>
                          
						  <td>
							<div class="col-md-12 col-sm-2 col-xs-12">
							  <select name="hp"  class="form-control" style="width:100% !important;">
								<option value="<?php echo $h_values[4]; ?>"><?php echo $h_values[4]; ?></option>
								<option value="Beginner">Beginner</option>
								<option value="Proficient">Proficient</option>
								<option value="Expert">Expert</option>
							  </select>
							  <div id="error"></div>
							 </div>
							 </td>
                        </tr>
					</tbody>
					</table>
                    </div>
					  
					
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
                         <h4 class="control-label col-md-4 col-sm-2 col-xs-12" style="text-align: left;margin-bottom:12px;margin-top:10px;">Desired Employement Type</h4>
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
						Work Unit in India
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