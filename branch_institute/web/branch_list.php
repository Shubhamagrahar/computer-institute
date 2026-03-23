<?php 
include 'con.php';
include 'asset.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Branch List | <?php echo $brand_name; ?></title>
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
    
        <!-- Custom Theme Style -->
    <link href="Amaster/build/css/custom.min.css" rel="stylesheet">
     <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <style>
    .swal-modal{
      max-width: 800px;
      width: 800px;
      margin-top: 100px;  
    }
    .gallery_img {
        padding-top:0px;
   min-height:500px;
   max-height:600px; 
   height:500px;
   width:750px;
  }
.content_box{
    width:500px;
}
        @media only screen and (max-width: 600px) {
            .content_box{
    width:260px;
}
            .swal-modal{
      max-width: 300px;
      width: 300px;
      margin-top: 100px;  
    }
    
  .gallery_img {
      padding-top:0px;
    min-height:220px;
    max-height:300; 
    height:220px;
    width:284px;
    margin-left: -12px;
  }
}

table {
  border: 1px solid black;
  border-collapse: collapse;
  
}
th {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
  background-color: #214ded;
  color: white;
  padding: 5px;
}
td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
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
                    <h1 class="display-3 text-white animated slideInDown">Branch List</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Branch List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Gallery Start -->
    <div class="container-xxl py-5">
        <div class="container" >
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!--<h4 class="section-title bg-white text-center text-primary px-3">Branch Details</h4>-->
                <!--<h1 class="section-title bg-white text-center text-primary px-3">SOME MOMENTS</h1>-->
                <br><br>
            </div>
            <div class="row g-4" >
             <table >
                 <tr>
                     <th>SI. NO.</th>
                     <th>BRANCH NAME</th>
                     <th>BRANCH DETAILS</th>
                 </tr>
                 
                 
                 <?php
                $i=0;
                
                
                $sql_branch=mysqli_query($con,"select * from user where type='1' and status='1' order by id desc");
                while($row=mysqli_fetch_array($sql_branch)){
             ?>
                 <tr>
                     <td><?php echo $i +=1; ?></td>
                     <td><?php 
                     if($row['mobile']=='admin'){
                        echo $brand_name; 
                     }else{
                         echo $row['name'];
                     }
                     ?>
                     
                     </td>
                     <td>
                         <p><i class="fa fa-location-pin" style="color:#06bbcc;"></i> 
                         <?php echo $row['full_add']; ?><br>
                        <i class="fa fa-envelope" style="color:#06bbcc;"></i> <?php echo $row['email']; ?>
                         </p>
                         
                     </td>
                 </tr>
               <?php }  ?>     
                 
             </table> 
               
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
        
        function video_shrt(val){
           // alert(val);
               document.getElementById("sht_area"+val).style.display="none";
                document.getElementById("video_area"+val).style.display="block";
           
        }
        
    function close_popup(val) {
        document.getElementById(val).style.display = "none";
    }

    function show_popup(val) {
        document.getElementById(val).style.display = "block";
    }
</script>
<script>
    function close_popup_youtube(val2) {
        document.getElementById(val2).style.display = "none";
      // location.reload();
 
    }

    function show_popup_youtube(val) {
        document.getElementById(val).style.display = "block";
    }
</script>
</body>

</html>