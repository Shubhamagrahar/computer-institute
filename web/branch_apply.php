<?php
include 'con.php';
include'asset.php'; 




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


//  if($upload_photo){
                 
//               }else{
//               echo '<script>alert("Photo upload failed.");window.location.assign("branch_apply");</script>';  
//             } 



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
    <title>Login | <?php echo $brand_name; ?></title>
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
	body{
	      background: white;
	}
 label {
        display: block;
        margin-top: 10px;
        font-weight:800;
      }
      input[type="text"], input[type="number"], input[type="email"], input[type="password"], input[type="tel"], select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 5px;
      }
      input[type="radio"] {
        margin: 0 10px 0 0;
      }
 
	</style>
</head>

<body>


<!--loader and navbar start-->
<?php include 'header.php'; ?>
<!--loader and navbar end-->




 <div class="col-md-12">
                <div class="">
                    <br>
              <div  style="margin-bottom: 30px;" align="center">
                                <!--<img width="300px" style="margin-top: 5px;" src="<?php echo $brand_logo ; ?>" alt="Logo">-->
                                <h3 style="margin-top: 5px; font-weight: 800;"><?php echo $brand_name ; ?></h3>
                                <h4 style="font-weight: 600;">Branch Apply Form</h4>
                            </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="form_2" enctype="multipart/form-data">
                <div class="card-body ">
                <div class="row">
                    
                    
                  <div class="col-md-6">
                       <label>Branch/Institute Name: <span style="color:red;">*</span></label>
                      <input type="text" required name="branch_name" value="" class="form-control" placeholder="Enter branch/institute name.">
                     
                  </div>
                  <div class="col-md-6">
                    <label>Admin Name: <span style="color:red;">*</span></label>
                      <input type="text" required  name="owner_name" id="owner_name"   value="" class="form-control" placeholder="Enter admin/owner name.">
                  </div>
            <div class="col-md-6">
                      <label>Mobile No.: <span style="color:red;">*</span></label>
                      <input type="number"  required  name="mob" id="mob"   value=""  class="form-control" placeholder="Enter mobile number">
                  </div>
                  <!--<div class="col-md-6">-->
                  <!--    <label>Whatsapp No.: </label>-->
                  <!--    <input type="number"   name="w_mob" id="w_mob"   value=""  class="form-control">-->
                  <!--</div>-->
                  <div class="col-md-6">
                      <label>Email ID.: <span style="color:red;">*</span></label>
                      <input type="email" required name="email" id="email"  value="" class="form-control" pattern=".+@.+" placeholder="Enter email id.">
                  </div>
       
           
                   <div class="col-md-6">
                      <label>State: <span style="color:red;">*</span></label>
                     
                      <select name="state_id" required  class="form-control"  id="state_id"  >
                          <option value="">Select state</option>
                         
                          <?php 
                          $st_sql=mysqli_query($con,"select * from states order by name");
                          while($row=mysqli_fetch_array($st_sql)){
                              ?>
                              
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                              <?php 
                            
                          }
                          
                          ?>
                      </select>
              
                    </div>
                   <div class="col-md-6">
                      <label>District: <span style="color:red;">*</span></label>
                      <input type="text" required name="district" id="district"  value="" class="form-control"  placeholder="Enter district name.">
                  </div> 
                 
                  
                  <div class="col-md-6">
                      <label>Pin Code / Zip Code: <span style="color:red;">*</span></label>
                      
                      <input type="number" required   name="pin" id="pin"   value="" class="form-control" placeholder="Enter pincode/zip code.">
                  </div>
                   
                  <div class="col-md-6 form-group">
                      <label>Branch/Institute Full Address: <span style="color:red;">*</span></label>
                      <textarea class="form-control"  name="full_add" id="full_add" required  value="" placeholder="Enter full addres"></textarea>
                     <br>
                  </div>
                  
                   <div class="col-6" align="center">
                        
                         <div id="preview" style="border: 2px solid black;border-radius: 10px;height: 110px">
                         
                        </div>
                        
                       
                        <label>Admin photo: <span style="color:red;">*</span></label>
                        <input type="file" name="upload_file" required class="form-control" placeholder="Enter Name"
                            id="upload_file" onchange="getImagePreview(event)">
                        
                         
                        
                        <br>
                        <!--image preview div-->
                       

                    </div>
                    <div class="col-6" align="center">
                         <div id="preview2" style="border: 2px solid black;border-radius: 10px;height: 110px">
                         
                        </div>
                        <label>Branch Logo: <span style="color:red;">*</span></label>
                        <input type="file" name="upload_file2" required class="form-control" placeholder="Enter Name"
                            id="upload_file2" onchange="getImagePreview2(event)">
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                     <div class="col-6" align="center">
                         <div id="preview3" style="border: 2px solid black;border-radius: 10px;height: 110px">
                         
                        </div>
                        <label>Branch Photo: <span style="color:red;">*</span></label>
                        <input type="file" name="upload_file3" required class="form-control" placeholder="Enter Name"
                            id="upload_file3" onchange="getImagePreview3(event)">
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                     <div class="col-6" align="center">
                         <div id="preview4" style="border: 2px solid black;border-radius: 10px;height: 110px">
                         
                        </div>
                        <label>Lab + Office photo 1: <span style="color:red;">*</span></label>
                        <input type="file" name="upload_file4" required class="form-control" placeholder="Enter Name"
                            id="upload_file4" onchange="getImagePreview4(event)">
                            
                        <br>
                        <!--image preview div-->
                       
                    </div>
                    <div class="col-6" align="center">
                         <div id="preview5" style="border: 2px solid black;border-radius: 10px;height: 110px">
                         
                        </div>
                        <label>Lab + Office photo 2: <span style="color:red;">*</span></label>
                        <input type="file" name="upload_file5" required class="form-control" placeholder="Enter Name"
                            id="upload_file5" onchange="getImagePreview5(event)">
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                </div>
                <br>
                   <div class="col-3">
                      <button class="btn btn-primary w-100 py-3" type="submit" name="submit">SUBMIT</button>
                      </div>
                </div>
                <!-- /.card-body -->
                
                
                 
              </form>
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
     <script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.height = "99";
            newimg.width = "99";
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
           newimg.height = "99";
            newimg.width = "99";
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
           newimg.height = "99";
            newimg.width = "99";
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
            newimg.height = "99";
            newimg.width = "99";
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
            newimg.height = "99";
            newimg.width = "99";
            imagediv.appendChild(newimg);
        }
    </script>
     <script>
        function get_forget_form() {
            document.getElementById("forget_area").style.display = "block";
            document.getElementById("login_area").style.display = "none";
        }

        function get_login_form() {
            document.getElementById("forget_area").style.display = "none";
            document.getElementById("login_area").style.display = "block";
        }
    </script>
</body>

</html>