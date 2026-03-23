<?php 
include'con.php'; 
include'assets.php';


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback



$c_date=date("Y-m-d H:i:s");

if(isset($_POST['submit'])){
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$message=$_POST['message'];

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
    <title><?php echo $brand_name ?> Contact Us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <style>
       .gmap_canvas iframe {
           height: 500px;
       }
       .contents {
           border: 1px solid lightgray;
           border-radius: 15px;
           box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.25);
           padding: 15px;
       }
       .contact {
           gap: 70px;
       }
        @media(max-width: 780px) {
            .contact {
                gap: 10px;
            }
        }
        .blue {
            color: #0c3259 !important;
        }
        .bg-blue {
            background-color: #0c3259 !important;
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
                    <h1 class="display-3 text-white animated slideInDown">Contact</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <!--<li class=""><a class="text-white" href="#">  About / </a></li>-->
                            <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-xxl">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="mb-5 animated-heading">Contact For Any Query</h1>
            </div>
            <div class="row g-4 contact">
                <div class="col-lg-4 col-md-6 wow fadeInUp contents" data-wow-delay="0.1s">
                    <h5>Get In Touch</h5>
                    <p class="mb-4">Write us a mail to get in touch or visit our office:</p>
                    <?php  if($brand_add !== ""){   ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary bg-blue" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary blue">Address</h5>
                            <p class="mb-0"><?php echo $brand_add?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php  if($brand_add2 !== ""){   ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary bg-blue" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary blue">Address Line 2</h5>
                            <p class="mb-0"><?php echo $brand_add2?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary bg-blue" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary blue">Mobile</h5>
                            <?php if($brand_mob !== ""){ ?> <p class="mb-0"><a href="tel:<?php echo $brand_mob; ?>"><?php echo $brand_mob?></a><?php } ?> <?php if($brand_mob2 !== ""){ ?> <a href="tel:<?php echo $brand_mob2; ?>"><?php echo ' | ' .  $brand_mob2?></a></p><?php } ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary bg-blue" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary blue">Email</h5>
                            <?php if($brand_email !== ""){ ?><p class="mb-0"><a href="mailto:<?php echo $brand_email; ?>"><?php echo $brand_email?></a><?php } ?>
                            <?php if($brand_email2 !== ""){ ?><?php echo ' | '  ?><a href="mailto:<?php echo $brand_email2; ?>"><?php echo $brand_email2?></a></p><?php } ?>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="col-lg-7 mb-4 mb-lg-0 form_box contents wow fadeInUp" data-wow-delay="0.1s">
                    <form method="post">
                      <input type="text" class="form-control mb-3" id="name" name="name" required="" placeholder="Your Name">
                      <input type="email" class="form-control mb-3" id="email" name="email" required="" placeholder="Your Email">
                      <input type="number" class="form-control mb-3" id="mobile" name="mobile" required="" placeholder="Your Mobile Number">
                      <textarea id="message" name="message" class="form-control mb-3" required="" placeholder="Your Message"></textarea>
                      <button type="submit" name="submit" class="btn btn-primary">SEND MESSAGE</button>
                    </form>
                  </div>
                
                <!--<div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">-->
                <!--    <form>-->
                <!--        <div class="row g-3">-->
                <!--            <div class="col-12">-->
                <!--                <a href="Enquiry" class="btn btn-primary w-100 py-3" type="submit">Click Here For Further Enquiry</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </form>-->
                <!--</div>-->
            </div>
            
            <div class="mapouter" style="margin-top: 50px;">
                    <div class="gmap_canvas">
                    <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="100%"  src="<?php echo $add_map?>"></iframe>
                    <!--<a href="https://embed-googlemap.com/">embed code google maps</a>-->
                    </div>
                    <!--<style>.mapouter{position:relative;text-align:right;width:785px;height:415px;}.gmap_canvas {overflow:hidden;background:none!important;height:415px;}.gmap_iframe {width:785px!important;height:415px!important;}</style>-->
                </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php  include 'footer.php'; ?>




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