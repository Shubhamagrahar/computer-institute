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
    <title><?php echo $brand_name ?> | Student Verification</title>
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
        
        
        
/* Student Details Section */
.student-details {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
  width: 100%;
}
.student-details h2{
  text-align:center;
  margin-bottom: 1.5rem;
  font-size: 2rem;
  font-weight: bold;
  background: linear-gradient(to right, #1a1a37, #2a8f61);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  position: relative;
  text-transform: uppercase;
}
.student-details h2::after{
content: '';
  display: block;
  width: 60px;
  height: 4px;
  background: #1a1a37;
  margin: 0.5rem auto 0;
  border-radius: 2px;
}

.student-info-container {
  display: flex;
  flex-direction: column;
  margin-left: 8rem;
  margin-bottom: 40px;
  justify-content: center;
  align-items: center;
  width: 100%;
  max-width: 800px;
  border: 1px solid #ccc;
  padding: 15px;
  border-radius: 8px;
  background: #f9f9f9;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  flex-wrap: wrap;
}

.student-image img {
  width: 170px;
  height: 170px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 10px;
  /*margin-right: 20px;*/
  /*margin-left:35px;*/
  border: 2px solid #0c7eaf;
}

.student-details-table {
  flex: 2;
  width: 100%;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 16px;
  margin-top: 10px;
}

table th, table td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

table th {
  font-size: 15px;
  text-align: center;
  background-color: #04046e;
  font-weight: 400;
  color: #ffffff;
  padding: 10px 10px;
}

table td {
  background-color: white;
  color: black;
  text-align:center !important;
  /*padding:10px 65px;*/
}

.student-details-table td{
  padding: 10px 65px;
  font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
  .student-info-container {
      margin-left: 0;
      flex-direction: column;
      align-items: center;
      text-align: center;
  }
  table th, table td{
      font-size: 12px;
      /*padding:  17px 47px;*/
  }

  .student-image img {
      margin-bottom: 15px;
  }

  .student-details-table {
      width: 100%;
      display: grid;
      justify-content: center;
  }
}

@media (max-width: 480px) {
  
  table th, table td {
      font-size: 15px;
      padding: 10px !important;
  }

  .student-image img {
      width: 120px;
      height: 120px;
  }
}

        @media (max-width: 600px) {
            .form_container {
                padding: 20px;
                width: 85%;
            }
            h2 {
                font-size: 22px;
            }
            .verify-btn{
                width: 100%;
            }
        }
        
        
        .certificate {
    display: flex;
    justify-content: center;
    padding: 40px;
}

.certificate-wrapper {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 40px;
    transition: all 0.3s ease;
}
@media ( max-width: 768px){
    .certificate-wrapper{
        flex-direction: column;
    }
    .form_container {
        width: 300px !important;
    }
    .student-details {
        width: 300px !important;
    }
}

.form_container {
    width: 400px ;
    max-width: 100% !important;
    margin-top: 100px !important;
}

.student-details {
    display: none;
    width: 500px;
}
.certificate.show-details .certificate-wrapper {
    justify-content: flex-start;
}
.page-title-section {
            background: linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)), url(images/backgrounds/image_top_background2.jpg);
            background-size: cover;
        }
        
        .animated-heading {
            font-size: 1.9rem !important;
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
                    <h1 class="display-3 text-white animated slideInDown">Student Verification</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Student / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Student Verification</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-xxxl py-5 certificate">
        <div class="certificate-wrapper">
        
         <div class="form_container">
        <h2 class="animated-heading">Student Verification</h2>
        <form method="post">
            <div class="form-group">
                <label for="student">Registration No.: <span style="color: red;">*</span></label>
                <input type="text" id="reg_no" name="reg_no" placeholder="Enter Registration number">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth: <span style="color: red;">*</span></label>
                <input type="date" id="dob" name="dob">
            </div>
            <button type="submit" name="submit" id="verify-btn" onclick="data_verify(event)" class=" verify-btn btn btn-primary py-4 px-lg-5 d-lg-block">Verify</button>
        </form>
    </div>
    
    
    <!-- Student Details -->
     
        </div>
    </div>
    <!-- Team End -->
        

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function data_verify(e) {
      e.preventDefault(); 
    var regNo = document.getElementById("reg_no").value.trim();
    var dob = document.getElementById("dob").value;

    if (regNo === "" ) {
      Swal.fire({
        icon: 'warning',
        title: 'Empty Field',
        text: 'Please enter a Registration number.',
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

   
   window.location.href = "verify-student?reg_no=" + encodeURIComponent(regNo) + "&dob=" + encodeURIComponent(dob);

  }
</script>




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