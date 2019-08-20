<?php 
 include('../adminreg/db.php');
 //date_default_timezone_set('Asia/Kolkata');


if(isset($_POST['loadClgInfo'])){

    $getClgInfo="SELECT id,email,clg_name,off_email,mobile_number,state,current_location,contact_person_1,mobile_number_1  FROM ad_admin   GROUP BY clg_id ORDER BY id DESC";
    $getClgInfoRes = mysql_query($getClgInfo) or die("Error :".mysql_error());
        

    while ($row=mysql_fetch_array($getClgInfoRes)) 
    {
       $clg_name=$row['clg_name'];
       $email=$row['email']; 
       $off_email=$row['off_email']; 
       $mobile_number=$row['mobile_number']; 
       $state=$row['state']; 
       $current_location=$row['current_location']; 
       $contact_person_1=$row['contact_person_1']; 
       $mobile_number_1=$row['mobile_number_1']; 

       $getAllClgDetails[]=array('clg_name' =>$clg_name,
                           'email' =>$email,
                           'off_email' =>$off_email,
                           'mobile_number' =>$mobile_number,
                           'state' =>$state,
                           'current_location' =>$current_location,
                           'contact_person_1' =>$contact_person_1,
                           'mobile_number_1' =>$mobile_number_1
                           );
    }

        $status["getAllClgDetails"] =$getAllClgDetails;
        $final_data=$status;
        echo json_encode($final_data);  
}





?>