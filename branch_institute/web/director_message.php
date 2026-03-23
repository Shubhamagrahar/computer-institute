<?php 
include 'con.php';
include 'asset.php';


$web_director_message=mysqli_fetch_array(mysqli_query($con,"select * from web_director_message where id='1'"));
if($web_director_message['status']=="HIDE"){
    echo '<script>alert("Details not found");window.location.assign("index");</script>'; 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Director Message | <?php echo $brand_name; ?></title>
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
    .dir_img{
        width:250px;
        height:300px;
        /*margin-left: 125px;*/
        border:1px solid black;
    }
    .btn2 {
    background-color: #0d6efd;
    color: white;
    border-color: #faebd700;
    border-radius: 4px;
}
.btn2:hover {
  background-color: #4CAF50;
  color: white;
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
                    <h1 class="display-3 text-white animated slideInDown">Director Message</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                           
                            <li class="breadcrumb-item text-white active" aria-current="page">Director Message</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


  
    
  <div class="card-body ">
                <div class="row" style="">
                  <div class="col-md-1"  align="center">
                    
                     
                  </div>  
                  <div class="col-md-3"  align="">
                   
                    <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="<?php echo $web_link.$web_director_message['photo']; ?>" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn2 mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn2 mx-1" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn2 mx-1" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div style="padding-left: 5px;padding-right: 5px; ">
                          <p style="font-family: cursive;font-style: italic; color: orange; margin-top: 40px;text-align: justify;">&ldquo;<?php echo $web_director_message['slogan']; ?>&rdquo;</p>  
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0"><?php echo $web_director_message['name']; ?></h5>
                            <small><?php echo $web_director_message['qualification']; ?></small>
                        </div>
                    </div>
                </div>
                  </div>
                     <div class="col-md-7" data-wow-delay="0.6s">
                    <h3>Message</h3>
                   <p><?php echo $web_director_message['message']; ?></p>

                    </div>
                  
                 
                  <div class="col-md-1"  align="center">
                  </div>
                   
                </div>
               
                </div> 
    

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