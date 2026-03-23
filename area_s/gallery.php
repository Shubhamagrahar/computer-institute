<?php
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Gallery  |  <?php echo $brand_name; ?></title>
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
        
        .drop_a2{
        	background: #157daf !important;
        }
        
        .gallery1{
        	background: #157daf !important;
        }

            .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid {
                max-width: 100%;
            }
            
        .ekko-lightbox-container>div.ekko-lightbox-item {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
        }
        
        .fade:not(.show) {
            opacity: 0;
        }
        .fade {
            transition: opacity .15s linear;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .ekko-lightbox-nav-overlay {
            z-index: 1;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: -ms-flexbox;
            display: flex;
        }
        .ekko-lightbox-nav-overlay a {
            -ms-flex: 1;
            flex: 1;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            opacity: 0;
            transition: opacity .5s;
            color: #fff;
            font-size: 30px;
            z-index: 1;
        }
        .ekko-lightbox-nav-overlay a span {
            padding: 0 30px;
        }
        .ekko-lightbox-nav-overlay a>* {
            -ms-flex-positive: 1;
            flex-grow: 1;
        }
        .modal-content {
            margin-top: 50px;
        }
        [dir=ltr] .container, [dir=ltr] .page__container, [dir=ltr] .container-fluid {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
        }
        .image img {
            border: 1px solid lightgray;
            border-radius: 10px;
            width: 250px;
            height: 180px;
        }
        .image img:hover {
            transform: scale(1.04);
        }
        .image {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        [dir] .card-header {
            background-color: #303956;
        }
        [dir] .card-title {
            color: #ffffff;
        }
        
        [dir] .modal-dialog {
            margin: auto;
        }
        .ekko-lightbox-item img {
            padding: 20px;
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

              

                <div class="page-section bg-white border-bottom-2">

                    <div class="container page__container">
                        
                        
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
          
          <div class="col-12">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h4 class="card-title">SOME MOMENTS</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                                
                                <?php 
                                $sqlgallary=mysqli_query($con,"select * from gallery order by id desc");
                                while($row=mysqli_fetch_array($sqlgallary)){
                                ?>
                              
                              <div class="col-sm-3 image">
                                <a href="<?php echo $web_link.$row['img'] ;?>" data-toggle="lightbox" data-title="<?php echo $row['name'] ;?>" data-gallery="gallery">
                                  <img src="<?php echo $web_link.$row['img'] ;?>" class="img-fluid mb-2" alt="<?php echo $row['name'] ;?>"/>
                                </a>
                              </div>
                              <?php } ?>
                             
                            
                            </div>
                          </div>
                        </div>
          </div>
          
          
        </div>
      </div>
    </section>
    <!-- /.content -->
                        
                        
                    </div>

                </div>

                <?php include 'footer.php'; ?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>

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
        
        
        <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

    </body>

</html>