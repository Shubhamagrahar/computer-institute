<?php 
include 'con.php';
include 'asset.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Courses | <?php echo $brand_name; ?></title>
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

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>


<!--loader and navbar start-->
<?php include 'header.php'; ?>
<!--loader and navbar end-->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Courses</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                           
                            <li class="breadcrumb-item text-white active" aria-current="page">Courses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">All Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php 
                $i="0";
      $sql=mysqli_query($con,"select * from course_details where status='OPEN'");
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
	        if($i==4){
	            $Data_wow_delay_time=".7s";
	        }
	        if($i==5){
	            $Data_wow_delay_time=".9s";
	        }
	        if($i==6){
	            $Data_wow_delay_time=".11s";
	        }
	        if($i==7){
	            $Data_wow_delay_time=".13s";
	        }
	        if($i==8){
	            $Data_wow_delay_time=".15s";
	        }
	        if($i==9){
	            $Data_wow_delay_time=".17s";
	        }
	        if($i==10){
	            $Data_wow_delay_time=".19s";
	        }
	        if($i==11){
	            $Data_wow_delay_time=".21s";
	        }
	        if($i==12){
	            $Data_wow_delay_time=".23s";
	        }
	        if($i==13){
	            $Data_wow_delay_time=".25s";
	        }
	        if($i==14){
	            $Data_wow_delay_time=".27s";
	        }
	        if($i==15){
	            $Data_wow_delay_time=".29s";
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
            </div>
        </div>
    </div>
    <!-- Courses End -->



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