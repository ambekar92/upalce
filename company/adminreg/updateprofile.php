<?php
error_reporting(0);
include('db.php');

function mysql_update_array($table, $data, $exclude = array(),$cond) {
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
        	$dataA[]=$key."='" .$data[$key]. "'";
        }
    }     
    $dataA = implode(",", $dataA);

/*echo "UPDATE $table SET $dataA where $cond";
die();*/
$res = mysql_query("UPDATE $table SET $dataA where $cond") or die('Error: ' . mysql_error());;
    if( $res ) {
        return array( "mysql_error" => false,
                      "mysql_insert_id" => mysql_insert_id(),
                      "mysql_affected_rows" => mysql_affected_rows(),
                      "mysql_info" => mysql_info(),
                      "res_info" => "Successfully Updated.. !!"
                    );
    } else {
        return array("mysql_error" => mysql_error() );
    }
}




		$cond=' id = '.$_POST["ad_com_id"];
	    $table= 'ad_companies';	
	    $DataMarge=array('contact_person_1'=>$_POST["contact_person_1"],
						'designation_1'=>$_POST["designation_1"],
						'mobile_number_1'=>$_POST["mobile_number_1"],
						'email_1'=>$_POST["email_1"],
						'office_add'=>$_POST["office_add"],
						'country'=>$_POST["country"],
						'state'=>$_POST["state"],
						'current_location'=>$_POST["current_location"],
						'pinCode'=>$_POST["pinCode"],
						'gst_val'=>$_POST["gst_val"]
					  );

						$result=mysql_update_array($table,$DataMarge,'submit',$cond);

						//print_r($result);
						if($result['mysql_error']){
							//$error= "Query Failed: " . $result['mysql_error'];
							$error="$comp_name -- \"Already Registered\"";
							$response['data']=$error;
						}
						else
						{
						  $response['data']=$result['res_info'];
						}

		//$status['data'] = $response;     
        echo json_encode($response);


?>
