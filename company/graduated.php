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
  
tempData.compFresher={

loadJobDetails:function(){   
 debugger;
  var comp_id= $('#comp_id').val();
  var type= $('#job_type').val();
  var url="ajax/getJobDetailsFGEI.php";
  var myData={getSavedJobDetails:"getSavedJobDetails",comp_id:comp_id,type:type};

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
                  var a='<button type="button" title="Edit" class="btn btn-primary btn-xs" onclick="tempData.compFresher.editJob('+row.id+');"><i class="fa fa-pencil-square-o"></i> </button>';
                  var b='<button type="button" title="Delete" class="btn btn-danger btn-xs" onclick="tempData.compFresher.delete('+row.id+');"><i class="fa fa-trash"></i> </button>';
                  var c='<button type="button" title="Publish" class="btn btn-success btn-xs" onclick="tempData.compFresher.publish('+row.id+');">Publish <i class="fa fa-send"></i> </button>';
                  var d='<button type="button" title="Publish" class="btn btn-warning btn-xs"> Published </button>';
                  if(row.publish==0){
                  print=a+' '+b+' '+c;
                  }else{
                  print=d;
                  }
                  return print;

                }
              },
              { data: "comp_job_id" },
              { data: "title"},
              { data: "no_position"},
              { data: "requirement",
                 render: function (data, type, row, meta) {
                 var a="<textarea readonly>"+row.requirement+"</textarea>";
                  return a;
                }
              },
              { data: "descp",
                render: function (data, type, row, meta) {
                 var a="<textarea readonly>"+row.descp+"</textarea>";
                  return a;
                }
              },
              { data: "location"},
              { data: "contact_email"},
              { data: "salary",
                render: function (data, type, row, meta) {
                 var a="&#8377;"+tempData.compFresher.formatNumber(row.salary);
                  return a;
                }
              },
              { data: "last_date"},
              ]
           });

           } // else End here  

          } // ajax success ends
        });   
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
             tempData.compFresher.loadJobDetails();
          }else{
            $("#commondialog").modal({backdrop:'static'});
            $("#getCode").html('<p>Please Try Again !!</p>'); 
          }
        }
  });
},
delete:function(id) {
  deleteVar=id;
  tempData.compFresher.confirmDelete();
},
confirmDelete:function(val){
   if(val==1){
      var url="ajax/getJobDetailsFGEI.php";
      var myData = {deleteJob:'deleteJob', delete_id:deleteVar};
      
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
                 tempData.compFresher.loadJobDetails();
              }else{
                $("#commondialog").modal({backdrop:'static'});
                $("#getCode").html('<p>Please Try Again !!</p>'); 
              }
            }
      });

   }
   $("#deleteModel").modal({backdrop:'static'});
},
editJob:function (id){
    for(var i=0;i<globalJOBData.length;i++){
        if(id==globalJOBData[i].id){
          $('#record_id').val(globalJOBData[i].id);
          $('#job_title').val(globalJOBData[i].title);
          $('#no_position').val(globalJOBData[i].no_position);
          $('#requirement').val(globalJOBData[i].requirement);
          $('#descp').val(globalJOBData[i].descp);
          $('#location').val(globalJOBData[i].location);
          $('#contact_email').val(globalJOBData[i].contact_email);
          $('#salary').val(globalJOBData[i].salary);
          $('#last_date').val(globalJOBData[i].last_date);
          $('#job_id').val(globalJOBData[i].comp_job_id);
          break;
        }
    }
    $("#removeStyle").fadeIn("fast");
    $("#add_job_hide").hide();
    $("#update_job_hide").show();            
},
clearForm:function(){
    $('#jobTitleFrom')[0].reset();
    $("#removeStyle").fadeOut("fast");
},
validateEmail:function(emailField){
  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  if (reg.test(emailField.value) == false){
     // alert('Invalid Email Address');
      $('#contact_email').css('border-color', 'red');
      $("#submit_data").prop("disabled", true);
      $("#job_update").prop("disabled", true);
      return false;
  }
  $('#contact_email').css('border-color', '');
  $("#submit_data").prop("disabled", false);
  $("#job_update").prop("disabled", false);
  return true;
},
formatNumber:function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


};


$(document).ready(function(){
tempData.compFresher.loadJobDetails();

      var setDateFormat="dd/mm/yyyy";
      $('#last_date').datepicker({
          format: setDateFormat,
          autoclose: true
      });

    $("#cancel").click(function(){
      //$('#removeStyle').hide();
      tempData.compFresher.clearForm();
    });

    /* Save the Job */
    $("#submit_data").click(function(){
    
      var url="ajax/getJobDetailsFGEI.php";
      var fromData =$("#jobTitleFrom").serialize();
      var myData="&saveJob=saveJob";

      var job_title=$('#job_title').val();
      var descp=$('#descp').val();
      var requirement=$('#requirement').val();
      var location=$('#location').val();
      var contact_email=$('#contact_email').val();
      var last_date=$('#last_date').val();
      var job_id=$('#job_id').val();

      if(job_id == ""){
        $('#job_id').css('border-color', 'red');
        return false;
      }else{
        $('#job_id').css('border-color', '');
      } 
    if(job_title == ""){
      $('#job_title').css('border-color', 'red');
      return false;
    }else{
      $('#job_title').css('border-color', '');
    }

    if(descp == ""){
      $('#descp').css('border-color', 'red');
      return false;
    }else{
      $('#descp').css('border-color', '');
    }

    if(requirement == ""){
      $('#requirement').css('border-color', 'red');
      return false;
    }else{
      $('#requirement').css('border-color', '');
    }

    if(location == ""){
      $('#location').css('border-color', 'red');
      return false;
    }else{
      $('#location').css('border-color', '');
    }

    if(contact_email == ""){
      $('#contact_email').css('border-color', 'red');
      return false;
    }else{
      $('#contact_email').css('border-color', '');
    }

    if(last_date == ""){
      $('#last_date').css('border-color', 'red');
      return false;
    }else{
      $('#last_date').css('border-color', '');
    }
          
         
       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:fromData+myData,
            success: function(obj) {
              debugger;
              if(obj.data != null){
                 $("#commondialog").modal({backdrop:'static'});
                 $("#getCode").html(obj.data.info);
                 tempData.compFresher.clearForm();
                 tempData.compFresher.loadJobDetails();
              }else{
                $("#commondialog").modal({backdrop:'static'});
                $("#getCode").html('<p>Please Try Again !!</p>'); 
              }
            }
      });
    
    });

/* Update the Job */
$("#job_update").click(function(){
      var url="ajax/getJobDetailsFGEI.php";
      var fromData =$("#jobTitleFrom").serialize();
      var myData="&saveJob=saveJob";

      var job_title=$('#job_title').val();
      var descp=$('#descp').val();
      var requirement=$('#requirement').val();
      var location=$('#location').val();
      var contact_email=$('#contact_email').val();
      var last_date=$('#last_date').val();
      var job_id=$('#job_id').val();

      if(job_id == ""){
        $('#job_id').css('border-color', 'red');
        return false;
      }else{
        $('#job_id').css('border-color', '');
      } 
    if(job_title == ""){
      $('#job_title').css('border-color', 'red');
      return false;
    }else{
      $('#job_title').css('border-color', '');
    }

    if(descp == ""){
      $('#descp').css('border-color', 'red');
      return false;
    }else{
      $('#descp').css('border-color', '');
    }

    if(requirement == ""){
      $('#requirement').css('border-color', 'red');
      return false;
    }else{
      $('#requirement').css('border-color', '');
    }

    if(location == ""){
      $('#location').css('border-color', 'red');
      return false;
    }else{
      $('#location').css('border-color', '');
    }

    if(contact_email == ""){
      $('#contact_email').css('border-color', 'red');
      return false;
    }else{
      $('#contact_email').css('border-color', '');
    }

    if(last_date == ""){
      $('#last_date').css('border-color', 'red');
      return false;
    }else{
      $('#last_date').css('border-color', '');
    }
          
         
       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:fromData+myData,
            success: function(obj) {
              debugger;
              if(obj.data != null){
                 $("#commondialog").modal({backdrop:'static'});
                 $("#getCode").html(obj.data.info);
                 tempData.compFresher.clearForm();
                 tempData.compFresher.loadJobDetails();
              }else{
                $("#commondialog").modal({backdrop:'static'});
                $("#getCode").html('<p>Please Try Again !!</p>'); 
              }
            }
      });
    
    });


});
</script>
  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">           
            <div class="clearfix"></div>    
            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title collapse-link" style="cursor: pointer;">
                    <h2>Job for Graduated</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a><i class="fa fa-chevron-down"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
    <div class="x_content" id="removeStyle" style="display: none;">
          <br />
      <form id="jobTitleFrom" class="form-horizontal form-label-left" 
      enctype="multipart/form-data">
          <!-- Record id -->
          <input type="hidden"  name="record_id" id="record_id">
          <input type="hidden"  name="job_type" id="job_type" value='G'>
          <input type="hidden"  name="comp_id" id="comp_id" value="<?php echo $ad_com_id; ?>" >
          
          <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Job ID
            <span class="required">*</span>
          </label>
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input type="text" name="job_id" id="job_id" required="required" placeholder="Job ID" class="form-control col-md-7 col-xs-12" autofocus>
          </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Job Title
              <span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="text" name="job_title" id="job_title" required="required" placeholder="Job Title" class="form-control col-md-7 col-xs-12" autofocus>
            </div>
            
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Number of Positions</label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="number" name="no_position" id="no_position" required="required" placeholder="Position" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
            
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Requirement
              <span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <textarea name="requirement" id="requirement" required="required" style="height:100px;" class="form-control col-md-7 col-xs-12" placeholder="Requirement"></textarea> 
              <!-- <input type="text"  > -->
            </div>
            
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description 
              <span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <textarea name="descp" id="descp" required="required" placeholder="Description" class="form-control col-md-7 col-xs-12" style="height:100px;" ></textarea> 
             <!--  <input type="text" name="descp" id="descp" required="required" placeholder="Description" class="form-control col-md-7 col-xs-12"> -->
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Location
              <span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="text" name="location" id="location" required="required" placeholder="Location" class="form-control col-md-7 col-xs-12">
            </div>
            
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Contact Email 
              <span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="text" name="contact_email" id="contact_email" required="required" placeholder="Contact Email" class="form-control col-md-7 col-xs-12" 
              onblur="tempData.compFresher.validateEmail(this);">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Salary
             </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="number" name="salary" id="salary" placeholder="Salary" class="form-control col-md-7 col-xs-12">
            </div>
            
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Last Date to Apply 
              <span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="text" name="last_date" id="last_date" required="required" class="form-control col-md-7 col-xs-12" placeholder="Select Date" readonly="readonly">
            </div>
          </div>

           <br/>
           
<div class="form-group">
  <div class="col-md-4 col-sm-3 col-xs-12">
  </div>
  <div class="col-md-2 col-sm-3 col-xs-12" id="add_job_hide">
    <button type="button" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add JOB</button>
  </div>
   
  <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_job_hide">
    <button type="button" name="job_update" id="job_update" class="btn btn-success" style="width:150px;">Update JOB</button>
  </div>
  
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input type="button" class="btn btn-danger" id="cancel" name="cancel" value="Clear" 
    style="width:150px;">
  </div>
</div>
            
<div class="ln_solid"></div>
        
        </form>
          
                </div>
                </div>
              
                 <div class="x_panel">
                  <div class="x_title collapse-link" style="cursor: pointer;">
                    <h2>Graduated JOB Details</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
          
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                    
                   <table id="loadJobDetails" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Action</th>
                          <th>Job ID</th>
                          <th>Job Title</th>
                          <th>Number Position</th>
                          <th>Requirement</th>
                          <th>Description</th>
                          <th>Location</th>
                          <th>Contact Email</th>
                          <th>Salary</th>
                          <th>Last Date</th>                                                  
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