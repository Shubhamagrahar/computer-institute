 <style>
 .logo_brand{
        max-width:200px;
        max-height:130px;
    }
     @media (max-width: 425px) {
    .logo_brand{
        max-width:187px;
        max-height:90px;
    }
    }
 @media (max-width: 375px) {
    .logo_brand{
        max-width:187px;
        max-height:90px;
    }
    }
    @media (max-width: 360px) {
    .logo_brand{
        max-width:187px;
        max-height:90px;
    }
    }
     @media (max-width: 320px) {
    .logo_brand{
        max-width:187px;
        max-height:90px;
    }
    }
      .img_sliders{
       height: 530px;
   } 
    @media only screen and (max-width: 320px) {
  .img_sliders{
       height: 262px;
   }
   .area_slider{
     height: 154px !important;  
   }
   .navbar-light .navbar-brand, .navbar-light a.btn {
    height: 74px;
}
.slider_content{
    display:none;
}
.header-carousel .owl-carousel-item {
        position: relative;
        min-height: 171px;
    }
    
    .header-carousel .owl-carousel-item img {
        position: absolute;
        width: 100%;
        height: 100%;
        height: 100%;
        object-fit: cover;
    }
}
 @media only screen and (max-width: 360px) {
  .img_sliders{
       height: 262px;
   }
   .area_slider{
     height: 154px !important;  
   }
   .navbar-light .navbar-brand, .navbar-light a.btn {
    height: 74px;
}
.slider_content{
    display:none;
}
.header-carousel .owl-carousel-item {
        position: relative;
        min-height: 171px;
    }
    
    .header-carousel .owl-carousel-item img {
        position: absolute;
        width: 100%;
        height: 100%;
        height: 100%;
        object-fit: cover;
    }
}  
@media only screen and (max-width: 375px) {
  .img_sliders{
       height: 262px;
   }
   .area_slider{
     height: 154px !important;  
   }
   .navbar-light .navbar-brand, .navbar-light a.btn {
    height: 74px;
}
.slider_content{
    display:none;
}
.header-carousel .owl-carousel-item {
        position: relative;
        min-height: 171px;
    }
    
    .header-carousel .owl-carousel-item img {
        position: absolute;
        width: 100%;
        height: 100%;
        height: 100%;
        object-fit: cover;
    }
}
@media only screen and (max-width: 425px) {
  .img_sliders{
       height: 262px;
   }
   .area_slider{
     height: 154px !important;  
   }
   .navbar-light .navbar-brand, .navbar-light a.btn {
    height: 74px;
}
.slider_content{
    display:none;
}
.header-carousel .owl-carousel-item {
        position: relative;
        min-height: 169px;
    }
    
    .header-carousel .owl-carousel-item img {
        position: absolute;
        width: 100%;
        height: 100%;
        height: 90%;
        object-fit: cover;
    }
}
 </style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

 <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <!--<h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i></h2>-->
         <img class="m-0 logo_brand"  width="<?php echo $brand_logo_width;?>" src="<?php echo $brand_logo; ?>" alt="logo" style="border-radius:8px;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index" class="nav-item nav-link active">Home</a>
                <!--<a href="about" class="nav-item nav-link">About</a>-->
                 <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="about" class="dropdown-item">About Us</a>
                        
                         <?php 
                         $web_director_message=mysqli_fetch_array(mysqli_query($con,"select * from web_director_message where id='1'"));
				    if($web_director_message['status']=="SHOW"){
				    ?>
                        <a href="director_message" class="dropdown-item">Director Message</a>
                      <?php } ?>
                       <?php 
				    if($web_details['v_m_status']=="SHOW"){
				    ?>
                        <a href="vision_mission" class="dropdown-item" >Our Vision/Mission</a>
                        <?php } ?>
                         <a href="teaching_staff" class="dropdown-item">Teaching Staffs </a>
                        <a href="administrative_staff" class="dropdown-item">Administrative Staffs</a>
                    <a href="reg_aff" class="dropdown-item">Registration And Affiliation</a>
                    </div>
                </div>
                <a href="courses" class="nav-item nav-link">Courses</a>
               
                <!--<a href="certificate" class="nav-item nav-link">Certificate</a>-->
                 <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Student Zone</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="certificate" class="dropdown-item">Certificate Verify</a>
                        <a href="marksheet" class="dropdown-item">Marksheet Verify</a>
                        <a href="registration" class="dropdown-item">Registration</a>
                       
                        
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Branch</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="branch_list" class="dropdown-item">Branch List</a>
                        <a href="branch_apply" class="dropdown-item">New Branch Apply</a>
                        
                        <!--<a href="video_gallery" class="dropdown-item">Student Registration Form</a>-->
                        <!--<a href="video_gallery" class="dropdown-item">Bank Account Details</a>-->
                        
                    </div>
                </div>
                <!-- <div class="nav-item dropdown">-->
                <!--    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Teachers & Staffs</a>-->
                <!--    <div class="dropdown-menu fade-down m-0">-->
                <!--        <a href="teaching_staff" class="dropdown-item">Teaching Staffs </a>-->
                <!--        <a href="administrative_staff" class="dropdown-item">Administrative Staffs</a>-->
                       
                      
                        
                <!--    </div>-->
                <!--</div>-->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Gallery</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="photo_gallery" class="dropdown-item">Photo Gallery</a>
                        <a href="video_gallery" class="dropdown-item">Video Gallery</a>
                        
                    </div>
                </div>
                <a href="contact" class="nav-item nav-link">Contact</a>
                <a href="login" class="nav-item nav-link " >Login</a>
                
            </div>
            <!--<a href="login" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>-->
        </div>
    </nav>
    <!-- Navbar End -->
    
    <?php include"whatsapp.php"; ?> 
    <?php
    $section=1;
    if($section==2){ ?>
        <script language="JavaScript">
      
       window.onload = function () {
           document.addEventListener("contextmenu", function (e) {
               e.preventDefault();
           }, false);
           document.addEventListener("keydown", function (e) {
               //document.onkeydown = function(e) {
               // "I" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                   disabledEvent(e);
               }
               // "J" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                   disabledEvent(e);
               }
               // "S" key + macOS
               if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                   disabledEvent(e);
               }
               // "U" key
               if (e.ctrlKey && e.keyCode == 85) {
                   disabledEvent(e);
               }
               // "F12" key
              if (event.keyCode == 123) {
                  disabledEvent(e);
              }
           }, false);
           function disabledEvent(e) {
               if (e.stopPropagation) {
                   e.stopPropagation();
               } else if (window.event) {
                   window.event.cancelBubble = true;
               }
               e.preventDefault();
               return false;
           }
       }
//edit: removed ";" from last "}" because of javascript error

</script> 
  <?php  }
    ?>
 