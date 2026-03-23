<?php 
include 'con.php';
include 'asset.php';

function redirectTohttps() {
if(empty($_SERVER['HTTPS'])) {
$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo '<script>window.location.assign(".$redirect.")</script>';
//header("Location:$redirect");
}}

redirectTohttps();

if(isset($_POST['submit'])){
$name=VerifyData($_POST['name']);
$mobile=VerifyData($_POST['mobile']);
$email=VerifyData($_POST['email']);
$message=VerifyData($_POST['message']);

if(!$name=="" && !$mobile=="" && !$email=="" && !$message==""){
 $check=mysqli_num_rows(mysqli_query($con,"select * from query_data where mobile='$mobile' and status='OPEN'"));
 if(!$check>0){
     $check=mysqli_num_rows(mysqli_query($con,"select * from query_data where email='$email' and status='OPEN'"));
 if(!$check>0){
     $insert_data=mysqli_query($con,"insert into `query_data`(`name`, `mobile`, `email`, `query`, `query_date`) values('$name', '$mobile', '$email', '$message', '$c_date')"); 
    if($insert_data){
        echo '<script>alert("Message Submited Sucessfully Done .");window.location.assign("index");</script>'; 
    }else{
        echo '<script>alert("Server Error 101.");window.location.assign("index");</script>'; 
    }
 }else{
    echo '<script>alert("Your previous query already under process.");window.location.assign("index");</script>'; 
 }  
 }else{
    echo '<script>alert("Your previous query already under process.");window.location.assign("index");</script>'; 
 }  
}else{
  echo '<script>alert("Please fill All data.");window.location.assign("index");</script>'; 
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo $brand_fav_logo; ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
        <style>
    
        #particles-js {
	position: absolute;
	width: 100%;
	height: 530px;
	z-index: 6;
}
.rgcsm-accordion-style1 .card .card-header {
    padding: 0;
    border: 0;
    margin-bottom: 10px;
    background: transparent;
}
.rgcsm-accordion-style1 .card .card-header .acdn-title {
    background-color: rgba(240, 240, 240, 0.8);
    position: relative;
    margin-bottom: 0;
    font-size: 18px;
    height: 50px;
    line-height: 50px;
    padding: 0 20px;
    cursor: pointer;
    font-weight: 500;
    letter-spacing: 0.2px;
    -webkit-transition: 0.2s background-color ease-in-out;
    transition: 0.2s background-color ease-in-out;
}
.rgcsm-accordion-style1 .card .card-header .acdn-title:not(.collapsed) {
    background-color: #40b0dd;
    color: #ffffff;
}
.rgcsm-accordion-style1 .card .card-header .acdn-title:after {
    position: absolute;
    font-family: FontAwesome;
    content: "\f0da";
    right: 20px;
    transition: all 0.3s ease 0s;
}
.rgcsm-accordion-style1 .card .card-header .acdn-title:not(.collapsed):after {
    transform: rotate(90deg);
    color: #ffffff;
}
.button-section{
    background-color: #FFB40000;
    background-image: url(img/technology_background.jpg);
    background-position: center center;
    background-size: cover;
    /*opacity: 0.26;*/
    transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
}
.btnn1{
    font-family: "Hind", Sans-serif;
    font-size: 15px;
    font-weight: 600;
    background-color: #E97A00;
    color:white;
    border-radius: 7px 7px 7px 7px;
    padding: 15px 25px 15px 25px;
}
.btnn2{
   font-family: "Hind", Sans-serif;
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    background-color: #14A14C;
    color:white;
    border-radius: 7px 7px 7px 7px;
    padding: 15px 25px 15px 25px;
}
.btnn3{
   font-family: "Hind", Sans-serif;
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    background-color: #710AD2;
    color:white;
    border-radius: 7px 7px 7px 7px;
    padding: 15px 25px 15px 25px;
}
.btnn4{
  font-family: "Hind", Sans-serif;
    font-size: 15px;
    font-weight: 600;
    background-color: #0087FF;
    color:white;
    border-radius: 7px 7px 7px 7px;
    padding: 15px 25px 15px 25px;
}
@media only screen and (max-width: 700px) {
  #particles-js {
	position: absolute;
	width: 100%;
	height: 75%;
	z-index: 6;
}
.rgcsm-accordion-style1 .card .card-header .acdn-title {
    background-color: rgba(240, 240, 240, 0.8);
    position: relative;
    margin-bottom: 0;
    font-size: 15px;
    height: 50px;
    line-height: 50px;
    padding: 0 20px;
    cursor: pointer;
    font-weight: 500;
    letter-spacing: 0.2px;
    -webkit-transition: 0.2s background-color ease-in-out;
    transition: 0.2s background-color ease-in-out;
}
}
@media only screen and (max-width: 320px) {
      #particles-js {
	position: absolute;
	width: 100%;
	height: 25%;
	z-index: 6;
}
}
@media only screen and (max-width: 360px) {
      #particles-js {
	position: absolute;
	width: 100%;
	height: 25%;
	z-index: 6;
}
}
@media only screen and (max-width: 425px) {
      #particles-js {
	position: absolute;
	width: 100%;
	height: 25%;
	z-index: 6;
}
}
.call-to-action {
    position: relative;
    padding: 44px 0px;
    background: #996666;
    /*background-attachment: fixed;*/
    background-position: center center;
    background-repeat: no-repeat;
    background-image: radial-gradient(#b76f6f, #c7b6b6);
}

.panel {
    margin-bottom: 10px;
    background-color: #fff;
    border: 1px solid #eee;
}
.panel-body {
    padding: 5px;
}
.tab-content>.active {
    display: block;
}
ul.lst li{
  line-height: 20px;
    margin-bottom: 10px;
    list-style: none;
    /*border-bottom: 1px solid #000;*/
    padding-bottom: 10px;
}
    </style>
</head>

<body>
   
<!--loader and navbar start-->
<?php include 'header.php'; ?>
<!--loader and navbar end-->

<!--Popup start-->
<?php include 'popup_notice.php'; ?>
<!--popup End-->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
     <!--<div id="particles-js"></div>   -->
        <div class="owl-carousel header-carousel position-relative">
            <?php 
    $sql_slider=mysqli_query($con,"select * from web_top_slider_area  order by id desc");
    while($row=mysqli_fetch_array($sql_slider)){
    ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid img_sliders" src="<?php echo $web_link.$row['img']; ?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center area_slider" style="background: rgb(24 29 56 / 11%);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8" style="margin-top: 95px;">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown slider_content">Welcome To <?php echo $brand_name; ?></h5>
                                <h1 class="display-3 text-white animated slideInDown slider_content"><?php echo $row['con_hading'] ?></h1>
                                <p class="fs-5 text-white mb-4 pb-2 slider_content" style="color: #68f345 !important;"><?php echo $row['content'] ?></p>
                                <!--<a href="about" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>-->
                                <!--<a href="registration" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Register Now</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <?php } ?>
             <?php
             $section=1;
             if($section==2){
             ?>
            <!--<div class="owl-carousel-item position-relative">-->
            <!--    <img class="img-fluid" src="img/carousel-2.jpg" alt="">-->
            <!--    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">-->
            <!--        <div class="container">-->
            <!--            <div class="row justify-content-start">-->
            <!--                <div class="col-sm-10 col-lg-8">-->
            <!--                    <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses</h5>-->
            <!--                    <h1 class="display-3 text-white animated slideInDown">Get Educated Online From Your Home</h1>-->
            <!--                    <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>-->
            <!--                    <a href="about" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>-->
            <!--                    <a href="registration" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Register Now</a>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <?php } ?>
        </div>
    </div>
    <!-- Carousel End -->

 <?php
$section=2;
if($section==2){
?>
    <!-- Service Start -->
    <div class="container-xxl py-5 button-section" style="margin-top: -35px;">
        <div class="container">
            <div class="row g-4" align="center">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                  <div>
                      <a href="login" class=""><button class="btnn1">CENTER LOGIN</button></a>
                  </div>  
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                   <div>
                      <a href="login" class=""><button class="btnn2">STUDENT LOGIN</button></a>
                  </div>  
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                   <div>
                      <a href="branch_apply" class=""><button class="btnn3">APPLY FOR FRANCHISE</button></a>
                  </div>  
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                   <div>
                      <a href="certificate" class=""><button class="btnn4">CERTIFICATE VERIFICATION</button></a>
                  </div>  
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
<?php } ?>

    <!--Notification start-->

<div class="call-to-action" >
<div class="container">
        <div class="row">
                 <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                                              <div class="panel panel-default">
                            <div style="background:#2b176e; color:#FFFFFF; padding:10px;">
                            <strong>LATEST ANNOUNCEMENT</strong></a>
                            </div>
                            <div class="panel-body" style="background-color:#fffdf1;">
                            <div class="tab-content">

                        <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:300px;">
                         <p   style="color: #214427;font-style: italic;margin-top:7px;font-size: 18px;font-weight: 800;"><i style="color: #e7b59f;" class="fa fa-hands-praying"></i>Welcome to <?php echo $web_details['name']; ?>.</p>
                                                        <?php 
                                        $sql_news=mysqli_query($con,"select * from web_news where status='OPEN' order by id desc");
                                        while($row=mysqli_fetch_array($sql_news)){
                                            ?>
                                            <p  align="justify" style="color: #214427;font-style: italic;margin-top:7px;"><i style="color: #e7b59f;" class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php echo $row['des'] ?> 
                                            <?php
                            if($row['new']=="YES"){
                                ?>
                                            <img src="img/m-new.gif">
                                            <?php } ?>
                                            </p>
                                            <?php
                                        }
                                        ?>
                            </marquee>

                </div>
                </div>
                </div>
                </div>
                 <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    

<div class="panel panel-default">
<div style="background:#2b176e; color:#FFFFFF; padding:10px;">
<strong>RECENTLY JOIN STUDENT</strong></a>
</div>
<div class="panel-body" style="background-color:#fffdf1;">
<div class="tab-content">

<marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:300px;">
<ul class="lst">
<!------------     -------------->

<?php
$sql_student=mysqli_query($con,"select * from course_book where status='RUN'order by start_date desc LIMIT 10");
while($row=mysqli_fetch_array($sql_student)){
    $course_book_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]' and type='3'"));
     $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
   $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$course_book_user[branch_id]'"));
?>
<li style="border-bottom: 1px dotted #000;"><center>
<img class="alignnone size-full wp-image-4843" src="<?php echo $web_link.$course_book_user['photo']; ?>" alt="" style="height:110px;width:120px;">
<br/>
<strong>Name : <?php echo $course_book_user['name']; ?></strong><br/>
<strong>Course : <?php echo $course_details['name']; ?></strong><br/>
<strong>Branch : <?php echo $branch_details['name']; ?></strong>

</center>
</li>
<!------------     -------------->
<?php } ?>
</ul>
</marquee>

</div>
</div>
</div>

                </div>

	</div>
</div> 
</div>

<!--Notification End-->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="<?php echo $web_link.$web_details['intro_img1']; ?>" alt="" style="object-fit: cover;max-width: 535px; max-height: 430px;border-radius: 10px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <!--<h1 class="mb-4">Welcome to </h1>-->
                    <h1 class="mb-4">Welcome to <?php echo $web_details['name']; ?></h1>
                     <p class="mb-4">
                        <?php 
						            	     $content="$web_details[intro_des]";
						            	     $contant_explode=explode(" ",$content);
                            				      $sr=0;
                            				      $print_content="";
                            				       foreach($contant_explode as $i=>$key){
                            				           $print_content .=" ".$key;
                            				           $sr +=1;
                            				           if($sr==75){
                            				               break;
                            				           }
                            				       }
						            	    if(count($contant_explode)>75){
						            	        echo $print_content."...";
						            	    }else{
						            	    echo $print_content;
						            	    }
						            	    ?>
                        
                    </p>
                    
                    <div class="">
				                    		<a class="clr pd4_16 boxedBtn" href="about">Read More <i class="fa fa-arrow-right"></i></a>
				                    	</div>
                    <?php
             $section=1;
             if($section==2){
             ?>
                    <!--<div class="row gy-2 gx-4 mb-4">-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>-->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

 <?php
$section=1;
if($section==2){
?>
    <!-- Categories Start -->
    <!--<div class="container-xxl py-5 category">-->
    <!--    <div class="container">-->
    <!--        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">-->
    <!--            <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>-->
    <!--            <h1 class="mb-5">Courses Categories</h1>-->
    <!--        </div>-->
    <!--        <div class="row g-3">-->
    <!--            <div class="col-lg-7 col-md-6">-->
    <!--                <div class="row g-3">-->
    <!--                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">-->
    <!--                        <a class="position-relative d-block overflow-hidden" href="">-->
    <!--                            <img class="img-fluid" src="img/cat-1.jpg" alt="">-->
    <!--                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">-->
    <!--                                <h5 class="m-0">Web Design</h5>-->
    <!--                                <small class="text-primary">49 Courses</small>-->
    <!--                            </div>-->
    <!--                        </a>-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">-->
    <!--                        <a class="position-relative d-block overflow-hidden" href="">-->
    <!--                            <img class="img-fluid" src="img/cat-2.jpg" alt="">-->
    <!--                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">-->
    <!--                                <h5 class="m-0">Graphic Design</h5>-->
    <!--                                <small class="text-primary">49 Courses</small>-->
    <!--                            </div>-->
    <!--                        </a>-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">-->
    <!--                        <a class="position-relative d-block overflow-hidden" href="">-->
    <!--                            <img class="img-fluid" src="img/cat-3.jpg" alt="">-->
    <!--                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">-->
    <!--                                <h5 class="m-0">Video Editing</h5>-->
    <!--                                <small class="text-primary">49 Courses</small>-->
    <!--                            </div>-->
    <!--                        </a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">-->
    <!--                <a class="position-relative d-block h-100 overflow-hidden" href="">-->
    <!--                    <img class="img-fluid position-absolute w-100 h-100" src="img/cat-4.jpg" alt="" style="object-fit: cover;">-->
    <!--                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin:  1px;">-->
    <!--                        <h5 class="m-0">Online Marketing</h5>-->
    <!--                        <small class="text-primary">49 Courses</small>-->
    <!--                    </div>-->
    <!--                </a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Categories Start -->
<?php } ?>

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php
                $i="0";
                $Data_wow_delay_time="0";
      $sql=mysqli_query($con,"select * from course_details where status='OPEN' and first_page_status='OPEN'");
      while($row=mysqli_fetch_array($sql)){
          $i +=1;
	        if($i==1){
	            $Data_wow_delay_time=".1s";
	        }
	        if($i==2){
	            $Data_wow_delay_time=".3s";
	        }
	        if($i==3){
	            $Data_wow_delay_time=".5s";
	        }
      ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $Data_wow_delay_time ; ?>">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" style="height: 200px; width: 355px;" src="<?php echo $web_link.$row['img']; ?>" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h4 class="mb-4"><?php echo $row['name']; ?></h4>
                            <div align="center"><h5>Course Code : <?php echo $row['course_code']; ?></h5></div>
                            <div align="center"><h5>Course Duration : <?php echo $row['duration']; ?> Month</h5></div>
                        
                        <div align="center" style="color: black;"><h5>Total Fees :</h5></div>
                            <div class="price-footer" >
							    <div align="center"><h5 style="color: black; font-family: serif;font-size: 19px;font-weight: 600;">Rs.<del><?php echo $row['max_fee']; ?></del>/-</h5>
							    <!--<div align="center"><h5 style="color: black; font-family: serif;font-size: 19px;font-weight: 600;">Rs.<del><?php echo $row['fee'] + $row['fee'] /100*15; ?>.00</del>/-</h5>-->
							    <h3 style="color: #5d9913; font-family: serif;">Rs: <?php echo $row['fee']; ?>/-</h3></div>
								<div class="col-md-12" id="des_div<?php echo $row['id'];?>" style="display:none; text-align: left;">
					     <!--<p><strong>Description: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>-->
					     <p ><?php echo $row['des']; ?></p>
					     <div align="center">
					     <button  type="submit" name="hide_des" onclick="hide_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')" class="btn btn-info">Hide Details</button> 
					     </div>
					     
					   </div>
					   <div class="col-md-12" align="center" id="des_btn<?php echo $row['id'];?>" >
					    <button type="submit" name="show_des" class="btn btn-primary" onclick="show_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')">View Details</button> 
					 </div>
					 <br>
						<div align="center"><a style="text-decoration: none;" href="registration?ids=<?php echo $row['id']; ?>" class="btn btn-success">Enroll Now</a></div>
						</div>
                            <br>
                        </div>
                        
                    </div>
                </div>
                <?php } ?> 
                
                 <?php
             $section=1;
             if($section==2){
             ?>
                <!--<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">-->
                <!--    <div class="course-item bg-light">-->
                <!--        <div class="position-relative overflow-hidden">-->
                <!--            <img class="img-fluid" src="img/course-2.jpg" alt="">-->
                <!--            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">-->
                <!--                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>-->
                <!--                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="text-center p-4 pb-0">-->
                <!--            <h3 class="mb-0">$149.00</h3>-->
                <!--            <div class="mb-3">-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small>(123)</small>-->
                <!--            </div>-->
                <!--            <h5 class="mb-4">Web Design & Development Course for Beginners</h5>-->
                <!--        </div>-->
                <!--        <div class="d-flex border-top">-->
                <!--            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>-->
                <!--            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>-->
                <!--            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">-->
                <!--    <div class="course-item bg-light">-->
                <!--        <div class="position-relative overflow-hidden">-->
                <!--            <img class="img-fluid" src="img/course-3.jpg" alt="">-->
                <!--            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">-->
                <!--                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>-->
                <!--                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="text-center p-4 pb-0">-->
                <!--            <h3 class="mb-0">$149.00</h3>-->
                <!--            <div class="mb-3">-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small class="fa fa-star text-primary"></small>-->
                <!--                <small>(123)</small>-->
                <!--            </div>-->
                <!--            <h5 class="mb-4">Web Design & Development Course for Beginners</h5>-->
                <!--        </div>-->
                <!--        <div class="d-flex border-top">-->
                <!--            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>-->
                <!--            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>-->
                <!--            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <?php } ?>
            <div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="courses">All Course</a>
            </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->

 <?php
$section=1;
if($section==2){
?>
    <!-- Team Start -->
    <!--<div class="container-xxl py-5">-->
    <!--    <div class="container">-->
    <!--        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">-->
    <!--            <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>-->
    <!--            <h1 class="mb-5">Expert Instructors</h1>-->
    <!--        </div>-->
    <!--        <div class="row g-4">-->
    <!--            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">-->
    <!--                <div class="team-item bg-light">-->
    <!--                    <div class="overflow-hidden">-->
    <!--                        <img class="img-fluid" src="img/team-1.jpg" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">-->
    <!--                        <div class="bg-light d-flex justify-content-center pt-2 px-1">-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-center p-4">-->
    <!--                        <h5 class="mb-0">Instructor Name</h5>-->
    <!--                        <small>Designation</small>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">-->
    <!--                <div class="team-item bg-light">-->
    <!--                    <div class="overflow-hidden">-->
    <!--                        <img class="img-fluid" src="img/team-2.jpg" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">-->
    <!--                        <div class="bg-light d-flex justify-content-center pt-2 px-1">-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-center p-4">-->
    <!--                        <h5 class="mb-0">Instructor Name</h5>-->
    <!--                        <small>Designation</small>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">-->
    <!--                <div class="team-item bg-light">-->
    <!--                    <div class="overflow-hidden">-->
    <!--                        <img class="img-fluid" src="img/team-3.jpg" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">-->
    <!--                        <div class="bg-light d-flex justify-content-center pt-2 px-1">-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-center p-4">-->
    <!--                        <h5 class="mb-0">Instructor Name</h5>-->
    <!--                        <small>Designation</small>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">-->
    <!--                <div class="team-item bg-light">-->
    <!--                    <div class="overflow-hidden">-->
    <!--                        <img class="img-fluid" src="img/team-4.jpg" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">-->
    <!--                        <div class="bg-light d-flex justify-content-center pt-2 px-1">-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>-->
    <!--                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-center p-4">-->
    <!--                        <h5 class="mb-0">Instructor Name</h5>-->
    <!--                        <small>Designation</small>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Team End -->
<?php } ?>

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                 <?php 
                $sql_testimonial=mysqli_query($con,"select * from testimonial order by id desc");
                while($row=mysqli_fetch_array($sql_testimonial)){
                ?> 
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="<?php echo $web_link.$row['img']; ?>" style="width: 80px; height: 80px;">
                    <h5 class="mb-0"><?php echo $row['name']; ?></h5>
                    <br>
                    <!--<p>Profession</p>-->
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0"><?php echo $row['des']; ?></p>
                    </div>
                </div>
                 <?php } ?>
                  <?php
             $section=1;
             if($section==2){
             ?>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
<?php
$section=1;
if($section==2){
?>
 <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!--<h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>-->
                <!--<h1 class="mb-5">Contact For Any Query</h1>-->
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <!--<h5>Payment QR Code</h5>-->
                    <p class="mb-4" style="font-size: 18px;color: black;font-weight: 700;text-transform: uppercase;">Payment QR Code</p>
                    <!--<p class="mb-4">Just use the contact form below for any questions and inquiries.</p>-->
                    <!--<div class="d-flex align-items-center mb-3">-->
                       
                       
                    <!--</div>-->
                  <div >
                      <img width="50%" src="img/qr-1024x996.jpeg">
                  </div>
                  <p>UPI ID: fdashjkfds<br>
                  ACCOUNT DETAILS:fdsfd
                  
                  </p>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                       src="<?php echo $add_map; ?>"

                        frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>

                <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56995.91603448977!2d83.01673506953125!3d26.768467100000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399125d9f1322e61%3A0x325a0917f7ab924e!2sNEW%20RAMA%20COMPUTER%20TECHNICAL%20DEGREE%20COLLEGE!5e0!3m2!1sen!2sin!4v1684904240535!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        -->
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form method="post">
                        <div class="" style="">
                            <p class="mb-4" style="font-size: 18px;color: black;font-weight: 700;text-transform: uppercase;">For any inquiries fill the form</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                     <input type="text" class="form-control" required="required" size="30" value="" id="name" name="name">
                                    <label for="name">Your Name:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" required="required" aria-required="true" value="" id="mobile" name="mobile">
                                    <label for="mobile">Mobile Number:</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" required="required" aria-required="true" value="" id="email" name="email">
                                    <label for="subject">Email Id:</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea required="required" class="form-control" aria-required="true" rows="8" cols="45" id="message" name="message"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" name="submit">Send Message</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->        
<?php } ?>
    <!-- Footer Start -->
   <?php include 'footer.php'; ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/particles.min.js"></script>
    <script src="js/particle-app.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function show_des_function(val,val1){
            document.getElementById(val).style.display="block";
            document.getElementById(val1).style.display="none";
        }
        function hide_des_function(val,val1){
            document.getElementById(val).style.display="none";
            document.getElementById(val1).style.display="block";
        }
    </script>

</body>

</html>