<?php
include 'session.php'; 

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


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Change Password |  <?php echo $brand_name; ?></title>
        
        <!-- Favicons -->
        <link href="<?php echo $brand_logo; ?>" rel="icon">

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"\ content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&amp;display=swap"\ rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"\ href="public/vendor/spinkit.css" rel="stylesheet">

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

.password_change{
	background: #157daf !important;
}
            .login-container {
                /*border: 1px solid lightgray;*/
                padding: 25px;
                border-radius: 10px;
                margin: auto;
                width: 60%;
                box-shadow: 0 1px 4px rgb(0 0 0 / 50%);
                background: linear-gradient(45deg, #5567ff, transparent);
            }
            @media(max-width: 768px) {
                .login-container {
                    width: 100%;
                }
            }
            .form-label {
                color: #ffffff;
            }
            .save {
                background-color: #ff0049 !important;
            }
                .mdk-drawer-layout .container {
                    max-width: 95%;
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


        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <?php include 'top-navbar.php'; ?>


                <div class="page-section pb-0">
                    <div class="container page__container d-flex flex-column flex-sm-row align-items-sm-center">
                        <div class="flex">
                            <h1 class="h2 mb-0">Change Password</h1>
                            <!--<p class="text-breadcrumb">Account Management</p>-->
                        </div>
                        
                    </div>
                </div>

                <div class="page-section">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Change Password</div>
                        </div>
                        <div class="login-container">
                            <form method="post"  class="">
                                <div class="form-group">
                                    <label class="form-label" for="pass_old">Old Password:</label>
                                    <input type="password" class="form-control" id="pass_old" name="pass_old" onkeyup="get_user_pass(this.value)" placeholder="Enter old password" required>
                                    <span id="mathc1"></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="pass_new">New Password:</label>
                                    <input type="password" class="form-control" id="pass_new" name="pass_new" placeholder="Create New password" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password2">Confirm New Password:</label>
                                    <input type="password" class="form-control" id="pass_con" name="pass_con" onkeyup="get_match(this.value)" placeholder="Enter Confirm New password" required>
                                    
                                    <span  id="mathc_2" style="color:red; display:none;"> New And Confirm Password Not Match</span>
                                    <span  id="mathc_3" style="color:green; display:none;"> New And Confirm Password Match</span>
                                </div>
                                <button type="submit" name="change" class="btn btn-primary save">Save password</button>
                            </form>
                        </div>
                    </div>
                </div>


                <?php include 'footer.php'; ?>

                <!-- // END Footer -->

            </div>


            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->
        
        
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
  $.widget.bridge('uibutton', $.ui.button)
</script>

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