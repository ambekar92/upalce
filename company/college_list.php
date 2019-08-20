<?php
  
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 
 include('links.php');

?>


<script type="text/javascript">

var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
  
tempData.compHome=
{

loadCompanyDetails:function(){   
 debugger;
  var url="ajax/getCompanyHome.php";
  var myData={loadClgInfo:"loadClgInfo"};

       $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){

        if(obj.getAllClgDetails==null){
          $('#loadClgInfo').DataTable({
             "paging":false,
              "ordering":true,
              "info":true,
              "searching":false,         
              "destroy":true,
          }).clear().draw();

        }else{
            /*     "scrollX": true,    "scrollY": 250,           */
        var loadClgInfo = $('#loadClgInfo').DataTable( {
            'paging'      : false,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "destroy":true,
            "data":obj.getAllClgDetails,   
            "columns": [
              {data:null,"SlNo":false,className: "text-center"},
              { data: "clg_name" },
              // { data: "email" },
              { data: "contact_person_1"},
              { data: "mobile_number_1"},
              { data: "off_email"},
              { data: "current_location",
                render: function (data, type, row, meta) {
                      return row.current_location+", "+row.state;
                }
              },
              ]
           });

          loadClgInfo.on( 'order.dt search.dt', function () {
            loadClgInfo.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw(); 

           } // else End here  

          } // ajax success ends
        });   
}

};
$(document).ready(function() {
debugger;
tempData.compHome.loadCompanyDetails();

});

   
</script>

  <!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>
    
<div class="x_panel">
        <div class="x_title">
            <h2>Colleges with Uplace</h2>
            <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
      </ul>
          <div class="clearfix"></div>
        </div>
    <div class="x_content">
            <div class="col-md-12">
                <div class="row">
          <div class="table-responsive">
                  
                        <!-- <span class="pull-right"> <b>* Time in (hh:mm:ss) </b> </span> -->
                       <table id="loadClgInfo" class="table table-hover table-bordered table-responsive" style="width:100%">
                           <thead>
                            <tr>
                              <th>Sl No</th>
                              <th>College Name</th>
                              <!-- <th>Email ID</th>                                -->
                              <th>Contact Person</th>                               
                              <th>Phone Number</th>                               
                              <th>Official Email ID</th>                               
                              <th>Location</th>                               
                            </tr>
                            </thead>
                        </table>
                    </div>     
                </div>
        </div>   
        </div>
    </div><!-- End x_panel -->


    
    
  
  <div style="margin-bottom:0px;"></div>

  <?php include('sup_files/footer.php'); ?> 
  </div> <!