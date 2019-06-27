<?php
error_reporting(0);
include('db.php');

if(isset($_GET["subject"]))
{
	$subject=$_GET["subject"];
	$message=$_GET["message"];
	//$admin_id=$_GET["admin_id"];
	

//echo "what..$subject,$message,$admin_id";	
	$table = 'su_notifications';
	$query ="insert into $table (subject,message) values('$subject','$message')"; 
	$Result = mysql_query($query) or die(" Error in Server !!");
			if($Result)
				{
					echo "Notification Successfully Published .. !!";
					}
				else {
					echo "Something went wrong, Please try again later.";
				}
}

if(isset($_GET["notify_list"]))
{
	//$admin_id=$_GET["admin_id"];
	$data = mysql_query("SELECT * FROM su_notifications ORDER BY id DESC") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		
	$rowcount=mysql_num_rows($data);	
	if($rowcount>0){
			while($row=mysql_fetch_array($data)) 
				{
				/* 	$subject=$row['subject']; 
					$message=$row['message']; 
				} */	
				$msg= substr($row['message'],0,135);
		?>

				<script>
				$('#notify_count').html('<?php echo $rowcount;?>');
				</script>
				
				<li class="list_data" onclick="list_data_get('<?php echo $row['id'];?>');">
				  <a>
					<span><img src="images/admin_notify.png" alt="Profile Image" style="height:30px;width:30px;" /></span>
					<span>
					  <span style="font-size:14px;"><b><?php echo $row['subject']; ?></b></span>
					  <span class="time">	</span>
					</span>
					<p class="message" style="text-align:justify;word-wrap: break-word;"> <?php echo $msg; ?> ... <u>Read More</u><br>
					<span class="timee"><?php echo $row['modified']; ?></span>
					</p>
				  </a>
				</li>
				
		<?php		
				}
	}else{
		?>
			<script>
			$('#notify_count').html('0');
			</script>
			
			<li  style="height:350px;width:100%;">
			 <br>
			<center style="width:100%;">	
			 <h4> Notification Not Found</h4>
			<img src="images/no_notify.png" alt="Notification" /> 
			</center>
				
			
			</li>
		<?php
	}
}


if(isset($_GET["load_data"]))
{
	//$admin_id=$_GET["admin_id"];
	$notify_id=$_GET["notify_id"];
	
	$data = mysql_query("SELECT * FROM su_notifications WHERE id='$notify_id'") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		while($row=mysql_fetch_array($data)) 
		{
?>

				<p style="color:black;"><b>Subject : </b><?php echo $row['subject']; ?></p> 
				<p style="color:black;"><b>Message :</b>
				<p style="text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;">
				<?php echo $row['message']; ?></span></p>
				<p style=color:black;><b>Published : </b><i><?php echo $row['modified']; ?></i></p>
				  
				  
				 <br>
				 
	 			<b>If You want to delete this Notification : </b>
				<br><a href="javascript:void(0);" onclick="delete_notify(<?php echo $row['id']; ?>);">
				<input type=button class="btn btn-danger" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>
			<a href="javascript:void(0);">
			<input type="button" class="btn btn-warning" data-dismiss="modal" onclick="reload12();" 
			style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/></a>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		 
	
<?php		
		}
}

if(isset($_GET["delete_notify"]))
{
	 $notify_id = $_GET["notify_id"];
	// $admin_id = $_GET["admin_id"];
	
	 $del ="DELETE FROM su_notifications WHERE id='$notify_id'";
		$result= mysql_query($del) or die(mysql_error());
		 if($result)
				{
					echo "Notification Delete .. !!";
					}
				else {
					echo "Something went wrong, Please try again later.";
				}
}
?>
