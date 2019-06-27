<?php
error_reporting(0);
include('db.php');

//date_default_timezone_set('Asia/Kolkata');

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

function sentMailNotification($paths,$branch,$notify_year,$message,$subject,$admin_id){

//echo "<pre>"; print_r($branch); die();

if($branch==138){
	//$sql="select stu.email as stuMail,ad.clg_name as ClgName,ad.email as clgMail,ad.off_email as offClgMail from stu_student stu, ad_admin ad where stu.college_id=ad.clg_id and ad.id=".$admin_id;

	$sql="select stu_e.end_year as year,stu.email as stuMail,ad.clg_name as ClgName,ad.email as clgMail,ad.off_email as offClgMail from stu_student stu, ad_admin ad,stu_education stu_e where stu.id=stu_e.fk_stu_id and stu.college_id=ad.clg_id and ad.id=".$admin_id."  and stu_e.end_year=".$notify_year." group by stuMail";
}else{
	$sql="select stu.email as stuMail,ad.clg_name as ClgName,ad.email as clgMail,ad.off_email as offClgMail from stu_student stu, ad_admin ad,stu_education stu_e where stu.college_id=ad.clg_id and ad.id=".$admin_id."  and stu.id=stu_e.fk_stu_id and stu_e.end_year=".$notify_year." 
	    and stu_e.branch_id IN (".implode(',',$branch).")  group by stu.email";
}

//echo $sql; die;

$Mailres = mysql_query($sql) or die(" Error in Server !!");
while($row=mysql_fetch_array($Mailres)) 
{
	//$stuMail=$row['stuMail'];	
	$ClgName=$row['ClgName'];	
	$clgMail=$row['clgMail'];	
	$offClgMail=$row['offClgMail'];	

	$mail=$row['stuMail'];	
	$mailArr[]=array($mail);

	SendMail($mail,$ClgName,$clgMail,$offClgMail,$paths,$message,$subject);
}
//print_r($mailArr);
/*echo "<br>".$sql;
echo "<br>".$paths;
echo "<br>".$branch;
echo "<br>".$notify_year;
echo "<br>".$message;
echo "<br>".$subject;
echo "<br>".$admin_id;*/


//recipient
// $mailArr = array("santhoshkcse4@gmail.com","santhoshcse4@gmail.com","santhoshk@eimsolutions.com");
// $mail = rtrim(implode(',', $mailArr), ',');
//die();

}

function SendMail($mail,$ClgName,$clgMail,$offClgMail,$paths,$message,$subject){
	$to = $mail;

//sender
$from = $clgMail;
$fromName = $ClgName;

//email subject
$subject = $subject; 

//attachment file path
$file = "../".$paths;

//email body content
$htmlContent = '<h2>Notification From '.$ClgName.'</h2>
    <p>'.$message.'</p>';

//header for sender info
$headers = "From: $fromName"." <".$from.">";

//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//headers for attachment 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

//multipart boundary 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

//preparing attachment
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($files[$i])."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

	//send email
	$mail = mail($to, $subject, $message, $headers, $returnpath); 

	/*if($mail){		  
	 	echo "1";
	}else{
		echo "0";
	}*/
}

if(isset($_POST["notify_subject"]))
{
	//echo "string";die();
	$subject=$_POST["notify_subject"];
	$message=$_POST["notify_msg"];
	$admin_id=$_POST["ad_id"];
	$branch=$_POST["branchs"];
	$notify_year=$_POST["notify_year"];
	
	//echo "<pre>"; print_r($branch); die();
		//$attchFile=$_POST["attchFile"];
		//$tmp=$_FILES['attchFile']['tmp_name'];
		$file_names = $_FILES['attchFile']['name'];
		$file_sizes =$_FILES['attchFile']['size'];
		$file_tmps =$_FILES['attchFile']['tmp_name'];
		$file_types=$_FILES['attchFile']['type'];   
	//die($admin_id);

		$imgExt = strtolower(pathinfo($file_names,PATHINFO_EXTENSION)); // get image extension
		$valid_extensions = array('jpg', 'png', 'pdf'); // valid extensions
		if(in_array($imgExt, $valid_extensions))
			{	
					//unlink("../$img_name");
			 $paths ="../notifications/".$admin_id."ADM".$file_names;
			// die($paths);
				if(move_uploaded_file($file_tmps,$paths)) 
				{
					$paths="notifications/".$admin_id."ADM".$file_names;
					/*$sql = "UPDATE stu_student set profile_img='$paths' WHERE id = '$user_id'";
					$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
					echo "Image Updated Sucessfully.";*/

					sentMailNotification($paths,$branch,$notify_year,$message,$subject,$admin_id);

					//if($returnVal==1){
						$table = 'notifications';

					for($i=0;$i<sizeof($branch);$i++){
						$query ="insert into $table (fk_clg_id,subject,message,branch_id,year,img_notify) values('$admin_id','$subject','$message','".$branch[$i]."','$notify_year','$paths')";
						$res = mysql_query($query) or die(" Error in Server !!sss");
					}
						
						
							if($res){
								echo "Notification Successfully Published .. !!";
							}
							else {
								echo "Something went wrong, Please try again later.";
							}	
					/*}else{
						echo "Something went wrong with Mail, Please try again later.";
					}*/
				}
				else{
				echo "Error in uploading file";
				}
			}
			else
			{
				$paths="";
				sentMailNotification($paths,$branch,$notify_year,$message,$subject,$admin_id);

				$table = 'notifications';

				for($i=0;$i<sizeof($branch);$i++){
					$query ="insert into $table (fk_clg_id,subject,message,branch_id,year) values('$admin_id','$subject','$message','".$branch[$i]."','$notify_year')"; 
					$res = mysql_query($query) or die(" Error in Server !aaa!");
				}

					
						if($res){
							echo "Notification Successfully Published .. !!";
						}
						else {
							echo "Something went wrong, Please try again later.";
						}
			}

			
}

if(isset($_GET["notify_list"]))
{
	$admin_id=$_GET["admin_id"];
	$data = mysql_query("SELECT img_notify,modified,subject,message,fk_clg_id,id,year,(select branch_name from branchs where id=e.branch_id) as branch FROM notifications e WHERE fk_clg_id='$admin_id' ORDER BY modified DESC") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		
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
				  <a style="width:100%;">
					<span><img src="images/admin_notify.png" alt="Profile Image" style="height:30px;width:30px;" /></span>
					<span>
					  <span style="font-size:14px;"><b><?php echo $row['subject']; ?></b> &nbsp;&nbsp;
					  <?php  if($row['img_notify'] != ''){ ?>
					  	<i class="fa fa-paperclip fa-2x" aria-hidden="true"></i>
					  	<?php } ?>
					  </span>
					  <span class="pull-right"><?php echo $row['branch']; ?></span><br>
					  <span class="pull-right"><?php if($row['year'] == 0){echo " "; }else{ echo $row['year']; } ?></span>
					</span>
					<p class="message" style="text-align:justify;word-wrap: break-word;width: 92%;"> <?php echo $msg; ?> ... <u>Read More</u><br>
					<span class="timee"><?php echo timeAgo($row['modified']);  ?></span>
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
	$admin_id=$_GET["admin_id"];
	$notify_id=$_GET["notify_id"];
	$data = mysql_query("SELECT img_notify,modified,subject,message,fk_clg_id,id,year,(select branch_name from branchs where id=branch_id) as branch FROM notifications WHERE id='$notify_id' and fk_clg_id='$admin_id'") or 
	die("Error in Selection Query <br> ".$query."<br>". mysql_error());
	
		while($row=mysql_fetch_array($data)) 
		{
?>
			<div class="col-md-6 col-xs-12">	
				<div class="col-md-12">
				<p style="color:black;"><b>Branch : </b><?php echo $row['branch']; ?></p> 
				</div>
				<div class="col-md-12">
				<p style="color:black;"><b>Year : </b><?php  if($row['year'] == 0){echo "All"; }else{ echo $row['year']; }?></p> </div>
				<div class="col-md-12">
				<p style="color:black;"><b>Subject : </b><?php echo $row['subject']; ?></p>  </div>
			</div>
			 <?php  if($row['img_notify'] != ''){ ?>
			<div class="col-md-6 col-xs-12">	
				<img src="./<?php echo $row['img_notify']; ?>" alt="Profile Image" class="img-responsive" /><br>
				<a href="./<?php echo $row['img_notify']; ?>"  target="_blank">
					<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
				</a>
			</div>	
			<?php } ?>
			<div class="col-md-12 col-xs-12">
				<p style="color:black;"><b>Message :</b>
				<p style="text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;">
				<?php echo $row['message']; ?></span></p>
				<p style=color:black;><b>Published : </b><i><?php echo $row['modified']; ?></i></p>
			  	 <br>
			 </div>	
			 <div class="col-md-12 col-xs-12">	 
	 			<b>If You want to delete this Notification : </b>
				<br><a href="javascript:void(0);" onclick="delete_notify(<?php echo $row['id']; ?>);">
				<input type=button class="btn btn-danger" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>
			<a href="javascript:void(0);">
			<input type="button" class="btn btn-warning" data-dismiss="modal" onclick="reload12();" 
			style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/></a>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
						
			</div>
<?php		
		}
}

if(isset($_GET["delete_notify"]))
{
	 $notify_id = $_GET["notify_id"];
	 $admin_id = $_GET["admin_id"];
	
	 $del ="DELETE FROM notifications WHERE id='$notify_id' and fk_clg_id='$admin_id'";
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
