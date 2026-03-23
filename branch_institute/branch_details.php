<?php
include 'con.php';
include 'assets.php';
if(isset($_GET['id'])){
    $id=VerifyData($_GET['id']);
    $branch_details= mysqli_fetch_array(mysqli_query($con, "select * from user where id='$id'"));
    
}else {
    echo '<script>alert("Branch Id not found.");window.location.assign("branch-list")</script>';
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title> <?php echo $brand_name;?> | Branch Details </title>
  
  <?php include 'head.php' ;?>

  <style>
table th {
    font-size: 15px;
    text-align: center;
    background-color: #04046e;
    font-weight: 500;
    color: #ffffff;
    padding: 15px 15px;
}

@media (max-width: 480px){
    .student-details-table td {
        padding: 10px 30px;
    }
        
}
@media(max-width: 1024px) {
    .bg-light {
        width: 250px;
    }
}

@media(max-width: 768px) {
    
    table th, table td {
            font-size: 10px !important;
        }
}
.branch_details {
    width: 95%;
    border: 1px solid #04046e;
    border-radius: 15px;
    box-shadow: 0px 0px 10px 5px #8d8d8d;
    margin: auto;
    background: #edf6fd;
}

.page-title-section {
    background: linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)), url(images/backgrounds/image_top_background2.jpg);
    background-size: cover;
}
.heading {
    margin-top: 20px;
}
.image {
    border: 1px solid #04046e;
}
.branch {
    margin-bottom: 20px;
    background: lightgrey;
    border: 1px solid #04046e;
    border-top: none;
}
@media (max-width: 768px) {
    .student-details-table {
        margin-bottom: 20px;
    }
    table th {
        padding: 5px 5px;
    }
    .student-details-table td {
        padding: 10px 15px;
    }
}
@media screen and (max-width: 768px) {
  .table-container {
    padding: 2rem 1.5rem;
  }
  table {
    font-size: 0.9rem;
  }

  th, td {
    padding: 8px;
  }
  .btn-primary {
    font-size: 1rem;
    padding: 8px 15px;
  }
}

@media screen and (max-width: 480px){
  .table-container{
    padding: 1rem;
  }
  th, td {
    font-size: 0.8rem;
    padding: 6px;
  }

  .btn-primary {
    font-size: 1rem;
    padding: 8px 15px;
  }
}

 table {
  display: contents;
  width: 100%;
  max-width: 800px;
  /* margin: 0 auto; */
  border-collapse: collapse;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
@media screen and (max-width: 768px){
.table{
  overflow-x: auto;
}
}


th, td {
  padding: 10px 15px;
  text-align: center;
  border: 1px solid #ddd;
}

th {
  background-color: #34495e;
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
  text-align: center;
}

td {
  text-align: center;
  background-color: #f9f9f9;
}

tr:nth-child(even) td {
  /*background-color: #82a1d8;*/
  background-color: #dfdfff;
}

tr:hover td {
  background-color: #c9d7ee;
}
.student-details {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
  width: 100%;
}
.student-details-table {
    flex: 2;
    width: 100%;
}
    

  </style>
 
 
</head>

<body>
  

<!-- header -->
<?php include 'header.php'; ?>

<!-- page title -->
<!--<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">-->
<section class="page-title-section overlay">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item">
              <a class="h2 text-primary font-secondary"></a>
          </li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <!-- <p class="text-lighten">Welcome to DEMO INSTITUTE Run by TVS SOLUTION, where innovation meets education in the world of computers and technology.</p> -->
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- about -->
<div class="card-body ">
    
<div class="branch_details" style="padding-bottom: 20px;">    
    
    <div class="heading" align="center">
        <h2> <?php echo $branch_details['name']; ?></h2>
    </div>
    <div class="row" style="margin-top: 50px; justify-content: space-evenly;">
      <div class="col-lg-4 col-md-12">
  <div class="team-item bg-light" style="width:270px; margin:auto;">
    <div class="overflow-hidden">
      <img class="img-fluid image" src="<?php echo $web_link.$branch_details['photo']; ?>" alt="" style="height: 240px; width:270px;">
    </div>
    <div class="text-center p-4 branch" style="width:270px;">
      <h5 class="mb-0"><?php echo $branch_details['father_name']; ?></h5>
    </div>
  </div>
</div>

       <div class="col-lg-8 col-md-12">
    <div data-wow-delay="0.6s">
        <h3 style="color: black !important; text-align: center;">Branch Details</h3>
       
       
                        <div class="student-details-table">
                    <table>
                        
                        <?php 
                            $sql_branch=mysqli_query($con,"select * from branch_application where status='OPEN' order by id desc");
                                // while($row=mysqli_fetch_array($sql_branch)){
                            // $branch=mysqli_fetch_array(mysqli_query($con,"select * from where type='1' and status='1' order by id desc"));
                         ?>
                        <tr><th>Branch Code:</th><td><?php echo $branch_details['branch_code']; ?></td></tr>
                        <tr><th>Branch Head:</th><td id="student-dob"><?php echo $branch_details['father_name']; ?></td></tr>
                        <tr><th>Address:</th><td id="student-gender"><?php echo $branch_details['full_add']; ?></td></tr>
                        <tr><th>Email:</th><td id="student-gender"><?php echo $branch_details['email']; ?></td></tr>
                        <tr><th>Contact No.:</th><td id="student-address"><?php echo  $branch_details['mobile']; ?></td></tr>
                        <?php 
                        
                        // } 
                        ?>
                    </table>
                </div>

        </div>
  </div>
     
      
     
      
       
    </div>
 </div>
    </div>

   

<!-- footer -->
<?php include 'footer.php'; ?>
<!-- /footer -->

<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- aos -->
<script src="plugins/aos/aos.js"></script>
<!-- venobox popup -->
<script src="plugins/venobox/venobox.min.js"></script>
<!-- mixitup filter -->
<script src="plugins/mixitup/mixitup.min.js"></script>
<!-- google map -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>-->
<!--<script src="plugins/google-map/gmap.js"></script>-->

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>