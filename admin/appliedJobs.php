<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
include('sup_files/db.php');
?>

<script type="text/javascript">
var deleteVar=null;
var tempData;
var globalJOBData=null;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.appliedJOB={

loadJobDetails:function(){   
 debugger;
  var college_id= $('#college_id').val();  
  var comp_id= $('#comp_id').val();
  var url="ajax/getJobDetailsADM.php";
  var myData={getCompJobsList:"getCompJobsList",college_id:college_id,comp_id:comp_id};

       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){

              globalJOBData =obj.loadJobDetails;
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
              { data: "id",
                render: function (data, type, row, meta) {
                  var a='<button type="button" title="Approve" class="btn btn-primary btn-xs" onclick="tempData.appliedJOB.approve('+row.id+');"><i class="fa fa-check-circle"></i> Approve </button>';
                  var e='<button type="button" title="View" class="btn btn-info btn-xs" onclick="tempData.appliedJOB.viewInfo('+row.id+');"><i class="fa fa-eye"></i> </button>';
                  var b='<button type="button" title="Approved" class="btn btn-success btn-xs" onclick="tempData.appliedJOB.gotoJobs('+row.id+');"><i class="fa fa-check-circle"></i> View Students </button>';

                  if(row.clg_approval==1){
                    show = b+' '+e;
                  }else{
                    show = a+' '+e;
                  }
                  return show;
                }
              },
              { data: "job_id" },  
             
              { data: "type",
                 render: function (data, type, row, meta) {
                   var f,a,b;

                   if(row.type=='F'){
                    f='Fresher';
                   }else{
                    f='Internship';
                   }
                 
                  return f;
                }
              },
              { data: "title"},
              // { data: "requirement",
              //    render: function (data, type, row, meta) {
              //    var a="<textarea readonly>"+row.requirement+"</textarea>";
              //     return a;
              //   }
              // },
              { data: "no_position",className:'text-right'},
              { data: "salary",className:'text-right',
                render: function (data, type, row, meta) {
                 var a="&#8377;"+' '+tempData.appliedJOB.formatNumber(row.salary);
                  return a;
                }
              },    
              { data: "location"},
              { data: "stu_count",className:'text-right',
                 render: function (data, type, row, meta) {
                 var a="<p style='font-weight: bold;color:blue;'>"+row.stu_count+"</p>";
                 return a;
                }
              },
              { data: "last_date",
                 render: function (data, type, row, meta) {
                 var a="<p style='font-weight: bold;'>"+row.last_date+"</p>";
                 return a;
                 }
              },
              
              { data: "id",
                render: function (data, type, row, meta) {
                  var b='<button type="button" title="Edit" class="btn btn-primary btn-xs" onclick="tempData.appliedJOB.clg_to_hr('+row.id+');"><i class="fa fa-check-circle"></i> Approve </button>';
                  var a='<button type="button" title="Approved" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> </button>';
                  
                  if(row.clg_approval==1){

                    if(row.stu_count > 0){

                        if(row.clg_to_hr_status==1){
                          show = a;
                        }else{
                            show = b;
                        }

                    }else{
                        show = "Student Count < 0";
                    }
                    
                  }else{
                    show = "Approve Needed";
                  }
                
                  return show;
                }
              }
              ]
           });

           } // else End here  

          } // ajax success ends
        });   
},
gotoJobs:function(id){
   var comp_id= $('#comp_id').val();
    window.location="appliedJobStudent.php?comp_id="+comp_id+"&job_id="+id;
},
formatNumber:function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
},
approve:function (id){
  var url="ajax/getJobDetailsADM.php";
  var college_id= $('#college_id').val();

  var myData = {approve:'approve', rec_id:id,college_id:college_id};
  
   $.ajax({
        type:"POST",
        url:url,
        async: false,
        dataType: 'json',
        data:myData,
        success: function(obj) {
          debugger;
          if(obj.data != null){
             $("#commondialogJObs").modal();
             $("#getCodeJobs").html(obj.data.info);
             tempData.appliedJOB.loadJobDetails();
          }else{
            $("#commondialogJObs").modal({backdrop:'static'});
            $("#getCodeJobs").html('<p>Please Try Again !!</p>'); 
          }
        }
  });
},
clg_to_hr:function (id){
  var url="ajax/getJobDetailsADM.php";
  var college_id= $('#college_id').val();
  var code=101;

  var myData = {approve:'approve', rec_id:id,college_id:college_id,code:code};
  
   $.ajax({
        type:"POST",
        url:url,
        async: false,
        dataType: 'json',
        data:myData,
        success: function(obj) {
          debugger;
          if(obj.data != null){
             $("#commondialogJObs").modal();
             $("#getCodeJobs").html(obj.data.info);
             tempData.appliedJOB.loadJobDetails();
          }else{
            $("#commondialogJObs").modal({backdrop:'static'});
            $("#getCodeJobs").html('<p>Please Try Again !!</p>'); 
          }
        }
  });
},
getKeyByValue(object, value,key) { 
  debugger;
    for (var prop in object) { 
      if (object[prop][key] == value){
        return object[prop]; 
      }
    } 
},
viewInfo:function(val){
  var obj = tempData.appliedJOB.getKeyByValue(globalJOBData,val,'id');
  console.log(obj);

  var descp = obj.descp.replace(/↵/g,'<br/>');
  var requirement = obj.requirement.replace(/↵/g,'<br/>');
  console.log(requirement);

  var content='<h2>Job ID : <b>'+obj.job_id+'</b></h2><br>'+
              '<h2>Job Title : '+obj.title+'</h2><br>'+
              '<h2>Description :</h2><p>'+descp+'</p><br>'+
              '<h2>Requirement :</h2><p>'+requirement+'</p><br>'+
              '<h2>Salary : '+obj.salary+'</h2><br>'+
              '<h2>Number of Position : '+obj.no_position+'</h2><br>'+ 
              '<h2>Location : '+obj.location+'</h2><br>';
              '<h2>Last Date : '+obj.last_date+'</h2><br>';
             
  $('#bodyContent').html(content);
   $("#viewInfo").modal({backdrop:'static'});
},
};


$(document).ready(function(){
  $('#college_id').val(<?php echo $ad_clg_id; ?>);  
  $('#comp_id').val(<?php echo $_GET['comp_id']; ?>);
  tempData.appliedJOB.loadJobDetails();
});
</script>
  
   <input type="hidden" id="college_id" name="college_id">   
   <input type="hidden" id="comp_id" name="comp_id">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">           
            <div class="clearfix"></div>    
            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">

                 <div class="x_panel">
                  <div class="x_title collapse-link" style="cursor: pointer;">
                    <h2>Company List <b>> Jobs List </b></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
          
                  <div class="x_content"  style="width:100%;">   <!--overflow-x:scroll; -->
                    
                <table id="loadJobDetails" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Post Jobs to Students</th>
                          <th>Job ID</th>
                          <th>Type</th>                    
                          <th>Title</th>
                          <!-- <th>Description</th>
                          <th>Requirement</th> -->
                          <th>No. Position</th>
                          <th>Salary</th> 
                          <th>Location</th>
                          <th>Student Count</th>
                          <th>Last Date</th>
                          <th>Send List to HR</th>
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

<div class="modal fade" id="viewInfo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       <div class="modal-header">
      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
       <h5 class="modal-title" id="myModalLabel">Job Details</h5>
       </div>
         <div class="modal-body"  id="bodyContent">
         </div>
      <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
      <input type="button" class="btn btn-default" data-dismiss="modal" 
  style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="commondialogJObs" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body" id="getCodeJobs">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>

</body>
</html>