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
                  var a='<button type="button" title="Edit" class="btn btn-primary btn-xs" onclick="tempData.appliedJOB.gotoJobs('+row.id+');"><i class="fa fa-eye"></i> View </button>';
                  
                  return a;
                }
              },
              { data: "comp_job_id" },              
              { data: "salary",
                render: function (data, type, row, meta) {
                 var a="&#8377;"+' '+tempData.appliedJOB.formatNumber(row.salary);
                  return a;
                }
              },
              { data: "last_date",
                 render: function (data, type, row, meta) {
                 var a="<p style='font-weight: bold;'>"+row.last_date+"</p>";
                  return a;
              }
              },
              { data: "title"},
              { data: "descp",
                 render: function (data, type, row, meta) {
                 var a="<textarea readonly>"+row.descp+"</textarea>";
                  return a;
                }
              },
              { data: "requirement",
                 render: function (data, type, row, meta) {
                 var a="<textarea readonly>"+row.requirement+"</textarea>";
                  return a;
                }
              },
              { data: "no_position"},
              { data: "location"},
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
publish:function (id){
  var url="ajax/getJobDetailsFGEI.php";
  var myData = {publish:'publish', rec_id:id};
  
   $.ajax({
        type:"POST",
        url:url,
        async: false,
        dataType: 'json',
        data:myData,
        success: function(obj) {
          debugger;
          if(obj.data != null){
             $("#commondialog").modal({backdrop:'static'});
             $("#getCode").html(obj.data.info);
             tempData.appliedJOB.loadJobDetails();
          }else{
            $("#commondialog").modal({backdrop:'static'});
            $("#getCode").html('<p>Please Try Again !!</p>'); 
          }
        }
  });
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
          
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                    
                <table id="loadJobDetails" class="table table-striped table-bordered" style="width:110%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Action</th>
                          <th>Job ID</th>
                          <th>Salary</th>
                          <th>Last Date</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Requirement</th>
                          <th>No. Position</th>
                          <th>Location</th>
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