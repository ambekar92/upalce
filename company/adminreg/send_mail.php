<?php
 include('db.php');
 
$to=$_REQUEST['to'];
$data_link=$_REQUEST['data_link'];
$subject=$_REQUEST['subject'];
$msg=$_REQUEST['txtEditor'];
$admin_email=$_REQUEST['admin_email'];
 
// echo "$to,$data_link,$subject,$admin_email,$msg"; die();
 if($to != '' && $data_link != '' && $subject != '' && $msg != ''){
	   $to =''.$to.'';
       $subject = ''.$subject.'';
       $headers = "From: " . strip_tags(''.$admin_email.'') . "\r\n";
	   //$headers .= 'CC:'.$cust_email2.''."\r\n";
	   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";
	   //$headers .= "Reply-To: ". strip_tags('sandeep@panache.diamonds') . "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
       $message = $msg;
       $message .='<h5>Please Check the Below Link :</h5>
	   <a href='.$data_link.' style="-moz-box-shadow:inset 0px 0px 5px 1px #54a3f7;
	-webkit-box-shadow:inset 0px 0px 5px 1px #54a3f7;
	box-shadow:inset 0px 0px 5px 1px #54a3f7;
	background-color:#007dc1;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #124d77;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Courier New;
	font-size:16px;
	font-weight:bold;
	padding:8px 21px;
	text-decoration:none;
	text-shadow:0px 1px 24px #154682;">Profile Details link</a>
</body>
</html>';
       if(mail($to, $subject, $message, $headers))
	   {
		   echo "Mail Sent Successfully";
	   }
	   else
	   {
		   echo "Network Issues Please try Again Later !!";
	   }
}else
{
   echo "Fields are Mandatory";
}	   

?>
