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
       $headers = "From:".strip_tags(''.$admin_email.'')."\r\n";
	   //$headers .= 'CC:'.$cust_email2.''."\r\n";
	   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";
	   //$headers .= "Reply-To: ". strip_tags('sandeep@panache.diamonds') . "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
       $message = $msg;
       $message .='<h4 style="text-algin:left;">Please Check the Below Link :</h4><br/>
	  <a href='.$data_link.' style="font-size:16px;padding: 8px 21px;text-algin:left;
		text-decoration: none;
		text-shadow: 0px 1px 24px #154682;
		border: 2px solid black;
		border-radius: 17px;">Profile Details link</a><br/><br/><br/>-----<br/>
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
