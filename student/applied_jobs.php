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
		margin-right:1%
	}
	.x_title span{
		color: white;
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
    //alert(stu_id);
	var myData = {getAplliedJobDetails:'getAplliedJobDetails',stu_id:stu_id};
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
	  	var interVar="";

	  	$('#buildJob').html('');

	      if(obj.loadJobDetails !=null){

	      	for(var i=0;i<obj.loadJobDetails.length;i++){
			  img="";
		      if(obj.loadJobDetails[i].profile_img!=''){
	            img='<img class="comlogo" src="../company/'+obj.loadJobDetails[i].profile_img+'">';
	          }else{
	            img='<img class="comlogo" src="../company/images/user.png">';
	          }

          	if(obj.loadJobDetails[i].type=='I'){
          		interVar='<button class=" pull-right btn btn-primary btn-xs"> <span class="glyphicon glyphicon-envelope"></span> &nbsp;'+' Internship </button>';
          	}else{
          		interVar='';
          	}

			  content='<div class="x_panel">'+
					'<div class="x_title collapse-link" style="cursor: pointer;">'+img+
					'<h2 class="title">'+obj.loadJobDetails[i].title+'<br>'+
					'<small>'+obj.loadJobDetails[i].comp_name+'</small></h2>'+	
							
					'<ul class=" pull-right nav navbar-right panel_toolbox" style="min-width:0 !important;margin-bottom: 1%;">'+          
					'<li><a><i class="fa fa-chevron-down pull-right"></i></a></li>'+
					'</ul><br>'+
					'<button class=" pull-right btn btn-primary btn-xs"><span class="glyphicon glyphicon-star"></span>'+' Applied </button>'+interVar+
					'<p class="lastDate pull-right">Last Date : '+obj.loadJobDetails[i].last_date+'</p>'+ 
					'<div class="clearfix"></div>'+
					'</div>'+			
					'<div class="x_content" id="removeStyle1" style="display: none;">'+
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
				    // '<p class="pMargin">Contact Email : '+obj.loadJobDetails[i].contact_email+'</p><br>'+

					 // '<button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-heart"></span>'+' Applied </button>'+
				  '</div>'+
      			'</div>'; 
				  $('#buildJob').append(content);
			  }	      
			  	  
			  setTimeout(function(){ 
				// Panel toolbox
					$(document).ready(function() {
						$('.collapse-link').on('click', function() {
							var $BOX_PANEL = $(this).closest('.x_panel'),
								$ICON = $(this).find('i'),
								$BOX_CONTENT = $BOX_PANEL.find('.x_content');
							
							// fix for some div with hardcoded fix class
							if ($BOX_PANEL.attr('style')) {
								$BOX_CONTENT.slideToggle(200, function(){
									$BOX_PANEL.removeAttr('style');
								});
							} else {
								$BOX_CONTENT.slideToggle(200); 
								$BOX_PANEL.css('height', 'auto');  
							}

							$ICON.toggleClass('fa-chevron-up fa-chevron-down');
						});

						$('.close-link').click(function () {
							var $BOX_PANEL = $(this).closest('.x_panel');

							$BOX_PANEL.remove();
						});
					});
			  }, 2000);

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

}

};

$(document).ready(function() {
//setTimeout(function(){  }, 3000);	
$('#stu_id').val(<?php echo $stu_id; ?>);
tempData.uplace.loadJobs();
//	$('.x_content').hide();
});
</script>
		
		
            <!-- page content -->
        <div class="right_col" role="main">
        	
        <input type="hidden" id="stu_id" name="stu_id">

          <div class="">
            <div class="page-title">          
            <div class="clearfix"></div>		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" id="buildJob">
              
			  
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