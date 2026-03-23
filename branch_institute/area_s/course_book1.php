<?php
include 'session.php'; 

if($login_details['bulk_aff']=="YES"){
    echo '<script>window.location.assign("index");</script>';
}

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['book'])){
    $course_id=VerifyData($_GET['book']);
    if(!$course_id==""){
        $check_course=mysqli_query($con,"select * from course_details where id='$course_id' and status='OPEN'");
        if(mysqli_num_rows($check_course)==1){
         $course_details=mysqli_fetch_array($check_course);
          $chek_pre_booking=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and course_id='$course_id' and status!='CANCEL'"));
          if(!$chek_pre_booking>0){
            
            $insert_course_book=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$_SESSION[userid]', '$course_id', '$course_details[fee]', '$t_date')");
            if($insert_course_book){
             
                   echo '<script>alert("Course enrollment successfully done.");window.location.assign("course_running");</script>'; 
               
                
            }else{
             echo '<script>alert("Server error 101.");window.location.assign("course_book");</script>';     
            } 
              
          }else{
            echo '<script>alert("Hello dear, You have already done this course.");window.location.assign("course_book");</script>';  
          }
            
        }else{
          echo '<script>alert("Course not found or not active.");window.location.assign("course_book");</script>';   
        }
    }else{
       echo '<script>alert("Somthing Went wrong.");window.location.assign("course_book");</script>'; 
    }
} 
 
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Course Book |  <?php echo $brand_name; ?></title>
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
        
        .drop_course{
        	background: #157daf !important;
        }
        
        .course_book{
        	background: #157daf !important;
        }
            .card-group-row__col:hover {
                background-color: #00000000;
            }
.card-group-row__col:hover .hover-overlay {
    opacity: 1;
    visibility: visible;
    display: flex;
    flex-direction: column;
}
.hover-overlay h2 {
    font-size: 22px;
    color: white;
}
.hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 123, 255, 0.5); 
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
    z-index: 2;
}

/* Button style */
.view-details-btn {
    z-index: 3;
    font-weight: bold;
}
[dir] .overlay--primary-dodger-blue.overlay--show .overlay__content {
    /*height: 164px;*/
}

.content {
    height: 180px;
    overflow-y: scroll;
}
.course-card {
    /*display: block !important;*/
}

  .mdk-reveal__content {
      z-index: 1;
  }
  [dir] .mdk-reveal__content {
    background-color: #fff;
    /*width: 18%;*/
    border-bottom-left-radius: 5%;
    border-bottom-right-radius: 5%;
    /* display: block; */
    margin-top: -5px;
    /* z-index: 1111; */
    position: relative;
    transform: none !important;
}
.card-group-row__card {
    height: 245px !important;
}
.js-image {
    height: 168px !important;
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


                <div class="page-section">
                    <div class="container page__container">
                        
                        
                        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Book Course</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./">Courses</a></li>

                                    <li class="breadcrumb-item active"> Book Courses </li>

                                </ol>

                            </div>
                        </div>
                        
                        

                        <div class="page-separator">
                            <div class="page-separator__text">Popular Courses</div>
                        </div>

                        <div class="row card-group-row">

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                     
                                     
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/mailchimp_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                           <h2>Newsletter Design</h2>
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                       href="student-course">Newsletter Design</a>
                                                       <div class="d-flex" style="justify-content: space-between;">
                                                           <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                            <small class="text-50">6 hours</small>
                                                        </div>
                                                    
                                                </div>
                                                <a href="student-course"
                                                   data-toggle="tooltip"
                                                   data-title="Remove Favorite"
                                                   data-placement="top"
                                                   data-boundary="window">
                                                   </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/mailchimp_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Newsletter Design</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                     
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/xd_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                       href="student-course">Adobe XD</a>
                                                       <div class="d-flex" style="justify-content:space-between;">
                                                           <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                            <small class="text-50">6 hours</small>
                                                        </div>
                                                    
                                                </div>
                                                <a href="student-course"
                                                   data-toggle="tooltip"
                                                   data-title="Add Favorite"
                                                   data-placement="top"
                                                   data-boundary="window"></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/xd_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Adobe XD</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                   
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/invision_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    

                                    <div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                       href="student-course">inVision App</a>
                                                       <div class="d-flex" style="justify-content:space-between;">
                                                            <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                            <small class="text-50">6 hours</small>
                                                        </div>
                                                    
                                                </div>
                                                <a href="student-course"
                                                   data-toggle="tooltip"
                                                   data-title="Add Favorite"
                                                   data-placement="top"
                                                   data-boundary="window"></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/invision_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">inVision App</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                    
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/craft_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                       href="student-course">Craft by inVision</a>
                                                       <div class="d-flex" style="justify-content:space-between;">
                                                            <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                            <small class="text-50">6 hours</small>
                                                        </div>
                                                </div>
                                                <a href="student-course"
                                                   data-toggle="tooltip"
                                                   data-title="Add Favorite"
                                                   data-placement="top"
                                                   data-boundary="window"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/craft_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Craft by inVision</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                     
                                     
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/mailchimp_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                       href="student-course">Newsletter Design</a>
                                                       <div class="d-flex" style="justify-content: space-between;">
                                                            <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                            <small class="text-50">6 hours</small>
                                                        </div>
                                                </div>
                                                <a href="student-course"
                                                   data-toggle="tooltip"
                                                   data-title="Remove Favorite"
                                                   data-placement="top"
                                                   data-boundary="window">
                                                   </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/mailchimp_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Newsletter Design</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                     
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/invision_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    

                                    <div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                       href="student-course">inVision App</a>
                                                    <div class="d-flex" style="justify-content:space-between;">
                                                            <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                            <small class="text-50">6 hours</small>
                                                        </div>
                                                </div>
                                                <a href="student-course"
                                                   data-toggle="tooltip"
                                                   data-title="Add Favorite"
                                                   data-placement="top"
                                                   data-boundary="window"></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/invision_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">inVision App</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="mb-32pt">

                            <ul class="pagination justify-content-start pagination-xsm m-0">
                                <li class="page-item prev disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                                        <span>Prev</span>
                                    </a>
                                </li>
                                <li class="page-item num active1" data-page="1">
                                    <a class="page-link" href="#" aria-label="Page 1"><span>1</span></a>
                                </li>
                                <li class="page-item num" data-page="2">
                                    <a class="page-link" href="#" aria-label="Page 2" ><span>2</span></a>
                                </li>
                                <li class="page-item next">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                                    </a>
                                </li>
                            </ul>


                        </div>

                        <div class="page-separator">
                            <div class="page-separator__text">Development Courses</div>
                        </div>

                        <div class="row card-group-row">

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item2 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/angular_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                   

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Angular fundamentals</a>
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/angular_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Angular fundamentals</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item2 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/swift_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Build an iOS Application in Swift</a>
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                                
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/swift_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Build an iOS Application in Swift</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item2 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/wordpress_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Build a WordPress Website</a>
                                                <div class="d-flex" style="justify-content: space-between;">
                                                    <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                    <small class="text-50">6 hours</small>
                                                </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/wordpress_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Build a WordPress Website</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item2 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="left">
                                        
                                       <img src="public/images/paths/react_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Become a React Native Developer</a>
                                                   
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/react_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Become a React Native Developer</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item2 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/swift_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Build an iOS Application in Swift</a>
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                                
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/swift_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Build an iOS Application in Swift</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item2 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/angular_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                   

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Angular fundamentals</a>
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/angular_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Angular fundamentals</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        
                        <div class="mb-32pt">

                            <ul class="pagination page2 justify-content-start pagination-xsm m-0">
                                <li class="page-item prev prev2 disabled2">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                                        <span>Prev</span>
                                    </a>
                                </li>
                                <li class="page-item num num2 active2" data-page="1">
                                    <a class="page-link" href="#" aria-label="Page 1"><span>1</span></a>
                                </li>
                                <li class="page-item num num2" data-page="2">
                                    <a class="page-link" href="#" aria-label="Page 2"><span>2</span></a>
                                </li>
                                <li class="page-item next next2">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                                    </a>
                                </li>
                            </ul>



                        </div>


                        <div class="page-separator">
                            <div class="page-separator__text">Design Courses</div>
                        </div>

                        <div class="row card-group-row">

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item3 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/sketch_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Sketch</a>
                                                <div class="d-flex" style="justify-content: space-between;">
                                                    <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                    <small class="text-50">6 hours</small>
                                                </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/sketch_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Sketch</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item3 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/flinto_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Flinto</a>
                                                   
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/flinto_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Flinto</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item3 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/photoshop_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Photoshop</a>
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/photoshop_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Photoshop</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col  course-card-item3 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/figma_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Figma</a>
                                                   
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/figma_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Figma</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item3 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/photoshop_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Photoshop</a>
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/photoshop_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Photoshop</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col course-card-item3 course-card">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">
                                    
                                    <a href="javascript:void(0);"
                                       class="js-image overlay-hover"
                                       data-position="">
                                       <img src="public/images/paths/flinto_430x168.png" alt="course">
                                       <span class="overlay__content align-items-center justify-content-center hover-overlay">
                                          <button class="btn btn-light btn-sm view-details-btn" type="button">View Details</button>
                                       </span>
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course">Learn Flinto</a>
                                                   
                                                   <div class="d-flex" style="justify-content: space-between;">
                                                        <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                                        <small class="text-50">6 hours</small>
                                                    </div>
                                            </div>
                                            <a href="student-course"
                                               data-toggle="tooltip"
                                               data-title="Add Favorite"
                                               data-placement="top"
                                               data-boundary="window"></a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="public/images/paths/flinto_40x40%402x.png"
                                                 width="40"
                                                 height="40"
                                                 alt="Angular"
                                                 class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">Learn Flinto</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">with</span>
                                                <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="content">

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>
    
                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="student-course"
                                               class="btn btn-primary">Enroll Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="mb-32pt">

                            <ul class="pagination page3 justify-content-start pagination-xsm m-0">
                                <li class="page-item prev prev3 disabled3">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                                        <span>Prev</span>
                                    </a>
                                </li>
                                <li class="page-item num num3 active3" data-page3="1">
                                    <a class="page-link" href="#" aria-label="Page 1"><span>1</span></a>
                                </li>
                                <li class="page-item num num3" data-page3="2">
                                    <a class="page-link" href="#" aria-label="Page 2"><span>2</span></a>
                                </li>
                                <li class="page-item next next3">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                                    </a>
                                </li>
                            </ul>

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
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap popovers if not already initialized
    $('[data-toggle="popover"]').popover({
        html: true,
        container: 'body',
        trigger: 'manual',
        content: function () {
            return $(this).closest('.card').next('.popoverContainer').html();
        }
    });

    // Handle click on view-details button
    document.querySelectorAll('.view-details-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            const card = this.closest('.card');
            $('[data-toggle="popover"]').popover('hide'); 
            $(card).popover('show');
        });
    });
});
</script>



<script>
(function() {
  const cards = document.querySelectorAll('.course-card-item');
  const itemsPerPage = 4;
  let currentPage = 1;
  const totalPages = Math.ceil(cards.length / itemsPerPage);

  function showPage(page) {
    if (page < 1 || page > totalPages) return;
    currentPage = page;

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    cards.forEach((card, i) => {
      card.style.display = (i >= start && i < end) ? '' : 'none';
    });

    document.querySelectorAll('.pagination .num').forEach(li => {
      li.classList.toggle('active', parseInt(li.dataset.page) === currentPage);
    });

    document.querySelector('.pagination .prev').classList.toggle('disabled', currentPage === 1);
    document.querySelector('.pagination .next').classList.toggle('disabled', currentPage === totalPages);
  }

  document.querySelector('.pagination').addEventListener('click', function(e) {
    e.preventDefault();
    const target = e.target.closest('a');
    if (!target) return;
    const li = target.closest('li');
    if (li.classList.contains('disabled')) return;

    if (li.classList.contains('prev')) {
      showPage(currentPage - 1);
    } else if (li.classList.contains('next')) {
      showPage(currentPage + 1);
    } else if (li.classList.contains('num')) {
      const page = parseInt(li.dataset.page);
      showPage(page);
    }
  });

  showPage(1);
})();
</script>

<script>
(function() {
  const cards2 = document.querySelectorAll('.course-card-item2');
  const itemsPerPage2 = 4;
  let currentPage2 = 1;
  const totalPages2 = Math.ceil(cards2.length / itemsPerPage2);

  function showPage(page) {
    if (page < 1 || page > totalPages2) return;
    currentPage2 = page;

    const start2 = (currentPage2 - 1) * itemsPerPage2;
    const end2 = start2 + itemsPerPage2;

    cards2.forEach((card, i) => {
      card.style.display = (i >= start2 && i < end2) ? '' : 'none';
    });

    document.querySelectorAll('.page2 .num2').forEach(li => {
      li.classList.toggle('active', parseInt(li.dataset.page) === currentPage2);
    });

    document.querySelector('.page2 .prev2').classList.toggle('disabled2', currentPage2 === 1);
    document.querySelector('.page2 .next2').classList.toggle('disabled2', currentPage2 === totalPages2);
  }

  document.querySelector('.page2').addEventListener('click', function(e) {
    e.preventDefault();
    const target = e.target.closest('a');
    if (!target) return;
    const li = target.closest('li');
    if (li.classList.contains('disabled2')) return;

    if (li.classList.contains('prev2')) {
      showPage(currentPage2 - 1);
    } else if (li.classList.contains('next2')) {
      showPage(currentPage2 + 1);
    } else if (li.classList.contains('num2')) {
      const page = parseInt(li.dataset.page);
      showPage(page);
    }
  });

  showPage(1);
})();
</script>

<script>
(function() {
  const cards3 = document.querySelectorAll('.course-card-item3');
  const itemsPerPage3 = 4;
  let currentPage3 = 1;
  const totalPages3 = Math.ceil(cards3.length / itemsPerPage3);

  function showPage3(page3) {
    if (page3 < 1 || page3 > totalPages3) return;
    currentPage3 = page3;

    const start3 = (currentPage3 - 1) * itemsPerPage3;
    const end3 = start3 + itemsPerPage3;

    cards3.forEach((card, i) => {
      card.style.display = (i >= start3 && i < end3) ? '' : 'none';
    });

    document.querySelectorAll('.page3 .num3').forEach(li => {
      li.classList.toggle('active', parseInt(li.dataset.page3) === currentPage3);
    });

    document.querySelector('.page3 .prev3').classList.toggle('disabled3', currentPage3 === 1);
    document.querySelector('.page3 .next3').classList.toggle('disabled3', currentPage3 === totalPages3);
  }

  document.querySelector('.page3').addEventListener('click', function(e) {
    e.preventDefault();
    const target = e.target.closest('a');
    if (!target) return;
    const li = target.closest('li');
    if (li.classList.contains('disabled3')) return;

    if (li.classList.contains('prev3')) {
      showPage3(currentPage3 - 1);
    } else if (li.classList.contains('next3')) {
      showPage3(currentPage3 + 1);
    } else if (li.classList.contains('num3')) {
      const page3 = parseInt(li.dataset.page3);
      showPage3(page3);
    }
  });

  showPage3(1);
})();
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