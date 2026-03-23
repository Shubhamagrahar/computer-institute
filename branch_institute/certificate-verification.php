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
    <title><?php echo $brand_name ?> | Certificate Verification</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        .container-xxxl{
            background: linear-gradient(135deg, #97b5c1, #ffffff);
       
        }    
        
        .form_container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
            margin: 0 auto;
        }
        
        

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #1e3c72;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
            border-color: #2a5298;
            box-shadow: 0 0 8px rgba(42, 82, 152, 0.4);
        }
        
        .verify-btn{
            margin: 0 auto;
        }
        

        @media (max-width: 600px) {
            .form_container {
                padding: 20px;
                width:85%;
            }
            h2 {
                font-size: 22px;
            }
            .verify-btn{
                width: 100%;
            }
        }
        
        .animated-heading {
            font-size: 2rem !important;
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
                    <h1 class="display-3 text-white animated slideInDown"> Certificate Verification</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Student / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> Certificate Verification</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-xxxl py-5">
        
         <div class="form_container">
        <h2 class="animated-heading">Certificate Verification</h2>
        <form>
            <div class="form-group">
                <label for="enrollment">Certificate No./S.N.: <span style="color: red;">*</span></label>
                <input type="text" id="certificate_no" name="certificate_no" placeholder="Enter Certificate number" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth: <span style="color: red;">*</span></label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <button type="submit" onclick='data_verify(event)' class=" verify-btn btn btn-primary py-4 px-lg-5 d-lg-block">Verify</button>
        </form>
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
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function data_verify(e) {
      e.preventDefault(); 
    var certificateNo = document.getElementById("certificate_no").value.trim();
    var dob = document.getElementById("dob").value;

    if (certificateNo === "" ) {
      Swal.fire({
        icon: 'warning',
        title: 'Empty Field',
        text: 'Please enter a Certificate number.',
        confirmButtonColor: '#3085d6'
      });
      return;
    }
    if (dob === "" ) {
      Swal.fire({
        icon: 'warning',
        title: 'Empty Field',
        text: 'Please enter a Date Of Birth number.',
        confirmButtonColor: '#3085d6'
      });
      return;
    }

   
   window.location.href = "verify?certificate_no=" + encodeURIComponent(certificateNo) + "&dob=" + encodeURIComponent(dob);

  }
</script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>