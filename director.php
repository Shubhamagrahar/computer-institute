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
    <title><?php echo $brand_name?> | Director Message </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <style>
       .text-muted {
           margin: 20px 120px;
       }
       .director-box {
           background-color: #fffff0 !important;
            border: 1px solid lightgray;
            /*box-shadow: 1px 0px 4px 5px 0.5 black;*/
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
       }
       .rounded {
           border-radius: 20px !important;
       }
       .director {
           border: 1px solid lightgray;
           padding: 0px;
           /*box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.25);*/
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
           width: 20rem;

       }
        small {
         color: black;  
          font-size: 16px;
       }
      
    .director-message p {
        color: black;
        text-align: justify;
    }
       
       .director-box h4 {
           color: black !important;
       }
       @media(max-width: 780px) {
           .text-muted {
               margin: 0;
               margin-top: 20px !important;
           }
           .director-message h1 {
               margin-top: 60px;
               text-align: center;
           }
           .director {
               width: 17rem;
               margin-left: 10px;
               margin-right: 10px;
           }
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
                    <h1 class="display-3 text-white animated slideInDown">Director Message</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  About / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> Director Message</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->

    
    <!--Director Message-->
    
    
<?php
$query = mysqli_query($con, "SELECT * FROM web_director_message WHERE id='1' AND status='SHOW'");
$data = mysqli_fetch_assoc($query);

// Assign fetched values

$photo = !empty($data['photo']) ? $data['photo'] : 'images/dummy-img.jpg';
$name = !empty($data['name']) ? $data['name'] : 'Director Name';
$qualification = !empty($data['qualification']) ? $data['qualification'] : 'Qualification';
$slogan = !empty($data['slogan']) ? $data['slogan'] : 'Default Slogan';
$message = !empty($data['message']) ? $data['message'] : 'Default Message';
?>

<?php
if($data['status'] == 'SHOW'){
?>
    <div class="container-xxl py-5">
            <div class="container" style="padding: 0;">
                <div class="bg-light rounded director-box">
                    <div class="row g-0">
                        <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                            <div class="position-relative h-100 text-center">
                                <!-- Image -->
                                <img class="img-fluid director rounded" src="<?php echo $photo; ?>" style="object-fit: contain;">
                                
                                <!-- Text below the image -->
                                <div class="mb-4">
                                    <p class="text-muted" style="text-align: center;">“<?php echo $slogan; ?>”</p>
                                    <h4><?php echo $name; ?></h4>
                                    <small><?php echo $qualification; ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100 d-flex flex-column justify-content-center p-4 director-message">
                                <h1 class="">Director Message</h1>
                                <p class="message"><?php echo htmlspecialchars_decode($message); ?>
                                </p>
        
                                <!--<div class="ms-3">-->
                                <!--    <h6 class="color mb-1">Jhon Doe</h6>-->
                                <!--    <medium>Thank You.</medium>-->
                                <!--</div>-->
                                <!-- <a class="btn btn-primary py-3 px-5" href="">Get Started Now<i class="fa fa-arrow-right ms-2"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>

    <!-- About Start -->
  
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