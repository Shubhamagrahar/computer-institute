<?php
include 'session.php'; 

function getStateName($id) {
    global $con;
    $res = mysqli_query($con, "SELECT name FROM states WHERE id = '$id' LIMIT 1");
    if ($row = mysqli_fetch_assoc($res)) {
        return $row['name'];
    }
    return "Unknown";
}


if(isset($_POST['update_photo'])){
    $photo = $_FILES["photo"]["name"];
     $photo2 = $_FILES["photo"]["tmp_name"];
      if(!$photo==""){ 
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="area_s2/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"user_img/".$newfilename1) ;
        if($upload_photo){
            $update_dr=mysqli_query($con,"update user set photo='$photo_dr' where id='$_SESSION[userid]'");
            if($update_dr){
                
                $last_check=end(explode("/",$login_details['photo']));
                
                if($last_check=="user.jpg"){
                   $unlink_p="1" ;
                }else{
                     $unlink_p=unlink("user_img/".$last_check);
                 
                }
                
                
                if($unlink_p){
                echo '<script>alert("Photo Update Successfully Done.");window.location.assign("profile");</script>';
                }else{
                   echo '<script>alert("Photo Unlink Failed.");window.location.assign("profile");</script>';  
                }
            }else{
                echo '<script>alert("Photo Update user Failed.");window.location.assign("profile");</script>';     
            }
        }else{
          echo '<script>alert("Photo Upload Failed.");window.location.assign("profile");</script>';     
        }
     }else{
        echo '<script>alert("Please Select Photo.");window.location.assign("profile");</script>';
     }
}


if(isset($_POST['update'])){
    $father_name=VerifyData($_POST['father_name']);
    $email=VerifyData($_POST['email']);
    $dob=VerifyData($_POST['dob']);
    $gender=VerifyData($_POST['gender']);
    $w_mob=VerifyData($_POST['w_mob']);
    $qualification=VerifyData($_POST['qualification']);
    $state_id=VerifyData($_POST['state_id']);
    $pin=VerifyData($_POST['pin']);
    $full_add=VerifyData($_POST['full_add']);
   
   $update=mysqli_query($con,"update user set father_name='$father_name', email='$email', dob='$dob', gender='$gender', w_mob='$w_mob', qualification='$qualification', state_id='$state_id', pin='$pin', full_add='$full_add' where id='$_SESSION[userid]'");    
   if($update) {
      echo '<script>alert("Profile details update successfully Done.");window.location.assign("profile");</script>'; 
   }else{
      echo '<script>alert("Server Error 101.");window.location.assign("profile");</script>'; 
   }
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Profile Details | <?php echo $brand_name;?></title>
        
        <!-- Favicons -->
        <link href="<?php echo $brand_logo; ?>" rel="icon">

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots" content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&amp;display=swap" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
        <!-- Material Icons from Google Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/css/preloader.css" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="public/css/app.css" rel="stylesheet">
        
        <style>
        
        .drop_a1{
	background: #157daf !important;
}

.profile{
	background: #157daf !important;
}
        
        .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid {
            max-width: 100%;
        }
              
.profile-flow-wrapper .navbar {
  display: flex;
  flex-wrap: wrap; 
  background: #1f2538;
  padding: 5px;
  gap: 10px;
  border-radius: 10px;
  justify-content: start;
}

.profile-flow-wrapper .navbar button {
    background: none;
    color: #fff;
    border: none;
    margin-right: 2px;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 6px;
    font-size: 16px !important;
    display: flex;
    line-height: 16px;
    align-items: center;
}

.profile-flow-wrapper .navbar button.active {
  background: #fff;
  color: #ff6d00;
}
.profile-flow-wrapper .navbar button.active svg{
    filter: brightness(0) saturate(100%) invert(61%) sepia(70%) saturate(5402%) hue-rotate(0deg) brightness(102%) contrast(104%);
}
.profile-flow-wrapper .navbar button svg{
margin-right: 5px;
}
.profile-flow-wrapper .card {
  background: white;
  margin: 10px 0px;
  border-radius: 8px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.1);
  overflow: hidden;
}

.profile-flow-wrapper .header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
    background: #EAEBEE;
}
.profile-flow-wrapper .header h5{
    margin: 0;
    font-size: 18px;
}
.profile-flow-wrapper .header a {
  color: #007bff;
  text-decoration: none;
  cursor: pointer;
  font-size: 18px;
  font-weight: bold;
}

.profile-flow-wrapper .profile-view,
.profile-flow-wrapper .profile-edit {
  display: flex;
  margin-top: 20px;
  gap: 20px;
  flex-wrap: wrap;
  flex-direction: column;
  /*padding: 0 20px;*/
}

@media(max-width: 1024px) {
    .profile-flow-wrapper .profile-view, 
    .profile-flow-wrapper .profile-edit {
        flex-direction: column;
    }
}

.profile-flow-wrapper .left {
  display: flex;
  flex-direction: column; 
  align-items: center;
  gap: 10px; 
  padding-top: 20px;
}

.profile-flow-wrapper .left img {
  width: 250px;
  border-radius: 10px;
}
@media (max-width: 375px) {
    .profile-flow-wrapper .left img {
        width: 80%;
    }
}

.profile-flow-wrapper .status {
  background: #c8facc;
  padding: 5px 15px;
  border-radius: 20px;
  display: inline-block;
  margin-top: 10px;
}

.profile-flow-wrapper .right {
  display: grid;
  grid-template-columns: 1fr 1fr; 
  gap: 15px;
  flex: 1;
  padding: 20px 5px;
}

.profile-flow-wrapper .right div {
  display: flex;
  flex-direction: column;
}

.profile-flow-wrapper .right input,
.profile-flow-wrapper .right select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.profile-flow-wrapper .picture-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
}

.profile-flow-wrapper .update-btn {
  background-color: #00bcd4;
  color: white;
  padding: 6px 14px;
  border: none;
  border-radius: 4px;
  font-size: 14px;
  cursor: pointer;
}

.profile-flow-wrapper .delete-btn {
  background-color: #ffebee;
  border: none;
  padding: 6px 10px;
  border-radius: 4px;
  cursor: pointer;
  color: #e53935;
  font-size: 16px;
}

.profile-flow-wrapper .btns {
  display: flex;
  gap: 10px;
  margin-top: 10px;
}

.profile-flow-wrapper .save-btn {
  background: #0d6efd;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 6px;
}

.profile-flow-wrapper #cancelBtn {
  background: #e0e0e0;
  border: none;
  padding: 8px 15px;
  border-radius: 6px;
}

.profile-flow-wrapper .tab-content {
  display: none;
}

.profile-flow-wrapper .tab-content.active {
  display: block;
}

.profile-flow-wrapper input[readonly], .profile-flow-wrapper p {
  /*border: none;*/
  border: 1px solid #ccc;
  background: transparent;
  color: #333;
  font-weight: normal;
  pointer-events: none;
  padding: 5px 10px;
  font-size: 18px;
}

.profile-flow-wrapper select:disabled {
  background: transparent;
  color: #333;
  pointer-events: none;
  border:0px;
  padding:10px 0;
  
}

@media(max-width: 375px) {
    .profile-flow-wrapper .right {
        display: flex;
        flex-direction: column;
        margin-top: 70px !important;
    }
}

@media (max-width: 768px) {
  .profile-flow-wrapper .right {
        grid-template-columns: 1fr !important;
        min-width: 240px;
        margin-top: 120px;
  }

  .profile-flow-wrapper .right div {
    width: 100%;
  }

  .profile-flow-wrapper .right input,
  .profile-flow-wrapper .right select,
  .profile-flow-wrapper .right button {
    width: 100%;
    box-sizing: border-box;
  }

  .profile-flow-wrapper .btns {
    flex-direction: column;
  }

  .profile-flow-wrapper .btns button {
    width: 100%;
  }

  .profile-flow-wrapper .picture-actions {
    flex-direction: column;
    width: 100%;
  }

  .profile-flow-wrapper .update-btn,
  .profile-flow-wrapper .delete-btn {
    width: 100%;
  }
}
textarea {
    border-radius: 8px;
    padding: 10px;
    width: 100%;
}
        </style>

    </head>

    <body class="layout-app ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <!-- Navbar -->

                <?php include 'top-navbar.php'; ?>

                <!-- // END Navbar -->

                <!-- // END Header -->

                <div class="pt-32pt">
                    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                        <div class="flex d-flex flex-column flex-sm-row align-items-center">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Profile</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./">Home</a></li>

                                    <li class="breadcrumb-item">

                                        <a href="#">Profile</a>

                                    </li>

                                    <li class="breadcrumb-item active"> Edit Profile </li>

                                </ol>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="container-fluid profile-flow-wrapper">
    <div class="row">

        <div class="card col-md-12">
            <!-- VIEW MODE -->
            <div id="about" class="tab-content active">
                <!-- About Content: Personal Info -->
                <div class="header">
                    <h5>Personal Information</h5>
                    <!--<a href="#" id="editBtn" class="text-primary">Edit</a>-->
                </div>
                
                <?php 
                    if (isset($_POST['update_photo']) && isset($_FILES['photo'])) {
                        $file = $_FILES['photo'];
                        $fileName = time().'_'.$file['name'];
                        move_uploaded_file($file['tmp_name'], "uploads/profile/".$fileName);
                    
                        mysqli_query($con, "UPDATE student_table SET photo = 'uploads/profile/$fileName' WHERE id = '".$login_details['id']."'");
                        echo "<script>alert('Photo updated'); location.href='profile.php';</script>";
                    }

                ?>
                <form id="photoForm" method="post" enctype="multipart/form-data">
                  <div class="left">
                    <img src="<?php echo $web_link.$login_details['photo'] ?>" alt="profile" />
                    
                    <div class="picture-actions" id="pictureActions" style="display: none;">
                        <input type="file" name="photo" id="fileInput" accept="image/*" />
                        <button type="submit" name="update_photo" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
                    
                    <?php
                        if (isset($_POST['update'])) {
                        $name = $_POST['student_name'];
                        $father = $_POST['father_name'];
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $dob = $_POST['dob'];
                        $gender = $_POST['gender'];
                        $w_mob = $_POST['w_mob'];
                        $pin = $_POST['pin'];
                        $state = $_POST['state_id'];
                        $address = $_POST['full_add'];
                    
                        mysqli_query($con, "UPDATE student_table SET
                            name='$name',
                            father_name='$father',
                            mobile='$mobile',
                            email='$email',
                            dob='$dob',
                            gender='$gender',
                            state_id='$state',
                            full_add='$address',
                            w_mob='$w_mob',
                            pin='$pin'
                            WHERE id = '".$login_details['id']."'
                        ");
                    
                        echo "<script>alert('Profile updated'); location.href='profile.php';</script>";
                    }

                    ?>
                    
                    <form id="detailsForm" method="post">
                      <div class="right">
                        <div>
                          <label>Name</label>
                          <input name="student_name" type="text" value="<?php echo $login_details['name']; ?>" readonly />
                        </div>
                    
                        <div>
                          <label>Father's/Husband's Name</label>
                          <input name="father_name" type="text" value="<?php echo $login_details['father_name']; ?>" readonly />
                        </div>
                    
                        <div>
                          <label>Mobile</label>
                          <input type="number" name="mobile" value="<?php echo $login_details['mobile']; ?>" readonly />
                        </div>
                    
                        <div>
                          <label>Email</label>
                          <input type="email" name="email" value="<?php echo $login_details['email']; ?>" readonly />
                        </div>
                    
                        <div>
                          <label>DOB</label>
                          <input type="date" name="dob" value="<?php echo $login_details['dob']; ?>" readonly />
                        </div>
                    
                        <!-- Gender -->
                        <div id="gender-view">
                          <label>Gender</label>
                          <input type="text" value="<?php echo $login_details['gender']; ?>" readonly />
                        </div>
                    
                        <div class="form-group" id="gender-edit" style="display: none;">
                          <label><strong>Gender</strong></label><br />
                          <select name="gender" id="gender" class="form-control" required>
                            <option value="<?php echo $login_details['gender']; ?>"><?php echo $login_details['gender']; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                        
                        <div>
                          <label>WhatsApp No.</label>
                          <input type="number" name="w_mob" value="<?php echo $login_details['w_mob'] ;?>" readonly />
                        </div>
                    
                        <!-- State -->
                        <div id="states-view">
                          <label>State</label>
                          <input type="text" value="<?php echo getStateName($login_details['state_id']); ?>" readonly />
                        </div>
                    
                        <div class="form-group" id="states-edit" style="display: none;">
                          <label>State</label>
                          <select name="state_id" class="form-control" required>
                            <option value=""><?php echo getStateName($login_details['state_id']); ?></option>
                            <?php 
                            $st_sql=mysqli_query($con,"select * from states order by name");
                            while($row=mysqli_fetch_array($st_sql)){
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                            ?>
                          </select>
                        </div>
                        
                        
                        <div>
                          <label>Pin Code / Zip Code</label>
                          <input type="number" name="pin" value="<?php echo $login_details['pin'] ;?>" readonly />
                        </div>
                    
                        <!-- Address -->
                        <div id="address-view">
                          <label>Address</label>
                          <textarea readonly><?php echo $login_details['full_add']; ?></textarea>
                        </div>
                    
                        <div class="form-group" id="address-edit" style="display: none;">
                          <label><strong>Address</strong></label>
                          <textarea name="full_add"><?php echo $login_details['full_add']; ?></textarea>
                        </div>
                    
                        <!-- Buttons -->
                        <div class="btns" id="formBtns" style="display: none;">
                          <button type="submit" name="update" class="save-btn">Save</button>
                          <button type="button" id="cancelBtn">Cancel</button>
                        </div>
                      </div>
                    </form>
                    
                    <p id="detailsNote" style="color: red; font-size: 14px; margin-top: 20px;">
                      <strong>Note:</strong> To update your personal details, please contact to the admin.
                    </p>


            </div>

         
        </div>
    </div>
</div>

                <!-- // END Page Content -->

                <!-- Footer -->

                <?php include 'footer.php'; ?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>
        
        
        
        <script>
document.getElementById("editBtn").addEventListener("click", function (e) {
  e.preventDefault();

  // Enable all readonly input and textarea fields
  document.querySelectorAll("#detailsForm input[readonly], #detailsForm textarea[readonly]").forEach(el => el.removeAttribute("readonly"));

  // Show image upload and save/cancel buttons
  const pictureActions = document.getElementById("pictureActions");
  const formBtns = document.getElementById("formBtns");
  if (pictureActions) pictureActions.style.display = "block";
  if (formBtns) formBtns.style.display = "grid"; // or "flex" if you prefer

  // Hide view-only sections
  const genderView = document.getElementById("gender-view");
  const statesView = document.getElementById("states-view");
  const addressView = document.getElementById("address-view");
  if (genderView) genderView.style.display = "none";
  if (statesView) statesView.style.display = "none";
  if (addressView) addressView.style.display = "none";

  // Show editable sections
  const genderEdit = document.getElementById("gender-edit");
  const statesEdit = document.getElementById("states-edit");
  const addressEdit = document.getElementById("address-edit");
  if (genderEdit) genderEdit.style.display = "block";
  if (statesEdit) statesEdit.style.display = "block";
  if (addressEdit) addressEdit.style.display = "block";

  // Hide view mode notes
  const photoNote = document.getElementById("photoNote");
  const detailsNote = document.getElementById("detailsNote");
  if (photoNote) photoNote.style.display = "none";
  if (detailsNote) detailsNote.style.display = "none";

  // Hide the Edit button itself
  this.style.display = "none";
});

document.getElementById("cancelBtn").addEventListener("click", function () {
  location.reload(); // Reload page to revert changes
});
</script>


        
        <script>
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
        
        
        


        <!-- // END Drawer Layout -->

        <!-- jQuery -->
        <script src="public/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="public/vendor/popper.min.js"></script>
        <script src="public/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="public/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="public/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="public/vendor/material-design-kit.js"></script>

        <!-- App JS -->
        <script src="public/js/app.js"></script>

        <!-- Preloader -->
        <script src="public/js/preloader.js"></script>

    </body>


</html>