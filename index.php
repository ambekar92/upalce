<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google-site-verification" content="-Lq3WUFnUGchxSUVIYlZ6m9q1MKQFQggMnrS_aX6ckQ" />

    <title>uPLACE | Home</title>

    <link rel="icon" type="image/png" href="web/img/icon.jpg">
    <!-- Bootstrap Core CSS -->
    <link href="web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="web/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="web/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="web/css/creative.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="web/assets/css/hexagons.min.css"> 
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <script src="web/js/jssor.slider-22.2.7.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: true,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style>
        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('web/img/header/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        .jssora22l.jssora22lds      (disabled)
        .jssora22r.jssora22rds      (disabled)
        */
        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('web/img/header/a22.png') center center no-repeat;
            overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
        .jssora22l.jssora22lds { background-position: -10px -31px; opacity: .3; pointer-events: none; }
        .jssora22r.jssora22rds { background-position: -70px -31px; opacity: .3; pointer-events: none; }
    </style>
    
    <style>
    section{
    min-height: 100% !important;
    }
    .menu_color{
    color:black !important;
    }
    
    .thumbnail {
    position:relative;
    overflow:hidden;
}
 
.caption {
    position:absolute;
    top:0;
    right:0;
    background-color: rgba(240,95,64,.9);
    width:100%;
    height:100%;
    padding:2%;
    display: none;
    text-align:center;
    
    z-index:2;
}

.text-primary {
    color: #2130c0  !important;
}

.text-primary01 {
    color: #2130c0  !important;
}

.text-muted {
    color: #040404 !important;
}

/* Float Shadow */
.hvr-float-shadow {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px transparent;
  position: relative;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
}
.hvr-float-shadow:before {
  pointer-events: none;
  position: absolute;
  z-index: -1;
  content: '';
  top: 100%;
  left: 5%;
  height: 10px;
  width: 90%;
  opacity: 0;
  background: -webkit-radial-gradient(center, ellipse, rgba(0, 0, 0, 0.35) 0%, transparent 80%);
  background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.35) 0%, transparent 80%);
  /* W3C */
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform, opacity;
  transition-property: transform, opacity;
}
.hvr-float-shadow:hover, .hvr-float-shadow:focus, .hvr-float-shadow:active {
  -webkit-transform: translateY(-5px);
  transform: translateY(-5px);
  /* move the element up by 5px */
}
.hvr-float-shadow:hover:before, .hvr-float-shadow:focus:before, .hvr-float-shadow:active:before {
  opacity: 1;
  -webkit-transform: translateY(5px);
  transform: translateY(5px);
  /* move the element down by 5px (it will stay in place because it's attached to the element that also moves up 5px) */
}

.comp_patners{
    width:20%;
    margin-left:5%;
    border: 2px solid black; 
    border-radius: 8%;
}

.btn-xl {
    padding: 29px 45px !important;
}

.cls250{
    height: 250px;
}

.clstext{
    font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif;
    font-size: 27px;
    padding: 86px 120px 10px;
}

.cardCss{
    box-shadow: 6px 4px 4px 0px black;
}
    </style>
    
    <script>
    function get_data(){
    //var url ='adminreg/send_mail.php?form='+to+'&data_link='+data_link+'&subject='+subject+'&msg='+msg+'&admin_email=<?php echo $off_email;?>';
    var url ='web/php/send_mail.php';
    //$("#cs").hide();
    $.ajax({
            type:'POST',
            url:url,
            data: $("#form_data").serialize(),
            success:function(data){
                //alert(data);
                if(data==0){
                $("#err_field").fadeIn()
                setTimeout(function(){ 
                    $("#err_field").fadeOut();
                }, 3000); 
                    
                }else{
                $("#mail_sent").fadeIn()
                setTimeout(function(){ 
                    $("#mail_sent").fadeOut();
                }, 3000);
                    
                }
                           $('#form_data')[0].reset();
            }  
        });  

    }
    
        
</script>

<script type="text/javascript"> //<![CDATA[ 
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>   u

</head>

<body id="page-top" style="font-family: 'Open Sans','Helvetica Neue',Arial,sans-serif !important;">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid" style="background-color: white;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <!--
                <img src="web/img/header_logo.jpg" class="navbar-brand page-scroll" style="width:10%;border-radius:2px;">-->
        <!--        <a class="navbar-brand page-scroll" href="#page-top">uplace</a>-->
                <a  class="navbar-left"><img src="web/img/header_logo.jpg" style="width:100px;border-radius:2px;"></a>
                <!--<a class="navbar-brand" rel="home" href="#" title="Buy Sell Rent Everyting">
                    <img style="max-width:100px;" src="web/img/header_logo.jpg">
                </a>-->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#home">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll menu_color" href="#about">About us</a>
                    </li>
                  <!--  <li>
                        <a class="page-scroll menu_color" href="#services">Services</a>
                    </li>-->
                    <li>
                        <a class="page-scroll menu_color" href="#notifications">Notifications</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll menu_color" href="#login">Login</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll menu_color" href="#portfolio">Student Blog</a>
                    </li>
                    <li>
                        <a class="page-scroll menu_color" href="#partners">our partners</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll menu_color" href="#contact">Contact us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


      <!--  <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading" style="text-transform:none !important;">uPLACE</h1> 
                <hr>
                <p>uPLACE can help you to build better Career ! Just logon and get good opportunity to showcase your talent and start your journey in IT ..!</p>
               
            </div>
        </div>-->
    <aside id="home" style="min-height:auto;margin-bottom: -4%;">   
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:550px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('web/img/header/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:550px;overflow:hidden;">
            <div>
                <img data-u="image" src="web/img/header/1.jpg" style="opacity: 0.6;"/>
                <div style="position:absolute;top:50px;left:460px;height:120px;z-index:0;color:#ffffff;line-height:60px;">
                <h1 style="text-transform:none !important;font-size:90px;
                color: black;font-family: -webkit-body;text-shadow: rgb(4, 65, 241) 1px 4px 11px;
                padding: 5px;   padding-left: 45px;    padding-right: 45px;    border-radius: 123px;">
                uPLACE</h1> 
                </div>
                <div style="position:absolute;top:280px;left:250px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;">
                <p style="text-transform:none !important;font-size:25px;font-weight:bold;
                color: black;font-family: -webkit-body;text-shadow: rgb(4, 65, 241) 1px 4px 11px;
                padding: 5px;    padding-left: 45px;    padding-right: 45px;
                border-radius:5px;text-transform: uppercase;">
                uPLACE can help you to build better Career ! Just logon and get good <br>opportunity to showcase your talent and start your professional journey..!</p>
                </div>
            </div>
          
            <div>
                <img data-u="image" src="web/img/header/2.jpg" style="opacity: 0.6;"/>
                <div style="position:absolute;top:50px;left:460px;height:120px;z-index:0;color:#ffffff;line-height:60px;">
                <h1 style="text-transform:none !important;font-size:90px;
                color: black;font-family: -webkit-body;text-shadow: rgb(4, 65, 241) 1px 4px 11px;
                padding: 5px;   padding-left: 45px;    padding-right: 45px;    border-radius: 123px;">
                uPLACE</h1> 
                </div>
                <div style="position:absolute;top:280px;left:250px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;">
                <p style="text-transform:none !important;font-size:25px;font-weight:bold;
                color: black;font-family: -webkit-body;text-shadow: rgb(4, 65, 241) 1px 4px 11px;
                padding: 5px;    padding-left: 45px;    padding-right: 45px;
                border-radius:5px;text-transform: uppercase;">
                A unique platform which would revolutionize the campus placement.</p>
                </div>
            </div>
            <div>
                <img data-u="image" src="web/img/header/3.jpg" style="opacity: 0.6;"/>
                <div style="position:absolute;top:50px;left:460px;height:120px;z-index:0;color:#ffffff;line-height:60px;">
                <h1 style="text-transform:none !important;font-size:90px;
                color: black;font-family: -webkit-body;text-shadow: rgb(4, 65, 241) 1px 4px 11px;
                padding: 5px;   padding-left: 45px;    padding-right: 45px;    border-radius: 123px;">
                uPLACE</h1> 
                </div>
                <div style="position:absolute;top:280px;left:160px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;">
                <p style="text-transform:none !important;font-size:25px;font-weight:bold;
                color: black;font-family: -webkit-body;text-shadow: rgb(4, 65, 241) 1px 4px 11px;
                padding: 5px;    padding-left: 45px;    padding-right: 45px;
                border-radius:5px;text-transform: uppercase;">
                A perfect way for U to showcase your talents to the world and stand out from the crowd.</p>
                </div>
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
    </aside>
   

    <section id="about" style="background-image: url(web/img/bg.png);color:white;">
        <div class="container">
            <div class="row">
            <!-- <div class="col-lg-2  text-center">
            <center><img src="web/img/full_logo.jpg" style="border-radius:2px;width:220px;" class="img-responsive"></center>
            </div> -->
                <div class="col-lg-10 col-lg-offset-1 text-center">
                 <h2 class="section-heading">About Us</h2>
                    <hr class="light">
<p style="text-align:justify;"> 
uPLACE aims at providing a platform which connects students, their respective universities/colleges with the companies who are looking to hire them. Universities/colleges will have powerful yet easy to manage tools to assist them in their placement related activities.
</p>
<p style="text-align:justify;">             
uPLACE provides best in class options for the students to showcase their talents and achievements and try to stand out from the crowd.
</p>

<p style="text-align:justify;"> 
Companies can quickly check their requirement criteria with respect to all the possible universities/colleges and accordingly get in touch with the respective placement officers and also post fresher jobs and internship options to intended colleges.To sum up, it’s an attempt to answer the question of how to make placement activities easy for both students and universities by providing a handy tool and social platform at university level through which they can easily interact with the targeted companies.
</p>              
                </div>
            </div>
        </div>
    </section>

<!--    <section id="services" style="background-color:white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services for U</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Sturdy Templates</h3>
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Ready to Ship</h3>
                        <p class="text-muted">You can use this theme as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Up to Date</h3>
                        <p class="text-muted">We update dependencies to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">You have to make your websites with love these days!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    
    
    
<section id="notifications">
        <div class="container">
            <div class="row" style="margin-top:-26px;">
                <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                    <h2 class="section-heading">Admin Notifications </h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 text-center">
                    <div style="border:2px solid black;border-radius:15px;height:100%;"><br>
                      <img src="web/img/notify.jpg" style="width:40px;border-radius:2px;"> <h3>uPLACE Updates</h3>
                       
                        <!--<marquee direction="up" scrolldelay=200 style="margin-left:20px;" height="300px" onmouseover="this.stop();" onmouseout="this.start();">
                         <span id="uplace_notification"></span>
                        </marquee>-->
<marquee direction="up" scrolldelay=200 style="margin-left:20px;" height="300px" onmouseover="this.stop();" onmouseout="this.start();">

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to </b>
<br><span style="margin-left: 41px;font-weight: bold;">Acharya Tulsi National College Of Commerce, Shimoga into uPLACE family!</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes  </b>
<br><span style="margin-left: 41px;font-weight: bold;">Lal Bahadur Arts, Science & S.B.Solabanna Shetty Commerce College , Sagara, Shimoga</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes  </b>
<br><span style="margin-left: 41px;font-weight: bold;">Sri Venkateshwara College of Engineering, Bangalore</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes  </b>
<br><span style="margin-left: 41px;font-weight: bold;">Rao Bahadur Y Mahabaleswarappa Engineering College.</span>
</p>


<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes  </b>
<br><span style="margin-left: 41px;font-weight: bold;">Rajarajeshwari College of Engineering Bangalore.</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to </b>
<br><span style="margin-left: 41px;font-weight: bold;"> ACS College of Engineering into uPLACE family!</span>
</p>


<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes  </b>
<br><span style="margin-left: 41px;font-weight: bold;">St. Philomena's College, Mysore into its family.</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to </b>
<br><span style="margin-left: 41px;font-weight: bold;"> Maharaja Institute of Technology into uPLACE family!</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to Mysore college </b>
<br><span style="margin-left: 41px;font-weight: bold;">  of Engineering and Management into its family.</span>
</p>


<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to TTL college </b>
<br><span style="margin-left: 41px;font-weight: bold;"> of Business Management into uPLACE family!</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to Amruta Institute of Engineering and</b>
<br><span style="margin-left: 41px;font-weight: bold;">  Management Sciences into uPLACE family!</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b>  A Warm welcome to JSS Academy Of Technical  </b>
<br><span style="margin-left: 41px;font-weight: bold;"> Education Bangalore into uPLACE family!</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes  </b>
<br><span style="margin-left: 41px;font-weight: bold;">Surana college into its family.</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> A Warm welcome to </b>
<br><span style="margin-left: 41px;font-weight: bold;">Jyothy Institute of Technology into uPLACE family.</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes </b>
<br><span style="margin-left: 41px;font-weight: bold;">City Engineering College Bangalore into its family.</span>
</p>

<p class="text-muted">
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> A Warm welcome to </b>
<br><span style="margin-left: 41px;font-weight: bold;">SJB Institute Of Technology into uPLACE family.</span>
</p>

<p class="text-muted"> 
<img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp; <b> uPLACE Welcomes </b>
<br><span style="margin-left: 41px;font-weight: bold;">Atria Institute Of Technology into its family.</span>
</p>
                            
</marquee>
                    </div>

                </div>
                <div class="col-xs-12 hidden-md hidden-lg text-center">&nbsp;</div>
                <div class="col-lg-6 col-md-6 col-xs-12 text-center">
                    <div style="border:2px solid black;border-radius:15px;height:100%;"><br>
                        <i class="fa fa-4x fa-university text-primary01 sr-icons" style="color: #2130c0  !important;"></i>
                        <h3>Ongoing Campus Events</h3>
                             <marquee direction="up" scrolldelay=200 style="margin-left:20px;" height="300px" onmouseover="this.stop();" onmouseout="this.start();">
                              <p class="text-muted">  
                              <i class="fa fa-fw fa-university" style="color: #2130c0  !important;"></i> Coming Soon
                              <br><span style="margin-left:26px;font-weight: 200;"></span></p>
                             </marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="login" style="background-image: url(web/img/bg.png);color:white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Login</h2>
                    <hr class="light">
                </div>
            </div>
        </div>
        <br>        <br><br><br><br><br>
        <div class="container">
            <div class="row">       
                <div class="col-lg-12 text-center">         
                    <div class="col-md-3 col-xs-12">  
                                <!-- <div class="hidden-md hidden-lg">
                                <img src="web/img/exp.png" class="img-responsive img-thumbnail" style="width:60%;">
                                    <p><a href="../student/exp_login.php" class="page-scroll btn btn-danger btn-lg hvr-float-shadow" style="color:white;padding:10px; width: 280px;"> Experienced <br> Candidate Login </a></p>
                                </div>   -->
                        <div class=""> 
                           <!-- <div class="thumbnail">
                                <div class="caption">
                                   <div class="project-name text-faded" style="color:white;">
                                        <h3 style="margin-top: 35%;">Experienced Candidate</h3>
                                    </div>
                                </div> 
                        
                                <img src="web/img/exp.png" alt="...">
                           </div> -->
                           <p><a href="../student/exp_login.php" class="page-scroll btn btn-danger btn-xl hvr-float-shadow"> Experienced Login </a></p>
                        </div>
                     </div>
                                     
                    <div class="col-md-3 col-xs-12">  
                            
                                <!-- <div class="hidden-md hidden-lg">
                                <img src="web/img/stu.png" class="img-responsive img-thumbnail" style="width:60%;">
                                    <p><a href="../student/stulogin.php" class="page-scroll btn btn-danger btn-lg hvr-float-shadow" style="color:white;padding:10px; width: 280px;"> Student Login </a></p>
                                </div>   -->
                        <div class=""> 
                           <!-- <div class="thumbnail">
                                <div class="caption">
                                   <div class="project-name text-faded" style="color:white;">
                                        <h3 style="margin-top: 35%;">Student</h3>
                                    </div>
                           
                                </div> 
                        
                                <img src="web/img/stu.png" alt="...">
                           </div> -->
                           <p><a href="../student/stulogin.php" class="page-scroll btn btn-danger btn-xl hvr-float-shadow"> STUDENT Login </a></p>
                        </div>
                     </div>
                     
                      <div class="col-md-3 col-xs-12">     
        
                            <!-- <div class="hidden-md hidden-lg">
                            <img src="web/img/clg.png" class="img-responsive img-thumbnail" style="width:60%;">
                                    <p><a href="../admin" class="page-scroll btn btn-danger btn-lg hvr-float-shadow" style="color:white;padding:10px; width: 280px;"> College/University <br> Login </a></p>
                            </div>  -->
                        <div class="">     
                           <!-- <div class="thumbnail">
                               <div class="caption">
                                   <div class="project-name text-faded" style="color:white;">
                                        <h3 style="margin-top: 35%;">College/University</h3>
                                    </div>
                                   
                                </div> 
                                <img src="web/img/clg.png" alt="...">
                            </div> -->
                            <p><a href="../admin/login.php" class="page-scroll btn btn-danger btn-xl hvr-float-shadow"> University Login </a></p>
                           </div>
                     </div>
                     
                      <div class="col-md-3 col-xs-12">     
        
                            <!-- <div class="hidden-md hidden-lg">
                                
                                <img src="web/img/company.png" class="img-responsive img-thumbnail" style="width:60%;">
                                <p> <a href="../company" class="page-scroll btn btn-danger btn-lg hvr-float-shadow" style="color:white;padding:10px; width: 280px;"> Company Login </a></p>
                            </div>  -->
                        <div class="">     
                           <!-- <div class="thumbnail">
                               <div class="caption">
                                   <div class="project-name text-faded" style="color:white;">
                                        <h3 style="margin-top: 35%;">Company Login</h3>
                                    </div>
                                    
                                </div> 
                                <img src="web/img/company.png" alt="...">
                            </div> -->
                            <p><a href="../company/login.php" class="page-scroll btn btn-danger btn-xl hvr-float-shadow"> Company Login </a></p>
                           </div>
                     </div>
                </div>
                
            </div>
        </div>
    </section>

    
          <!--   <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Free Download at Start Bootstrap!</h2>
                <a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Download Now!</a>
            </div>
        </div>
    </aside> -->
    
<!--    <aside class="bg-dark" id="portfolio" style="min-height:90%;background-image: url(web/img/bg.png);color:white;">
        <div class="container text-center">
            <div class="call-to-action">
                <h2 style="margin-top:40px;font-size:50px;">Coming Soon...!!</h2>
               <a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Download Now!</a>
            </div>
        </div>
    </aside>-->
   
    
    
    
<section id="partners" style="background-image: url(web/img/bg.png);color:white;">
        <div class="container">
            <div class="row" style="margin-top:-26px;">
                <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                    <h2 class="section-heading">Our Partners </h2>
                    <hr class="light">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 text-center">
                    <div style="border:2px solid black;border-radius:15px;height:100%;"><br>
                      <i class="fa fa-4x fa-university text-primary01 sr-icons" style="color: white  !important;"></i>  
                    <h3>College / University</h3>
                       
<marquee direction="up" scrolldelay=200 style="margin-left:20px;" height="300px" onmouseover="this.stop();" onmouseout="this.start();">

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Acharya Tulsi National College Of Commerce, Shimoga
<br> <img src="web/partners/acharya-tulsi-national-college.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i>  Lal Bahadur Arts, Science & S.B.Solabanna Shetty Commerce College , sagara, shimoga
<br> <img src="web/partners/lbsbs.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Sri Venkateshwara College of Engineering, Bangalore
<br> <img src="web/partners/svce.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Rao Bahadur Y Mahabaleswarappa Engineering College
<br> <img src="web/partners/rbyme.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Rajarajeshwari College of Engineering  Bangalore
<br> <img src="web/partners/rrce.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> ACS College of Engineering
<br> <img src="web/partners/acs_bangalore.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> St. Philomena's College, Mysore
<br> <img src="web/partners/stphilos.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Maharaja Institute of Technology, Mysore
<br> <img src="web/partners/mit.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Mysore College of Engineering and Management
<br> <img src="web/partners/mycem.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> TTL college of Business Management, Mysore
<br> <img src="web/partners/ttl.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Amruta Institute of Engineering and Management Sciences
<br> <img src="web/partners/aiems.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>


<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> JSS Academy Of Technical Education
<br> <img src="web/partners/jssate.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Surana College
<br> <img src="web/partners/surana.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Jyothy Institute of Technology
<br> <img src="web/partners/jit.jpg" class="comp_patners" style="height:75px;width: 26% !important;">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> City Engineering College
<br> <img src="web/partners/city_ec.jpg" class="comp_patners">
</p>

<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> SJB Institute of Technology
<br> <img src="web/partners/sjbit.jpg" class="comp_patners">
</p>
                         
<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> Atria Institute of Technology
<br> <img src="web/partners/atria.jpg" class="comp_patners">
</p>
                         
<p><i class="fa fa-fw fa-university" style="color: white  !important;"></i> S R S Institution
<br> <img src="web/partners/clg_1.png" class="comp_patners">
</p>
             
</marquee>
                    </div>

                <a href="singupclg.html" class="btn btn-info hvr-float-shadow" style="float: right;margin-top: 4%;">
                    More Info <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="col-xs-12 hidden-md hidden-lg text-center">&nbsp;</div>
                <div class="col-lg-6 col-md-6 col-xs-12 text-center">
                    <div style="border:2px solid black;border-radius:15px;height:100%;"><br>
                        <i class="fa fa-building-o fa-4x text-primary01 sr-icons" style="color: white  !important;"></i>
                        <h3>Companies</h3>
                             <marquee direction="up" scrolldelay=200 style="margin-left:20px;" height="300px" onmouseover="this.stop();" onmouseout="this.start();">
                            <p> <i class="fa fa-fw fa-building-o" style="color: white  !important;"></i> Dhamaka Store
                                    <br> <img src="web/partners/pat_1.png" class="comp_patners">
                            </p>

                            <p> <i class="fa fa-fw fa-building-o" style="color: white  !important;"></i> Ruptara Trans
                                    <br> <img src="web/partners/pat_2.jpg" class="comp_patners">
                            </p>
                            </marquee>
                        </div>
                    </div>
                </div>


                <div class="row">
                  

                </div>    
            </div>
        </div>
    </section>

    
    <section id="contact">
        <div class="container">
            <div class="row" style="margin-top:-26px;">
                <div class="col-lg-4 col-xs-12 hidden-xs">
                    <center><img src="web/img/full_logo.jpg" style="border-radius:2px;width:220px;" class="img-responsive"></center>
                </div>
                <div class="col-lg-8 col-xs-12">
                    <div class="col-lg-8 col-lg-offset-3 text-center">
                        <h2 class="section-heading">Let's Get In Touch!</h2>
                        <hr class="primary">
                        <!--<p></p>-->
                    </div>
                    <div class="col-lg-12 text-center">
                        <form class="form-horizontal" id="form_data" role="form" method="post" action="#">
                           <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Email :</label>
                            <div class="col-sm-10 col-xs-12">
                              <input type="email" id="form" name="form" placeholder="Your Email ID" class="form-control" required="required">
                            </div>
                          </div>
                          
                                                                      
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Subject :</label>
                            <div class="col-sm-10 col-xs-12">
                              <input type="text" id="subject" name="subject" placeholder="Subject" class="form-control" required="required">
                            </div>
                          </div>
                          
                           <div class="form-group">
                               <label class="col-sm-2 control-label" for="textinput">Message :</label>
                                <div class="col-sm-10 col-xs-12">
                                   <textarea rows="6" cols="30" placeholder="Message" class="form-control" id="txtEditor" name="txtEditor" required="required"></textarea>
                                </div>
                                
                           </div>
                        
                        <div id="cs" class="col-lg-8 col-lg-offset-3">
                            <!-- <button type="reset" class="btn btn-info">Refresh</button> -->
                            <!--<input type="reset" class="btn btn-warning" value="Reset" >-->
                            <button type="button" onclick="get_data();" class="btn btn-danger btn-l  hvr-float-shadow">Send <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </div>
                        <br><br>
                                                
                        <div class="alert alert-success col-lg-8 col-lg-offset-3" role="alert" id="mail_sent" style="display:none;">
                          <strong>Mail Sent !</strong> Successfully..
                        </div>
                        
                        <div class="alert alert-danger col-lg-8 col-lg-offset-3" role="alert" id="err_field" style="display:none;">
                          <strong>Error !</strong> Fields are mandatory !!..
                        </div>
                                                 
                        </div>
                        
                         </form>
                         
                        
                    </div>
                </div>  
                <div class="row">
                    <div class="col-lg-12"> 
                        <hr style="border-color: #191514;border-width: 2px; max-width: 100%;">
                        <div class="col-lg-2 col-xs-6 text-center">
                                <center>
                                <!--<img src="web/img/secure.png" style="border-radius:2px;width:130px;" class="img-responsive">-->
                                    <script language="JavaScript" type="text/javascript">
                                    TrustLogo("http://www.uplace.in/web/img/secure.png", "CL1", "none");
                                    </script>
                                    <a  href="https://www.positivessl.com/" id="comodoTL">Positive SSL</a>
                                </center>
                        </div>
                        <div class="col-lg-2 col-xs-6 col-sm-6 hidden-lg  text-center">
                            <center><img src="web/img/qr.png" style="border-radius:2px;width:100px;" class="img-responsive"></center>
                            uPLACE <br/><br/>
                        </div>
                        
                        <div class="col-lg-8 col-xs-12 text-center">
                        <br><br>
                            <p style="font-size:12px;">
                            Policies: <a href="t&c.html" style="color:blue;text-decoration:none;">Terms and conditions</a> 
                            |<a href="privacy_policy.html" style="color:blue;text-decoration:none;"> Privacy policy </a>  <br> Â© 2016-2017 uplace.in
                            </p>
                        <!-- <a href="privacy_policy.html" style="color:blue;text-decoration:none;"> Privacy Policy</a> | <a href="t&c.html" style="color:blue;text-decoration:none;">Terms & Conditions</a>.-->

                        </div>
                        
                        <div class="col-lg-2 col-xs-6 col-sm-6 hidden-xs hidden-sm hidden-md text-center">
                            <center><img src="web/img/qr.png" style="border-radius:2px;width:100px;" class="img-responsive"></center>
                            uPLACE 
                        </div>



                    </div>
                </div>

                <div class="row">
                            <div class="text-center">
<ul class="footer-social"style="margin-left: -40px;">
    <a href="https://www.facebook.com/uplacein-158683761297811/" target="_blank"><span class="hb hb-xs inv">
    <i class="fa fa-facebook"></i></span></a>
    <a href="https://plus.google.com/104671882387557326854" target="_blank"><span class="hb hb-xs inv">
    <i class="fa fa-google-plus"></i></span></a>
    <a href="https://twitter.com/uplaceIndia" target="_blank"><span class="hb hb-xs inv">
    <i class="fa fa-twitter"></i></span></a> 
    <a href="https://www.linkedin.com/company/uplace.in" target="_blank"><span class="hb hb-xs inv">
    <i class="fa fa-linkedin-square"></i></span></a>
    <a href="https://www.pinterest.com/uplaceindia/" target="_blank"><span class="hb hb-xs inv">
    <i class="fa fa-pinterest"></i></span></a>
</ul> 
                
          </div>

                </div>      
            </div>
        
    </section>

    <!-- jQuery -->
    <script src="web/vendor/jquery/jquery.min.js"></script>
        <script src="web/assets/js/hexagons.min.js"></script>   

    <!-- Bootstrap Core JavaScript -->
    <script src="web/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="web/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="web/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="web/js/creative.min.js"></script>

    <script>
    $( document ).ready(function() {

jssor_1_slider_init();
    <!-- #endregion Jssor Slider End -->
        //alert();
              /*  $.ajax({
            type:'POST',
            url:'web/php/uplace_notify.php',
            dataType: 'json',
            success:function(obj){
                debugger;
                //alert(obj);
                var notify_data="";
                for(var i=0;i<obj.data.length;i++){
                    notify_data+='<p class="text-muted"> <img src="web/img/list_icon.png" style="width:30px;">&nbsp;&nbsp;'
                    +obj.data[i].subject+'<br><span style="margin-left: 41px;font-weight: 200;">'+obj.data[i].message+'</span></p>';
                }   
                
                    $('#uplace_notification').html(notify_data);
                        
            }  
        });   */
    
       $("[rel='tooltip']").tooltip();    
        $('.thumbnail').hover(
            function(){
                $(this).find('.caption').slideDown(250); //.fadeIn(250)
            },
            function(){
                $(this).find('.caption').slideUp(250); //.fadeOut(205)
            }
        ); 
    });
    </script>
    

</body>

</html>
