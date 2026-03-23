<?php 
include'con.php'; 
include'assets.php';
if (!empty($_GET['certificate_no']) && !empty($_GET['dob'])) {
    $certificate_no = $_GET['certificate_no'];
    $dob = $_GET['dob'];
    $details = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM student_certificate WHERE certificate_no = '$certificate_no' and dob='$dob'"));

    if (!$details) {
        echo "<script>
            alert('Please Enter Valid Certificate Number');
            window.location.href = './';
        </script>";
        exit;
    }

   
    
    $user = mysqli_fetch_array(mysqli_query($con, "select * from user where mobile='$details[mobile]' limit 1"));
    $branch = mysqli_fetch_array(mysqli_query($con, "select * from user where id='$user[branch_id]' limit 1"));
    $obt_marks = 0;
    $max_marks = 0;
    $subject_name = [];
   
    
} else {
    echo "<script>
        alert('Please enter a certificate number!');
        window.location.href = './';
    </script>";
    exit;
}

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
  /*margin-left: 8rem;*/
  margin-bottom: 40px;
  justify-content: center;
  align-items: center;
  width: 100%;
  /*max-width: 800px;*/
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
  background-color: #04046e !important;
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
    padding: 15px;
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
       
@media (max-width: 768px) {
    .student-details {
        width: 390px !important;
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
    
        <div class="col-md-9 mx-auto">
            
            <div class="student-details">
            
            <div class="student-info-container">
                <div class="info">
                    <img src="<?php echo $brand_logo; ?>" style="width:25%">
                   
                </div>
                <div class="student-image mt-4">
                    <img src="<?php echo $web_link.$user['photo']; ?>" alt="Student Image" id="student-image" />
                    <h3 style="text-align:center;"><?php echo $user['name']; ?></h3>
                </div>
                <div class="student-details-table">
                    <div id="paginated-tables">
 
                          <div class="page-table" style="display: block;">
                            <table class="table table-bordered">
                              <tr><td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px; color: #04046e;">Profile Information</td></tr>
                              <tr><th>Reg No:</th><td><?php echo $details['reg_no']; ?></td></tr>
                              <tr><th>Father Name:</th><td><?php echo $details['father_name']; ?></td></tr>
                              <tr><th>Date Of Birth:</th><td><?php echo date('d-M Y', strtotime($details['dob'])); ?></td></tr>
                              <tr><th>Address:</th><td><?php echo $user['full_add']; ?></td></tr>
                              <tr><th>Centre:</th><td><?php echo $branch['name']; ?>(<?php echo $branch['branch_code']; ?>)</td></tr>
                              
                            </table>
                          </div>
                        
                          <div class="page-table" style="display: none;">
                            <table class="table table-bordered">
                              <tr><td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px; color: #04046e;">Institute Information</td></tr>
                              <tr><th>Institute Name:</th><td><?php echo $brand_name;?></td></tr>
                              <tr><th>Institute Address:</th><td><?php echo $brand_add; ?></td></tr>
                            </table>
                          </div>
                        
                          <div class="page-table" style="display: none;">
                            <table class="table table-bordered">
                              <tr><td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px; color: #04046e;">Course Information</td></tr>
                              <?php
                              $course_book = mysqli_query($con, "select * from course_book where userid='$user[id]'");
                             
                              while($row = mysqli_fetch_array($course_book)){
                                  $course = mysqli_fetch_array(mysqli_query($con, "select * from course_details where id='".$row['course_id']."'"));
                                    
                                  
                                  $obt_marks = $max_marks = 0;
                                  $subject_name = [];
                                  $sql = mysqli_query($con, "select * from certificate_marks_details where student_certificate_id = '".$details['id']."' and course_id='".$row['course_id']."'");

                                  while($rowm = mysqli_fetch_array($sql)){
                                      $obt_marks += $rowm['obt_mark'];
                                      $max_marks += $rowm['max_mark'];
                                      $subject_name[] = $rowm['subject_name'];
                                  }
                                 if ($max_marks > 0) {
                                        $percentage = round(($obt_marks * 100) / $max_marks, 2);
                                    } else {
                                        $percentage = 0; // or null, or 'N/A'
                                    }

                                  $subject_list = implode(', ', $subject_name);
                        
                                  if($percentage >= 80) { $result_status = "Pass"; $result_grade = "A"; }
                                  elseif($percentage >= 65) { $result_status = "Pass"; $result_grade = "B"; }
                                  elseif($percentage >= 50) { $result_status = "Pass"; $result_grade = "C"; }
                                  elseif($percentage >= 35) { $result_status = "Pass"; $result_grade = "D"; }
                                  else { $result_status = "Failed"; $result_grade = "F"; }
                              ?>
                              <tr><th>Course Name:</th><td><?php echo $course['name']; ?></td></tr>
                              <tr><th>Course Duration:</th><td><?php echo $course['duration']; ?> month</td></tr>
                              <tr><th>Subject Details:</th><td><?php echo $subject_list; ?></td></tr>
                              <tr><th>Total Marks:</th><td><?php echo $obt_marks." / ".$max_marks; ?></td></tr>
                              <tr><th>Total Percentage:</th><td><?php echo $percentage; ?>%</td></tr>
                              <tr><th>Grade:</th><td><?php echo $result_grade; ?></td></tr>
                              <?php } ?>
                            </table>
                          </div>
                          
                           <div class="page-table" style="display: none;">
                            <table class="table table-bordered">
                              <tr><td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px; color: #04046e;">Emax Education Associate/Recognition</td></tr>
                              <tr><td><img style="width:100%;" src="logo_image/partners.png"></td></tr>
                             <tr><td><p>For more information, please visit our website: <a href="<?php echo $web_link; ?>" target="_blank"><?php echo $web_link; ?></a> or  you can directly reach us on <a href="mailto:<?php echo $brand_email; ?>"><?php echo $brand_email; ?></a></p></td></tr>
                            </table>
                          </div>
                        </div>
                        
                       
                        
                        <div class="text-center mt-4">
                          <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="btn btn-primary text-white" href="javascript:void(0);" id="prev-btn">Previous</a></li>
                            <li class="page-item"><a class="page-link disabled" id="page-number">1 / 3</a></li>
                            <li class="page-item"><a class="btn btn-primary text-white" href="javascript:void(0);" id="next-btn">Next</a></li>
                          </ul>
                        </div>



                </div>  
            </div>
        </div>

        </div>
        </div>
    </div>
    <!-- Team End -->
        

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->






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
document.addEventListener("DOMContentLoaded", function () {
    console.log("Student verification pagination script loaded");

  const pages = document.querySelectorAll('.page-table');
  console.log("Page count:", pages.length);
  if (pages.length === 0) {
    console.warn("No .page-table elements found!");
  }

  let currentPage = 0;

  const updatePagination = () => {
    pages.forEach((page, index) => {
      page.style.display = index === currentPage ? 'block' : 'none';
    });
    document.getElementById('page-number').textContent = `${currentPage + 1} / ${pages.length}`;
  };

  document.getElementById('next-btn').addEventListener('click', () => {
    if (currentPage < pages.length - 1) {
      currentPage++;
      updatePagination();
    }
  });

  document.getElementById('prev-btn').addEventListener('click', () => {
    if (currentPage > 0) {
      currentPage--;
      updatePagination();
    }
  });

  updatePagination();
});

</script>


</body>

</html>