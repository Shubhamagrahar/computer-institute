<?php
include 'con.php';
include 'assets.php';


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name?> | About </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <style>
       p {
           text-align: justify;
       }
   </style>
</head>

<body>


    <!-- Navbar Start -->
   <?php include 'header.php'; ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 page-header"
         style="background: linear-gradient(rgba(24, 29, 56, 0.7), rgba(24, 29, 56, 0.7)), url('<?php echo $bread_img; ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  About / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  

    <!-- Header End -->


    <!-- Service Start -->
    <!--<div class="container-xxl py-5">-->
    <!--    <div class="container">-->
    <!--        <div class="row g-4">-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-graduation-cap color mb-4"></i>-->
    <!--                        <h5 class="mb-3">Skilled Instructors</h5>-->
    <!--                        <p>Imparting value based quality education to students. Creating leadership qualities with futuristic vision.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-globe color mb-4"></i>-->
    <!--                        <h5 class="mb-3">Classes</h5>-->
    <!--                        <p>Provides both online and offline class facilities as per the student's concern for better learning and exploring.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-home color mb-4"></i>-->
    <!--                        <h5 class="mb-3">Home Projects</h5>-->
    <!--                        <p><?php echo $brand_name?> delivers a diverse range of learning and talent development programs to millions of individuals.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">-->
    <!--                <div class="service-item text-center pt-3">-->
    <!--                    <div class="p-4">-->
    <!--                        <i class="fa fa-3x fa-book-open color mb-4"></i>-->
    <!--                        <h5 class="mb-3">Book Library</h5>-->
    <!--                        <p><?php echo $brand_name?> is a group of technical and professional Institute. A complete vocational training shall be received by the students.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Service End -->


    <!-- About Start -->
    
    
<?php

$query = "SELECT intro_img1, intro_des FROM website_data LIMIT 1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>
        
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 160px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 " src="<?php echo $web_link.$row['intro_img1']; ?>" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start color pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to <?php echo $brand_name?></h1>
                    <p class="mb-4"><?php echo ($row['intro_des']); ?></p>
                   
                    <!--<a class="btn btn-primary py-3 px-5 mt-2" href="courses">Read More</a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


   
        

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