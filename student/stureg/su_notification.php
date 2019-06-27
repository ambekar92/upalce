<?php
error_reporting(0);
include('db.php');


if(isset($_GET["notify_list"]))
{
	$stu_college_id=$_GET["stu_college_id"];
	//$data = mysql_query("SELECT * FROM notifications WHERE fk_clg_id='$admin_id' ORDER BY id DESC") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
	
$data = mysql_query("select * FROM su_notifications ORDER BY id DESC") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());

	
	$rowcount=mysql_num_rows($data);	
	if($rowcount>0){
		while($row=mysql_fetch_array($data)) 
			{
			/* 	$subject=$row['subject']; 
				$message=$row['message']; 
			} */	
			$msg= substr($row['message'],0,50);
		?>

			<script>
			$('#notify_count_exp').html('<?php echo $rowcount;?>');
			</script>
			
			<li class="list_data" onclick="exp_list_data_get('<?php echo $row['id'];?>');">
			  <a>
				<span><img src="images/admin_notify.png" alt="Profile Image" style="height:30px;width:30px;" /></span>
				<span>
				  <span style="font-size:14px;"><b><?php echo $row['subject']; ?></b></span>
				  <span class="time">	</span>
				</span>
				<p class="message" style="text-align:justify;word-wrap: break-word;"> <?php echo $msg; ?> ... <u>Read More</u><br><br>
				<span class="timee"><b><i style="font-size:11px !important;"><?php echo $row['modified']; ?></i></b></span>
				</p>
			  </a>
			</li>
			
		<?php		
			}
		}//end if
		else{
			?>
			<script>
			$('#notify_count').html('0');
			</script>
			
			<li  style="height:200px;overflow:hidden;">
			 <br>
			<center>	
			 <h4> Notification Not Found</h4>
			<img src="images/no_notify.png" alt="Notification" /> 
			</center>
				
			
			</li>
		<?php
		}//end else
}


if(isset($_GET["load_data"]))
{
//$stu_college_id=$_GET["stu_college_id"];
	$notify_id=$_GET["notify_id"];
	
	//$data = mysql_query("SELECT * FROM notifications WHERE id='$notify_id' and fk_clg_id='$admin_id'") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		
$data = mysql_query("select * FROM su_notifications WHERE id='$notify_id'") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());


		
		while($row=mysql_fetch_array($data)) 
		{
?>

				<p style="color:black;"><b>Subject : </b><?php echo $row['subject']; ?></p> 
				<p style="color:black;"><b>Message :</b>
				<p style="text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;">
				<?php echo $row['message']; ?></span></p>
				<p style=color:black;><b>Published : </b><i><?php echo $row['modified']; ?></i></p>
			
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		 
	
<?php		
		}
}

?>
