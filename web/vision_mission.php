<?php 
include 'con.php';
include 'asset.php';

if($web_details['v_m_status']=="HIDE"){
  echo '<script>alert("Page not found.");window.location.assign("index")</script>'; 
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vision & Mission | <?php echo $brand_name; ?></title>
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
    
    
    <style>
        .topbr1 {
    border-top: 2px solid #009933;
    font-size: 244%;
}
       .colps {
    background: #009933;
    font-size: 42%;
    color: white;
    /*padding: 19px;*/
    padding: 18px 9px 9px 9px;
    font-weight: 900;
} 
p {
    margin: 0 0 10px;
}
.owner-txt1 {
    /*width: auto;*/
    /*float: left;*/
    /*font: normal 16px/25px;*/
    /*color: #000;*/
    /*padding: 5px 15px 5px 5px;*/
    text-align: justify;
}
b {
    font-weight: 700;
}
    </style>
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
                    <h1 class="display-3 text-white animated slideInDown">Our Vision And Mission</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                           
                            <li class="breadcrumb-item text-white active" aria-current="page">Our Vision And Mission</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                
                  <?php 
				    if($web_details['v_m_status']=="SHOW"){
				    ?>
				    <div id="vision"></div>
                 <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3s" style="text-align: justify;">
                   
                    <h1 class="mb-4 topbr1">
                    <b class="mb-4 colps">OUR VISION</b>
                    </h1>
                    <p class="owner-txt1">&nbsp; &nbsp;<?php echo $web_details['vision']; ?></p>
                 </div>
                 <div class="col-lg-4 " data-wow-delay="0.3s">
                   
                    <img width="90%" src="logo_image/vision_mission2.png">
                 </div>
                  <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.6s" style="text-align: justify;">
                   
                    <h1 class="mb-4 topbr1">
                    <b class="mb-4 colps">OUR MISSION </b>
                    </h1>
                   <p class="owner-txt1">&nbsp; &nbsp; <?php echo $web_details['mission']; ?></p>
                 </div>
                 <?php } ?>
                 
            </div>
        </div>
    </div>
    <!-- About End -->



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
</body>

</html>