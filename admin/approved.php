<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
include('sup_files/db.php');
?>

<script type="text/javascript">
var deleteVar=null;
var globalJOBData=null;
var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.appliedJOB={

loadJobDetails:function(){   
 debugger;
  var college_id= $('#college_id').val();
  var url="ajax/getJobDetailsADM.php";
  var myData={getSavedJobDetails:"getSavedJobDetails",college_id:college_id};

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
            /*     "scrollX": true,    "scrollY": 250, */
        globalJOBData = obj.loadJobDetails;
        var loadJobDetails = $('#loadJobDetails').DataTable( {
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "destroy":true,
            "data":obj.loadJobDetails,   
            "columns": [
              { data: "company_id",
                render: function (data, type, row, meta) {
                  var a='<button type="button" title="Edit" class="btn btn-primary btn-xs" onclick="tempData.appliedJOB.gotoJobs('+row.company_id+');"><i class="fa fa-eye"></i> View Jobs </button>';
                  
                  return a;
                }
              },
              { data: "comp_name" },
              // { data: "contact_person_1"},
              // { data: "designation_1"},
              // { data: "email_1"},
              // { data: "mobile_number_1"},
              // { data: "company_id",
              //   render: function (data, type, row, meta) {
              //    var a=row.state+','+row.country;
              //     return a;
              //   }
              // },    
              { data: "totaljobs",className:"text-right",
                render: function (data, type, row, meta) {
                 //var a=row.state+','+row.country;
                  return "<p style='font-weight: bold;color:blue;'>"+row.totaljobs+"</p>";
                }
              },
              { data: "approvedJobs",className:"text-right",
                render: function (data, type, row, meta) {
                 //var a=row.state+','+row.country;
                  return "<p style='font-weight: bold;color:blue;'>"+row.approvedJobs+"</p>";
                }
              }   
              
              ]
           });

           } // else End here  

          } // ajax success ends
        });   
},
gotoJobs:function(compId){
    window.location="appliedJobs.php?comp_id="+compId;
},
};


$(document).ready(function(){
  $('#college_id').val(<?php echo $ad_clg_id; ?>);
  tempData.appliedJOB.loadJobDetails();
});
</script>
  
   <input type="hidden" id="college_id" name="college_id">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">           
            <div class="clearfix"></div>    
            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">

                 <div class="x_panel">
                  <div class="x_title collapse-link" style="cursor: pointer;">
                    <h2>Company List</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
          
                  <div class="x_content"  style="width:100%;">
                    
                   <table id="loadJobDetails" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Action</th>
                          <th>Company</th>
                          <!-- <th>Contact Person</th>
                          <th>Designation</th> -->
                          <!-- <th>Email</th> -->
                          <!-- <th>Mobile Number</th> -->
                          <!-- <th>Company Location</th> -->
                          <th>Posted Jobs</th>
                          <th>Approved Jobs</th>
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