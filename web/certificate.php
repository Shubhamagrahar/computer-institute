<?php 
include'con.php'; 
include'asset.php';




// if(isset($_POST['submit'])){
//     $en_no=VerifyData($_POST['en_no']);
//     // $dob=VerifyData($_POST['dob']);
//     if(!$en_no==""){
//       $sql=mysqli_query($con,"select * from student_certificate where enrollment_no='$en_no'");
//       if(mysqli_num_rows($sql)==1){
//           $data_details=mysqli_fetch_array($sql);
//           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$data_details[course_id]'"));
           
//       }else{
//         echo '<script>alert("Please enter the correct certificate number.");window.location.assign("certificate");</script>';   
//       }
//     }else{
//         echo '<script>alert("Please fill all feilds.");window.location.assign("certificate");</script>';
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Certificate | <?php echo $brand_name; ?></title>
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
                    <h1 class="display-3 text-white animated slideInDown">Certificate</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Certificate</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Gallery Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!--<h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>-->
                <h1 class="section-title bg-white text-center text-primary px-3">Certificate</h1>
                <br><br>
            </div>
            
            <div class="col-md-12">
                       <div class="contact-part">
                            <div  style="margin-bottom: 30px;" align="center">
                                <!--<img width="300px" style="margin-top: 5px;" src="<?php echo $brand_logo ; ?>" alt="Logo">-->
                                <h3 style="margin-top: 5px;">Verify Certificate</h3>
                                <!--<h4>Verify Certificate</h4>-->
                            </div>
                                <!--<form method="post" name="form_23">-->
                                    <div class="card-body ">
                                        <div class="row">
                                           <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <lable>Certificate No.</lable>
                                                <input type="text" required name="en_no" id="en_no" value="" class="form-control" placeholder="Enter certificate number.">
                                              <div align="center"><br>
                                        <button type="submit" name="submit"  onclick="data_verify(en_no.value)" class="btn btn-primary">Verify</button>
                                       
                                        </div>
                                           
                                            </div>
                                           
                                        </div>
                                        <br>
                                       
                                    </div>
                                    <!-- /.card-body -->
                                <!--</form>-->
                              
                        </div>
                        
                     </div>
                    
        </div>
    </div>
    <!-- Gallery End -->


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
        function data_verify(val){
            if(!val==""){
                window.open('verify_certificate?data_id='+val);
                $("#en_no").val("");
            }else{
                alert("Please Etner Certificate Number.");
            }
        }
    </script>
</body>

</html>