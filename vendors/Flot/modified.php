<?php 
if ($_SERVER['HTTP_HOST'] == 'localhost:8088') {
$connection=mysql_connect("localhost","root","") or DIE('connection failed');
mysql_select_db("common_db") or DIE('Database name is not available!');
}
else{
mysql_connect("localhost","uplacvyo_admin","admin@123") or DIE('connection failed');
mysql_select_db("uplacvyo_common_db") or DIE('Database name is not available!');
}
$p_num = mysql_query("SELECT * FROM main_db") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($p_num)) 
{
	$server_id=$row['id']; 
	$server_host_name=$row['host_name']; 
	$server_db_name=$row['db_name']; 
	$server_username=$row['username']; 
	$server_password=$row['password']; 
	$modified=$row['modified']; 
}




?>					
                   <table border="1" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                         <th>id</th>
						<th>Host Name</th>
						<th>DB</th>
						<th>Username</th>
						<th>Password </th>
						<th>Modified </th>
                       </tr>
                      </thead>
					  <tbody>
					                       
						<tr>
						<td><?php echo $server_id; ?></td>
						<td><?php echo $server_host_name; ?></td>                                            
						<td><?php echo $server_db_name; ?></td>                                            
						<td><?php echo $server_username; ?></td>                                            
						<td><?php echo $server_password; ?></td>                                            
						<td><?php echo $modified; ?></td>                                            
						 </tr>
						
						  </tbody>
                    </table>
					
<?php

mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');



$su_admin = mysql_query("SELECT * FROM su_admin") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
$ad_admin = mysql_query("SELECT * FROM ad_admin") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
$stu_student = mysql_query("SELECT * FROM stu_student") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

$count1=mysql_num_rows($su_admin);
$count2=mysql_num_rows($ad_admin);
$count3=mysql_num_rows($stu_student);
?>					
<br><br>
<?php echo $count1; ?>
					<table border="1" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                        <th>id</th>
						<th>Username</th>
						<th>Profile</th>
						<th>Email</th>
						<th>Password </th>
						<th>Mobile </th>
						<th>Modified </th>
                       </tr>
                      </thead>
					  <tbody>
						<?php
						  while ($row=mysql_fetch_array($su_admin)) 
						   {  
					   ?>                            
						<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['username']; ?></td>                                            
						<td><?php echo $row['profile_img']; ?></td>                                            
						<td><?php echo $row['email']; ?></td>                                            
						<td><?php echo $row['password']; ?></td>                                            
						<td><?php echo $row['mobile']; ?></td>                                            
						<td><?php echo $row['modified']; ?></td>                                            
						 </tr>
						 <?php 

						  }?>
						  </tbody>
                    </table>
                  
				  
<br><br>
<?php echo $count2; ?>
					<table border="1" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                        <th>id</th>
						<th>private_number</th>
						<th>clg_id</th>
						<th>clg_name </th>
						<th>email </th>
						<th>off_email </th>
						<th>password </th>
						<th>mobile_number </th>
						<th>country </th>
						<th>state </th>
						<th>current_location </th>
						<th>reg_number </th>
						<th>modified </th>
                       </tr>
                      </thead>
					  <tbody>
						<?php
						  while ($row=mysql_fetch_array($ad_admin)) 
						   {  
					   ?>                            
						<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['private_number']; ?></td>                                          
						<td><?php echo $row['clg_id']; ?></td>                                            
						<td><?php echo $row['clg_name']; ?></td>                                            
						<td><?php echo $row['email']; ?></td>                                            
						<td><?php echo $row['off_email']; ?></td>                                            
						<td><?php echo $row['password']; ?></td>                                            
						<td><?php echo $row['mobile_number']; ?></td>                                            
						<td><?php echo $row['country']; ?></td>                                            
						<td><?php echo $row['state']; ?></td>                                            
						<td><?php echo $row['current_location']; ?></td>                                            
						<td><?php echo $row['reg_number']; ?></td>                                            
						<td><?php echo $row['modified']; ?></td>                                            
						 </tr>
						 <?php 

						  }?>
						  </tbody>
                    </table>				  
		
<br><br>
<?php echo $count3; ?>
					<table border="1" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                        <th>id</th>
						<th>random_num_gen</th>
						<th>college_id</th>
						<th>email </th>
						<th>username </th>
						<th>password </th>
						<th>college_name </th>
						<th>usn </th>
						<th>mobile </th>
						<th>father_name </th>
						<th>mother_name </th>
						<th>alternate_mobile </th>
						<th>modified </th>
                       </tr>
                      </thead>
					  <tbody>
						<?php
						  while ($row=mysql_fetch_array($stu_student)) 
						   {  
					   ?>                            
						<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['random_num_gen']; ?></td>                                         
						<td><?php echo $row['college_id']; ?></td>                                            
						<td><?php echo $row['email']; ?></td>                                            
						<td><?php echo $row['username']; ?></td>                                            
						<td><?php echo $row['password']; ?></td>                                            
						<td><?php echo $row['college_name']; ?></td>                                            
						<td><?php echo $row['usn']; ?></td>                                            
						<td><?php echo $row['mobile']; ?></td>                                            
						<td><?php echo $row['father_name']; ?></td>                                            
						<td><?php echo $row['mother_name']; ?></td>                                            
						<td><?php echo $row['alternate_mobile']; ?></td>                                            
						<td><?php echo $row['modified']; ?></td>                                            
						 </tr>
						 <?php 

						  }?>
						  </tbody>
                    </table>		
</body>

</html>


