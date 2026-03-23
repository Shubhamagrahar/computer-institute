<?php
include('session.php');


if(isset($_POST['change'])){
   $old_pass=VerifyData($_POST['pass_old']);
   $new_pass=VerifyData($_POST['pass_new']);
   $con_pass=VerifyData($_POST['pass_con']);
   
  
  
   
   if($login_details['pass']==$old_pass){
      if($new_pass==$con_pass){
         $update=mysqli_query($con,"update user set pass='$con_pass' where id='$_SESSION[userid]'"); 
        if($update){
            echo '<script>alert("Password Change Sucessfully Done .");window.location.assign("change_password");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("change_password");</script>'; 
        }
          
      }else{
          echo '<script>alert("New Password And Confirm Password Not Match.");window.location.assign("change_password");</script>'; 
      }
       
   }else{
      echo '<script>alert("Old Password Not Match.");window.location.assign("change_password");</script>'; 
   }
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>TVS SOLUTION | Change Password </title>
    <meta name="theme-color" content="#f38e0c"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'header.php' ; ?>
<style>
    .change_pass{
        box-shadow: 0 2px 7px rgba(34, 48, 53, 0.81)!important;
    margin-right: 11px;
    margin-left: 9px;
    margin-top: 12px;
    padding-bottom: 10px;
    }
</style>
</head>
<body >
<!--Top Page-->
<?php include 'top_page.php' ; ?>
<!-- Top Page -->

<div class="container-fluid">
<div class="row">






<div class="col_m contant_1">


<div align="center" class="col_m">
 <h4 class="welcome_admin">Change Password</h4>
 
</div> 

<div class="col_m">
    <div class="col-sm-12">
   <div class="col-sm-4"></div>
   
 <div class="col-sm-4 change_pass" id="fees_div" >
       <div class="col-sm-12 page_heading_all2">
       
      </div>
     <form method="post">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="pass_old">Old Password</label>
                <input type="password" class="form-control" id="pass_old" name="pass_old" onkeyup="get_user_pass(this.value)" placeholder="Enter old password">
                <span id="mathc1"></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="pass_new">Create New Password</label>
                 <input type="password" class="form-control" id="pass_new" name="pass_new" placeholder="Create New password">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="pass_con">Confirm New Password</label>
                <input type="password" class="form-control" id="pass_con" name="pass_con" onkeyup="get_match(this.value)" placeholder="Enter Confirm New password">
               <span  id="mathc_2" style="color:red; display:none;"> New And Confirm Password Not Match</span>
                <span  id="mathc_3" style="color:green; display:none;"> New And Confirm Password Match</span>
            </div>
        </div>
        
        <div class="col-sm-12">
            <div class="form-group">
                <br>
                 <button type="submit" name="change" class="btn btn-primary">Change</button>
                </form>
                
            </div>
        </div>
       
       </div>
   
   </div>
</div>


<div class="col_m">
    
</div>

<div class="col_m">
    
</div>




<br><br><br><br><br><br><br>
 
</div>

</div>

 


</div>
  
<?php include 'footer.php'; ?>
  
</body>
<script>
     function get_user_pass(val){
       
        
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_user_userid12='+val,
                success: function(data){
                 $("#mathc1").html(data);
                }
              }
              );
              
         
    }
    function get_match(val){
            var new2 =$("#pass_new").val(); 
            if((val== new2)){
               
              document.getElementById("mathc_2").style.display="none";
              document.getElementById("mathc_3").style.display="block";
            }else{
                 
              document.getElementById("mathc_2").style.display="block";
              document.getElementById("mathc_3").style.display="none";  
            }
            
    }
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