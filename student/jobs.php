<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');
?>
<style type="text/css">
	/*body {
		background: #f7f7f7 !important; 
	}*/
	.nav-md .container.body .right_col {
	    min-height: 400px !important;
	}

	.x_title {
     border-bottom: 0px solid #E6E9ED; 
     padding: 0px 0px 0px; 
     margin-bottom: 0px; 
	}
	.x_title h2 small {
     margin-left: 0px; 
	}
	hr {
     margin-top:0px; 
     margin-bottom:0px; 
     border: 0; 
     border-top: 1px solid #f3bcbc;
	}

	.comlogo{
		width: 40px;
	    border: 1px solid;
	    float: left;
	    margin-right: 1%;
	}
	.pMargin{
		margin: 2px;
		font-size: 14px;
	}
	.title{
		text-transform: uppercase;
        color: black;
	}
	.lastDate{
		font-weight: bold;
    	color: black;
	}
</style>

<script>
var tempData;
if(tempData===null||tempData===undefined){
   tempData={};
}
tempData.uplace=
{
loadJobs:function(){
  debugger;
    var url="stureg/getJobDataController.php";
    var stu_id = $('#stu_id').val();
	var myData = {getJobDetails:'getJobDetails',stu_id:stu_id};
	$.ajax({
	  type:"POST",
	  url:url,
	  async: false,
	  dataType: 'json',
	  cache: false,
	  data:myData,
	  success: function(obj) {
	  	var content="";
	  	var img="";
	  	$('#buildJob').html('');

	      if(obj.loadJobDetails !=null){

	      	for(var i=0;i<obj.loadJobDetails.length;i++){
			  img="";
		      
		      if(obj.loadJobDetails[i].profile_img!=''){
	            img='<img class="comlogo" src="../company/'+obj.loadJobDetails[i].profile_img+'">';
	          }else{
	            img='<img class="comlogo" src="../company/images/user.png">';
	          }

	      	content +='<div class="x_panel">'+
	              '<div class="x_title">'+img+
	                '<h2 class="title">'+obj.loadJobDetails[i].title+'<br>'+
	                	'<small>'+obj.loadJobDetails[i].comp_name+'</small></h2>'+	             
	               '<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">'+          
	                  '<li><p class="lastDate">Last Date : '+obj.loadJobDetails[i].last_date+'</p></li>'+
	                  '<br><button class="btn btn-primary btn-xs" onClick="tempData.uplace.applyjob('+obj.loadJobDetails[i].id+')"><span class="glyphicon glyphicon-ok" ></span>'+
	                  ' Apply </button>'+
	                '</ul>'+
	                '<div class="clearfix"></div>'+
	              '</div>'+			
				  '<div class="x_content">'+
				  	'<hr>'+
					'<h2>JOB ID : '+obj.loadJobDetails[i].comp_job_id+'</h2>'+
					'<h2 style="color:#000000cf;">Description :</h2>'+
					'<p style="text-align: justify;">'+obj.loadJobDetails[i].descp+'</p><br>'+
				    '<h2 style="color:#000000cf;">Requirement :</h2>'+ 
				    '<p style="text-align: justify;">'+obj.loadJobDetails[i].requirement+'</p>'+
				    '<hr><br>'+
				    '<p class="pMargin">Salary : '+tempData.uplace.formatNumber(obj.loadJobDetails[i].salary)+'</p>'+
				    '<p class="pMargin">Number of Position : '+obj.loadJobDetails[i].no_position+'</p>'+
				    '<p class="pMargin">Location : '+obj.loadJobDetails[i].location+'</p>'+
				    '<p class="pMargin">Contact Email : '+obj.loadJobDetails[i].contact_email+'</p><br>'+

					'<button class="btn btn-primary btn-sm" onClick="tempData.uplace.applyjob('+obj.loadJobDetails[i].id+')"><span class="glyphicon glyphicon-ok"></span>'+  
					' Apply </button>'+
				  '</div>'+
      			'</div>'; 

	      	}
	      	$('#buildJob').append(content);

	      }else{

	      	content +='<div class="x_panel">'+
	              '<h2>Job Not Available !!</h2>'+
      			'</div>'; 

	      	$('#buildJob').html(content);
	      }
	    } 
	});
},
formatNumber:function (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
},
applyjob:function(id){
	var url="stureg/getJobDataController.php";
    var stu_id = $('#stu_id').val();
    var stu_college_id = $('#stu_college_id').val();
	var myData = {applyJob:'applyJob',stu_id:stu_id,stu_college_id:stu_college_id,job_id:id};
	$.ajax({
	  type:"POST",
	  url:url,
	  async: false,
	  dataType: 'json',
	  cache: false,
	  data:myData,
	  success: function(obj) {
	      if(obj.data !=null){
	      	alert(obj.data.info);
	      	tempData.uplace.loadJobs();
	      }else{

	      }
	    } 
	});
},

};

$(document).ready(function() {

$('#stu_id').val(<?php echo $stu_id; ?>);
$('#stu_college_id').val(<?php echo $stu_college_id; ?>);
tempData.uplace.loadJobs();
//	$('.x_content').hide();
});
</script>
		
		
            <!-- page content -->
        <div class="right_col" role="main">
        	
        <input type="hidden" id="stu_id" name="stu_id">
        <input type="hidden" id="stu_college_id" name="stu_college_id">

          <div class="">
            <div class="page-title">          
            <div class="clearfix"></div>		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" id="buildJob">
                
				<!-- 	 <span id="buildJob"></span> -->
                <!-- <div class="x_panel">
	              <div class="x_title">
	                <img src="images/user.png" class="comlogo" /> <h2>Job Title<br>
	                	<small>Company Name</small></h2>	             
	                <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">           
	                  <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
	                </ul>
	                <div class="clearfix"></div>
	              </div>			
				  <div class="x_content">
				  	<hr>
					<h2>Description</h2>
				    <h2>Requirement</h2> 
					 <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok"></span>  Apply </button>
				  </div>
      			</div>   -->

      			 
			
			  
			  </div> <!-- col-12 -->
            </div> <!-- row -->
          </div>
        </div>
        <!-- /page content -->
		<br/>&nbsp;

		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>


</body>

</html>