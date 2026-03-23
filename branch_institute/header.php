<?php
// include 'assets.php'; 

// include 'con.php';

// Fetch header background and text color
$query = mysqli_query($con, "SELECT header_bg_color, header_text_color, button_bg_color, button_text_color  FROM website_data LIMIT 1");
$color_data = mysqli_fetch_assoc($query);

$header_bg_color = $color_data['header_bg_color'] ?? '#ffffff'; // Default white background
$header_text_color = $color_data['header_text_color'] ?? '#000000'; // Default black text
$button_bg_color = $color_data['button_bg_color'] ?? '#000000';
$button_text_color = $color_data['button_text_color'] ?? '#ffffff';


?>

<style>
    .navbar-nav .nav-link,
    .navbar-brand h2,
    .dropdown-menu a {
        color: <?php echo $header_text_color; ?> !important;
    }

    .navbar-nav .nav-link:hover,
    .dropdown-menu a:hover {
        color: <?php echo $header_text_color; ?>;
        text-decoration: underline;
    }

    .dropdown-menu {
        background-color: <?php echo $header_bg_color; ?>;
    }
    .btn.btn-primary {
        background-color: <?php echo $button_bg_color; ?> !important;
        color: <?php echo $button_text_color; ?>;
    }
</style>



<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0" style="background-color: <?php echo $header_bg_color; ?> !important; color: <?php echo $header_text_color; ?>;">
        <a href="./" class="navbar-brand d-flex align-items-center  px-lg-5">
            <h2 class="m-0 text-golden"><i class=""><img src="<?php echo $brand_logo?>" width="<?php echo $brand_logo_width?>" height="95px"></i></h2>
        </a>
        <button type="button" class="navbar-toggler me-4 toggler-right" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="./" class="nav-item nav-link">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="about" class="dropdown-item">About Us</a>
                        <?php
                        $check = mysqli_fetch_array(mysqli_query($con, "select status from web_director_message where id='1'"))['status'];
                        if($check == 'SHOW'){
                        ?>
                        <a href="director" class="dropdown-item">Director Message</a>
                        <?php } ?>
                        <a href="mission_vission" class="dropdown-item">Mission/Vission</a>
                        
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Staff</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="teacher" class="dropdown-item">Teacher Staff</a>
                        <a href="administrative" class="dropdown-item">Administrative Staff</a>
                        
                    </div>
                </div>
                <!--<a href="courses" class="nav-item nav-link">Courses</a>-->
                
                <div class="nav-item dropdown">
                    
                    
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Courses </a>
                    <div class="dropdown-menu fade-down m-0">
                        
                        <?php
                         $sql=mysqli_query($con,"select * from course_type where status='SHOW'");
                        while($row=mysqli_fetch_array($sql)){
                        ?>
                        
                        <a href="courses?course_type_id=<?php echo $row['id'];?>" class="dropdown-item"> <?php echo $row['name'];?> </a>
                        <?php } ?>
                        
                        
                    </div>
                </div>
                
                
                <!--<a href="registration" class="nav-item nav-link">Student Registration</a>-->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Student </a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="certificate-verification" class="dropdown-item"> Certificate Verification</a>
                        <a href="marksheet-verification" class="dropdown-item"> Marksheet Verification</a>
                        <a href="student-verification" class="dropdown-item"> Student Verification</a>
                        <a href="registration" class="dropdown-item"> Student Registration</a>
                        <a href="exam" class="dropdown-item"> Student Exam</a>
                        <a href="other-link" class="dropdown-item"> Other Link</a>
                        
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Gallery</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="photo_gallery" class="dropdown-item">Photo Gallery</a>
                        <a href="video" class="dropdown-item">Video Gallery</a>
                        
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Branch</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="branch_list" class="dropdown-item">Branch List</a>
                        <a href="branch_apply" class="dropdown-item">New Branch Apply</a>
                        
                    </div>
                </div>
                
                <!--<div class="nav-item dropdown">-->
                <!--    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>-->
                <!--    <div class="dropdown-menu fade-down m-0">-->
                <!--        <a href="team" class="dropdown-item">Our Team</a>-->
                <!--        <a href="testimonial" class="dropdown-item">Testimonial</a>-->
                <!--        <a href="gallery" class="dropdown-item">Gallery</a>-->
                <!--        <a href="404" class="dropdown-item">Events</a>-->
                <!--    </div>-->
                <!--</div>-->
                <a href="contact" class="nav-item nav-link">Contact</a>
            </div>
            <a href="login" class="btn btn-primary py-4 px-lg-5 d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>