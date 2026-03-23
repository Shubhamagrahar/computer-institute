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
    <title><?php echo $brand_name?> | Mission-Vision </title>
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
    
    
    <div class="container-fluid bg-primary py-5 mb-5 page-header"
         style="background: linear-gradient(rgba(24, 29, 56, 0.7), rgba(24, 29, 56, 0.7)), url('<?php echo $bread_img; ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Mission-Vision</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  About / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> Mission-Vision</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->

    <!--Mission/Vission-->
    
        <?php
            $query = "SELECT vision, mission FROM website_data LIMIT 1";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
        ?>
            
    
     <div class="mission-container">
        <!-- Mission Section -->
        <div class="mission-section mission">
            <div class="text">
                <h2 class="animated-heading">Our Mission</h2>
                <p><?php echo htmlspecialchars_decode($row['mission']); ?></p>
                
            </div>
            <div class="image">
                <img src="img/our_mission.jpg" alt="Mission Image">
            </div>
        </div>

        <!-- Vision Section -->
        <div class="mission-section vision">
            <div class="image">
                <img src="img/our_vission.jpg" alt="Vision Image">
            </div>
            <div class="text">
                <h2 class="animated-heading">Our Vision</h2>
                <p><?php echo htmlspecialchars_decode($row['vision']); ?></p>
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