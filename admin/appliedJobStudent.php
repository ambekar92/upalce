<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
include('sup_files/db.php');
?>

<style>
.usnCss{
  font-weight: 600;
  color: darkblue;
  letter-spacing: 1px;
}
</style>
<script type="text/javascript">
var deleteVar=null;
var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.appliedJOB={

loadJobDetails:function(){   
 debugger;
  var college_id= $('#college_id').val();  
  var comp_id= $('#comp_id').val();
  var job_id= $('#job_id').val();
  var url="ajax/getJobDetailsADM.php";
  var myData={getJobsStudentList:"getJobsStudentList",college_id:college_id,comp_id:comp_id,job_id:job_id};

       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){

        if(obj.loadJobDetails==null){
          $('#loadJobDetails').DataTable({
             "paging":false,
              "ordering":true,
              "info":true,
              "searching":false,         
              "destroy":true,
          }).clear().draw();

        }else{
        var loadJobDetails = $('#loadJobDetails').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "destroy":true,
            "data":obj.loadJobDetails,   
            "columns": [
              {
                  "data":null,"sortable": false,
                  "render": function ( data, type, row, meta ) { 
                    var url='';

                      var view ='<button class="btn btn-info btn-xs" onclick="tempData.appliedJOB.view('+row.student_id+');"><i class="fa fa-eye"></i> View</button>';

                      if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){
                        url="http://<?php echo $_SERVER['HTTP_HOST'];?>/student/"+row.resume_name;
                      }else{
                        url="http://<?php echo $_SERVER['HTTP_HOST'];?>/student/"+row.resume_name;
                      }

                      var resume='<a href="'+url+'" target="_blank" title="Resume"><button class="btn btn-warning btn-xs">	<i class="fa fa-file-text" aria-hidden="true"></i> Resume </button> </a>';
                      	
                      return resume+''+view;
                  }
              },      
              { data: "usn",
                "render": function ( data, type, row, meta ) { 
                  return "<sapn class='usnCss'>"+row.usn+"</sapn>";
                }
              },              
              { data: "firstname" },              
              { data: "gender" },              
              { data: "branch" },              
              { data: "email" },              
              { data: "end_year" },    
              ]
           });
            // loadJobDetails.on( 'order.dt search.dt', function () {
            // loadJobDetails.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            //         cell.innerHTML = i+1;
            //     } );
            // } ).draw(); 

           } // else End here  

          } // ajax success ends
        });   
},
view:function(id){
	
//<a href="stu_view_profile.php?stu_id=<?php echo $row["id"]; ?>" target="_blank"></a>

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
		}
		else{
		//window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id;
		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	}
},
gotoJobs:function(compId){
    window.location="appliedJobs.php?comp_id="+compId;
},
formatNumber:function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
};


$(document).ready(function(){
  $('#college_id').val(<?php echo $ad_clg_id; ?>);  
  $('#comp_id').val(<?php echo $_GET['comp_id']; ?>);
  $('#job_id').val(<?php echo $_GET['job_id']; ?>);
  tempData.appliedJOB.loadJobDetails();

  $('#select_all').click(function(event) { 
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;  
            
  var favorite = [];
  $.each($("input[name='select_all']:checked"), function(){            
      favorite.push($(this).val());
      $('#btn_'+$(this).val()).hide();
  });

			//$('#delete_btn').show();		
        });
    }else{
		$(':checkbox').each(function() {
            this.checked = false;   
      //$('#delete_btn').hide();	
      var favorite = [];
  $.each($("input[name='select_all']:checked"), function(){            
      favorite.push($(this).val());
      $('#btn_'+$(this).val()).show();
  });

        });
	}
}); 

});
</script>
  
   <input type="hidden" id="college_id" name="college_id">   
   <input type="hidden" id="comp_id" name="comp_id">
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
                    <h2>Company List <b>></b> Jobs List <b>> Students List </b></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
          
                  <div class="x_content"  style="width:100%; "> <!--overflow-x:auto; -->
                    
                <table id="loadJobDetails" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Action</th>
                          <!-- <th>Sl.No.</th> -->
                          <th>USN</th>
                          <th>First Name</th>
                          <th>Gender</th>
                          <th>Branch</th>
                          <th>Email</th>
                          <th>Passing Year</th>
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