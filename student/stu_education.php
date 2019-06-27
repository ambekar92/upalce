<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_education';
$whereCond="fk_stu_id='$stu_id' and class=10";	
$Query = 'select * from '.$table.' where '.$whereCond;
$stu_education_10 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_education_10)) 
{ 
	$id_10=$row['id'];
	$class_10 = $row['class'];
	$end_year_10 = $row['end_year'];
	$college_name_10 = $row['college_name'];
	$university_10 = $row['university'];
	$secured_10 = $row['secured'];
}

$whereCond="fk_stu_id='$stu_id' and class=12";	
$Query = 'select * from '.$table.' where '.$whereCond;
$stu_education_12 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_education_12)) 
{ 
	$id_12=$row['id'];
	$class_12 = $row['class'];
	$end_year_12 = $row['end_year'];
	$college_name_12 = $row['college_name'];
	$university_12 = $row['university'];
	$secured_12 = $row['secured'];
}


//Get values for Table
$whereCond="fk_stu_id='$stu_id' and value_select=13";	
$Query = 'select * from '.$table.' where '.$whereCond;
$stu_education_13 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

//Get  values for Update  ,, here value_select is higherEduction Num 13, 10th, 12th  
$id_13=$_GET['update'];
$whereCond="fk_stu_id='$stu_id' and value_select=13 and id='$id_13'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$stu_education_update = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_education_update)) 
{ 
	$id_13=$row['id'];
	$class_13 = $row['class'];
	$class_type_13 = $row['class_type'];
	$course_type_13 = $row['course_type'];
	$start_year_13 = $row['start_year'];
	$end_year_13 = $row['end_year'];
	$college_name_13 = $row['college_name'];
	$university_13 = $row['university'];
	$branch_13 = $row['branch'];
	$branch_13_id = $row['branch_id'];
	$secured_13 = $row['secured'];
	$sem_1 = $row['sem1'];
	$sem_2 = $row['sem2'];
	$sem_3 = $row['sem3'];
	$sem_4 = $row['sem4'];
	$sem_5 = $row['sem5'];
	$sem_6 = $row['sem6'];
	$sem_7 = $row['sem7'];
	$sem_8 = $row['sem8'];
	$sem_type = $row['total_sem'];

	$edu_summary_13 = $row['edu_summary'];	
	$value_select_13 = $_POST['value_select'];
}
//echo $class_type_13; die('_a');
/* Delete the record by id */
if(isset($_GET['delete']))
{
 $delete =$_GET['delete'];
		if($delete != '')
		{
		?>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#commondialog").modal({backdrop:'static'});
						$("#getCode").html('<p style=color:red;>Record Successfully Deleted !!</p>');	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		 $del ="DELETE FROM $table WHERE id='$delete'";
		 mysql_query($del) or die(mysql_error());
		}
		
}


/* Update the record by id */
if(isset($_GET['update']))
{
 $update_id =$_GET['update'];
 
		if($update_id != '')
		{
		?>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#hide_panel_edu").hide(); 
						$("#hide_panel_10_12").hide(); 
						$("#update_high_edu").show();
						//class_type_13	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		}

}

/*-------------------------------------------- Add the 10th record to DATABASE-----------------------------------------------------------*/
if(isset($_POST['update_marks_10']))
{
	$class = $_POST['class'];
	
	$end_year = $_POST['end_year_10'];
	$college_name = $_POST['college_name_10'];
	$university = $_POST['university_10'];
	$secured = number_format((float)$_POST['secured_10'], 2, '.', ''); 
	
	
	$user_id = $_POST['user_id'];
	$id_10 = $_POST['id_10'];

if($id_10 == '')	
{	
	if($secured !='' && $end_year!='' && $college_name!='' && $university!='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="insert into $table (fk_stu_id,class,end_year,college_name,university,secured) 
		values('$user_id','$class','$end_year','$college_name','$university','$secured')";  
	
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Added.</p>');	
				$("#update_hide_10").show();
				//$("#update_show").hide();
				
				
				//$("#getCode").html('<p>Successfully Inserted.</p>'+"<?php echo $tools; ?>");	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}
}
else
{
	//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="update $table set class='$class',end_year='$end_year',college_name='$college_name',university='$university',secured='$secured' where fk_stu_id='$user_id' and id='$id_10'";
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Updated.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
}	

}

/*----------------- Add the 12th record to DATABASE--------------------*/
if(isset($_POST['update_marks_12']))
{
	$class = $_POST['class'];
	
	$end_year = $_POST['end_year_12'];
	$college_name = $_POST['college_name_12'];
	$university = $_POST['university_12'];
	$secured = number_format((float)$_POST['secured_12'], 2, '.', ''); 
	
	
	$user_id = $_POST['user_id'];
	$id_12 = $_POST['id_12'];

if($id_12 == '')	
{	
	if($secured !='' && $end_year!='' && $college_name!='' && $university!='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="insert into $table (fk_stu_id,class,end_year,college_name,university,secured) 
		values('$user_id','$class','$end_year','$college_name','$university','$secured')";  
	
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Added.</p>');	
				$("#update_hide_12").show();
				//$("#update_show").hide();
				
				
				//$("#getCode").html('<p>Successfully Inserted.</p>'+"<?php echo $tools; ?>");	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}
}
else
{
	//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="update $table set class='$class',end_year='$end_year',college_name='$college_name',university='$university',secured='$secured' where fk_stu_id='$user_id' and id='$id_12'";
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Updated.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
}	

}


/*----------------- Add the Higher Education record to DATABASE--------------------------*/
if(isset($_POST['add_record']))
{
	$user_id = $_POST['user_id'];
	$value_select = $_POST['value_select'];
	
	$class = $_POST['class'];
	$class_type = $_POST['after12Dip'];
	$course_type = $_POST['course_type'];
	$start_year = $_POST['start_year'];
	$end_year = $_POST['end_year'];
	$college_name = $_POST['college_name'];
	$university = $_POST['university'];
	$branch_data = $_POST['branch'];
	
	$sem_1 = $_POST['sem_1'];
	$sem_2 = $_POST['sem_2'];
	$sem_3 = $_POST['sem_3'];
	$sem_4 = $_POST['sem_4'];
	$sem_5 = $_POST['sem_5'];
	$sem_6 = $_POST['sem_6'];
	$sem_7 = $_POST['sem_7'];
	$sem_8 = $_POST['sem_8'];
	$sem_type = $_POST['sem_type'];
	
	$secured = $_POST['secured'];
	$edu_summary = $_POST['edu_summary'];
	//echo $branch_data;die;
	//$branch_value=Array();
	$branch_value= explode("|",$branch_data);// getting only name
		$branch_id=$branch_value[0];
		$branch_name=$branch_value[1];
		//print_r($branch_name);die;
		
	if($class !='' && $course_type!='' && $start_year!='' && $end_year!='' && $college_name!='' && $university!='' && $branch_data!='' && $secured!='' && $edu_summary!='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="insert into $table (class_type,fk_stu_id,class,course_type,start_year,end_year,college_name,university,branch_id,branch,secured,edu_summary,value_select,sem1,sem2,sem3,sem4,sem5,sem6,sem7,sem8,total_sem) 
		values('$class_type','$user_id','$class','$course_type','$start_year','$end_year','$college_name','$university','$branch_id','$branch_name','$secured','$edu_summary','$value_select','$sem_1','$sem_2','$sem_3','$sem_4','$sem_5','$sem_6','$sem_7','$sem_8','$sem_type')";  
	
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Added.</p>');	
				$("#update_hide_12").show();
				//$("#update_show").hide();
				
				
				//$("#getCode").html('<p>Successfully Inserted.</p>'+"<?php echo $tools; ?>");	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}
}



/*-------------------------------------------- Add the 12th record to DATABASE-----------------------------------------------------------*/
if(isset($_POST['update_record']))
{
		//die('dsd');
	$user_id = $_POST['user_id'];
	$id_13 = $_POST['id_13'];
	$value_select = $_POST['value_select'];
	
	$class = $_POST['class_u'];
	$class_type = $_POST['after12Dip_u'];
	$course_type = $_POST['course_type'];
	$start_year = $_POST['start_year'];
	$end_year = $_POST['end_year'];
	$college_name = $_POST['college_name'];
	$university = $_POST['university'];
	$branch_data = $_POST['branch'];
	
	$secured = $_POST['secured'];
	$edu_summary = $_POST['edu_summary'];

	
	$sem_1 = $_POST['sem_1'];
	$sem_2 = $_POST['sem_2'];
	$sem_3 = $_POST['sem_3'];
	$sem_4 = $_POST['sem_4'];
	$sem_5 = $_POST['sem_5'];
	$sem_6 = $_POST['sem_6'];
	$sem_7 = $_POST['sem_7'];
	$sem_8 = $_POST['sem_8'];
	$sem_type = $_POST['sem_type'];
	
	
		$branch_value= explode("|",$branch_data);// getting only name
		$branch_id=$branch_value[0];
		$branch_name=$branch_value[1];
	//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="update $table set class_type='$class_type',class='$class',course_type='$course_type',start_year='$start_year',end_year='$end_year',college_name='$college_name',university='$university',	branch_id='$branch_id',branch='$branch_name',secured='$secured',edu_summary='$edu_summary',sem1='$sem_1',sem2='$sem_2',sem3='$sem_3',sem4='$sem_4',
		sem5='$sem_5',sem6='$sem_6',sem7='$sem_7',sem8='$sem_8',total_sem='$sem_type' where fk_stu_id='$user_id' and id='$id_13'";
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Updated.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php

}	
	
?>

<script type = "text/javascript" language = "javascript">
$(document).ready(function() {	
	

    changeFuncUpdates('<?php echo $sem_type; ?>');
	checkDipGrad();
	checkDipGradUpdate();

		<!-- fetching Branch list-->
		$.ajax({
		type:'POST',
		url:'stureg/branch_data.php',
		success:function(data){
				//alert(data);
			$('#branchs').html(data);
		}
		});
		
/* 		$.ajax({
		type:'POST',
		url:'stureg/branch_data.php',
		success:function(data){
				//alert(data);
			$('#branchs_update').html(data);
		}
		}); */
});
function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=stu_education.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}
function changeUpdate()
{	//alert();
	$("#update_show_10").show();
	$("#update_hide_10").hide();
}

function changeUpdate_12()
{	//alert();
	$("#update_show_12").show();
	$("#update_hide_12").hide();
}
function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='stu_education.php';
}

function changeFuncUpdates(){
var val=document.getElementById("sem_type_u").value;

var afterDiploma=document.getElementById('afterDiploma_u');

var sem1=parseFloat(document.getElementById("sem_1_u").value);	
var sem2=parseFloat(document.getElementById("sem_2_u").value);	
var sem3=parseFloat(document.getElementById("sem_3_u").value);	
var sem4=parseFloat(document.getElementById("sem_4_u").value);	
var sem5=parseFloat(document.getElementById("sem_5_u").value);	
var sem6=parseFloat(document.getElementById("sem_6_u").value);	
var sem7=parseFloat(document.getElementById("sem_7_u").value);	
var sem8=parseFloat(document.getElementById("sem_8_u").value);

if (isNaN(sem1) == true){sem1=0;}
if (isNaN(sem2) == true){sem2=0;}
if (isNaN(sem3) == true){sem3=0;}
if (isNaN(sem4) == true){sem4=0;}
if (isNaN(sem5) == true){sem5=0;}
if (isNaN(sem6) == true){sem6=0;}
if (isNaN(sem7) == true){sem7=0;}
if (isNaN(sem8) == true){sem8=0;}

var total_per=null;
if(afterDiploma.checked){
  total_per =(sem3+sem4+sem5+sem6+sem7+sem8)/(val-2);
}else{
  total_per =(sem1+sem2+sem3+sem4+sem5+sem6+sem7+sem8)/val;
}

var result_avg = total_per.toFixed(2);			
$('#total_per_u').html(result_avg);
$('#secured_u').val(result_avg);

	if(val==1){
		$('#sem1_u').show();
		$('#sem2_u').hide();
		$('#sem3_u').hide();
		$('#sem4_u').hide();
		$('#sem5_u').hide();
		$('#sem6_u').hide();
		$('#sem7_u').hide();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==2){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').hide();
		$('#sem4_u').hide();
		$('#sem5_u').hide();
		$('#sem6_u').hide();
		$('#sem7_u').hide();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==3){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').show();
		$('#sem4_u').hide();
		$('#sem5_u').hide();
		$('#sem6_u').hide();
		$('#sem7_u').hide();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==4){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').show();
		$('#sem4_u').show();
		$('#sem5_u').hide();
		$('#sem6_u').hide();
		$('#sem7_u').hide();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==5){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').show();
		$('#sem4_u').show();
		$('#sem5_u').show();
		$('#sem6_u').hide();
		$('#sem7_u').hide();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==6){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').show();
		$('#sem4_u').show();
		$('#sem5_u').show();
		$('#sem6_u').show();
		$('#sem7_u').hide();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==7){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').show();
		$('#sem4_u').show();
		$('#sem5_u').show();
		$('#sem6_u').show();
		$('#sem7_u').show();
		$('#sem8_u').hide();
		getCheckedDipOr12Update();
	}else if(val==8){
		$('#sem1_u').show();
		$('#sem2_u').show();
		$('#sem3_u').show();
		$('#sem4_u').show();
		$('#sem5_u').show();
		$('#sem6_u').show();
		$('#sem7_u').show();
		$('#sem8_u').show();
		getCheckedDipOr12Update();
	}
}

function changeFunc(){
var val=document.getElementById("sem_type").value;
var afterDiploma=document.getElementById('afterDiploma');
$('#total_per').html('');

var sem1=parseFloat(document.getElementById("sem_1").value);	
var sem2=parseFloat(document.getElementById("sem_2").value);	
var sem3=parseFloat(document.getElementById("sem_3").value);	
var sem4=parseFloat(document.getElementById("sem_4").value);	
var sem5=parseFloat(document.getElementById("sem_5").value);	
var sem6=parseFloat(document.getElementById("sem_6").value);	
var sem7=parseFloat(document.getElementById("sem_7").value);	
var sem8=parseFloat(document.getElementById("sem_8").value);


if (isNaN(sem1) == true){sem1=0;}
if (isNaN(sem2) == true){sem2=0;}
if (isNaN(sem3) == true){sem3=0;}
if (isNaN(sem4) == true){sem4=0;}
if (isNaN(sem5) == true){sem5=0;}
if (isNaN(sem6) == true){sem6=0;}
if (isNaN(sem7) == true){sem7=0;}
if (isNaN(sem8) == true){sem8=0;}

var total_per=null;
if(afterDiploma.checked){
  total_per =(sem3+sem4+sem5+sem6+sem7+sem8)/(val-2);
}else{
  total_per =(sem1+sem2+sem3+sem4+sem5+sem6+sem7+sem8)/val;
}


var result_avg = total_per.toFixed(2);			
$('#total_per').html(result_avg);
$('#secured').val(result_avg);

	if(val==1){
		$('#sem1').show();
		$('#sem2').hide();
		$('#sem3').hide();
		$('#sem4').hide();
		$('#sem5').hide();
		$('#sem6').hide();
		$('#sem7').hide();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==2){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').hide();
		$('#sem4').hide();
		$('#sem5').hide();
		$('#sem6').hide();
		$('#sem7').hide();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==3){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').show();
		$('#sem4').hide();
		$('#sem5').hide();
		$('#sem6').hide();
		$('#sem7').hide();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==4){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').show();
		$('#sem4').show();
		$('#sem5').hide();
		$('#sem6').hide();
		$('#sem7').hide();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==5){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').show();
		$('#sem4').show();
		$('#sem5').show();
		$('#sem6').hide();
		$('#sem7').hide();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==6){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').show();
		$('#sem4').show();
		$('#sem5').show();
		$('#sem6').show();
		$('#sem7').hide();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==7){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').show();
		$('#sem4').show();
		$('#sem5').show();
		$('#sem6').show();
		$('#sem7').show();
		$('#sem8').hide();
		getCheckedDipOr12();
	}else if(val==8){
		$('#sem1').show();
		$('#sem2').show();
		$('#sem3').show();
		$('#sem4').show();
		$('#sem5').show();
		$('#sem6').show();
		$('#sem7').show();
		$('#sem8').show();
		getCheckedDipOr12();
	}
}

function checkDipGrad(){
	debugger;
	var name=document.getElementById("class").value;

	if(name=='Graduation'){
		$('#radioBtn').show();
		$('#radioBtnUpdate').show();
	}else{
		$('#radioBtn').hide();
		$('#radioBtnUpdate').hide();
	}
}

function checkDipGradUpdate(){
	debugger;
	var name=document.getElementById("class_u").value;

	if(name=='Graduation'){
		$('#radioBtn').show();
		$('#radioBtnUpdate').show();
	}else{
		$('#radioBtn').hide();
		$('#radioBtnUpdate').hide();
	}
}

function getCheckedDipOr12(){
	debugger;
	var after12=document.getElementById('after12');
	var afterDiploma=document.getElementById('afterDiploma');

	if(after12.checked){
		$('#remove1').show();
		$('#remove2').show();
		$('#sem1').show();
		$('#sem2').show();
	}else{
		$('#remove1').hide();
		$('#remove2').hide();
		$('#sem1').hide();
		$('#sem2').hide();
	}

var val=document.getElementById("sem_type").value;
var afterDiploma=document.getElementById('afterDiploma');
$('#total_per').html('');

var sem1=parseFloat(document.getElementById("sem_1").value);	
var sem2=parseFloat(document.getElementById("sem_2").value);	
var sem3=parseFloat(document.getElementById("sem_3").value);	
var sem4=parseFloat(document.getElementById("sem_4").value);	
var sem5=parseFloat(document.getElementById("sem_5").value);	
var sem6=parseFloat(document.getElementById("sem_6").value);	
var sem7=parseFloat(document.getElementById("sem_7").value);	
var sem8=parseFloat(document.getElementById("sem_8").value);

if (isNaN(sem1) == true){sem1=0;}
if (isNaN(sem2) == true){sem2=0;}
if (isNaN(sem3) == true){sem3=0;}
if (isNaN(sem4) == true){sem4=0;}
if (isNaN(sem5) == true){sem5=0;}
if (isNaN(sem6) == true){sem6=0;}
if (isNaN(sem7) == true){sem7=0;}
if (isNaN(sem8) == true){sem8=0;}

var total_per=null;
if(afterDiploma.checked){
  total_per =(sem3+sem4+sem5+sem6+sem7+sem8)/(val-2);
}else{
  total_per =(sem1+sem2+sem3+sem4+sem5+sem6+sem7+sem8)/val;
}


var result_avg = total_per.toFixed(2);			
$('#total_per').html(result_avg);
$('#secured').val(result_avg);

}

function getCheckedDipOr12Update(){
	debugger;
	var after12=document.getElementById('after12_u');
	var afterDiploma=document.getElementById('afterDiploma_u');


	if(after12.checked){
		$('#remove1U').show();
		$('#remove2U').show();
		$('#sem1_u').show();
		$('#sem2_u').show();
	}else{
		$('#sem_1_u').val(0);
		$('#sem_2_u').val(0);
		$('#remove1U').hide();
		$('#remove2U').hide();
		$('#sem1_u').hide();
		$('#sem2_u').hide();
	}

var val=document.getElementById("sem_type_u").value;
var afterDiploma=document.getElementById('afterDiploma_u');

var sem1=parseFloat(document.getElementById("sem_1_u").value);	
var sem2=parseFloat(document.getElementById("sem_2_u").value);	
var sem3=parseFloat(document.getElementById("sem_3_u").value);	
var sem4=parseFloat(document.getElementById("sem_4_u").value);	
var sem5=parseFloat(document.getElementById("sem_5_u").value);	
var sem6=parseFloat(document.getElementById("sem_6_u").value);	
var sem7=parseFloat(document.getElementById("sem_7_u").value);	
var sem8=parseFloat(document.getElementById("sem_8_u").value);


var total_per=null;
if(afterDiploma.checked){
  total_per =(sem3+sem4+sem5+sem6+sem7+sem8)/(val-2);
}else{
  total_per =(sem1+sem2+sem3+sem4+sem5+sem6+sem7+sem8)/val;
}

var result_avg = total_per.toFixed(2);			
$('#total_per_u').html(result_avg);
$('#secured_u').val(result_avg);

}

</script>

<style type="text/css">
	.select2-container--default .select2-selection--single {
	    background-color: #fff;
	    border: 1px solid #cecece; 
	    border-radius: 0px;
	}

</style>
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<link rel="stylesheet" href="./comm/bootstrap-iso.css" />
<!--<script type="text/javascript" src="./comm/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript" src="./comm/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="./comm/bootstrap-datepicker3.css"/>

            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
				<div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="hide_panel_10_12">
             
                   <div class="x_title">
                    <h2>Secondary Education - <small>(10th and 12th / Diploma Marks)</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content" style="width:100%;overflow-x:auto;">
				  <br />

				<table id="datatablea" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
                          <th>Class</th>
                          <th>Year of Completion</th>
                          <th>School/College Name</th>
                          <th>Education Board</th>
                          <th>% or GPA secured</th>
                          <th>Action</th>
                          
                        
                        </tr>
                      </thead>


                      <tbody>
<form id="update_10marks" data-parsley-validate class="form-horizontal form-label-left" action="stu_education.php" method="post" enctype="multipart/form-data">
	<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
	<input type="hidden"  name="id_10" value="<?php echo $id_10;?>"> <!-- Get the ID from Update each record -->
	
	<input type="hidden"  name="class" value="10"> <!-- 10th -->
	
		<tr id="update_hide_10">
		<td> 
		<b>10th </b>
		</td>	
		<td> 
		<?php echo $end_year_10; ?>
		</td>
		<td> 
		<?php echo $college_name_10; ?>
		</td>
		<td> 
		<?php echo $university_10; ?>
		</td>
		<td> 
		<?php echo $secured_10; ?>
		</td>
		<td  align="center">
	<button type="button"  onclick="changeUpdate();" class="btn btn-primary" style="width:100px;">Edit</button>	
		</td>
		</tr>
		
		
	<tr id="update_show_10" style="display:none;">
		<td> 
		<b>10th </b>
		</td>	
		<td> 
		<input type="number" value="<?php echo $end_year_10; ?>" name="end_year_10" placeholder="Year of Completion" class="form-control col-md-7 col-xs-12" autofocus>
		</td>
		<td> 
		<input type="text" value="<?php echo $college_name_10; ?>" name="college_name_10" placeholder="School/College Name" class="form-control col-md-7 col-xs-12">
		</td>
		<td> 
		<input type="text"  value="<?php echo $university_10; ?>" name="university_10" placeholder="Education Board" class="form-control col-md-7 col-xs-12">
		</td>
		<td> 
		<input type="text" value="<?php echo $secured_10; ?>" name="secured_10" placeholder="% or GPA secured" class="form-control col-md-7 col-xs-12">
		</td>

		<td  align="center"> 
			<button type="submit" name="update_marks_10" id="update_marks_10" class="btn btn-success" style="width:100px;">Update</button>
		
		</td>
	</tr>
	
	</tr>
 </form>

 <form id="update_12marks" data-parsley-validate class="form-horizontal form-label-left" action="stu_education.php" method="post" enctype="multipart/form-data">
	<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
	<input type="hidden"  name="id_12" value="<?php echo $id_12;?>"> <!-- Get the ID from Update each record -->
	
	<input type="hidden"  name="class" value="12"> <!-- 12th -->
	
		<tr id="update_hide_12">
		<td> 
		<b>12th / Diploma  </b>
		</td>	
		<td> 
		<?php echo $end_year_12; ?>
		</td>
		<td> 
		<?php echo $college_name_12; ?>
		</td>
		<td> 
		<?php echo $university_12; ?>
		</td>
		<td> 
		<?php echo $secured_12; ?>
		</td>
		<td  align="center">
	<button type="button" onclick="changeUpdate_12();" class="btn btn-primary" style="width:100px;">Edit</button>	
		</td>
		</tr>
		
		
	<tr id="update_show_12" style="display:none;">
		<td> 
		<b>12th / Diploma </b>
		</td>	
		<td> 
		<input type="number" value="<?php echo $end_year_12; ?>" name="end_year_12" placeholder="Year of Completion" class="form-control col-md-7 col-xs-12" autofocus>
		</td>
		<td> 
		<input type="text" value="<?php echo $college_name_12; ?>" name="college_name_12" placeholder="School/College Name" class="form-control col-md-7 col-xs-12">
		</td>
		<td> 
		<input type="text"  value="<?php echo $university_12; ?>" name="university_12" placeholder="Education Board" class="form-control col-md-7 col-xs-12">
		</td>
		<td> 
		<input type="text" value="<?php echo $secured_12; ?>" name="secured_12" placeholder="% or GPA secured" class="form-control col-md-7 col-xs-12">
		</td>

		<td align="center"> 
			<button type="submit" name="update_marks_12" id="update_marks_12" class="btn btn-success" style="width:100px;">Update</button>
		
		</td>
	</tr>
	
	</tr>
 </form>
                        
                      
                      </tbody>
                    </table>
  	       		<!--	<p>Note : If you completed diploma no need to update 12 marks </p>-->
			 <div class="ln_solid"></div>
                </div>
                </div>


<!-- ---------------------------------- Higher Education ------------------------------- -->
<div class="modal fade" id="myModal2" data-backdrop="static">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
       <!--   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
          <h4 class="modal-title">Higher Education</h4>
        </div><div class="container"></div>
        <div class="modal-body">
		
    <form  method="POST" class="form-horizontal form-label-left">      
		<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
		<input type="hidden"  name="value_select" value="13"> <!-- For Featching Data-->
		
		
		<!--<input type="hidden"  name="id" value="<?php//echo $id;?>">--> <!-- Get the ID from Update each record -->
		
				<div class="form-group">
                        
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Degree <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="class"  id="class" class="form-control select_degree" style="width:100% !important;" required="required" onchange="checkDipGrad();">
                            <option value="Post Graduation Diploma">Post Graduation Diploma</option>
                            <option value="Graduation">Graduation</option>
                            <option value="Post Graduation">Post Graduation</option>
                            <option value="Doctorate">Doctorate</option>
                          </select>
						  <div id="error"></div>
						 </div>
						 
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Course Type <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="course_type"  id="course_type" class="form-control select_ctype" style="width:100% !important;" required="required">
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Correspondence">Correspondence</option>
                          </select>
						<div id="error"></div>
						</div>
						
				</div>
					  
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Started Year <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $start_year_13; ?>" name="start_year" required="required" placeholder="Started Year" class="form-control col-md-7 col-xs-12" autofocus>
					</div>
					
					<label class="control-label col-md-2 col-sm-2 col-xs-12">End Year <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $end_year_13; ?>"  name="end_year" required="required" placeholder="End Year" class="form-control col-md-7 col-xs-12">
					  
					</div>
				</div>
					  
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">College Name <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $college_name_13; ?>" name="college_name" required="required" placeholder="College Name" class="form-control col-md-7 col-xs-12" autofocus>
					</div>
					
					<label class="control-label col-md-2 col-sm-2 col-xs-12">University <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $university_13; ?>"  name="university" required="required" placeholder="University" class="form-control col-md-7 col-xs-12">
					  
					</div>
				</div>	  
					  
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Branch <span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-2 col-xs-12">
					   <select name="branch" id="branchs" class="form-control select_branch" style="width:100% !important;" required="required">
                           <!-- Data is fetching form Ajax call (Branchs)-->
					
                          </select>
					<div id="error"></div>
					</div>
					
				
				</div>
				
				<div class="form-group" style="margin-top: 3%; margin-bottom: 1%;display:none;" id="radioBtn">
				<div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-2">
					  <label><input type="radio" name="after12Dip" id="after12" onclick="getCheckedDipOr12();" value="After 12" checked > After 12</label>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					  <label><input type="radio" name="after12Dip" id="afterDiploma" onclick="getCheckedDipOr12();" value="After Diploma"> After Diploma</label>
				</div>	

					<div id="error"></div>
										
				</div>
				
				<div class="form-group">

					<label class="control-label col-md-2 col-sm-2 col-xs-12">Aggregate  <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $secured_13; ?>"  id="secured" name="secured" readonly="readonly" placeholder="Aggregate" class="form-control col-md-7 col-xs-12">
					</div>


					<label class="control-label col-md-2 col-sm-2 col-xs-12">Select Semesters <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					      <select name="sem_type"  id="sem_type" class="form-control select_sem" style="width:100% !important;" required="required" onchange="changeFunc();">
                            <option value="1" id="remove1">1</option>
                            <option value="2" id="remove2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                          </select>
						<div id="error"></div>
						
					</div>
				</div>

				<div class="form-group">
				
				  <div class="col-md-12">
					<div class="col-md-5" id="sem1">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 1 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_1; ?>" onchange="changeFunc();" name="sem_1" id="sem_1" min="0" placeholder="Semester 1 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem2" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 2 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_2; ?>" onchange="changeFunc();" name="sem_2" id="sem_2" min="0" placeholder="Semester 2 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>

				  <div class="col-md-12">
					<div class="col-md-5" id="sem3" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 3 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_3; ?>" onchange="changeFunc();" name="sem_3" id="sem_3" min="0" placeholder="Semester 3 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem4" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 4 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_4; ?>" onchange="changeFunc();" name="sem_4" id="sem_4" min="0" placeholder="Semester 4 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>
				  
				   <div class="col-md-12">
					<div class="col-md-5" id="sem5" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 5 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_5; ?>" onchange="changeFunc();" name="sem_5" id="sem_5" min="0" placeholder="Semester 5 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem6" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 6 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_6; ?>"  onchange="changeFunc();" name="sem_6" id="sem_6" min="0" placeholder="Semester 6 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>
				  
				   <div class="col-md-12">
					<div class="col-md-5" id="sem7" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 7 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_7; ?>" onchange="changeFunc();" id="sem_7" name="sem_7" min="0" placeholder="Semester 7 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem8" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 8 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_8; ?>" onchange="changeFunc();" id="sem_8" name="sem_8" min="0" placeholder="Semester 8 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>
				  
				  <div class="col-md-10 col-md-offset-1">
					<hr/>
					<label class="pull-right">Total Aggregate : <b><span id="total_per"></span> </b>
					<hr/>
				  </div>
				</div>
				
				<div class="form-group">
									
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Education Summary<span class="required">*</span>
					</label>
					<div class="col-md-8 col-sm-2 col-xs-12">
<textarea name="edu_summary" required="required" placeholder="Key Subjects / Specialisation" class="form-control col-md-7 col-xs-12" style="height:100px;" maxlength="1000"><?php echo $edu_summary_13;?></textarea> 
					</div>
				</div>
		<span class="required">* Mandatory Fields</span>
		
        </div>
        <div class="modal-footer">
		
          <!--<button data-dismiss="modal" class="btn btn-primary">Close</button>-->
       <a href="stu_education.php" class="btn btn-primary">Close</a>
	<button type="submit" name="add_record" id="add_record" class="btn btn-success" style="width:200px;">Add Record</button> 

        </div>
	</form>	
	
      </div>
    </div>
</div>
<!-- End of Bootstrap Module  -->

<!-- Update the single Record  -->
<div class="x_panel" id="update_high_edu" style="display:none;">
  <div class="x_title">
	<h2>Update Record</h2>
	<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
	  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	  </li>
	</ul>
	<div class="clearfix"></div>
  </div>

<div class="x_content">

<form  method="POST" class="form-horizontal form-label-left" action="stu_education.php">      
		<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
		<input type="hidden"  name="value_select" value="13"> <!-- For Featching Data-->
	    <input type="hidden"  name="id_13" value="<?php echo $id_13;?>"> <!-- Get the ID from Update each record -->
		
				<div class="form-group">
                        
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Degree<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="class_u"  id="class_u" class="form-control select_degree" style="width:100% !important;" required="required" onchange="checkDipGradUpdate();">
                            <option value="<?php echo $class_13; ?>"><?php echo $class_13; ?></option>
                            <option value="Post Graduation Diploma">Post Graduation Diploma</option>
                            <option value="Graduation">Graduation</option>
                            <option value="Post Graduation">Post Graduation</option>
                            <option value="Doctorate">Doctorate</option>
                          </select>
						  <div id="error"></div>
						 </div>
						 
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Course Type<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="course_type"  id="course_type" class="form-control select_ctype" style="width:100% !important;" required="required">
                            <option value="<?php echo $course_type_13; ?>"><?php echo $course_type_13; ?></option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Correspondence">Correspondence</option>
                          </select>
						<div id="error"></div>
						</div>
						
				</div>
					  
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Started Year<span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $start_year_13; ?>" name="start_year" required="required" placeholder="Started Year" class="form-control col-md-7 col-xs-12" autofocus>
					</div>
					
					<label class="control-label col-md-2 col-sm-2 col-xs-12">End Year<span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $end_year_13; ?>"  name="end_year" required="required" placeholder="End Year" class="form-control col-md-7 col-xs-12">
					  
					</div>
				</div>
					  
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">College Name<span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $college_name_13; ?>" name="college_name" required="required" placeholder="College Name" class="form-control col-md-7 col-xs-12" autofocus>
					</div>
					
					<label class="control-label col-md-2 col-sm-2 col-xs-12">University<span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $university_13; ?>"  name="university" required="required" placeholder="University" class="form-control col-md-7 col-xs-12">
					  
					</div>
				</div>	  
					  
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Branch<span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-2 col-xs-12">
					 
						 <select name="branch" id="branchs_update" class="form-control select_branch" style="width:100% !important;" required="required">
						 	<option value=<?php echo $branch_13_id."|".$branch_13; ?> ><?php echo $branch_13; ?></option>
                     <?php     
					$sql = "SELECT * FROM branchs";
					//echo $sql;
					$states = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
				 
						while($row=mysql_fetch_array($states)){ 
								echo '<option value="'.$row['id'].'|'.$row['branch_name'].'">'.$row['branch_name'].'</option>';
						}
					
						?>
				
                          </select>
					<div id="error"></div>
					</div>
					
		
				</div>
			

				<div class="form-group" style="margin-top: 3%; margin-bottom: 1%;display:none;" id="radioBtnUpdate">
				<div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-2">
					  <label><input type="radio" name="after12Dip_u" id="after12_u" onclick="getCheckedDipOr12Update();" value="After 12" 
					  	<?php echo $class_type_13=="After 12" ? "checked" : "" ?> > After 12</label>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					  <label><input type="radio" name="after12Dip_u" id="afterDiploma_u" onclick="getCheckedDipOr12Update();" value="After Diploma"
					  	<?php echo $class_type_13=="After Diploma" ? "checked" : "" ?> > After Diploma</label>
				</div>	

					<div id="error"></div>
										
				</div>

				<div class="form-group">

					<label class="control-label col-md-2 col-sm-2 col-xs-12">Aggregate <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					  <input type="text" value="<?php echo $secured_13; ?>" id="secured_u" name="secured" required="required" readonly placeholder="Aggregate" class="form-control col-md-7 col-xs-12">
					  
					</div>


					<label class="control-label col-md-2 col-sm-2 col-xs-12">Select Semesters <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-2 col-xs-12">
					      <select name="sem_type"  id="sem_type_u" class="form-control select_sem" style="width:100% !important;" required="required" onchange="changeFuncUpdates();">
                            <option value="<?php echo $sem_type;?>"><?php echo $sem_type;?></option>
                            <option value="1" id="remove1U">1</option>
                            <option value="2" id="remove2U">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                          </select>
						<div id="error"></div>
					</div>
				</div>
			
			<div class="form-group">
				
				  <div class="col-md-12">
					<div class="col-md-5" id="sem1_u">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 1 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_1; ?>" onchange="changeFuncUpdates();" name="sem_1" id="sem_1_u" min="0" placeholder="Semester 1 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem2_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 2 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_2; ?>" onchange="changeFuncUpdates();" name="sem_2" id="sem_2_u" min="0" placeholder="Semester 2 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>

				  <div class="col-md-12">
					<div class="col-md-5" id="sem3_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 3 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_3; ?>" onchange="changeFuncUpdates();" name="sem_3" id="sem_3_u" min="0" placeholder="Semester 3 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem4_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 4 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_4; ?>" onchange="changeFuncUpdates();" name="sem_4" id="sem_4_u" min="0" placeholder="Semester 4 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>
				  
				   <div class="col-md-12">
					<div class="col-md-5" id="sem5_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 5 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_5; ?>" onchange="changeFuncUpdates();" name="sem_5" id="sem_5_u" min="0" placeholder="Semester 5 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem6_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 6 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_6; ?>"  onchange="changeFuncUpdates();" name="sem_6" id="sem_6_u" min="0" placeholder="Semester 6 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>
				  
				   <div class="col-md-12">
					<div class="col-md-5" id="sem7_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 7 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_7; ?>" step="any"  onchange="changeFuncUpdates();" id="sem_7_u" name="sem_7" min="0" placeholder="Semester 7 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
					
					<div class="col-md-5" id="sem8_u" style="display:none;">
						<label class="control-label col-md-6 col-sm-6 col-xs-6">Semester 8 % or GPA<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="number" step="any" value="<?php echo $sem_8; ?>" step="any"  onchange="changeFuncUpdates();" id="sem_8_u" name="sem_8" min="0" placeholder="Semester 8 " class="form-control">
							<div id="error"></div>
						</div>
					</div>
				  </div>
				  
				  <div class="col-md-10 col-md-offset-1">
					<hr/>
					<label class="pull-right">Total Aggregate : <b><span id="total_per_u"></span> </b>
					<hr/>
				  </div>
				</div>

				
				<div class="form-group">
									
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Education Summary<span class="required">*</span>
					</label>
					<div class="col-md-8 col-sm-2 col-xs-12">
<textarea name="edu_summary" required="required" placeholder="Key Subjects / Specialisation" class="form-control col-md-7 col-xs-12" style="height:100px;" maxlength="1000"><?php echo $edu_summary_13;?></textarea> 
					</div>
				</div>

    <br>
       <div class="col-md-4">
	   </div>
		<div class="form-group">
          <!--<button data-dismiss="modal" class="btn btn-primary">Close</button>-->
       <a href="stu_education.php" class="btn btn-primary" style="width:120px;">Close</a>
	<button type="submit" name="update_record" id="update_record" class="btn btn-success" style="width:150px;">Update Record</button> 
		</div>
     
	</form>	
			  </div>
			  </div>
			  
			  
		<!-- Onload Displaying data in Table -->	  
			  <div class="x_panel" id="hide_panel_edu">		  
                  <div class="x_title">
                    <h2>Higher Education - <small>(Diploma, Graduation, Post Graduation, Doctorate)</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%;overflow-x:scroll;">
				  
   	<button type="submit" class="btn btn-primary" style="width:200px;margin-bottom: 25px;"  data-toggle="modal" data-target="#myModal2">Add Record</button> 

					<!--<p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>table table-striped jambo_table bulk_action                     -->
          <table id="datatable" class="table table-striped table-bordered nowrap" style="width:1700px;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						  <!--<th width="2%">Delete</th>-->
                          <th width="7%">Action</th> 
                          <th>Degree</th>
                          <th>Course Type</th>
                          <th>Started Year</th>
                          <th>End Year</th>
                          <th>College Name</th>
                          <th>University</th>
                          <th>Branch</th>
                          <th>SEM 1</th>
                          <th>SEM 2</th>
                          <th>SEM 3</th>
                          <th>SEM 4</th>
                          <th>SEM 5</th>
                          <th>SEM 6</th>
                          <th>SEM 7</th>
                          <th>SEM 8</th>
						  <th>Aggregate</th>
						  <th>Education Summary</th>
                        
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($stu_education_13)) 
						   {   
					   ?>   
		<!--href='stu_education.php?delete=<?php //echo $row["id"];?>'	-->			   				   
						 <tr>
						 <td align="center" style="vertical-align: middle;">
						 <a title="Delete">
						 <button class="btn btn-danger" onclick="Delete(<?php echo $row["id"];?>);">
						 <i class="glyphicon glyphicon-trash"></i>
						  </button>
						 </a><!--</td>
						 <td align="center" style="vertical-align: middle;">-->
						 <a title="Update" href='stu_education.php?update=<?php echo $row["id"];?>'>
						 <button class="btn btn-warning">
						 <i class="glyphicon glyphicon-pencil"></i>
						 </button>
						 </a></td>
						 <td><?php echo $row['class']; ?></td>                                            
						 <td><?php echo $row['course_type']; ?></td>
						 <td><?php echo $row['start_year']; ?></td>
						 <td><?php echo $row['end_year']; ?></td>
						 <td><?php echo $row['college_name']; ?></td>
						 <td><?php echo $row['university']; ?></td>
						 <td><?php echo $row['branch']; ?></td>
						 <td><?php echo $row['sem1']; ?></td>
						 <td><?php echo $row['sem2']; ?></td>
						 <td><?php echo $row['sem3']; ?></td>
						 <td><?php echo $row['sem4']; ?></td>
						 <td><?php echo $row['sem5']; ?></td>
						 <td><?php echo $row['sem6']; ?></td>
						 <td><?php echo $row['sem7']; ?></td>
						 <td><?php echo $row['sem8']; ?></td>
						 <td><?php echo $row['secured']."%"; ?></td>
						 <td>
<textarea name="edu_summary" style="height:70px;width:250px;" readonly><?php echo $row['edu_summary']; ?></textarea> 						 
						 </td>
						</tr>		 
			 <!--href='skills.php?update=<?php //echo $row["id"];?>'-->

				<?php 

						   }?>
                        
                      
                      </tbody>
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

	

<script>
	$(document).ready(function(){
		var date_input=$('input[name="duration_from"],input[name="duration_to"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso span').length>0 ? $('.bootstrap-iso span').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>
	
	 <!-- Datatables -->
    <script>
      $(document).ready(function() {
		  
		$(".select_branch").select2({
          placeholder: "Select a Branchs",
          allowClear: true
        });

        $(".select_degree").select2({
          placeholder: "Select a Degree",
          allowClear: true
        });

        $(".select_ctype").select2({
          placeholder: "Select a Course Type",
          allowClear: true
        });

        $(".select_sem").select2({
          placeholder: "Select a Semester",
          allowClear: true
        });
	
	
        $('#datatable').dataTable();

      });
    </script>
    <!-- /Datatables -->
	
	

</body>

</html>