<?php
include('session.php');
// include('../init_connect.php');
 
//  include('function.php');
//  $user_sql=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]' "));
// date_default_timezone_set('Asia/Kolkata');
$c_date=date("Y-m-d H:i:s");

$trs="";
$btnname='Add';


?>

<?php 

if(isset($_POST['update_photo'])){
    $photo = $_FILES["photo"]["name"];
     $photo2 = $_FILES["photo"]["tmp_name"];
      if(!$photo==""){ 
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="area_user/user_img/".$newfilename1 ;
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Profile | <?php echo $company_full_name ?></title>
    <meta name="theme-color" content="#f38e0c"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'header.php' ; ?>

</head>
<body >
<!--Top Page-->
<?php include 'top_page.php' ; ?>
<!-- Top Page -->

<div class="container-fluid">
<div class="row">






<div class="col_m contant_1">


<div align="center" class="col_m">
 <h4 class="welcome_admin">Your Profile </h4>
 
</div> 

<div class="col_m">
   <div class="col-sm-12 input_div" >
     <div class="col-sm-12 page_heading_all2" align="center">
     <p style="font-size:18px; font-weight:800;">Profile Photo</p>
     </div>
     <form name="form1"  method="post" enctype="multipart/form-data">
     <div align="center">
         <div  style="text-align: center;"><br>
            	<img src="<?php echo $web_link.$login_details['photo'] ?>" class="img3" id="profile-img-tag" hight="80" width="100">
            </div>
            	<div class="col-sm-3">
            	<div class="form-group">
            	   <label for="last-name">Select Photo<span class="required">*</span>
            	    <input type="file" name="photo" id="profile-img" value="" class="form-control">
            	 </div>
             </div>
             <div class="col-sm-3">
            	<div class="form-group">
            	   <br><br>
            	    <button type="submit" name="update_photo" class="btn btn-success">Update</button>
            	 </div>
             </div>
         </form>
     </div>
 </div>
</div>
<br>

<div class="col_m">
   <div class="col-sm-12 input_div" >
     <div class="col-sm-12 page_heading_all2">
      <p style="font-size:18px; font-weight:800;">Profile Details</p>
     </div>
     <form name="form_2" method="post">
      <div class="col-sm-6">
           <label>Student  Name (Read Only)</label>
         <input type="text" readonly name="student_name" value="<?php echo $login_details['name'] ;?>" class="form-control">
         
      </div>
      <div class="col-sm-6">
        <label>Father  Name </label>
         <input type="text"   name="father_name" id="father_name"  required value="<?php echo $login_details['father_name'] ;?>" class="form-control">
      </div>
      <div class="col-sm-6">
          <label>Mobile No. (Read Only)</label>
          <input type="text" readonly name="mobile" value="<?php echo $login_details['mobile'] ;?>" class="form-control">
      </div>
      <div class="col-sm-6">
          <label>Email ID. </label>
          <input type="email"  name="email" id="email" required value="<?php echo $login_details['email'] ;?>" class="form-control" pattern=".+@.+">
      </div>
     
       <div class="col-sm-6">
          <label>DOB </label>
          <input type="date"  name="dob" id="dob" required value="<?php echo $login_details['dob'] ;?>" class="form-control">
      </div>
       <div class="col-sm-6">
         <label>Gender</label>
                <select name="gender"  id="gender"  required  class="form-control">
                   <option value="">Select </option>
                    <option value="Male">Male </option>
                    <option value="Female">Female </option>
                    <option value="Other">Other </option>
                </select>
      </div>
       <div class="col-sm-6">
          <label>WhatsApp No. </label>
          <input type="number"   name="w_mob" id="w_mob"  required value="<?php echo $login_details['w_mob'] ;?>"  class="form-control">
      </div>
       <div class="col-sm-6">
          <label>State </label>
          <select name="state_id"  class="form-control"  id="state_id"  required>
                          <option value="">Select </option>
                         
                          <?php 
                          $st_sql=mysqli_query($con,"select * from states order by name");
                          while($row=mysqli_fetch_array($st_sql)){
                              ?>
                              
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                              <?php } ?>
                      </select>
       </div>
       <script>
            $("#gender").val('<?php echo $login_details['gender'] ;?>');
            $("#state_id").val('<?php echo $login_details['state_id'] ;?>');
        </script>
      <div class="col-sm-6">
          <label>Pin Code / Zip Code:</label>
          
          <input type="number" required  name="pin" value="<?php echo $login_details['pin'] ;?>" class="form-control">
      </div>
       
      <div class="col-sm-6">
          <label>Full Address: </label>
          <textarea class="form-control" required name="full_add" id="full_add" value="<?php echo $login_details['full_add'] ;?>" placeholder="Enter your full addres"><?php echo $login_details['full_add'] ;?></textarea>
         
      </div>
     
     <div class="col-sm-6">
         <br>
         <button type="submit" name="update" class="btn btn-success">Update</button>
      </div>
     <br>
     </form>
    </div> 
</div>

<div class="col_m">
    
</div>




<br><br><br><br><br><br><br>
 
</div>

</div>

 


</div>
  
<?php include 'footer.php'; ?>
  
</body>
<script type="text/javascript">
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
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
</html>