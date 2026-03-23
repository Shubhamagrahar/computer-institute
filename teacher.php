<?php
include 'con.php';
include 'assets.php';


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name ?> | Teacher Staff</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <style>
       small {
           font-size: 1rem;
           color: black;
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
                    <h1 class="display-3 text-white animated slideInDown">Teachers</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Staff / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Teachers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->
    
    


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Staff</h6>
                <h1 class="animated-heading">Teacher Staff</h1>
            </div>
            <div class="row g-4">
                <?php
        		    $sql_teacher=mysqli_query($con,"select * from web_teching_admin_staff where role='teacher'");
        		    while($row=mysqli_fetch_array($sql_teacher)){
        		   
        		 ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="<?php echo $web_link.$row['img']; ?>" alt="">
                        </div>
                        <div class="text-center p-4 teacher-content">
                            <h5 class="mb-0"><?php echo $row['name']; ?></h5>
                            <small><?php echo $row['designation']; ?></small>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
                
                
            </div>
        </div>
    </div>
    <!-- Team End -->
        

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