<?php
include('db.php');
//date_default_timezone_set('Asia/Kolkata');

$branch_name = $_GET['branch'];
$blog_id = $_GET['blog_id'];

if($branch_name=='E'){
    $disp_name='Engineering and Management';
}else if ($branch_name=='M') {
   $disp_name='Medical';
}else if ($branch_name=='P') {
   $disp_name='Pure Science';
}else if ($branch_name=='H') {
   $disp_name='Hospitality management ';
}else if ($branch_name=='A') {
   $disp_name='Arts,Social Media and Fashion';
}else if ($branch_name=='C') {
   $disp_name='Commerce';
}else{
   $disp_name='Error : Please Go Back to Home Page.';
}


/*
Engineering and management - E
Medical                    - M
Pure Science               - P
Hospitality management     - H
Arts,Social Media and Fashion - A
Commerce                      - C
*/

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Comment Desc</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">
    <link href="css/BootSideMenu.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/BootSideMenu.js"></script>
    <style>
    
#login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgb(255, 255, 255);
}
#login-dp .help-block{
    font-size:12px    
}
#login-dp .bottom{
    background-color:rgba(255,255,255,.8);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}
#login-dp .social-buttons{
    margin:12px 0    
}
#login-dp .social-buttons a{
    width: 49%;
}
#login-dp .form-group {
    margin-bottom: 10px;
}

@media(max-width:768px){
    #login-dp{
        background-color: inherit;
        color: #fff;
    }
    #login-dp .bottom{
        background-color: inherit;
        border-top:0 none;
    }
}



.toggle-contentEss{
    padding-left: 8px;
    padding-right: 8px;
    padding-bottom: 6px;
    padding-top: 3px;
    font-size: 14px;
    width: 80%;
    text-align: justify;
    word-spacing: 1px;
    line-height: 14pt;
    border: 1px solid #d6a5a5;
    border-radius: 4px;
    margin-bottom: 5px;
    color:black;
    background-color: #f5f7f9;
}

.reply_txt {
  font-size: 14px;
  font-weight:bold;
  color:rgba(9, 103, 220, 0.85);
    
}

.reply_txt:hover {
    text-decoration: underline;
  cursor: pointer;
  cursor: hand; 
  color:#0967dc;
}

@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
    text-decoration: blink;
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 0.6s;
    -webkit-animation-iteration-count:infinite;
    -webkit-animation-timing-function:ease-in-out;
    -webkit-animation-direction: alternate;
}
.media-object{
    height: 35px;
    width: 45px;
}
    </style>
</head>


<script type="text/javascript">
var tempData;
if(tempData===null||tempData===undefined){
     tempData={};
}

var valid_id=null;
tempData.subComment=
{
    login:function(){
        debugger;
            $.ajax({
                type: 'POST',
                url: 'blogAjax/saveCommentData.php',
                async:false,
                dataType:'json',
                data: $('#loginFrom').serialize()+"&loginBlog=113324",
                success: function (obj) {
                    debugger;
                      if(obj.data!="F"){
                    $('#student_name').html('Hello '+obj.data[0].stu_firstname);
                    $('#stu_name').html('Hello '+obj.data[0].stu_firstname);
                    $('#login_status').val('A');

                    $('#stu_id_fkb').val(obj.data[0].stu_id);
                    $('#stu_nameb').val(obj.data[0].stu_firstname);
                   // $('#keywordb').val(<?php //echo $branch_name; ?>);
                    $('#clg_id_fkb').val(obj.data[0].stu_college_id);
                    $('#clg_nameb').val(obj.data[0].stu_college_name);
                    $('#stu_profile_imgb').val(obj.data[0].stu_profile_img);


                    $('#header_valid').show();
                    $('#note_valid').show();
                    $('#header').hide();
                    $('#note').hide();
                        $('#wrongUP').hide();  
                    }
                    else{
                        $('#wrongUP').show();
                    }
                }
              });   
    },
    logout:function(){
        $.ajax({
            type: 'post',
            url: 'blogAjax/saveCommentData.php',
            async:false,
            data:"logoutBlog=113324",
            success: function (obj) {
                debugger;
                $('#login_status').val('D');
                tempData.subComment.valid_page();
            }
          });   
    },
    valid_page:function(data){
        debugger;
        if(data!='' && data!= undefined){
            $('#student_name').html('Hello <?php echo "$stu_firstname"; ?>');
            $('#stu_name').html('Hello <?php echo "$stu_firstname"; ?>');
            $('#login_status').val('A');

            $('#stu_id_fkb').val(<?php echo "$stu_id"; ?>);
            $('#stu_nameb').val('<?php echo "$stu_firstname"; ?>');
           // $('#keywordb').val(obj.data[0].stu_firstname);
            $('#clg_id_fkb').val(<?php echo "$stu_college_id"; ?>);
            $('#clg_nameb').val('<?php echo "$stu_college_name"; ?>');
            $('#stu_profile_imgb').val('<?php echo "$stu_profile_img"; ?>');

            $('#header_valid').show();
            $('#note_valid').show();
            $('#header').hide();
            $('#note').hide();
        }else{
            $('#header_valid').hide();
            $('#note_valid').hide();
            $('#header').show();
            $('#note').show();
        }
    },
    loadSubComments:function(){
         debugger;
        $.ajax({
            type: 'post',
            url: 'blogAjax/saveCommentData.php',
            async:false,
            dataType:'json',
            data:"&loadComm2=1221&keywordb=<?php echo $branch_name; ?>&blog_id=<?php echo $blog_id; ?>",
            success: function (obj) {
                debugger;
              //alert(obj.data.length);
            
            $('#mainContant').html('');
            $('#loadMainProfile').html('');
            for(var i=0;i<obj.data.length;i++){
                var img;  
                if(obj.data[i].stu_profile_img !=''){
                    img=obj.data[i].stu_profile_img;
                }else{
                    img='images/user.png';
                }
                
                var imgContent="<img class=\"media-object\" src='../student/"+img+"' alt=''>";
                $('#loadMainProfile').append(imgContent); 
                
                var content= "<h4 class='media-heading'><span style='text-transform: uppercase;'>"+obj.data[i].stu_name+" &nbsp;&nbsp;</span> <small> "+obj.data[i].modified+"</small></h4>"+obj.data[i].msg;    
                $('#mainContant').append(content);          
             } 

            }
          }); 
    },
    loadSubNestedComments:function(){
        debugger;
        $.ajax({
            type: 'post',
            url: 'blogAjax/saveCommentData.php',
            async:false,
            dataType:'json',
            data:"&loadNestedComm=1221&keywordb=<?php echo $branch_name; ?>&blog_id=<?php echo $blog_id; ?>",
            success: function (obj) {
                debugger;
              //alert(obj.data.length);
            $('#subContant').html('');

            for(var i=0;i<obj.data.length;i++){
                var img;  
                if(obj.data[i].stu_profile_img !=''){
                    img=obj.data[i].stu_profile_img;
                }else{
                    img='images/user.png';
                }
               var content =  "<div class='media'><a class='pull-left' href='javascript:void(0);'>"
                            +"<img class='media-object' src='../student/"+img+"' alt=''></a>"
                            +"<div class='media-body'><h4 class='media-heading'><span style='text-transform: uppercase;'>"
                            +obj.data[i].stu_name+" &nbsp;&nbsp;</span> <small> "+obj.data[i].modified+"</small></h4>"+obj.data[i].msg
                            +"</div></div>";

                $('#subContant').append(content);          
             } 

            }
          }); 
    },
    saveSubComment:function(){
        debugger;
        $.ajax({
            type: 'post',
            url: 'blogAjax/saveCommentData.php',
            async:true,
            data: $('#commentSubFrom').serialize()+"&saveSubComm=1221",
            success: function (data) {
                debugger;
                //alert(data);
                $("#commonID").modal({backdrop:'static'});
                $("#commonInnerID").html(data);
                $('#commentSubMsg').val('');
                tempData.subComment.loadSubNestedComments();
            }
          });   
    },
    countChar:function(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').html('<b>Max Length : '+ (500 - len) +'</b>');
        }
    }   
};  
$(document).ready(function () {
    $(".circulars-content").hide(); 

    $(".circulars").click(function() {
       $(this).next(".circulars-content").slideToggle("normal");
       $(this).toggleClass('active_toggle');
       $(this).find('i').toggleClass('fa-plus fa-minus');
    });
    
    $('#keywordb').val('<?php echo $branch_name; ?>');
    tempData.subComment.valid_page(<?php echo $stu_id; ?>);
    tempData.subComment.loadSubComments();
    tempData.subComment.loadSubNestedComments();
});
</script>


<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Uplace</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php?branch=<?php echo $branch_name; ?>">Back</a>
                    </li>
                </ul>
        <!-- Search -->
    <!--<div class="col-sm-3 col-md-3">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search In Blog" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
    </div>-->
    
        <ul class="nav navbar-nav navbar-right" id="header">      
        <li><p class="navbar-text">Already have an account?</p></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                     <div class="row">
                            <div class="col-md-12">
                                 <form class="form" role="form" method="post" id="loginFrom" accept-charset="UTF-8" id="login-nav">
                                        <!--<div class="form-group text-center">    
                                            <b>www.uplace.in</b>
                                        </div>  -->
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                             <input type="email" class="form-control" id="exampleInputEmail2" name="email" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputPassword2">Password</label>
                                             <input type="password" class="form-control" id="exampleInputPassword2" name="password"placeholder="Password" required>
                                             <div class="help-block text-right">
                                                  <p style="color: red;display: none;" id="wrongUP">Invalid Username/Password</p>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <button type="button" class="btn btn-primary btn-block" onclick="tempData.subComment.login();"> Sign in <i class="fa fa-sign-in"></i></button>
                                        </div>
                                 </form>
                            </div>
                            <div class="bottom text-center">
                                New here ? <a href="../student"><b>Join Us</b></a>
                            </div>
                     </div>
                </li>
            </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right" id="header_valid">
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><b><span id="student_name"></span></b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                     <div class="row">
                            <div class="col-md-12">
                                 <form class="form" role="form" method="post" id="loginFrom" accept-charset="UTF-8" id="login-nav">
                                        <div class="form-group text-center">    
                                            <b class="blink">www.uplace.in</b>
                                        </div>  
                                        <div class="form-group">
                                             <button type="button" class="btn btn-primary btn-block" onclick="tempData.subComment.logout();"> Logout - <i class="fa fa-sign-out"></i> </button>
                                        </div>
                                 </form>
                            </div>
                            
                     </div>
                </li>
            </ul>
        </li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->          
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">
                <!--<h1>Blog Post Title</h1>
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>
                <hr>-->
                <!-- Date/Time -->
                 <div class="row">

                    <!-- Blog Post Content Column -->
                    <div class="col-lg-12">
                        <!-- Title -->
                        <h1>Blog Post - <?php echo $disp_name; ?></h1>
                        <!-- Author -->
                        <p class="lead">
                            by <a href="http://www.uplace.in">uPLACE</a>
                            <span class="pull-right" id="dataValid" style="font-size: 18px;"> <b>Today :   
                            <?php echo date("d/m/Y")." - ".date("l")?> </b></span>
                        </p>
                        <hr>
                    </div>
                <br>
             </div>
                        
            <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <span id="loadMainProfile"></span>
                    </a>

                    <div class="media-body">
               <!-- Load main data for it --> 
               <span id="mainContant">         
                     
                </span>        
                        <br><br>
                
                <span class="reply_txt toggle-titleEss circulars">Reply</span>
                <div class='toggle-contentEss circulars-content'> 
                    <form role="form" id="commentSubFrom">
                    <input id="login_status" name="login_status" type="hidden"/>

                    <input id="stu_id_fkb" name="stu_id_fkb" type="hidden"/>
                    <input id="stu_nameb" name="stu_nameb" type="hidden"/>
                    <input id="keywordb" name="keywordb" type="hidden"/>
                    <input id="clg_id_fkb" name="clg_id_fkb" type="hidden"/>
                    <input id="clg_nameb" name="clg_nameb" type="hidden"/>
                    <input id="blog_id" name="blog_id" type="hidden" value="<?php echo $blog_id; ?>"/>
                    <input id="stu_profile_imgb" name="stu_profile_imgb" type="hidden"/>

<span id="charNum" class="pull-right"></span></h4>  
            <div class="form-group">
                <textarea class="form-control" rows="3" name="commentSubMsg"  onkeyup="tempData.subComment.countChar(this)" 
                id="commentSubMsg"></textarea>
            </div>
                        <button type="button" onclick="tempData.subComment.saveSubComment();" class="btn btn-primary">POST</button>
                    </form>
                </div>  
                        <hr>
                        
                        
                        <!-- Nested Comment -->
                        <span id="subContant">                         
                        </span>
                        
                        <!-- End Nested Comment -->
                    </div>
                </div>
                <hr>
                <!-- Blog Comments -->
             </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    


</body>
</html>
