<?php
$to = 'santhoshkcse4@gmail.com';
$subject = "Beautiful HTML Email using PHP by CodexWorld";

$htmlContent = '
    <html>
    <head>
        <title>Welcome to CodexWorld</title>
    </head>
    <body>
        <h1>Thanks you for joining with us! SANTHOSH</h1>
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
            <tr>
                <th>Name:</th><td>CodexWorld</td>
            </tr>
            <tr style="background-color: #e0e0e0;">
                <th>Email:</th><td>contact@codexworld.com</td>
            </tr>
            <tr>
                <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td>
            </tr>
        </table>
    </body>
    </html>';

// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

// Additional headers
$headers .= 'From: SANTHOSH<sender@example.com>' . "\r\n";
$headers .= 'Cc: welcome@example.com' . "\r\n";
$headers .= 'Bcc: welcome2@example.com' . "\r\n";
$headers .= "Reply-To: The Sender <sender@domain.com>\r\n"; 

// Send email
if(mail($to,$subject,$htmlContent,$headers)):
    echo 'Email has sent successfully.';
else:
    echo 'Email sending fail.';
endif;
?>