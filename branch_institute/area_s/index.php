<?php
include 'session.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard  |  <?php echo $brand_name; ?></title>
        
        <link href="<?php echo $brand_fav_logo; ?>" rel="icon">

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        
        
        
        <style>
        
/*        .drop_a1{*/
/*	background: #4f87cf !important;*/
/*}*/
/*.drop_a1 a, .drop_a1 span{*/
/*	color: #ffffff !important;*/
/*}*/

/*.select1{*/
/*	background: #303956 !important;*/
/*}*/

  .drop_a1 {
	background: #157daf !important;
}

.select1 { 
	background: #157daf !important;
}

.bg-purple{
      background-color: #9158dd !important; 
}

            .mdk-drawer-layout .container {
                max-width: 100%;
            }
        
    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      /*margin-top: 25px;*/
    }

    .card {
      display: flex;
      justify-content: space-between;
      /*align-items: center;*/
      background: linear-gradient(135deg, #4caf50, #66bb6a);
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      color: #fff;
      transition: transform 0.3s ease;
      position: relative;
      overflow: hidden;
      flex-direction: row;
      width: 70%;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card.yellow {
      background: linear-gradient(135deg, #fbc02d, #fdd835);
      color: #333;
    }

    .card.blue {
      background: linear-gradient(135deg, #2196f3, #42a5f5);
    }

    .card-icon {
      font-size: 3rem;
      opacity: 0.3;
    }

    .card-content h2 {
      font-size: 2rem;
      margin: 0;
    }

    .card-content p {
      margin: 5px 0 10px;
      font-size: 0.9rem;
      opacity: 0.9;
    }

    .card a {
      font-size: 0.9rem;
      color: inherit;
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .card {
        /*flex-direction: column;*/
        align-items: flex-start;
        padding: 10px;
      }
      .card-container {
          margin-top: 0;
      }

      .card-icon {
        align-self: flex-end;
      }
    }
    
    .heading {
    text-align: center;
    padding: 20px 20px;
    background-color: #f9f9f9; 
    border-radius: 12px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    /*box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);*/
}

.heading h4 {
    margin: 0;
    font-weight: bold;
    background: linear-gradient(90deg, #303956, #38a1f4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

@media(max-width: 768px) {
    [dir] .dropdown-menu.show, [dir] .show>.dropdown-menu {
        margin-left: -130px !important;
    }
}

.info-box {
    box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    border-radius: .25rem;
    background-color: #fff;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 1rem;
    min-height: 80px;
    padding: .5rem;
    position: relative;
    width: 100%;
}
.info-box .info-box-icon {
    border-radius: .25rem;
    -ms-flex-align: center;
    align-items: center;
    display: -ms-flexbox;
    display: flex;
    font-size: 1.875rem;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    width: 70px;
}
.info-box .info-box-content {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    line-height: 1.8;
    -ms-flex: 1;
    flex: 1;
    padding: 0 10px;
    overflow: hidden;
}
.info-box .info-box-text, .info-box .progress-description {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.info-box .info-box-number {
    display: block;
    margin-top: .25rem;
    font-weight: 700;
}

.info-box .info-box-number {
    display: block;
    margin-top: .25rem;
    font-weight: 700;
}

@media(max-width: 768px) {
    .info-box {
        width: 95%;
    }
    .card {
        width: 100%;
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


               <?php include 'top-navbar.php'; ?>

                <div class="heading">
                    
                    <?php 
                    if($login_details['bulk_aff']=="YES"){
                        echo "(Bulk Affiliater)";
                    }
                    ?>
            
                    <h4>Hi, <?php echo $login_details['name'];?></h4>
                    <!--<h4>Demo</h4>-->
                    <h4 id="greeting" >Good Evening</h4>
                    
                </div>


                <div class="container page__container">   
                    
                    
                    <div class="card-container">
                        <!-- Balance Card -->
                        <div class="card">
                          <div class="card-content">
                            <h2><?php echo $login_wallet['main_b']; ?></h2>
                            <p>Balance</p>
                            <a href="transaction_main">More info →</a>
                          </div>
                          <div class="card-icon"><i class="fa fa-rupee"></i></div>
                        </div>
                        
                        <?php
                           if($login_details['bulk_aff']=="NO"){
                          ?>
                         
                          <!-- ./col -->
                          <?php }
                   
                        
                        $total_runing_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and (status='OPEN' or status='RUN')"));
                        if($login_details['bulk_aff']=="NO"){
                        ?>
        
                    
                        <!-- Total Running Courses Card -->
                        <div class="card yellow">
                          <div class="card-content">
                            <h2><?php echo $total_runing_course ; ?></h2>
                            <p>Total Running Course</p>
                            <a href="course_running">More info →</a>
                          </div>
                          <div class="card-icon"><i class="fa fa-book"></i></div>
                        </div>
                        
                        <?php  } 
                        
                        if($login_details['bulk_aff']=="YES1"){
                         $global_affiliate=mysqli_num_rows(mysqli_query($con,"select * from user where bulk_aff_id='$_SESSION[userid]' "));
                        ?>
                        
                    
                        <!-- Example Additional Card -->
                        <div class="card blue">
                          <div class="card-content">
                            <h2><?php echo $global_affiliate ; ?></h2>
                            <p>Global Affilates</p>
                            <a href="course_affiliate_global">More info →</a>
                          </div>
                          <div class="card-icon"><i class="fa fa-users"></i></div>
                        </div>
                        
                        <?php  } ?>
                        
                        
                        <?php
  
                            $total_affiliate=mysqli_num_rows(mysqli_query($con,"select * from user where aff_by_id='$_SESSION[userid]' "));
                            if($login_details['bulk_aff']=="NO1"){
                            ?>
                        
                        <div class="card bg-purple">
                          <div class="card-content">
                            <h2><?php echo $total_affiliate; ?></h2>
                            <p><?php
                                 if($login_details['bulk_aff']=="YES"){
                                    echo "Direct" ;
                                   
                                 }else{
                                     echo "Total";
                                 }
                                ?> Affilates </p>
                            <a href="course_affiliate">More info →</a>
                          </div>
                          <div class="card-icon"><i class="fa fa-users"></i></div>
                        </div>
                        
                        <?php } ?>
                        
                      </div>
                    

                    
                </div>
                
                
                <?php 
     if($login_details['bulk_aff']=="NO1"){
    ?>
    <section class="content">
        <div class="row">
          <!-- /.info-box start-->  
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            
          </div>
          <!-- /.info-box end-->
          <!-- /.info-box start-->
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-handshake-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Your Affiliate Link</span>
                <span class="info-box-number"><input type="text" id="myInput" readonly value="<?php echo "https://edug.in/registration?ref_data=".$login_details['aff_code']; ?>" class="form-control"></span>
                <span class="info-box-number"><button class="btn btn-success" onclick="myFunction23()">Copy</button></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </div>
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            
            
          </div>
           <!-- /.info-box end--> 
        </div>
    </section>
   <?php 
  } 
   ?>

                <?php include 'footer.php'; ?>


            </div>


            <?php include 'left-navbar.php';?>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->
        
        
        <script>
          const hour = new Date().getHours();
          let greeting = "Hello";
        
          if (hour < 12) greeting = "Good Morning";
          else if (hour < 17) greeting = "Good Afternoon";
          else greeting = "Good Evening";
        
          document.getElementById("greeting").innerText = greeting;
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

        <!-- Global Settings -->
        <script src="public/js/settings.js"></script>

        <!-- Flatpickr -->
        <script src="public/vendor/flatpickr/flatpickr.min.js"></script>
        <script src="public/js/flatpickr.js"></script>

        <!-- Moment.js -->
        <script src="public/vendor/moment.min.js"></script>
        <script src="public/vendor/moment-range.js"></script>

        <!-- Chart.js -->
        <script src="public/vendor/Chart.min.js"></script>
        <script src="public/js/chartjs.js"></script>

        <!-- Chart.js Samples -->
        <script src="public/js/page.student-dashboard.js"></script>

        <!-- List.js -->
        <script src="public/vendor/list.min.js"></script>
        <script src="public/js/list.js"></script>

        <!-- Tables -->
        <script src="public/js/toggle-check-all.js"></script>
        <script src="public/js/check-selected-row.js"></script>
        
        <script>
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

    </body>

</html>