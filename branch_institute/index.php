<?php
include 'con.php';
include 'assets.php';
$update_visiter_count=mysqli_query($con,"update `website_data` SET `visiter_count`='$visitor_counts'");

// Fetch header background and text color
$query = mysqli_query($con, "SELECT  button_bg_color, button_text_color  FROM website_data LIMIT 1");
$color_data = mysqli_fetch_assoc($query);

$button_bg_color = $color_data['button_bg_color'] ?? '#000000';
$button_text_color = $color_data['button_text_color'] ?? '#ffffff';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name?> | Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    

    
    <?php include 'head.php'; ?>
    
    
    <style>
    
      
        .h-80 {
            height: 750px;
        }
        .course-imgs {
          width: 360px !important;
          height: 240px !important;
          margin-top: 50px;
          
    }
    .c-name {
        margin-right: 53px !important;
        width: 170px;
    }
    /*.heading-section h2 {*/
    /*    font-size: 40px;*/
    /*    font-weight: bold;*/
    /*    text-transform: uppercase;*/
    /*    text-align: center;*/
    /*    background: linear-gradient(45deg, #167ce9, #054972);*/
    /*    -webkit-background-clip: text;*/
    /*    -webkit-text-fill-color: transparent;*/
    /*    text-shadow: 3px 3px 5px rgb(23 98 173 / 57%);*/
    /*}*/
    .latest {
        width: 120%;
        background-color: #030961 !important;
    }
    @media(max-width: 768px) {
        .latest {
            width: 100%;
        }
        .recent {
            width: 100% !important;
            margin-left: 0 !important;
        }
    }
    .p-5 {
        padding: 1rem !important;
    }
    .section-titles {
        font-size: 22px;
        font-weight: bolder;
        color: #ffffff;
        margin-bottom: 0px;
    }
    .recent {
        width: 60%;
        margin-left: 170px;
        background-color: #030961 !important;
    }
    .mt-20 {
        margin-top: 20px;
    }
    .mb-20 {
        margin-bottom: 20px;
    }
    .course-img {
           width: 408px;
           height: 262px;
           border-top-left-radius: 10px;
          border-top-right-radius: 10px;
       }
       .content-box {
           height: 150px;
           border: 1px solid #0c3259;
           /*background: linear-gradient(45deg, #a1c7ee, #00000000);*/
           background: #0c3259;
           border-bottom-left-radius: 10px;
           border-bottom-right-radius: 10px;
            width: 100%;
       }
       .content-box h5 {
           color: #ffffff;
           font-family: auto;
           margin-top: 5px;
           padding-bottom: 5px;
       }
       .service-item img{
           /*width: 230px;*/
           width: 100%;
           padding-bottom: 30px;
       }
       hr {
           opacity: 1 !important;
           color: white;
       }
       .panel-body {
           background-color: #ddebf8;
       }
       .bg-cover {
           background: url('img/background/announcement-bg.png');
           background-size: 100% 100%; 
           background-repeat: no-repeat;
           background-position: center;
       }
       .img-cat {
           height: 270px !important; 
           width: 500px !important;
       }
       .button-section {
           background: url('img/background/technology_background.jpg');
           background-position: center center;
           background-size: cover;
            /* opacity: 0.26; */
           transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
       }
       .box-container {
           max-width: 100% !important;
           padding-left: 0;
           padding-right: 0;
           padding-bottom: 0 !important;
       }
       .button-section {
           max-width: 100% !important;
       }
       .header-carousel .owl-nav .owl-prev:hover, .header-carousel .owl-nav .owl-next:hover {
           background-color: <?php echo $button_bg_color; ?> !important;
           color: <?php echo $button_text_color; ?>;
           border: <?php echo $button_bg_color; ?> !important;
       }
       .about p {
           text-align: justify;
       }
       @media(max-width: 768px) {
           .modal-body {
               flex-direction: column;
           }
           .p-3 {
               padding: 0 !important;
           }
       }
       
       .bg-light {
           box-shadow: 0 0 15px rgb(0 0 0 / 82%);
           border-radius: 10px;
       }
       .owl-carousel .owl-stage {
           margin-bottom: 20px;
       }
       


    </style>
</head>

<body>
   
    <?php include 'header.php';?>
    <!-- Navbar End -->

    <!--Popup start-->
        <?php include 'popup_notice.php'; ?>
    <!--popup End-->

    <!-- Carousel Start -->
    
    
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <?php
        $query = "SELECT * FROM web_top_slider_area ORDER BY id DESC";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid h-80" src="<?php echo htmlspecialchars($row['img']); ?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgb(24 29 56 / 27%);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <?php if (!empty($row['con_hading'])) { ?>
                                    <h1 class="display-5 text-white animated slideInDown none"><?php echo $row['con_hading']; ?></h1>
                                <?php } ?>
                                <?php if (!empty($row['short_about'])) { ?>
                                    <div class="fs-5 text-white mb-4 pb-2 none">
                                        <?php echo $row['short_about']; ?>
                                    </div>
                                <?php } ?>


                                <?php if (!empty($row['btn1_name']) && !empty($row['btn1_link'])) { ?>
                                    <a href="<?php echo htmlspecialchars($row['btn1_link']); ?>" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft"><?php echo htmlspecialchars($row['btn1_name']); ?></a>
                                <?php } ?>
                                <?php if (!empty($row['btn2_name']) && !empty($row['btn2_link'])) { ?>
                                    <a href="<?php echo htmlspecialchars($row['btn2_link']); ?>" class="btn btn-light py-md-3 px-md-5 animated slideInRight"><?php echo htmlspecialchars($row['btn2_name']); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

    
    
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5 mt-300 box-container">
        <div class="container button-section">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-3">
                            
                            <img src="img/background/courses.png">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-3">
                            
                            <img src="img/background/book_img.png">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-3">
                            
                            <img src="img/background/teacher_img.png">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-3">
                            
                            <img src="img/background/certificate_img.png">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    
    
    
<?php

$query = "SELECT intro_des, intro_img1 FROM website_data LIMIT 1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$word_limit = 150;
$intro_des = $row['intro_des'];  
$words = explode(' ', $intro_des);

if (count($words) > $word_limit) {
    $limited_text = implode(' ', array_slice($words, 0, $word_limit)) . '...';
} else {
    $limited_text = $intro_des;
}
?>

    
    
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 290px; ">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 " src="<?php echo $web_link . htmlspecialchars($row['intro_img1']); ?>" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp mt-80 about" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start color pe-3">About Us</h6>
                    <h1 class="mb-4 ">Welcome to <?php echo $brand_name?></h1>
                    <p class="mb-4"><?php echo $limited_text; ?></p>
                    
                    <a class="btn btn-primary py-3 px-5 mt-2" href="about">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    
    <div class="heading-section mt-50">
        <h2 class="animated-heading">Highlights</h2>
    </div>
    
    <section class="section bg-cover" style=" opacity: 0.8; margin-top:50px;" >
        
        
  
  <div class="container">
    <div class="row row-2">

      <div class="col-lg-6 col-sm-4 mt-20 mb-20">
        <div class="bg-white latest p-5">
          <h2 class="section-titles">LATEST ANNOUNCEMENT</h2>
          <hr>
          <div class="panel-body" >
              
              
              <div class="tab-content">
    <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:400px; padding: 10px;">
        <p style="color: #000000;font-style: italic;margin-top:7px;font-size: 18px;font-weight: 800;"><i style="color: #e7b59f;" class="fa fa-hands-praying"></i>Welcome to <?php echo $brand_name;?></p>
        <?php

        $query = "SELECT * FROM web_news WHERE status = 'OPEN' ORDER BY date DESC";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $description = $row['des'];
                $new = $row['new'];

                $newIcon = ($new === 'YES') ? '<img src="img/m-new.gif">' : '';

                echo '
                <div style="display: flex; align-items:center; gap:5px;">
                <p align="justify" style="color: black;  margin-top:7px;">
                    <img src="img/pointer.png" style="height: 30px; width: 30px;" alt="">&nbsp;' . 
                    $description . ' ' . $newIcon . '
                </p>
                </div>';
                
            }
        } else {
            echo '<p align="center" style="color: red;">No announcements available.</p>';
        }
        ?>
    </marquee>
</div>

              <div>
            
            </div>
                
          </div>
        </div>
      </div>


      <div class="col-lg-6 col-sm-8 mt mt-20 mb-20">
    <div class="bg-white recent p-5">
        <h2 class="section-titles">RECENTLY JOINED STUDENTS</h2>
        <hr>
        <div class="panel-body recently">
            <div class="tab-content">
                <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:400px; padding: 10px;">
                    <ul class="lst">
        <?php
        $sql_student=mysqli_query($con,"select * from course_book where status='RUN'order by start_date desc LIMIT 10");
        while($row=mysqli_fetch_array($sql_student)){
            $course_book_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]' and type='3'"));
             $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
           $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$course_book_user[branch_id]'"));
        ?>
                        <!--<hr style="border: 2px solid rgb(30 30 75); margin-left: -35px;">-->
                        <center style="margin-bottom: 12px;">
                            <img class="alignnone size-full wp-image-4843" src="<?php echo $web_link.$course_book_user['photo']; ?>" alt="" style="height:110px;width:120px; margin-left: -50px;">
                            <br>
                            <strong style="margin-left: -50px;">Name: <?php echo $course_book_user['name']; ?></strong><br>
                            <strong style="margin-left: -50px; padding-left: 5px; padding-right: 5px;">Course: <?php echo $course_details['name']; ?> </strong><br>
                            <strong style="margin-left: -50px;">Branch : <?php echo $branch_details['name']; ?></strong>
                        </center>
                        <hr style="border: 2px solid rgb(30 30 75); margin-left: -35px;">
                        <?php } ?>
                    </ul>
                </marquee>
            </div>
        </div>
    </div>
</div>
    </div>
  </div>
</section>


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center color px-3">Categories</h6>
                <h1 class="mb-5 animated-heading">Courses Categories</h1>
            </div>
            
             <div class="row g-4 justify-content-center">
        <?php
        $section=1;
        if($section==2){
        ?>
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
                            <img class="img-fluid" src="<?php echo $web_link.$row['img']; ?>" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-2">
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
           <?php } ?>     
                 <?php
             $section=2;
             if($section==2){
             ?>
              <?php
                $i="0";
                $Data_wow_delay_time="0";
      $sql=mysqli_query($con,"select * from course_type where status='SHOW'");
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
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s" style="">
                    <div class="course-item bg-light">
                        <a href="courses?course_type_id=<?php echo $row['id'];?>">
                            <div class="position-relative overflow-hidden" style="background-color: black;box-shadow: 0 0 15px rgb(0 0 0 / 82%); border-radius: 8px">
                            <img class="img-fluid img-cat" style="opacity: 0.7;" width="500" height="331" src="<?php echo $web_link.$row['img'];?>" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <p style="color:white;font-size: 21px;"><?php echo $row['name'];?></p>
                                <!--<a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>-->
                                <!--<a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>-->
                            </div>
                        </div>
                        </a>
                     
                    </div>
                </div>
              
                <?php } ?>
                <?php } ?>
            <!--<div>-->
            <!--    <a class="btn btn-primary py-3 px-5 mt-2" href="courses">All Course</a>-->
            <!--</div>-->
            </div>
           
        </div>
    </div>
    <!-- Categories Start -->


    <!-- Courses Start -->
    
<?php
$query = "SELECT * FROM course_details WHERE first_page_status = 'OPEN'";
$result = mysqli_query($con, $query);
?>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5 animated-heading">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                
               
                <div class="col-lg-4 col-md-6 wow fadeInUp course-container" data-wow-delay="0.5s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden ">
                            <img class="img-fluid course-img" src="<?= $row['img'] ?>" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-2">
                                <!--<a href="" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;" data-toggle="modal"  data-target="#courseModal<?= $row['id'] ?>">Read More</a>-->
                                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;" data-bs-toggle="modal" data-bs-target="#courseModal<?= $row['id'] ?>">Read More</a>
                                <a href="registration?id=<?= $row['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                            </div>
                        </div>
                        <div class="text-center pb-0 content-box btn btn-primary">
                            <h5 class="mb-0" style="color: <?php echo $button_text_color; ?>;">Fees</h5>
                            <span style="text-decoration: line-through; font-weight: 500; margin-right: 5px; color: <?php echo $button_text_color; ?>;">
                                Rs. <?= number_format($row['max_fee'], 2); ?>/-
                            </span>
                            <span style="font-weight: bold; color: <?php echo $button_text_color; ?>;">
                                Rs: <?= number_format($row['fee'], 2); ?>/-
                            </span>
                           
                            <h5 class="mb-4" style="color: <?php echo $button_text_color; ?>;"><?= $row['name'] ?></h5>
                        </div>
                    </div>
                </div>
                
                
                <div class="modal fade" id="courseModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel<?= $row['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="courseModalLabel<?= $row['id'] ?>"><?= $row['name'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <!--<span aria-hidden="true">&times;</span>-->
                                </button>
                            </div>

                            <div class="modal-body d-flex">
                                <div class="col-12 col-md-5 mb-3 mb-md-0 text-center details">
                                    <img src="<?= $row['img'] ?>" alt="<?= $row['name'] ?>" class="img-fluid rounded" style="position: sticky; top: 0;">
                                    <br>
                                    
                                    <p><strong>Duration:</strong> <?= $row['duration'] ?> Months</p>
                                  
                                    
                                    <strong>Total Fees: </strong>
                                    <br>
                                        <span style="text-decoration: line-through; color: grey; font-weight: 500; margin-right: 10px;">
                                            Rs. <?= number_format($row['max_fee'], 2); ?>/-
                                        </span>
                                        <span style="color: black; font-weight: bold;">
                                            Rs: <?= number_format($row['fee'], 2); ?>/-
                                        </span>
                                    <br>
                                    <a href="registration?id=<?= $row['id']; ?>" class="btn btn-success mt-3">Apply Now</a>
                                </div>

                                <div class="col-12 col-md-7 text-left" style="max-height: 400px; overflow-y: auto; padding: 15px; text-align: justify;">
                                    <!--<h3><?= $row['name'] ?></h3>-->
                                    
                                    <p><?= htmlspecialchars_decode($row['des']) ?></p>
                                    

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
                
                
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Testimonial Start -->
    
    
<?php

$query = "SELECT img, des, name FROM testimonial";
$result = mysqli_query($con, $query);

?>

    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center color px-3">Testimonial</h6>
                <h1 class="mb-5 animated-heading">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="testimonial-item text-center">
                        <img class="border rounded-circle p-2 mx-auto mb-3" src="<?php echo htmlspecialchars($row['img']); ?>" style="width: 80px; height: 80px;">
                        <h5 class="mb-0"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p>Student</p>
                        <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0"><?php echo nl2br(htmlspecialchars($row['des'])); ?></p>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
        
    <?php
    include 'footer.php';
    ?>
    
    
    <!-- Footer End -->




<script>
$(document).ready(function() {
    $('.btn[data-toggle="modal"]').on('click', function() {
        var target = $(this).data('target');
        $(target).modal('show');
    });
});
</script>



     <!--JavaScript Libraries -->
    <script src="code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

     <!--Template Javascript -->
    <script src="js/main.js"></script>


<script src="code.tidio.co_443/lfibhuhttajjfpucjteoaijtfqf9lwa8.js" async></script>

</body>
</html>