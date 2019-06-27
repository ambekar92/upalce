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

loadCollegDetails:function(){   
 debugger;  
  var comp_id= $('#comp_id').val();
  var job_id= $('#job_id').val();
  var url="ajax/getAppDetailsFGEI.php";
  var myData={getCollegeList:"getCollegeList",comp_id:comp_id,job_id:job_id};

       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){

        if(obj.loadClgDetails==null){
          $('#loadClgDetails').DataTable({
             "paging":false,
              "ordering":true,
              "info":true,
              "searching":false,         
              "destroy":true,
          }).clear().draw();

        }else{
        var loadCollegDetails = $('#loadClgDetails').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "destroy":true,
            "data":obj.loadClgDetails,   
            "columns": [
             { data: "id",
                render: function (data, type, row, meta) {
                  var a='<button type="button" title="Action" class="btn btn-primary btn-xs" onclick="tempData.appliedJOB.gotoStudent('+job_id+','+row.clg_id+');"><i class="fa fa-eye"></i> View Student </button>';
                  return a;
                }
              },
              // { data:null,"SlNo":false,className: "text-center"},              
              { data: "clg_name" },              
              { data: "email" },              
              { data: "mobile_number" },              
              { data: "current_location" },              
              { data: "state" },              
              // { data: "contact_person_1" },
              // { data: "mobile_number_1" },
              // { data: "email_id_1" },    
              ]
           });
            // loadCollegDetails.on( 'order.dt search.dt', function () {
            // loadCollegDetails.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            //         cell.innerHTML = i+1;
            //     } );
            // } ).draw(); 

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

};


$(document).ready(function(){
  $('#comp_id').val(<?php echo $ad_com_id; ?>);  
  $('#job_id').val(<?php echo $_GET['job_id']; ?>);
  tempData.appliedJOB.loadCollegDetails();
});
</script>

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
                    <h2>Job List <b>> College List </b></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
          
                  <div class="x_content"  style="width:100%; overflow-x:auto;">
                    
                <table id="loadClgDetails" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Action</th>
                          <!-- <th>Sl.No.</th> -->
                          <th>College Name</th>
                          <th>Email ID</th>
                          <th>Mobile</th>
                          <th>Location</th>
                          <th>State</th>
                          <!-- <th>Passing Year</th> -->
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