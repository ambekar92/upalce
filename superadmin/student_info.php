<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_student';
$whereCond="college_id=".$_GET['college_id'];
$Query = 'select * from '.$table.' where '.$whereCond;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());



?>

<script type = "text/javascript" language = "javascript">

function reload12()
{	

/*  <!-- function is call to header.php (Bootstrap model popup)-->*/
  var clgId=$('#clg_name').val();
  window.location='student_info.php?college_id='+clgId;
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
                    <h2>Student Info</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="row">
            <label class="control-label col-md-3 col-sm-2 col-xs-12">Select College<span class="required">*</span></label>
                         <?php 
            //Get all country data
            $get_clg = "SELECT * FROM su_active_clgs ORDER BY college_name ASC "; 
            $clg_d = mysql_query($get_clg) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
            //echo $private_number='ADM'.rand(1111111111,9999999999);
            ?>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                          <select  name="clg_name" id="clg_name" class="form-control select2_single_country" tabindex="-1" required="required" data-placement="right" data-toggle="tooltip" title="This field is required." onchange="reload12();">
                            <option></option>
                            <?php
              
                while($row=mysql_fetch_array($clg_d)){ 
                  echo '<option value="'.$row['college_id'].'">'.$row['college_name'].'</option>';
                }
              
              ?>
                          </select>
                        </div>
                    </div> 
          <br>

				  
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                   <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Reg Numberr</th>
                          <th>College Name</th>                          
                          <th>Student Name</th>
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
						 <td><?php echo $row['random_num_gen']; ?></td>                                            
						 <td><?php echo $row['college_name']; ?></td>   
             <td><?php echo $row['firstname']; ?></td>                                     
						 <td><?php echo $row['c_pass']; ?></td>                                     
						 <td><?php echo $row['email']; ?></td>                                                        
						 <td><?php echo $row['mobile']; ?></td>                                                     
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
        

        $(".select2_single_country").select2({
          placeholder: "Select a Company",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });


        $('#datatable').dataTable();

        
      });
    </script>
    <!-- /Datatables -->
</body>

</html>