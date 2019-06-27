<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='countries';
/* $whereCond="fk_stu_id='$stu_id'";	 */
$Query = 'select * from '.$table;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());



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
		 $skill_del ="DELETE FROM $table WHERE country_id='$delete'";
		 mysql_query($skill_del) or die(mysql_error());
		}
		
}


/* Update the record by id */
if(isset($_GET['update']))
{
 $update_id =$_GET['update'];
 
		if($update_id != '')
		{
		?>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#add_skill_hide").hide(); 
						$("#update_skill_hide").show();	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		}
		
 $skill_del ="SELECT * FROM $table where country_id='$update_id'";
 $Skill_Result=mysql_query($skill_del) or die(mysql_error());
 
	while($row=mysql_fetch_array($Skill_Result)) 
	{
		$country_id=$row['country_id']; 
		$country_name=$row['country_name']; 

		 
	}
}

/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$country_name = $_POST['country_name'];
	

	if($country_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_country;	
		$Query ="insert into $table (country_name) values('$country_name')";  
	
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
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}

}

/* Update the record in DATABASE */
if(isset($_POST['skill_update']))
{
	$country_name = $_POST['country_name'];
	$country_id = $_POST['country_id'];
	
	if($country_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_country;	
		$Query = "UPDATE $table set country_name='$country_name' WHERE country_id = '$country_id'";
					
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
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}

}

?>

<script type = "text/javascript" language = "javascript">

   
function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='country.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=country.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
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
                    <h2>Country</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="country.php" method="post" enctype="multipart/form-data">
					<!--<input type="hidden"  name="user_id" value="<?php// echo $stu_id;?>"> --><!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="country_id" value="<?php echo $country_id;?>"> <!-- Get the ID from Update each record -->
					
					<div class="col-md-3 col-sm-2 col-xs-12">
					</div>
					<div class="form-group">
                      <!--  <label class="control-label col-md-2 col-sm-2 col-xs-12">Country_code<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php //echo $country_id; ?>" name="skill_name" required="required" placeholder="Skill Name" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>-->
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Country_Name<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $country_name; ?>"  name="country_name" required="required" placeholder="Country Name" class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
				
					 <br>
					 
<div class="form-group">
<div class="col-md-4 col-sm-3 col-xs-12">
</div>
	<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
		<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add Country</button>
	</div>
	 
	 <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_skill_hide">
		<button type="submit" name="skill_update" id="skill_update" class="btn btn-success" style="width:150px;">Update Country</button>
	</div>
	
	<div class="col-md-3 col-sm-3 col-xs-12">
		<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:150px;">
		</div>
  </div>
					  
                      <div class="ln_solid"></div>
				
				</form>
				  
                </div>
                </div>
                </div><!-- col-12 -->
			</div>
				
		<div class="row">		
           
			  
			  <div class="col-md-6 col-sm-12 col-xs-12">   
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Country List</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                    <!--<p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>table table-striped jambo_table bulk_action                    style="width:1700px;" -->
                   <table id="datatable11" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                          <th>Action</th>
                          <th>Country_code</th>
                          <th>Country_Name</th>
                         
                          
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($skill_data)) 
						   {   
					   ?>                            
<tr>
<td align="center" style="vertical-align: middle;">
 <a title="Delete">
 <button class="btn btn-danger" onclick="Delete(<?php echo $row["country_id"];?>);">
 <i class="glyphicon glyphicon-trash"></i>
  </button>
 </a><!--</td>
 <td align="center" style="vertical-align: middle;">-->
 <a title="Update" href='country.php?update=<?php echo $row["country_id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
						 <td><?php echo $row['country_id']; ?></td>                                            
						 <td><?php echo $row['country_name']; ?></td>
						 
						 
			 <!--href='country.php?update=<?php //echo $row["id"];?>'-->
</tr>
				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>
			  
			  </div> <!-- col-12 -->
			  
			  <div class="col-md-6 col-sm-12 col-xs-12">   
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Country List</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                    <!--<p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>table table-striped jambo_table bulk_action                    style="width:1700px;" -->
                   <table id="datatable11" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                          <th>Action</th>
                          <th>Country_code</th>
                          <th>Country_Name</th>
                         
                          
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($skill_data)) 
						   {   
					   ?>                            
<tr>
<td align="center" style="vertical-align: middle;">
 <a title="Delete">
 <button class="btn btn-danger" onclick="Delete(<?php echo $row["country_id"];?>);">
 <i class="glyphicon glyphicon-trash"></i>
  </button>
 </a><!--</td>
 <td align="center" style="vertical-align: middle;">-->
 <a title="Update" href='country.php?update=<?php echo $row["country_id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
						 <td><?php echo $row['country_id']; ?></td>                                            
						 <td><?php echo $row['country_name']; ?></td>
						 
						 
			 <!--href='country.php?update=<?php //echo $row["id"];?>'-->
</tr>
				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>
			  
			  </div> <!-- col-12 -->
			  
            </div><!--row-->
          
       
	   
        <!-- /page content -->
		<div style="margin-bottom:250px;"></div>

		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

	

	
	
	 <!-- Datatables -->
    <script>
      $(document).ready(function() {
   
        $('#datatable').dataTable({
			responsiv:"true"
		});

        $('#datatable11').dataTable({
			responsiv:"true"
		});
       
      });
    </script>
    <!-- /Datatables -->
</body>

</html>