<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='ad_admin';
/* $whereCond="fk_stu_id='$stu_id'";	 */
$Query = 'select * from '.$table;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());



?>

<script type = "text/javascript" language = "javascript">

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='college_info.php';
}

</script>

            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
       
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>College Info</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                   <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Private Number</th>
                          <th>College Name</th>                          
                          <th>Password</th>
                          <th>Email</th>
                          <th>Mobile</th>
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($skill_data)) 
						   {   
					   ?>     
					   <tr>                                               
						 <td><?php echo $row['private_number']; ?></td>                                            
						 <td><?php echo $row['clg_name']; ?></td>   
						 <td><?php echo $row['password']; ?></td>                                     
						 <td><?php echo $row['email']; ?></td>                                                        
						 <td><?php echo $row['mobile_number']; ?></td>                                                     
						</tr> 
							<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>
			  
			  </div> <!-- col-12 -->
            </div>
          </div>
        </div>
        <!-- /page content -->
		<br/>&nbsp;

		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

	

	
	
	 <!-- Datatables -->
    <script>
      $(document).ready(function() {
        

        $('#datatable').dataTable();

        
      });
    </script>
    <!-- /Datatables -->
</body>

</html>