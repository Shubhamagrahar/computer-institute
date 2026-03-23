
<style>
    .input-group {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 60%;
}
@media screen and (max-width: 1024px) {
  .input-group {
   display:none;
}
}
@media screen and (max-width: 768px) {
  .input-group {
   display:none;
}
}
@media screen and (max-width: 425px) {
  .input-group {
   display:none;
}
}
@media screen and (max-width: 375px) {
  .input-group {
   display:none;
}
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo $brand_fav_logo; ?>" alt="Loading..." height="100px" width="100px">
  </div>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

 <div class="input-group" style="background-color:white;">
                 <marquee width="100%" direction="left" height="50px">
					 <h4>
		</h4><h4><strong><span style="color: #FF9933;"></span><?php echo $web_details['name']; ?></strong></h4>
	</marquee>
   </div>
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
          <a class="nav-link" data-toggle="dropdown" style="margin-top: -13px;" href="#"><span><?php echo $login_details['short_name'];?></span>
        
            <img style="border: 1px solid black; width: 40px; height: 40px; border-radius: 25px;" src="<?php echo $brand_logo; ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 210px;">
          <span class="dropdown-item dropdown-header"><strong><?php echo $login_details['short_name'];?></strong></span>
          <div class="dropdown-divider"></div>
          <a href="change_password" class="dropdown-item"><i class="fa fa-user mr-2"></i>Change Passowrd</a>
          <!--<div class="dropdown-divider"></div>-->
          <!--<a href="contact_us" class="dropdown-item"><i class="fa fa-contact mr-2"></i>Contact Us</a>-->
          <!--<a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">-->
          <!--   <i class="fas fa-cog"></i> Setting</a>-->
          <div class="dropdown-divider"></div>
          <a href="logout" class="dropdown-item"><i class="fa fa-sign-out mr-2"></i>Logout</a>
         
         
        </div>
      </li>
    
    </ul>
  </nav>