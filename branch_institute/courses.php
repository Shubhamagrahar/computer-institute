<?php
include 'con.php';
include 'assets.php'; 

$query = mysqli_query($con, "SELECT  bread_img, button_bg_color, button_bg_color FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);
$color_data = mysqli_fetch_assoc($query);


$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback


$button_bg_color = $color_data['button_bg_color'] ?? '#000000';
$button_text_color = $color_data['button_text_color'] ?? '#ffffff';



if(isset($_GET['course_type_id'])){
    
    $course_type_id=VerifyData($_GET['course_type_id']);
    $sql_course_type=mysqli_query($con,"select * from course_type where id='$course_type_id' and status='SHOW'");
    if(mysqli_num_rows($sql_course_type)>0){
        $show_course_data=1;
        $course_type_details=mysqli_fetch_array($sql_course_type);
    }else{
        $show_course_data=2;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name ?> | Courses</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <style>
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
           /*background: #0c3259;*/
           border-bottom-left-radius: 10px;
           border-bottom-right-radius: 10px;
           width: 100%;
       }
       
       .img-cat {
           height: 270px !important; 
           width: 500px !important;
       }
       
        @media(max-width: 768px) {
           .modal-body {
               flex-direction: column;
           }
       }
       .bg-light {
           box-shadow: 0 0 15px rgb(0 0 0 / 82%);
           border-radius: 10px;
       }
       .content-box h5 {
           color: #ffffff;
       }
       .animated-heading {
           font-size: 2rem;
       }
       
   </style>
</head>

<body>
   
    <!-- Navbar Start -->
   <?php include 'header.php'; ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header"
         style="background: linear-gradient(rgba(24, 29, 56, 0.7), rgba(24, 29, 56, 0.7)), url('<?php echo $bread_img; ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Courses</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <!--<li class=""><a class="text-white" href="#">  About / </a></li>-->
                            <li class="breadcrumb-item text-white active" aria-current="page"> Courses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


  
    
<?php
// $query = "SELECT * FROM course_details WHERE status = 'OPEN'";
// $result = mysqli_query($con, $query);

if (isset($course_type_id)) {
    // If course_type_id is set, filter courses by it
    $query = "SELECT * FROM course_details WHERE status = 'OPEN' AND course_type_id = '$course_type_id'";
} else {
    // Otherwise, show all open courses
    $query = "SELECT * FROM course_details WHERE status = 'OPEN'";
}
$result = mysqli_query($con, $query);


?>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3 ">Courses</h6>
                <h1 class="mb-5 animated-heading"><?php echo $course_type_details['name'] ; ?></h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden ">
                            <img class="img-fluid course-img" src="<?= $row['img'] ?>" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-2">
                                <!--<a href="" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;" data-toggle="modal"  data-target="#courseModal<?= $row['id'] ?>">Read More</a>-->
                                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;" data-bs-toggle="modal" data-bs-target="#courseModal<?= $row['id'] ?>">Read More</a>
                                <a href="registration?id=<?= $row['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                            </div>
                        </div>
                        <div class="text-center p-3 pb-0 content-box btn btn-primary">
                            <h5 class="mb-0" style="color: <?php echo $button_text_color; ?>;">Fees</h5>
                            <span style="text-decoration: line-through; font-weight: 500; margin-right: 5px; color: <?php echo $button_text_color; ?>;">
                                Rs. <?= number_format($row['max_fee'], 2); ?>/-
                            </span>
                            <span style="color: <?php echo $button_text_color; ?>; font-weight: bold;">
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
                                </button>
                            </div>

                            <div class="modal-body d-flex">
                                <div class="col-12 col-md-5 mb-3 mb-md-0 text-center details">
                                    <img src="<?= $row['img'] ?>" alt="<?= $row['name'] ?>" class="img-fluid rounded" style="position: sticky; top: 0; ">
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


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5 animated-heading">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
       
                 <?php
             $section=2;
             if($section==2){
             ?>
              <?php
                $i="0";
                $Data_wow_delay_time="0";
      $sql=mysqli_query($con,"select * from course_type where id!='$course_type_id' and status='SHOW'");
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
                            <div class="position-relative overflow-hidden" style="background-color: black;box-shadow: 0 0 15px rgb(0 0 0 / 82%); border-radius: 8px;">
                            <img class="img-fluid img-cat" style="opacity: 0.7;" width="500" height="331" src="<?php echo $web_link.$row['img'];?>" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-2">
                                <p style="color:white;font-size: 21px;"><?php echo $row['name'];?></p>
                            </div>
                        </div>
                        </a>
                     
                    </div>
                </div>
              
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
        

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>