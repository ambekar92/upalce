<?php
include('db.php');
$admin_id=$_GET["admin_id"];

$get_srch_q = "SELECT query from admin_search WHERE fk_ad_admin_id=$admin_id";
$srch_data= mysql_query($get_srch_q);
while($row_data=mysql_fetch_array($srch_data)) 
{
$value= $row_data['query'];
}


$sql=$value;


$header = '';
$result ='';
$exportData = mysql_query ($sql ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = mysql_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $exportData , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 date_default_timezone_set('Asia/Kolkata');
 $time=date('h:i:sa');
 $file=date("d/m/Y");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file--$time.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>