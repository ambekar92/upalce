<?php
session_start();
error_reporting(0);
//date_default_timezone_set('Asia/Kolkata');

include('../../common_db.php'); 

$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');


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


if(isset($_POST['saveComm'])){
	
	$commentMsg=$_POST['commentMsg'];
	$login_status=$_POST['login_status'];

	$stu_id_fk=$_POST['stu_id_fkb'];
	$stu_name=$_POST['stu_nameb'];
	$keyword=$_POST['keywordb'];
	$clg_id_fk=$_POST['clg_id_fkb'];
	$clg_name=$_POST['clg_nameb'];
	$stu_profile_img=$_POST['stu_profile_imgb'];

	//die($login_status);
	if($login_status == "A")
	{
		$sql="INSERT INTO blog_info (msg,stu_id_fk,stu_name,keyword,clg_id_fk,clg_name,profile_img) 
		VALUES('$commentMsg','$stu_id_fk','$stu_name','$keyword','$clg_id_fk','$clg_name','$stu_profile_img')";
		
		if(mysql_query($sql)){
			echo "<p style='color:green;font-weight:bold;'>Posted Successfully.</p>";
		}else{
			die('Error: ' . mysql_error());
		}
	}
	else
	{
		echo "<p style='color:red;font-weight:bold;'>Please Login Before you Post !!</p>";

	}		
}

if(isset($_POST['loginBlog']))
{	
	$email = mysql_real_escape_string($_POST['email']);
	$password=md5($_POST['password']);
	//echo $email." ".$password;
	$query = mysql_query("select * from stu_student where password='".$password."' AND email='".$email."'") or 
	die('Error: ' . mysql_error());
	//echo mysql_num_rows($query);
	if (mysql_num_rows($query) == 1) {
		
		$table='stu_student';
		$whereCond="email='$email'";
		$sub_q = 'select * from '.$table.' where '.$whereCond;
		$res_q = mysql_query($sub_q) or die("Error in Selection Query <br> ".$sub_q."<br>". mysql_error());
	//	echo mysql_num_rows($res_q);
		while($row=mysql_fetch_array($res_q)) 
		{
			$_SESSION['blog_stu_email'] = $row['email'];

			$stu_id=$row['id']; 
			$stu_status=$row['status']; 
			$stu_random_num_gen=$row['random_num_gen']; 
			$stu_college_id=$row['college_id']; 
			$stu_college_name=$row['college_name']; 
			$stu_firstname=$row['firstname']; 
			$stu_profile_img=$row['profile_img']; 
			$stu_usn=$row['usn']; 
			$stu_gender=$row['gender']; 

			$main_info[]=array('stu_id' =>"$stu_id",'stu_status' =>"$stu_status",'stu_random_num_gen' =>"$stu_random_num_gen",'stu_college_id' =>"$stu_college_id",'stu_college_name' =>"$stu_college_name",'stu_firstname' =>"$stu_firstname",'stu_profile_img' =>"$stu_profile_img",'stu_usn' =>"$stu_usn",'stu_gender' =>"$stu_gender");
		} 
		//print_r($main_info);die;
				$status = array_values($main_info);
		 		$fin_json["data"]=$status;
		 		echo $json_final = json_encode($fin_json);
		
	}else
	{
		//echo "F";
		$fin_json["data"]="F";
		echo $json_final = json_encode($fin_json);
	}
}
if(isset($_POST['logoutBlog']))
{
	unset($_SESSION['blog_stu_email']); 
	echo "F";
}

if(isset($_POST['loadComm']))
{

	$keywordb=$_POST[keywordb];
	$sql="SELECT id,stu_id_fk,stu_name,keyword,clg_id_fk,clg_name,msg,modified,profile_img from blog_info where keyword='".$keywordb."' order by id DESC";
	$res = mysql_query($sql);

	while($row=mysql_fetch_array($res)) 
		{
			$blog_id=$row['id']; 
			$stu_id_fk=$row['stu_id_fk']; 
			$stu_name=$row['stu_name'];
			$keyword=$row['keyword']; 
			$clg_id_fk=$row['clg_id_fk']; 
			$clg_name=$row['clg_name']; 
			$msg=$row['msg']; 
			$modified=timeAgo($row['modified']); 
			$stu_profile_img=$row['profile_imgb']; 

			$main_info[]=array('blog_id' =>"$blog_id",'stu_id_fk' =>"$stu_id_fk",'stu_name' =>"$stu_name",'keyword' =>"$keyword",'clg_id_fk' =>"$clg_id_fk",'clg_name' =>"$clg_name",'msg' =>"$msg",'modified' =>"$modified",'profile_img'=>"$stu_profile_img");
		} 
		//print_r($main_info);die;
				$status = array_values($main_info);
		 		$fin_json["data"]=$status;
		 		echo $json_final = json_encode($fin_json);		
}

if(isset($_POST['loadComm2']))
{

	$keywordb=$_POST[keywordb];
	$blog_id=$_POST[blog_id];

	$sql="SELECT id,stu_id_fk,stu_name,keyword,clg_id_fk,clg_name,msg,modified,profile_img from blog_info where keyword='".$keywordb."' and 
			id='".$blog_id."' order by id DESC";
	$res = mysql_query($sql);

	while($row=mysql_fetch_array($res)) 
		{
			$blog_id=$row['id']; 
			$stu_id_fk=$row['stu_id_fk']; 
			$stu_name=$row['stu_name'];
			$keyword=$row['keyword']; 
			$clg_id_fk=$row['clg_id_fk']; 
			$clg_name=$row['clg_name']; 
			$msg=$row['msg']; 
			$modified=timeAgo($row['modified']); 
			$stu_profile_img=$row['profile_img']; 

			$main_info[]=array('blog_id' =>"$blog_id",'stu_id_fk' =>"$stu_id_fk",'stu_name' =>"$stu_name",'keyword' =>"$keyword",'clg_id_fk' =>"$clg_id_fk",'clg_name' =>"$clg_name",'msg' =>"$msg",'modified' =>"$modified",'stu_profile_img'=>"$stu_profile_img");
		} 
		//print_r($main_info);die;
				$status = array_values($main_info);
		 		$fin_json["data"]=$status;
		 		echo $json_final = json_encode($fin_json);		
}


if(isset($_POST['saveSubComm'])){
	
	$commentMsg=$_POST['commentSubMsg'];
	$login_status=$_POST['login_status'];

	$stu_id_fk=$_POST['stu_id_fkb'];
	$stu_name=$_POST['stu_nameb'];
	$keyword=$_POST['keywordb'];
	$clg_id_fk=$_POST['clg_id_fkb'];
	$clg_name=$_POST['clg_nameb'];
	$blog_id=$_POST['blog_id'];	
	$stu_profile_img=$_POST['stu_profile_imgb'];

	//die($login_status);
	if($login_status == "A")
	{
		$sql="INSERT INTO blog_info_details (msg_rep,stu_id_fk,stu_name,keyword,clg_id_fk,clg_name,blog_info_id,profile_img) 
		VALUES('$commentMsg','$stu_id_fk','$stu_name','$keyword','$clg_id_fk','$clg_name','$blog_id','$stu_profile_img')";
		
		if(mysql_query($sql)){
			echo "<p style='color:green;font-weight:bold;'>Posted Successfully.</p>";
		}else{
			die('Error: ' . mysql_error());
		}
	}
	else
	{
		echo "<p style='color:red;font-weight:bold;'>Please Login Before you Post !!</p>";
	}		
}

if(isset($_POST['loadNestedComm']))
{

	$keywordb=$_POST[keywordb];
	$blog_id=$_POST[blog_id];

	$sql="SELECT id,stu_id_fk,stu_name,keyword,clg_id_fk,clg_name,msg_rep,modified,profile_img from blog_info_details where keyword='".$keywordb."' and blog_info_id='".$blog_id."' order by id DESC";
	$res = mysql_query($sql);

	while($row=mysql_fetch_array($res)) 
		{
			$blog_id=$row['id']; 
			$stu_id_fk=$row['stu_id_fk']; 
			$stu_name=$row['stu_name'];
			$keyword=$row['keyword']; 
			$clg_id_fk=$row['clg_id_fk']; 
			$clg_name=$row['clg_name']; 
			$msg=$row['msg_rep']; 
			$modified=timeAgo($row['modified']); 
			$stu_profile_img=$row['profile_img']; 

			$main_info[]=array('subBlog_id' =>"$blog_id",'stu_id_fk' =>"$stu_id_fk",'stu_name' =>"$stu_name",'keyword' =>"$keyword",'clg_id_fk' =>"$clg_id_fk",'clg_name' =>"$clg_name",'msg' =>"$msg",'modified' =>"$modified",'stu_profile_img'=>"$stu_profile_img");
		} 
		//print_r($main_info);die;
				$status = array_values($main_info);
		 		$fin_json["data"]=$status;
		 		echo $json_final = json_encode($fin_json);		
}

?>