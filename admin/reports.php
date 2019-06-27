<?php
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 
 include('links.php');
?>

<link rel="stylesheet" href="../build/amcharts/style.css" type="text/css">
<script src="../build/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../build/amcharts/pie.js" type="text/javascript"></script>
<script src="../build/amcharts/serial.js" type="text/javascript"></script>
<script src="../build/amcharts/plugins/responsive/responsive.min.js"></script>
  <!-- Export plugin includes and styles -->
<script src="../build/amcharts/plugins/export/export.js"></script>
<link  type="text/css" href="../build/amcharts/plugins/export/export.css" rel="stylesheet">


<!-- Highchart JS and CSS -->
<script src="../build/highchart/highcharts.js"></script>
<script src="../build/highchart/modules/data.js"></script>
<script src="../build/highchart/modules/drilldown.js"></script>
<script src="../build/highchart/modules/exporting.js"></script>

<script src="./js/jquery.table2excel.js"></script>

<!-- <link rel="stylesheet" href="./css/stylesheet-image-based.css"> -->

<style type="text/css">
.headerCount{
    background-color: rgb(42, 63, 84);
    border-radius: 3px;
    color: white;
    margin-bottom: 1%;
}

.labelStyle
{
    font-size: 13px;
    font-weight: bold;
    background-color: #c4e9ff;
    text-align: center;
    word-spacing: 6px;
    border-radius: 3px;
}
</style>

<script type="text/javascript">
var tempData;
if(tempData===null||tempData===undefined){
	 tempData={};
}
	
tempData.testDemo=
{
  getTotal:function(){
    debugger;
    //var date = new Date();
    //var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    //var curr_year=date.getFullYear();
    var url= "ajax/getData.php";
    var clg_id=<?php echo $ad_clg_id; ?>;
    var fk_clg_id=<?php echo $ad_id; ?>;
    var year= $('#loadYear').val();    
    var className=$('#getClasWise').val();
    var myData = {getTotal:112244,clg_id:clg_id,fk_clg_id:fk_clg_id,year:year,className:className};
      $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){
              debugger;
             // alert(obj.data);
               $('#female_count').html(obj.data[0].female_count);
               $('#inactive_count').html(obj.data[0].inactive_count);
               $('#male_count').html(obj.data[0].male_count);
               $('#notify_count').html(obj.data[0].notify_count);
               $('#perm_count').html(obj.data[0].perm_count);
               $('#student_count').html(obj.data[0].student_count);

            }
      });
  },
  loadReport1:function(){
    debugger;
    var msg="";
    var url= "ajax/getData.php";
    var year= $('#loadYear').val();
    var className=$('#getClasWise').val();
    var getPercent=$('#getPercent').val();
   // var getPercent='>=60';
    var ad_clg_id=<?php echo $ad_clg_id; ?>;
    var myData = {loadReport1:1122,year:year,ad_clg_id:ad_clg_id,className:className,getPercent:getPercent};
      $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){
              debugger;
              if(obj.data!=0){
                 $('#chart_empty1').show();
                 $('#chart_info1').hide();
                msg=" ";
                $('#Btotal').html(obj.branchCountSUM);
                 $('#Etotal').html(obj.eligibleSUM);
                tempData.testDemo.highchartGraph2(obj,msg);
                 
              }else{
                 $('#chart_empty1').hide();
                 $('#chart_info1').show();
                var msg=year +" : Record Not Found !!";
                tempData.testDemo.highchartGraph2(obj,msg);
              }  
            }
      });
  },
  highchartGraph2:function(obj,msg){
// Create the chart
Highcharts.chart('loadReport1', {
    chart: {
        type: 'column'
    },
    title: {
        text: msg
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: obj.Branch,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="font-size:14px;color:red;padding:0">{series.name}: </td>' +
            '<td style="padding:0;font-size:14px"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },
    series:obj.Students
    //[{"name":"TOOL12","data":[33,0,0,0,0,0,0,0,0,0,0,0,0,0,10,10,10,11]}]
});
  }, 
  loadReport2: function(){

    debugger;
  var year= $('#loadYear').val();
  var ad_clg_id=<?php echo $ad_clg_id; ?>;

  var url='adminreg/graphDetails.php';
      var myData = {graph_one:1122,year:year,ad_clg_id:ad_clg_id};
        $.ajax({
          type:"POST",
          url:url,
          async: false,
          dataType: 'json',
          data:myData,
          success: function(obj){
        
        //alert(chartData);
      var chart;
            var legend;
      var chartData =obj;
      debugger;
      //alert(chartData);
        setTimeout(function(){ 
      if(chartData==0){
        //alert(chartData);
        $('#chart_empty2').hide();
        $('#chart_info2').show();
      }else{
        $('#chart_empty2').show();
        $('#chart_info2').hide();
        
              
            var chart = AmCharts.makeChart( "loadReport2", {
              "type": "pie",
              "titles": [{
                "text": "",
                "size": 18
              }],
              "dataProvider":chartData,
              "valueField": "Students",
              "titleField": "Branch",
              "startEffect": "elastic",
              "startDuration": 2,
              "labelRadius": 15,
              "innerRadius": "50%",
              "depth3D": 10,
              "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
              "angle": 15,
              "legend": {
                "position": "right"
              },
              "export": {
                "enabled": true,
                "menu": [ {
                  "class": "export-main",
                  "menu": [ {
                    "label": "Download",
                    "menu": [ "PNG", "JPG", "CSV" ]
                  }, {
                    "label": "Annotate",
                    "action": "draw",
                    "menu": [ {
                      "class": "export-drawing",
                      "menu": [ "PNG", "JPG", "CANCEL" ]
                    } ]
                  } ]
                } ]
              }
            });
            
            }
      }, 200);      
                  
      
      }
      });
  },
  getClasWise:function(){    
   tempData.testDemo.getTotal(); // Load the top values
   tempData.testDemo.loadReport1(); // Load the graph 1
  },
  loadAllFun:function(){
    $('#progress123').show();
   tempData.testDemo.getTotal(); // Load the top values
   tempData.testDemo.loadReport1(); // Load the graph 1
   tempData.testDemo.loadReport2(); // Load the graph 2
   $('#progress123').hide();
  },
  loadYears:function(){
  debugger;
      var date = new Date();
      var year = date.getFullYear();
      var url='adminreg/graphDetails.php';
      var myData = {getYears:1122,year:year};
        $.ajax({
          type:"POST",
          url:url,
          async: false,
          dataType: 'json',
          data:myData,
          success: function(obj){
            debugger;
            for(var i=0;i<obj.years.length;i++)
            {
                var opt = new Option(obj.years[i]);
                 $("#loadYear").append(opt);
             }

          $('#loadYear').val(year);

          }
      });
},
getDetailedReport:function(){
    debugger
    $('#getDetailedReport').modal({show:true});
      setTimeout(function(){
        tempData.testDemo.getDetailedReportModel(); 
      }, 200);
},
getDetailedReportModel:function(){
    debugger

    var url= "ajax/getData.php";
    var year= $('#loadYear').val();
    var className=$('#getClasWise').val();
    var getPercent=$('#getPercent').val();

    var ad_clg_id=<?php echo $ad_clg_id; ?>;
    var myData = {getDetailedReport:1122,year:year,ad_clg_id:ad_clg_id,className:className,getPercent:getPercent};

        $.ajax({
            type:"POST",
            url:url,
            async: false,
            dataType: 'json',
            data:myData,
            success: function(obj){
              debugger;
   var DataTableProject = $('#getDetailedReportModel').DataTable( {
            "paging":false,
            "ordering":true,
            "info":true,
            "searching":false,         
            "destroy":true,
            "scrollX": true,
            "scrollY": 350,
            "data":obj.stuData,   
            "columns": [
              {data:null,"SlNo": false,className: "text-center"},
              { data: "usn"},             
              { data: "firstname"},             
              { data: "gender"},             
              { data: "email"},             
              { data: "mobile"},             
              { data: "class"},             
              { data: "branch_name"},             
              { data: "secured",className: "text-right" }           
            ]
           });   
        DataTableProject.on( 'order.dt search.dt', function () {
          DataTableProject.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw(); 

        }
     });
},


};	

$(document).ready(function() {
  debugger;
   tempData.testDemo.loadYears();
   tempData.testDemo.loadAllFun();
$("#table2excel").click(function(){
   $("#getDetailedReportModel").table2excel({
          exclude: ".table",
          name: "Students",
          filename: "Student Eligible Report"
        });
 });

  
});
</script>
  
<div class="progress123" style="width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #004C8C;
   z-index: 9045;
   text-align: center;
   display:none;">
   
   <div style="position: relative; 
   width: 100%;">
   <img src="images/loader.gif" style="margin-top:18%;width:100px;">
   
   <h2 style="position: absolute; 
   top: 350px; 
   left: 0; 
   width: 100%;
   color:white;
   font-size:16px;">please wait..</h2>
   </div>
</div> 


 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
             <!-- top tiles -->
              <div class="col-md-12 col-xs-12 ">
                <select class="form-control pull-right" id="loadYear" onchange="tempData.testDemo.loadAllFun();" style="width:15% !important;margin-bottom:10px;">
                </select>
              </div>
          <div class="row tile_count headerCount">
         
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Students</span>
              <div class="count green" id="student_count"></div>
              <span class="count_bottom">From All Departments</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-bell"></i> Notifications</span>
              <div class="count green" id="notify_count"></div>
              <span class="count_bottom">Sent to Students.</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count" id="male_count"></div>
              <span class="count_bottom">From All Departments</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count" id="female_count"></div>
              <span class="count_bottom">From All Departments</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Deactivated Students</span>
              <div class="count red" id="inactive_count"></div>
              <span class="count_bottom"> From All Departments</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Given Permissions</span>
              <div class="count green" id="perm_count"></div>
              <span class="count_bottom"> To upload the video link.</span>
            </div>
          </div>
          <!-- /top tiles -->

<div class="row">
 <div class="col-md-12 col-sm-6 col-xs-12">
    <div class="dashboard_graph x_panel">
      <div class="x_title">
        <div class="col-md-6 col-xs-4">
          <h2> <i class="fa fa-bar-chart" aria-hidden="true"></i> Percentage Wise Students Details</h2>
        </div>
         <div class="col-md-2 col-xs-3 pull-right">
          <select class="form-control" id="getClasWise" onchange="tempData.testDemo.getClasWise();">
                <option value="Graduation">Graduation</option>
                <option value="Post Graduation">Post Graduation</option>                
                <option value="Diploma">Diploma</option>
                <option value="Post Graduation Diploma">Post Graduation Diploma</option>
                <option value="Doctorate">Doctorate</option>
          </select>
        </div> 

        <div class="col-md-2 col-xs-3 pull-right">
          <select class="form-control" id="getPercent" onchange="tempData.testDemo.loadReport1();">
                <option value=">=60"> > = 60</option>
                <option value=">=70"> > = 70</option>
                <option value=">=80"> > = 80</option>
                <option value=">=50"> > = 50</option>
                <option value="<=50"> <= 50</option>
          </select>
        </div> 

        <div class="col-md-1 col-xs-2 pull-right">
          <button class="btn btn-primary btn-sm" onclick="tempData.testDemo.getDetailedReport();"> <i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp; Report</button>
        </div> 

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="demo-container table-responsive"  id="chart_empty1">
          <p class="labelStyle"> Students :<span id="Btotal"></span> and Eligible :<span id="Etotal"></span> </p>
                  <div id="loadReport1" style="width: 100%; height: 350px;"></div>
          </div> 

           <div class="row" id="chart_info1" style="display:none;">
              <div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
                <div  style="width: 100%; height: 100px;">
                <p style="color:#2a5aca;text-align:center;font-size:24px;">Data is Not Available for this Year !!</p>
                </div>            
              </div>
            </div>

      </div>
    </div>
  </div>

</div>

<div class="row">
   <div class="col-md-12 col-sm-6 col-xs-12">
      <div class="dashboard_graph x_panel">
        <div class="x_title">
          <div class="col-md-10 col-xs-10">
            <h2> <i class="fa fa-pie-chart" aria-hidden="true"></i> Total Branches and Students Analytical Graph</h2>
          </div>
          <div class="clearfix"></div>
          <!-- <div class="col-md-2 col-xs-4 pull-right">
            <select class="form-control" id="loadYear2" onchange="tempData.testDemo.loadAllFun();">
            </select>
          </div> -->
          
        </div>
        <div class="x_content">
            <div class="demo-container table-responsive" id="chart_empty2">
                    <div id="loadReport2" style="width: 100%; height: 350px;"></div>
            </div> 

            <div class="row" id="chart_info2" style="display:none;">
              <div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
                <div  style="width: 100%; height: 100px;">
                <p style="color:#2a5aca;text-align:center;font-size:24px;">Data is Not Available for this Year !!</p>
                </div>            
              </div>
            </div>
        </div>
      </div>
    </div>


<!--    
<div class="col-md-6 col-sm-6 col-xs-12">
      <div class="dashboard_graph x_panel">
        <div class="x_title">
          <div class="col-md-10 col-xs-10">
            <h2> <i class="fa fa-pie-chart" aria-hidden="true"></i> Total Branches and Students Analytical Graph</h2>
          </div>
          <div class="clearfix"></div>          
        </div>
        <div class="x_content">
            <div class="demo-container table-responsive" id="chart_empty2">
                    <div id="loadReport2" style="width: 100%; height: 350px;"></div>
            </div> 

            <div class="row" id="chart_info2" style="display:none;">
              <div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
                <div  style="width: 100%; height: 100px;">
                <p style="color:#2a5aca;text-align:center;font-size:24px;">Data is Not Available for this Year !!</p>
                </div>            
              </div>
            </div>
        </div>
      </div>
    </div> 
  -->


  </div>
</div>

  <?php //include('sup_files/footer.php'); ?> 
          </div>


   </div>
        <!-- /page content -->
</div>
</div>



<div id="getDetailedReport" class="modal fade"  role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-users" aria-hidden="true"></i> Student Eligible Report</h4>
            </div>
            <div class="modal-body">
              <div id="moreInfoBody">
                  <div class="table-responsive">
                     <span class="pull-right"> <button id="table2excel" class="btn btn-success btn-sm"> <i class="fa fa-download" aria-hidden="true"></i> Export </button> </span> 

                       <table id="getDetailedReportModel" class="table table-hover table-bordered table-responsive" style="width:100%">
                           <thead>
                            <tr style="background-color: #2e4050; color: white;">
                              <th>Sl No</th>
                              <th>USN</th>
                              <th>Student Name</th>
                              <th>Gender</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Class</th>
                              <th>Branch</th>                             
                              <th>Secured</th>                             
                            </tr>
                            </thead>
                        </table>
                    </div>          


              </div>
            
            </div>
            <div class="modal-footer" style="border-top:none;">
               
            </div>
    </div>
  </div>
</div> 



</body>
</html>
