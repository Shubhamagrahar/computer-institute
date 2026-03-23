<?php 
include 'con.php';
include 'asset.php';
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
     <div id="particles-js"></div>   
        <div class="owl-carousel header-carousel position-relative">
            <?php 
    $sql_slider=mysqli_query($con,"select * from web_top_slider_area  order by id desc");
    while($row=mysqli_fetch_array($sql_slider)){
    ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" style="height:530px;" src="<?php echo $web_link.$row['img']; ?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgb(24 29 56 / 11%);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8" style="margin-top: 95px;">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Welcome To <?php echo $brand_name; ?></h5>
                                <h1 class="display-3 text-white animated slideInDown"><?php echo $row['con_hading'] ?></h1>
                                <p class="fs-5 text-white mb-4 pb-2" style="color: #68f345 !important;"><?php echo $row['content'] ?></p>
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


    <!--Notification start-->

    <div class="container">
        <div class="row">
<div id="details" class="accordion">
		<div class="area-1">
		</div><!-- end of area-1 on same line and no space between comments to eliminate margin white space --><div class="area-2">
            
            <!-- Accordion -->
            <div class="accordion-container" id="accordionOne" >
                <h2 style="text-align:center;" class="mb-4">LATEST ANNOUNCEMENT</h2>
              <div style="margin-top: 20px;border: 2px solid #e5e5e5;padding: 10px;border-radius: 8px;background-color: #fbfbfb;">
                            <marquee height="200px" direction="up" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()">
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
            
               </div> <!-- end of accordion-container -->
            <!-- end of accordion -->

		</div> <!-- end of area-2 -->
    </div> <!-- end of accordion -->
    <!-- end of details 1 -->
   </div> 
    </div> 

<!--Notification End-->
 <?php
$section=1;
if($section==2){
?>
    <!-- Service Start -->
    <!--<div class="container-xxl py-5">-->
    <!--    <div class="container">-->
    <!--        <div class="row g-4">-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>-->
    <!--                        <h5 class="mb-3">Skilled Instructors</h5>-->
    <!--                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-globe text-primary mb-4"></i>-->
    <!--                        <h5 class="mb-3">Online Classes</h5>-->
    <!--                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-home text-primary mb-4"></i>-->
    <!--                        <h5 class="mb-3">Home Projects</h5>-->
    <!--                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-book-open text-primary mb-4"></i>-->
    <!--                        <h5 class="mb-3">Book Library</h5>-->
    <!--                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Service End -->
<?php } ?>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="<?php echo $web_link.$web_details['intro_img1']; ?>" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <!--<h1 class="mb-4">Welcome to </h1>-->
                    <h1 class="mb-4">Welcome to <?php echo $web_details['name']; ?></h1>
                    <p class="mb-4"><?php echo $web_details['intro_des']; ?></p>
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
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="<?php echo $weblink.$row['img']; ?>" style="width: 80px; height: 80px;">
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