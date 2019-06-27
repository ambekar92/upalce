<?php
 

$form="santhoshcse4@gmail.com";

$subject="Test Mail From UPLACE";

$msg="Hi The Test Mail is Working";

$to='santhosh@uplace.in';

 

// echo "$form,$subject,$msg"; die();

 if($form != '' && $subject != '' && $msg != ''){

	   $to =''.$to.'';

       $subject = ''.$subject.'';

       $headers = "From: " . strip_tags(''.$form.'') . "\r\n";

	   //$headers .= 'CC:'.$cust_email2.''."\r\n";

	   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";

	   //$headers .= "Reply-To: ". strip_tags('sandeep@panache.diamonds') . "\r\n";

       $headers .= "MIME-Version: 1.0\r\n";

       $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

       $message = '<html><body>

	   <h2>Contact Person Details</h2>

	   Sender Mail:<br>'.$form.'<br><br>

	   Subject:<br>'.$subject.'<br><br>

	   Message:<br>'.$msg.' 

	   </body></html>';

      

		

       if(mail($to, $subject, $message, $headers))

	   {

		   echo "1";

	   }

	   else

	   {

		   echo "0";

	   }

}else

{

   echo "M";

}	   



?>