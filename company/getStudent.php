<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
include('sup_files/db.php');
?>

<script type="text/javascript">
var deleteVar=null;
var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.appliedJOB={

loadStudentDetails:function(){   
 debugger;  
  var college_id= $('#college_id').val();
  var job_id= $('#job_id').val();
  var url="ajax/getAppDetailsFGEI.php";
  var myData={getStudentList:"getStudentList",college_id:college_id,job_id:job_id};

       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){

        if(obj.loadStudentDetails==null){
          $('#loadStudentDetails').DataTable({
             "paging":false,
              "ordering":true,
              "info":true,
              "searching":false,         
              "destroy":true,
          }).clear().draw();

        }else{
        var loadStudentDetails = $('#loadStudentDetails').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "destroy":true,
            "data":obj.loadStudentDetails,   
            "columns": [             
              { data: "sl_no" },       
              {
                "data":null,"sortable": false,
                "render": function ( data, type, row, meta ) {
                  return '<button class="btn btn-primary btn-xs" onclick="tempData.appliedJOB.view('+row.student_id+');">View Profile</button>'
                  +'<a href=../student/'+encodeURI(row.resume_name)+' target="_blank" title="Resume"> <button class="btn btn-warning btn-xs">'
                  +'Resume </button> </a>';	
                }
              },       
              { data: "firstname" },              
              { data: "10s_perc" },              
              { data: "12s_perc" },              
              { data: "be_perc" },             
              { data: "branch" },            
              ]
           });
           
        
           } // else End here  

          } // ajax success ends
        });   
},
gotoStudent:function(job_id,college_id){
  window.location="getStudent.php?job_id="+job_id+"&college_id="+college_id;
},
formatNumber:function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
},
view:function(id)
{
	params  = 'width='+window.outerWidth;
	params += ', height='+window.outerHeight;
	params += ', top=0, left=0'
	params += ', fullscreen=yes,scrollbars: 0';
	 
	//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
	if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){
		
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id;
		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	//window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/2016/admin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
	}else{
	//window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id;
		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	}
}

};


$(document).ready(function(){
  $('#comp_id').val(<?php echo $ad_com_id; ?>);  
  $('#job_id').val(<?php echo $_GET['job_id']; ?>);
  $('#college_id').val(<?php echo $_GET['college_id']; ?>);
  tempData.appliedJOB.loadStudentDetails();
});
</script>

   <input type="hidden" id="comp_id" name="comp_id">
   <input type="hidden" id="college_id" name="college_id">
   <input type="hidden" id="job_id" name="job_id">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">           
            <div class="clearfix"></div>    
            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">

                 <div class="x_panel">
                  <div class="x_title collapse-link" style="cursor: pointer;">
                    <h2>Job List > College List <b>> Student List</b></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
          
                  <div class="x_content"  style="width:100%;">
                    
                <table id="loadStudentDetails" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Sl.No</th>
                          <th>Action</th>
                          <th>Student Name</th>
                          <th>10th %</th>
                          <th>12th %</th>
                          <th>BE %</th>
                          <th>Branch</th>
                        </tr>
                  
                      </thead>
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


<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
       <div class="modal-header">
      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
       <h5 class="modal-title" id="myModalLabel">Message</h5>
       </div>
         <div class="modal-body">
         <p> Are you sure you want to delete ?</p>
    <input type=button id="btnYes" class="btn btn-success" data-dismiss="modal" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" 
    onclick="tempData.appliedJOB.confirmDelete(1)" value="YES" /></a>
    <input type="button" id="btnNo" class="btn btn-danger" data-dismiss="modal"  style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" 
    onclick="tempData.appliedJOB.confirmDelete(0)" value="NO"/>
         </div>
      <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
  <!--     <input type="button" class="btn btn-default" data-dismiss="modal" 
  style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/> -->
      </div>
    </div>
  </div>
</div>

</body>
</html>