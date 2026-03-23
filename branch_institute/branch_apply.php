<?php
include 'con.php';
include 'assets.php';


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback

function document_image_upload($document_name,$document_tmp_name,$db_dir,$upload_dir,$id){
   if(!$document_name==""){
                $extension12 = explode(".", $document_name);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$id.$nn_name.".".$extension1;
            $photo_dr=$db_dir.$newfilename1 ;
            $upload_photo= move_uploaded_file($document_tmp_name,$upload_dir.$newfilename1); 
            if($upload_photo){
               return array(1,$photo_dr); 
            }else{
                return array(2,"Photo upload failed.");
            }
   }else{
       return array(2,"Please choose photo.");
   }
}



$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['submit'])){
    $branch_name=VerifyData($_POST['branch_name']);
    $owner_name=VerifyData($_POST['owner_name']);
    $mob=VerifyData($_POST['mob']);
    $email=VerifyData($_POST['email']);
    $state_id=VerifyData($_POST['state_id']);
    $district=VerifyData($_POST['district']);
    $pin=VerifyData($_POST['pin']);
    $full_add=VerifyData($_POST['full_add']);
    $admin_photo = $_FILES["upload_file"]["name"];
    $admin_photo2 = $_FILES["upload_file"]["tmp_name"];
    $branch_logo = $_FILES["upload_file2"]["name"];
    $branch_logo2 = $_FILES["upload_file2"]["tmp_name"];
    $branch_photo = $_FILES["upload_file3"]["name"];
    $branch_photo2 = $_FILES["upload_file3"]["tmp_name"];
    $lab_photo = $_FILES["upload_file4"]["name"];
    $lab_photo2 = $_FILES["upload_file4"]["tmp_name"];
    $off_photo = $_FILES["upload_file5"]["name"];
    $off_photo2 = $_FILES["upload_file5"]["tmp_name"];
   
    
   
    
   if(!$off_photo=="" and !$lab_photo=="" and !$branch_photo=="" and !$branch_logo=="" and !$admin_photo=="" and !$branch_name=="" and !$owner_name=="" and !$mob=="" and !$email=="" and !$state_id=="" and !$district=="" and !$pin=="" and !$full_add==""){
       $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from branch_application where mobile='$mob'"));
            if(!$check_mobile>0){
             
                list($branch_image_key,$branch_image_details)=document_image_upload($branch_photo,$branch_photo2,"super_admin/branch_apply_image/","super_admin/branch_apply_image/",$mob);
              if($branch_image_key==1){
                 list($admin_image_key,$admin_image_details)=document_image_upload($admin_photo,$admin_photo2,"super_admin/branch_apply_image/","super_admin/branch_apply_image/",$mob); 
                 if($admin_image_key==1){
                     list($branch_logo_key,$branch_logo_details)=document_image_upload($branch_logo,$branch_logo2,"area_s/user_img/","area_s/user_img/",$mob); 
                    if($branch_logo_key==1){
                         list($lab_image_key,$lab_image_details)=document_image_upload($lab_photo,$lab_photo2,"super_admin/branch_apply_image/","super_admin/branch_apply_image/",$mob); 
                        if($lab_image_key==1){
                            list($off_image_key,$off_image_details)=document_image_upload($off_photo,$off_photo2,"super_admin/branch_apply_image/","super_admin/branch_apply_image/",$mob); 
                            if($off_image_key==1){
                                $insert=mysqli_query($con,"insert into `branch_application`(`admin_photo`, `branch_logo`, `branch_photo`, `lab_office_photo1`, `lab_office_photo2`, `branch_name`, `admin_name`, `mobile`, `email`, `state_id`, `district`, `pin_code`, `full_add`, `apply_date`) values('$admin_image_details', '$branch_logo_details', '$branch_image_details', '$lab_image_details', '$off_image_details', '$branch_name', '$owner_name', '$mob', '$email', '$state_id', '$district', '$pin', '$full_add', '$t_date')"); 
                    if($insert){
                        echo '<script>alert("The new Branch Request Successfully Submitted and waiting for approval.");window.location.assign("branch_apply")</script>';
                       
                        
                    }else{
                     echo '<script>alert("Server Error 101.");window.location.assign("branch_apply");</script>';  
                } 
                            }else{
                   echo '<script>alert("'.$off_image_details.'");window.location.assign("branch_apply");</script>';  
                 }
                            
                        }else{
                   echo '<script>alert("'.$lab_image_details.'");window.location.assign("branch_apply");</script>';  
                 }
                        
                    }else{
                   echo '<script>alert("'.$branch_logo_details.'");window.location.assign("branch_apply");</script>';  
                 }
                     
                 } else{
                   echo '<script>alert("'.$admin_image_details.'");window.location.assign("branch_apply");</script>';  
                 }
              }else{
                echo '<script>alert("'.$branch_image_details.'");window.location.assign("branch_apply");</script>'; 
              }
               
            }else{
                echo '<script>alert("Already register a branch with this mobile number.");window.location.assign("branch_apply");</script>';
            }
   }else{
        echo '<script>alert("Please fill all feild.");window.location.assign("branch_apply");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name ?> | Branch Apply</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">

   <?php include 'head.php'; ?>
   
    <style>
        .container-xxxl {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #c3e0e5, #a1a4c9);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .apply_container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1200px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            position: relative;
        }
        h2::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #1a486b;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"] {
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .form-group input:focus {
            border-color: #b0bfd6;
            box-shadow: 0 0 8px rgba(174, 187, 212, 1);
            outline: none;
        }
        .submit-btn {
            margin: 20px auto;
            display: block;
            width: 25%;
            padding: 15px;
            /*background: linear-gradient(135deg, #a1a4c9, #c3e0e5);*/
            border: none;
            border-radius: 8px;
            /*color: white;*/
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }
        .submit-btn:hover {
            transform: scale(1.05);
        }
        .form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="file"],
.form-group select {
    padding: 12px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
            .submit-btn{
                width: 60% !important;
            }
        }
        .animated-heading {
            font-size: 2rem;
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
                    <h1 class="display-3 text-white animated slideInDown">Branch Apply</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Branch / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> Branch Apply</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-xxxl py-5">
       <div class="apply_container">
        <h2 class="animated-heading">Apply for Branch</h2>
        <form method="post" name="form_2" enctype="multipart/form-data">
            <h3>Personal Information</h3>
            <hr>
            <div class="form-row">
                <div class="form-group">
                    <label>Your Full Name:</label>
                    <input type="text" placeholder="Enter your full name" name="owner_name" id="owner_name" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number:</label>
                    <input type="text" placeholder="Enter mobile number" name="mob" id="mob" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Email ID:</label>
                    <input type="email" placeholder="Enter email ID" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label>State:</label>
                    <select name="state_id" id="state_id" onchange="fetchDistrict(this.value);">
                        <option value="" selected>--Select State--</option>
                        <?php
                            $state = mysqli_query($con, "select * from states order by name");
                            while($row = mysqli_fetch_array($state)){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                    </select>
                    
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>District:</label>
                    <select name="district" id="district">
                        <option value="">--Select District--</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pin Code:</label>
                    <input type="text" placeholder="Enter pin code" name="pin" id="pin" required>
                </div>
            </div>

            <h3>Institute Information</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Branch/Institute Name:</label>
                    <input type="text" placeholder="Enter branch name" name="branch_name" id="branch_name" required>
                </div>
                <div class="form-group">
                    <label>Full Address:</label>
                    <input type="text" placeholder="Enter full address" name="full_add" id="full_add" required>
                </div>
            </div>

            <h3>Upload Photo</h3>
            <hr>
            <div class="form-row">
                <div class="form-group">
                    <label>Owner Photo:</label>
                    <input type="file" name="upload_file" required class="form-control" placeholder="Enter Name"
                            id="upload_file" onchange="getImagePreview(event)">
                     <div id="preview" style="height: 110px">
                         
                        </div>
                         <br>
                </div>
                <div class="form-group">
                    <label>Branch/Franchise Photo:</label>
                    <input type="file" name="upload_file3" required class="form-control" placeholder="Enter Name"
                            id="upload_file3" onchange="getImagePreview3(event)">
                     <div id="preview3" style="height: 110px">
                         
                        </div>
                         <br>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Branch/Franchise Logo:</label>
                    <input type="file" name="upload_file2" required class="form-control" placeholder="Enter Name"
                            id="upload_file2" onchange="getImagePreview2(event)">
                             <div id="preview2" style="height: 110px">
                         
                        </div>
                         <br>
                </div>
                <div class="form-group">
                    <label>Photo 1:</label>
                    <input type="file" name="upload_file4" required class="form-control" placeholder="Enter Name"
                            id="upload_file4" onchange="getImagePreview4(event)">
                             <div id="preview4" style="height: 110px">
                         
                        </div>
                         <br>
                </div>
            </div>
            <div class="form-row">
            <div class="form-group">
                <label>Photo 2:</label>
                 <input type="file" name="upload_file5" required class="form-control" placeholder="Enter Name"
                            id="upload_file5" onchange="getImagePreview5(event)">
                             <div id="preview5" style="height: 110px">
                         
                        </div>
                        <br>
            </div>
            <div class="form-group">
                <label>Photo 3:</label>
                <input type="file" name="upload_file5" required class="form-control" placeholder="Enter Name"
                            id="upload_file6" onchange="getImagePreview6(event)">
                             <div id="preview6" style="height: 110px">
                         
                        </div>
                         <br>
            </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary submit-btn">Submit</button>
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
function fetchDistrict(stateId) {
  if (stateId !== '') {
    $.ajax({
      url: 'get_districts',
      method: 'GET',
      data: { state_id: stateId },
      success: function(response) {
        $('#district').html(response);
      },
      error: function() {
        $('#district').html('<option value="">Error loading districts</option>');
      }
    });
  } else {
    $('#district').html('<option value="">--Select District--</option>');
  }
}
</script>
 <script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.height = "150";
            newimg.width = "250";
            imagediv.appendChild(newimg);
        }
    </script>
    <script>
        function getImagePreview2(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview2');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
           newimg.height = "150";
            newimg.width = "250";
            imagediv.appendChild(newimg);
        }
    </script>
    <script>
        function getImagePreview3(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview3');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
           newimg.height = "150";
            newimg.width = "250";
            imagediv.appendChild(newimg);
        }
    </script>
    <script>
        function getImagePreview4(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview4');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.height = "150";
            newimg.width = "250";
            imagediv.appendChild(newimg);
        }
    </script>
    <script>
        function getImagePreview5(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview5');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.height = "150";
            newimg.width = "250";
            imagediv.appendChild(newimg);
        }
    </script>
    <script>
        function getImagePreview6(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview6');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.height = "150";
            newimg.width = "250";
            imagediv.appendChild(newimg);
        }
    </script>
</body>

</html>