<?php
$subject = "this is a subject";
$message = "testing a message";




  $headers .= "Reply-To: The Sender <sender@domain.com>\r\n"; 
  $headers .= "Return-Path: The Sender <sender@domain.com>\r\n"; 
  $headers .= "From: The Sender <sender@domain.com>\r\n";  
  $headers .= "Organization: Sender Organization\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;



mail("santhoshkcse4@gmail.com", $subject, $message, $headers); 


?>