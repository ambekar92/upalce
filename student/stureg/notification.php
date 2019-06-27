<?php
error_reporting(0);
include('db.php');

date_default_timezone_set('Asia/Kolkata');

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );

    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}
if(isset($_GET["notify_list"]))
{
	$stu_college_id=$_GET["stu_college_id"];
	$stu_id=$_GET["stu_id"];
	//$data = mysql_query("SELECT * FROM notifications WHERE fk_clg_id='$admin_id' ORDER BY id DESC") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());

$data = mysql_query("select * FROM notifications n WHERE n.fk_clg_id=(select distinct clg.id from ad_admin clg, stu_student s 
	 where s.college_id=clg.clg_id and s.college_id='$stu_college_id') and n.branch_id IN(select branch_id from stu_education 
	where fk_stu_id = '$stu_id' and class='Graduation')
	and n.year IN(select end_year from stu_education where fk_stu_id = '$stu_id' and class='Graduation') ORDER BY n.id DESC") 
	or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
	
$dataForAll = mysql_query("select * from notifications where year=0 and fk_clg_id=(select distinct clg.id from ad_admin clg, stu_student s where s.college_id=clg.clg_id and s.college_id='$stu_college_id') ORDER BY id DESC");

	$rowcountdataForAll=mysql_num_rows($dataForAll);	

	$rowcount=mysql_num_rows($data);	
	
	
	if($rowcount>0 || $rowcountdataForAll>0){
?>

			<script>
			$('#notify_count').html('<?php echo ($rowcount + $rowcountdataForAll);?>');
			</script>
		<?php
			while($row=mysql_fetch_array($data)) 
			{
			$msg= substr($row['message'],0,50);
		?>

			
			<li class="list_data" onclick="list_data_get('<?php echo $row['id'];?>');" style="height: 100px;">
			  <a>
				<span><img src="images/admin_notify.png" alt="Profile Image" style="height:30px;width:30px;" /></span>
				<span>
				  <span style="font-size:14px;"><b><?php echo $row['subject']; ?></b>&nbsp;&nbsp;
					  <?php  if($row['img_notify'] != ''){ ?>
					  	<i class="fa fa-paperclip fa-2x" aria-hidden="true"></i>
					  	<?php } ?>
				</span>
				  <span class="time">	</span>
				</span>
				<p class="message" style="text-align:justify;word-wrap: break-word;"> <?php echo $msg; ?> ... <u>Read More</u><br><br>
				<span class="timee"><b><i style="font-size:11px !important;"><?php echo timeAgo($row['modified']); ?></i></b></span>
				</p>
			  </a>
			</li>
			
		<?php		
			}
			
		while($row=mysql_fetch_array($dataForAll)) 
			{
			$msg= substr($row['message'],0,50);
		?>
	
			<li class="list_data" onclick="list_data_get('<?php echo $row['id'];?>');" style="height: 100px;">
			  <a>
				<span><img src="images/admin_notify.png" alt="Profile Image" style="height:30px;width:30px;" /></span>
				<span>
				  <span style="font-size:14px;"><b><?php echo $row['subject']; ?></b>&nbsp;&nbsp;
					  <?php  if($row['img_notify'] != ''){ ?>
					  	<i class="fa fa-paperclip fa-2x" aria-hidden="true"></i>
					  	<?php } ?>
				  </span>
				  <span class="time">	</span>
				</span>
				<p class="message" style="text-align:justify;word-wrap: break-word;"> <?php echo $msg; ?> ... <u>Read More</u><br><br>
				<span class="timee"><b><i style="font-size:11px !important;"><?php echo timeAgo($row['modified']); ?></i></b></span>
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
$stu_college_id=$_GET["stu_college_id"];
	$notify_id=$_GET["notify_id"];
	
	//$data = mysql_query("SELECT * FROM notifications WHERE id='$notify_id' and fk_clg_id='$admin_id'") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		
$data = mysql_query("select * FROM notifications WHERE id='$notify_id' and fk_clg_id=(select distinct clg.id from ad_admin clg JOIN stu_student s ON 
	s.college_id=clg.clg_id where s.college_id='$stu_college_id')") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());


		
		while($row=mysql_fetch_array($data)) 
		{
?>

				<p style="color:black;"><b>Subject : </b><?php echo $row['subject']; ?></p> 
				<p style="color:black;"><b>Message :</b>
				<p style="text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;">
				<?php echo $row['message']; ?></span></p>
				<p style=color:black;><b>Published : </b><i><?php echo $row['modified']; ?></i></p>
			 <?php  if($row['img_notify'] != ''){ ?>
				<img src="../admin/<?php echo $row['img_notify']; ?>" alt="Profile Image" class="img-responsive" /><br>
				<a href="../admin/<?php echo $row['img_notify']; ?>"  target="_blank">
					<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
				</a>
			<?php } ?>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		 
	
<?php		
		}
}

?>
