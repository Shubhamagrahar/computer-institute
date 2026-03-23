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
        <title>Book Course |  <?php echo $brand_name; ?></title>
        
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
  
        
        <style type="text/css">
     
        .drop_course{
        	background: #157daf !important;
        }
        
        .course_book{
        	background: #157daf !important;
        }
            .card-group-row__col:hover {
                background-color: #00000000;
            }
    .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid {
        max-width: 100%;
    }
    .card-header {
        background-color: #303956 !important;
        height: 70px;
        text-align: center;
    }
    .card-title {
        color: #ffffff;
    }
    .btn-outline-success {
        color: #303956;
    }
    [dir] .btn-outline-success {
        border-color: #303956;
    }
    [dir] .btn-outline-success:hover {
        background-color: #303956;
        border-color: #303956;
    }
    [dir] .btn-success:hover {
        background-color: #303956;
        border-color: #303956;
    }
    [dir] .btn-success {
        background-color: #303956;
        border-color: #303956;
        box-shadow: inset 0 1px 0 hsla(0, 0%, 100%, .15), 0 1px 1px rgba(39, 44, 51, .075);
    }

.simple-modal {
  display: none;
  position: fixed; /* fixed to viewport */
  z-index: 10000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  pointer-events: none; /* disables background click unless modal is open */
}

.simple-modal.active {
  display: block;
  pointer-events: auto;
}

.simple-modal-content {
  position: absolute; /* Changed from fixed */
  left: 50%;
  transform: translateX(-50%); /* only horizontal centering */
  background-color: #fff;
  padding: 25px;
  border-radius: 10px;
  width: 90%;
  max-width: 800px;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
  max-height: 90vh;
  overflow-y: auto;
}
.close-modal {
  position: absolute;
  top: 0px;
  right: 20px;
  font-size: 28px;
  font-weight: bold;
  color: #888;
  cursor: pointer;
}

.close-modal:hover {
  color: #000;
}
.swal2-actions {
    gap: 10px;
}
.card-header {
    display: flex;
    align-items: center;
    justify-content: center;
}
.simple-modal-content h5 {
    color: #303956;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 0;
    text-align: center;
    margin-top: -15px;
}
[dir] hr {
    border-top: 2px solid #303956 !important;
}
.card-body img{
    width: 330px;
}
 @media (max-width:768px) {
     .card-body img {
         width: 212px;
     }
     .mdk-drawer-layout .container-fluid {
         padding-left: 10px !important;
         padding-right: 10px !important;
     }
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
                            <h1 class="h2 mb-0">Book Course</h1>
                            <!--<p class="text-breadcrumb">Account Management</p>-->
                        </div>
                        
                    </div>
                </div>

                <div class="page-section">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Book Course</div>
                        </div>
                        
                        
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
                
            <?php 
            
            $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
            while($row=mysqli_fetch_array($sql_course)){
                
            ?>
            
            <div class="col-md-4">
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"><?php echo $row['name'] ?></h3>
              </div>
              <!-- /.card-header -->
             
              
                <div class="card-body">
                  <div class="row" style="justify-content: center;">
				 <div >
				     <img  height="185px" style="border: 1px solid #303956; margin-bottom: 10px;" src="<?php echo $web_link.$row['img'] ?>">
				 </div>
				
					 <div class="col-md-12">
					     <p style="text-align:center;font-size: 18px; margin-bottom: 10px;">Course Code: <strong> <?php echo $row['course_code']; ?></strong></p>
					 </div>
					 <div class="col-md-12">
					     <p style="text-align:center;font-size: 18px; margin-bottom: 10px;">Duration: <strong> <?php echo $row['duration']; ?> Month</strong> </p>
					 </div>
					 <div class="col-md-12" align="center" style="margin-bottom: -8px;"><h5>Total Fees : </h5></div>
					 <div class="col-md-12" align="center">
					     <h5 style="font-weight: 700; font-family: 'Frank Ruhl Libre', serif; margin-bottom: 0;">Rs.<del><?php echo ($row['duration']*600)-1; ?>.00</del></h5>
					     <h3 style="color: #303956; font-weight: 700; font-family: 'Frank Ruhl Libre', serif;">Rs: <?php echo $row['fee']; ?></h3>
					 </div>
                        <div class="col-md-12" align="center">
                          <!--<button type="button" class="btn btn-block btn-outline-success btn-flat" data-toggle="modal" data-target="#desModal<?php echo $row['id']; ?>">-->
                          <!--  View Details-->
                          <!--</button>-->
                          <button type="button" class="btn btn-block btn-outline-success btn-flat" onclick="openModal('simpleModal<?php echo $row['id']; ?>')">
                                View Details
                            </button>
                        </div>
                        
                        
                        <!-- Simple Custom Modal -->
                            <div id="simpleModal<?php echo $row['id']; ?>" class="simple-modal">
                              <div class="simple-modal-content">
                                <span class="close-modal" onclick="closeModal('simpleModal<?php echo $row['id']; ?>')">&times;</span>
                                <h5><?php echo $row['name'] ?> </h5>
                                <hr>
                                <div class="modal-body">
                                  <?php echo $row['des']; ?>
                                </div>
                              </div>
                            </div>

				 </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="center">
                  <button type="button" class="btn btn-success" onclick="confirmEnroll('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>')">Enroll Now</button>
                </div>

              
            </div>
            </div>
            
          <?php } ?>
            
            <script>
                function show_des_function(val,val1){
                    document.getElementById(val).style.display="block";
                    document.getElementById(val1).style.display="none";
                }
                function hide_des_function(val,val1){
                    document.getElementById(val).style.display="none";
                    document.getElementById(val1).style.display="block";
                }
            </script>
          </div>
        </div>
     </section>
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
        
        <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>



<script>
  function confirmEnroll(bookId, bookName) {
    Swal.fire({
      title: 'Are you sure?',
      text: `Do you want to enroll in "${bookName}"?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, enroll me!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'course_book?book=' + bookId;
      }
    });
  }

</script>

<script>
function openModal(id) {
  const modal = document.getElementById(id);
  const content = modal.querySelector('.simple-modal-content');

  // Show the modal
  modal.classList.add('active');

  // Lock background scroll
  document.body.style.overflow = 'hidden';

  // Scroll-aware positioning
  const scrollY = window.scrollY || document.documentElement.scrollTop;
  content.style.top = (scrollY + window.innerHeight / 2) + 'px';
  content.style.transform = 'translate(-50%, -50%)';
}

function closeModal(id) {
  document.getElementById(id).classList.remove('active');
  document.body.style.overflow = '';
}

// Optional: Close modal on outside click
window.onclick = function(event) {
  const modals = document.getElementsByClassName('simple-modal');
  for (let i = 0; i < modals.length; i++) {
    if (event.target === modals[i]) {
      modals[i].classList.remove('active');
      document.body.style.overflow = '';
    }
  }
}
</script>


    </body>
</html>