	 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Common_DB</title>

  
</head>
<?php 
error_reporting(0);

if ($_SERVER['HTTP_HOST'] == 'localhost:8088') {
$connection=mysql_connect("localhost","root","") or DIE('connection failed');
mysql_select_db("uplacein_common_db") or DIE('Database name is not available!');
}
else{
$connection=mysql_connect("localhost","uplacein_admin","admin@123") or DIE('connection failed');
mysql_select_db("uplacein_common_db") or DIE('Database name is not available!');
}
	
$p_num = mysql_query("SELECT * FROM main_db") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($p_num)) 
{
	$server_id=$row['id']; 
	$server_host_name=$row['host_name']; 
	$server_db_name=$row['db_name']; 
	$server_username=$row['username']; 
	$server_password=$row['password']; 
}



/* Update the record by id */
if(isset($_POST['update_db']))
{
 $update_id =$_POST['update_id'];
 $server_host_name =$_POST['host_name'];
 $server_db_name =$_POST['db_name'];
 $server_username =$_POST['username'];
 $server_password =$_POST['password'];
 
	$Query = "UPDATE main_db set host_name='$server_host_name',db_name='$server_db_name',username='$server_username',password='$server_password'
		WHERE id = '$update_id'";					
		//echo $Query;die();
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
}					
?>
<style>
td{
	height: 30px;
    vertical-align: center;
}

input[type=text], input[type=password]  {
 	width: 100%;
	height:30px;
    margin: 8px 0;
	font-size:17px;
}

input[type=submit],input[type=reset] {
 	width: 40%;
	height:30px;
    margin: 8px 0;
	font-size:17px;
}

</style>


					<form method="post" action="DBconfig.php">
						<h1><span class="log-in">Database Configure</span></h1>
					
					<input type="hidden" name="update_id" value="<?php echo $server_id;?>" >
					
					<table border=0 width="40%">
					<tr>
						<td>HOST NAME</td>
						<td><input type="text" name="host_name" placeholder="HOST NAME" value="<?php echo $server_host_name;?>" autofocus required></td>
					</tr>
					<tr>
						<td>DB NAME</td>
						<td><input type="text" name="db_name" placeholder="DB NAME" value="<?php echo $server_db_name;?>" required></td>
					</tr>
					<tr>
						<td>USERNAME</td>
						<td><input type="text" name="username" placeholder="USERNAME" value="<?php echo $server_username;?>" required></td>
					</tr>
					<tr>
						<td>PASSWORD</td>
						<td><input type="password" name="password" placeholder="PASSWORD" value="<?php echo $server_password;?>"></td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input type="reset" value="Clear">
						<input type="submit" name="update_db" value="Update DB"></td>
					</tr>
					
					</table>

					
					</form>​​



</body>
</html>


