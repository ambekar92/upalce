			
	
	
	   <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
   <!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>
	
	
	  <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
	
	<!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>
	
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
      
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="../build/js/bootstrap-select.min.js"></script>
	
<script>
$(document).ready(function() {
	//alert();
	
	$.ajax({
    url: 'stureg/notification.php?notify_list=data&stu_id='+<?php echo $stu_id?>+'&stu_college_id='+<?php echo $stu_college_id?>,
    type: 'GET',
    success: function (returndata) {
	//	alert(returndata);
    //<!-- function is call to header.php (Bootstrap model popup)-->
	$("#notify_list").html(returndata);
  
    }
  });
  
   $.ajax({
    url: 'stureg/su_notification.php?notify_list=data',
    type: 'GET',
    success: function (returndata) {
	//	alert(returndata);
  //  <!-- function is call to header.php (Bootstrap model popup)-->
	$("#notify_list_exp").html(returndata);
  
    }
  }); 
  
});

  function list_data_get(data){
//alert(data)
$.ajax({
    url: 'stureg/notification.php?load_data=loaded&notify_id='+data+'&stu_college_id='+<?php echo $stu_college_id?>,
    type: 'GET',
    success: function (returndata) {
	//	alert(returndata);	 
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode_project11").html(returndata);
    $("#commondialog_project11").modal({backdrop:'static'});
	  
    }
  });
} 

 function exp_list_data_get(data){
//alert(data)
$.ajax({
    url: 'stureg/su_notification.php?load_data=loaded&notify_id='+data,
    type: 'GET',
    success: function (returndata) {
	//	alert(returndata);	 
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode_project112").html(returndata);
    $("#commondialog_project112").modal({backdrop:'static'});
	  
    }
  });
}

</script>
