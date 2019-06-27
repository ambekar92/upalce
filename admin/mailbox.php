<?php
  
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 
 
 include('links.php');
?>

<style>


.info{
	color:black;
	font-size:15px;
}
.info:hover .showme{
	background-color:red;
}
</style>
  <!-- page content -->
        <div class="right_col" role="main" style="background-color: #d6dbdc !important;">
          <div class="">


    <div class="clearfix"></div>
	 <div style="color:black;margin-bottom:2px;font-weight: bold;">Email ID :<span style="color:blue;"> <?php echo $off_email; ?> </span></div>
<div class="showme">Note: Password sent to your personal mail id.</div>
<iframe src="http://uplace.in/admin/webmail/" style="width:100%; height:500px;border:none;"></iframe>
       
	<?php include('sup_files/footer.php'); ?>

    </div>
    </div>
	

</body>

</html>
