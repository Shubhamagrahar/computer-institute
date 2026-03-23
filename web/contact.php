<?php 
include'con.php'; 
include'asset.php';

$c_date=date("Y-m-d H:i:s");

if(isset($_POST['submit'])){
$name=VerifyData($_POST['name']);
$mobile=VerifyData($_POST['mobile']);
$email=VerifyData($_POST['email']);
$message=VerifyData($_POST['message']);

if(!$name=="" and !$mobile=="" and !$email=="" and !$message==""){
 $check=mysqli_num_rows(mysqli_query($con,"select * from query_data where mobile='$mobile' and status='OPEN'"));
 if(!$check>0){
     $check=mysqli_num_rows(mysqli_query($con,"select * from query_data where email='$email' and status='OPEN'"));
 if(!$check>0){
     $insert_data=mysqli_query($con,"insert into `query_data`(`name`, `mobile`, `email`, `query`, `query_date`) values('$name', '$mobile', '$email', '$message', '$c_date')"); 
    if($insert_data){
        echo '<script>alert("Message Submited Sucessfully Done .");window.location.assign("contact");</script>'; 
    }else{
        echo '<script>alert("Server Error 101.");window.location.assign("contact");</script>'; 
    }
 }else{
    echo '<script>alert("Your previous query already under process.");window.location.assign("contact");</script>'; 
 }  
 }else{
    echo '<script>alert("Your previous query already under process.");window.location.assign("contact");</script>'; 
 }  
}else{
  echo '<script>alert("Please fill All data.");window.location.assign("contact");</script>'; 
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact | <?php echo $brand_name; ?></title>
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
                    <h1 class="display-3 text-white animated slideInDown">Contact</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                          <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="mb-5">Contact For Any Query</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Get In Touch</h5>
                    <p class="mb-4">Just use the contact form below for any questions and inquiries.</p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Address</h5>
                            <p class="mb-0"><?php echo $brand_add ; ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Mobile</h5>
                            <p class="mb-0"><a href="tel:<?php echo $brand_mob ; ?>" style="color:#52565B;"><?php echo $brand_mob ; ?></a></p>
                             <?php
                    if(!$brand_mob2==""){
                        ?>
                            <p class="mb-0"><a href="tel:<?php echo $brand_mob2 ; ?>" style="color:#52565B;"><?php echo $brand_mob2 ; ?></a></p>
                           
                            <?php }
                         
                         if(!$brand_mob3==""){
                        ?>
                            <p class="mb-0"><a href="tel:<?php echo $brand_mob3 ; ?>" style="color:#52565B;"><?php echo $brand_mob3 ; ?></a></p>
                           
                            <?php }
                            
                            ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0"><a href="mailto:<?php echo $brand_email ; ?>" style="color:#52565B;"><?php echo $brand_email ; ?></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                       src="<?php echo $add_map; ?>"

                        frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>

                <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56995.91603448977!2d83.01673506953125!3d26.768467100000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399125d9f1322e61%3A0x325a0917f7ab924e!2sNEW%20RAMA%20COMPUTER%20TECHNICAL%20DEGREE%20COLLEGE!5e0!3m2!1sen!2sin!4v1684904240535!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        -->
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                     <input type="text" class="form-control" required="required" size="30" value="" id="name" name="name">
                                    <label for="name">Your Name:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" required="required" aria-required="true" value="" id="mobile" name="mobile">
                                    <label for="mobile">Mobile Number:</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" required="required" aria-required="true" value="" id="email" name="email">
                                    <label for="subject">Email Id:</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea required="required" class="form-control" aria-required="true" rows="8" cols="45" id="message" name="message"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" name="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


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