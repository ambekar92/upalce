<?php
session_start();
error_reporting(0);


include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');
//echo $server_db_name;

if (!isset($_SESSION['blog_stu_email'])) {
	unset($_SESSION['blog_stu_email']);
	//echo "<script> window.location='index.php';</script>";
	$login_status = "I";
}
else{
	$login_status = "A";
	$ses_email=$_SESSION['blog_stu_email'];

	$table='stu_student';
	$whereCond="email='$ses_email'";
	$Query = 'select * from '.$table.' where '.$whereCond;
	$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
		while($row=mysql_fetch_array($Result)) 
		{
			$stu_id=$row['id']; 
			$stu_status=$row['status']; 
			$stu_random_num_gen=$row['random_num_gen']; 
			$stu_college_id=$row['college_id']; 
			$stu_college_name=$row['college_name']; 
			$stu_firstname=$row['firstname']; 
			$stu_profile_img=$row['profile_img']; 
			$stu_usn=$row['usn']; 
			$stu_gender=$row['gender']; 
		} 
}
?>



<div id="commonID" class="modal fade"  role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body" id="commonInnerID">
              
            </div>
            <div class="modal-footer" style="border-top:none;">
               &nbsp;
            </div>
    </div>
  </div>
</div> 