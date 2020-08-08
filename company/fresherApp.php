<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
include('sup_files/db.php');
?>

<style>
.hightlight{
  font-weight: bolder;
    color: darkblue;
}
</style>
<script type="text/javascript">
var deleteVar=null;
var globalJOBData=null;
var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.compFresher={

loadJobDetails:function(){   
 debugger;
  var comp_id= $('#comp_id').val();
  var type= $('#job_type').val();
  var url="ajax/getAppDetailsFGEI.php";
  var myData={getJobDetails:"getJobDetails",comp_id:comp_id,type:type};

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
              { data: "id",
                render: function (data, type, row, meta) {
                  var a='<button type="button" title="Edit" class="btn btn-primary btn-xs" onclick="tempData.compFresher.gotoCol('+row.id+');"><i class="fa fa-eye"></i> View College </button>';
                  return a;
                }
              },
              { data: "job_id",
                render: function (data, type, row, meta) {
                 var a= "<span class='hightlight'>"+row.job_id+"</span>";
                  return a;
                }
              },
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
              { data: "no_position",className: "text-right"},
              // { data: "requirement",
              //    render: function (data, type, row, meta) {
              //   // var a="<textarea readonly>"+row.requirement+"</textarea>";
              //     return row.requirement;
              //   }
              // },
              // { data: "descp",
              //   render: function (data, type, row, meta) {
              //    //var a="<textarea readonly>"+row.descp+"</textarea>";
              //     return row.descp;
              //   }
              // },
              { data: "location"},
              { data: "contact_email"},
              { data: "salary",className: "text-right",
                render: function (data, type, row, meta) {
                 var a="&#8377;"+tempData.compFresher.formatNumber(row.salary);
                  return a;
                }
              },
              { data: "last_date"},
              // { data: "college_count",className: "text-right",
              //   render: function (data, type, row, meta) {
              //     var a= "<span class='hightlight'>"+row.college_count+"</span>";
              //     return a;
              //   }
              // },
              // { data: "stu_count",className: "text-right",
              //   render: function (data, type, row, meta) {
              //     var a= "<span class='hightlight'>"+row.stu_count+"</span>";
              //     return a;
              //   }
              // }
              ]
           });

           } // else End here  

          } // ajax success ends
        });   
},
formatNumber:function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
},
gotoCol:function(job_id){
    window.location="getCollege.php?job_id="+job_id;
},

};


$(document).ready(function(){
tempData.compFresher.loadJobDetails();

      var setDateFormat="dd/mm/yyyy";
      $('#last_date').datepicker({
          format: setDateFormat,
          autoclose: true
      });



    


});
</script>
  
          <input type="hidden"  name="job_type" id="job_type" value='F'>
          <input type="hidden"  name="comp_id" id="comp_id" value="<?php echo $ad_com_id; ?>" >

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">           
            <div class="clearfix"></div>    
            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                
                 <div class="x_panel">
                  <div class="x_title collapse-link" style="cursor: pointer;">
                    <h2>JOB Details</h2>
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
                          <th>Job ID</th>
                          <th>Type</th>
                          <th>Job Title</th>
                          <th>Number Position</th>
                          <!-- <th>Requirement</th>
                          <th>Description</th> -->
                          <th>Location</th>
                          <th>Contact Email</th>
                          <th>Salary</th>
                          <th>Last Date</th>                                                  
                          <!-- <th>College Count</th>                                                  
                          <th>Student Count</th>                                                   -->
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
    onclick="tempData.compFresher.confirmDelete(1)" value="YES" /></a>
    <input type="button" id="btnNo" class="btn btn-danger" data-dismiss="modal"  style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" 
    onclick="tempData.compFresher.confirmDelete(0)" value="NO"/>
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