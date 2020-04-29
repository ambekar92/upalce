<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
error_reporting(0);
include('sup_files/db.php');


$whereCond="fk_stu_id='$stu_id'";	
$query = 'select id,fk_stu_id,resume_name,set_value,modified from stu_resume where '.$whereCond;
$res_resume_list = mysql_query($query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
$resume_count=mysql_num_rows($res_resume_list);



/* Delete the record by id */
if(isset($_GET['delete']))
{
 $delete =$_GET['delete'];
 $resumeName =$_GET['resumeName'];
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
		unlink("./$resumeName");
		 $del ="DELETE FROM stu_resume WHERE id='$delete'";
		 mysql_query($del) or die(mysql_error());
		}
		
}

if(isset($_POST['submit_data']))
{
	$user_id=$_POST["user_id"];
	//$resume_number='STU_RESUME_'.rand(111111,999999).'_';
	/* $img_name=$_POST["pro_img"];
	unlink("../$img_name"); */
		$file_names = $_FILES['resume_name']['name'];
			$file_sizes =$_FILES['resume_name']['size'];
			$file_tmps =$_FILES['resume_name']['tmp_name'];
			$file_types=$_FILES['resume_name']['type'];

			$resume_number='STU_RESUME_'.rand(111111,999999).'_'.$file_names;
			
		//echo $file_names."$user_id--asdasd"; die;
		   
				$imgExt = strtolower(pathinfo($file_names,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('pdf', 'docx', 'doc'); // valid extensions

			if(in_array($imgExt, $valid_extensions)){
					if($resume_count != '3'){	
						if(move_uploaded_file($file_tmps,"resume_uploads/".$resume_number)) 
						{	
							$paths="resume_uploads/".$resume_number;
							//$sql = "UPDATE stu_student set resume_name='$paths' WHERE id = '$user_id'";
							$sql = "insert into stu_resume (fk_stu_id,resume_name,set_value) values('$stu_id','$paths','inactive')";
							$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
							
							?>
						<script type="text/javascript">
							$(document).ready(function(){
								$("#commondialog").modal({backdrop:'static'});
								$("#getCode").html('<p>Successfully Added.</p>');	
							});
						</script>		
							
						<?php }	else{ ?>
						<script type="text/javascript">
							$(document).ready(function(){
								$("#commondialog").modal({backdrop:'static'});
								$("#getCode").html('<p>Error in uploading file.</p>');	
							});
						</script>			
						<?php
						}
					}else{ ?>
					<script type="text/javascript">
						$(document).ready(function(){
							$("#commondialog").modal({backdrop:'static'});
							$("#getCode").html('<p style=color:blue;>Max 3 Resume will be Uploaded</p>');	
						});
					</script>			
					<?php
					}
					
				
			}
			else
			{
				//echo "<script>alert('File Extension Not Valid.');</script>";
				?>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#commondialog").modal({backdrop:'static'});
						$("#getCode").html('<p>File Extension Not Valid.</p>');	
					});
				</script>			<!-- function is call to header.php (Bootstrap model popup)-->
				<?php
				//echo "<script>window.location='resume_upload.php';</script>";
			}
		

}

?>

<script type = "text/javascript" language = "javascript">

function Delete(data,resumePath)
{
	//alert(resumePath);

		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=resume_upload.php?delete='+data+'&resumeName='+resumePath+'>'+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');

}

function AlertFilesize()
{		
	var sizeinbytes = document.getElementById('resume_name').files[0].size;
	var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
	fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}
	//alert((Math.round(fSize*100)/100)+' '+fSExt[i]);
	var size=((Math.round(fSize*100)/100));//+' '+fSExt[i]);
	//alert(size);
	if(fSExt[i] =='KB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	}
	else if(size < 3 && fSExt[i] =='MB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	}
	else{
	$('#size').html("<p style='color:red;font-size:14;'><b>File size : "+size+" "+fSExt[i]+" , ( File size must be excately 3 MB )<b></p>");
	}
	
	
	var allowedFiles = [".doc", ".docx", ".pdf"];
            var fileUpload = document.getElementById("resume_name");
            var lblError = document.getElementById("lblError");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.value.toLowerCase())) {
                lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                return false;
            }
			else{
            lblError.innerHTML = "";
            return true;
			}
			
			
}

function reload12()
{	
	//alert();
	window.location='resume_upload.php';
}

function set_default(data)
{	
	//alert(data);
	var values=data.split('|');
	var v1_value=values[0];
	var v2_id=values[1];
	var v3_res_name=values[2];
	//alert(v3_res_name);

	 $.ajax({
		type:'POST',
		url:'stureg/condition.php',
		data:'&status='+v1_value+'&record_id='+v2_id+'&res_name='+v3_res_name+'&set_default_a=data&stu_id='+<?php echo $stu_id;?>,
		success:function(data){
			//alert(data);
		
						$("#commondialog").modal({backdrop:'static'});
						$("#getCode").html(data);	
			
		}
	}); 
	
}
	

	
</script>


 
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

 
            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
          
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upload Your Resume <small>Max 3 Resume will be Uploaded</small></h2>
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                
				<div class="x_content" style="width:100%;overflow-x:scroll;">
				
				 <form action="resume_upload.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>">
					<br/><br/>
						  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Upload Resume <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
                          <input type="file" name="resume_name" id="resume_name" required="required" class="form-control col-md-7 col-xs-12" onchange="AlertFilesize();"/>
							 (upload only .doc, .docx and .pdf)  <div id="size"></div>
							 <span id="lblError" style="color:red;font-size:13px;"></span>
						  
                        </div>
					<!--data-toggle="modal" data-target="#getCodeModal"-->
				  <div class="col-md-8 col-sm-8 col-xs-12 pull-right">
				  	<br/><br/>
					<input type="submit"  class="btn btn-primary"  name="submit_data" id="submit_update" value="Upload Resume">
					</div>		
					</form>	
					</div>
					
					 <!-- <div class="col-md-6 col-sm-6 col-xs-12">
						<br/>
						<a href="<?php //echo $stu_resume_name; ?>" target="_blank"><img src="images/pdf.png" style="height:30px; width:30px;"></a>&nbsp;
						<?php 
						//$name = substr("$stu_resume_name",33);
						//echo $name;
						?><br>
						
						<br>
					  </div>-->
					<br><br>
					
					 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th width="7%">Action</th> 
                          <th>Resume Name</th>
                          <th>Resume View</th>
                          <th>Last_Updated (yyyy-mm-dd)</th>
                          <th>Set Default Record</th>
                         </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($res_resume_list)) 
						   {   
						   	$delResume=$row['resume_name'];
					 ?>   
							<tr>
							 <td align="center" style="vertical-align: middle;">
							 <a title="Delete">
							 <button class="btn btn-danger" onclick="Delete('<?php echo $row['id'];?>','<?php echo $delResume;?>');">
							 <i class="glyphicon glyphicon-trash"></i>
							  </button>
							 </a>
							 
							</td>
							<td><?php $resume_nameCheck=substr($row['resume_name'],33);
								if($resume_nameCheck != ''){echo $resume_nameCheck;}
								else{echo "<b>Upload Fail :</b> Please delete and reupload the resume.";}
							?></td>    
							<td><a href="<?php echo $row['resume_name']; ?>" target="_blank"><img src="images/pdf.png" style="height:30px; width:30px;"> <b>View</b></a></td> 			
							<td style="vertical-align: middle;text-align:center;color:black;"><b><?php echo $row['modified']; ?></b></td>  
							<td> 
							<?php if($row['set_value'] == 'active'){ ?>							
							<a class="btn btn-warning">
							Active Resume
							</a>
							<?php }else{ ?>
							<a class="btn btn-primary" onclick="set_default('<?php echo $row['set_value'].'|'. $row['id'].'|'.$row['resume_name'];?>');">
							Set Default
							</a>
							<?php } ?>	
							 </td>  
							 </tr>
						<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>		
					 </div> 
				
				  
                </div>
				
              </div>
			  
            </div>
			
          </div>
		  
        </div>
        <!-- /page content -->
		<br/>&nbsp;<br/>&nbsp;
		        <!-- footer content -->
				
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

	

</body>

</html>