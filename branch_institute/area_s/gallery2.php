<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Gallery-2</title>

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
            margin-top: 150px;
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

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <?php include 'top-navbar.php'; ?>

                <!-- // END Header -->

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->



                <!--<div class="page-section border-bottom-2">-->
                <!--    <div class="container page__container">-->

                <!--        <div class="page-separator">-->
                <!--            <div class="page-separator__text">Table of Contents</div>-->
                <!--        </div>-->
                        
                        
                  
                        
                        
                <!--    </div>-->
                <!--</div>-->

                <div class="page-section bg-white border-bottom-2">

                    <div class="container page__container">
                        
                        
                        <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
          <!--<div class="col-12">-->
          <!--  <div class="card card-primary">-->
          <!--    <div class="card-header">-->
          <!--      <h4 class="card-title">FilterizR Gallery with Ekko Lightbox</h4>-->
          <!--    </div>-->
          <!--    <div class="card-body">-->
          <!--      <div>-->
          <!--        <div class="btn-group w-100 mb-2">-->
          <!--          <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>-->
          <!--          <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Category 1 (WHITE) </a>-->
          <!--          <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Category 2 (BLACK) </a>-->
          <!--          <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Category 3 (COLORED) </a>-->
          <!--          <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Category 4 (COLORED, BLACK) </a>-->
          <!--        </div>-->
          <!--        <div class="mb-2">-->
          <!--          <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>-->
          <!--          <div class="float-right">-->
          <!--            <select class="custom-select" style="width: auto;" data-sortOrder>-->
          <!--              <option value="index"> Sort by Position </option>-->
          <!--              <option value="sortData"> Sort by Custom Data </option>-->
          <!--            </select>-->
          <!--            <div class="btn-group">-->
          <!--              <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>-->
          <!--              <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>-->
          <!--            </div>-->
          <!--          </div>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--      <div>-->
          <!--        <div class="filter-container p-0 row">-->
          <!--          <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white">-->
          <!--              <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">-->
          <!--            <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black">-->
          <!--              <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red">-->
          <!--              <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red">-->
          <!--              <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2" alt="red sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">-->
          <!--            <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox" data-title="sample 5 - black">-->
          <!--              <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox" data-title="sample 6 - white">-->
          <!--              <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox" data-title="sample 7 - white">-->
          <!--              <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">-->
          <!--            <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black">-->
          <!--              <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red">-->
          <!--              <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox" data-title="sample 10 - white">-->
          <!--              <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">-->
          <!--            <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox" data-title="sample 11 - white">-->
          <!--              <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--          <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">-->
          <!--            <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black">-->
          <!--              <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample"/>-->
          <!--            </a>-->
          <!--          </div>-->
          <!--        </div>-->
          <!--      </div>-->

          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          
          <div class="col-12">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h4 class="card-title">SOME MOMENTS</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              
                              <div class="col-sm-3 image">
                                <a href="public/images/gallery-image1.jpg" data-toggle="lightbox" data-title="Image-1" data-gallery="gallery">
                                  <img src="public/images/gallery-image1.jpg" class="img-fluid mb-2" alt="Image-1"/>
                                </a>
                              </div>
                              
                              <div class="col-sm-3 image">
                                <a href="public/images/gallery-image2.jpg" data-toggle="lightbox" data-title="Image-2" data-gallery="gallery">
                                  <img src="public/images/gallery-image2.jpg" class="img-fluid mb-2" alt="Image-2"/>
                                </a>
                              </div>
                              <div class="col-sm-3 image">
                                <a href="public/images/gallery-image3.jpg" data-toggle="lightbox" data-title="Image-3" data-gallery="gallery">
                                  <img src="public/images/gallery-image3.jpg" class="img-fluid mb-2" alt="Image-3"/>
                                </a>
                              </div>
                              <div class="col-sm-3 image">
                                <a href="public/images/gallery-image4.jpg" data-toggle="lightbox" data-title="Image-4" data-gallery="gallery">
                                  <img src="public/images/gallery-image4.jpg" class="img-fluid mb-2" alt="Image-4"/>
                                </a>
                              </div>
                              <div class="col-sm-3 image">
                                <a href="public/images/gallery-image5.jpg" data-toggle="lightbox" data-title="Image-5" data-gallery="gallery">
                                  <img src="public/images/gallery-image5.jpg" class="img-fluid mb-2" alt="Image-5"/>
                                </a>
                              </div>
                              <div class="col-sm-3 image">
                                <a href="public/images/gallery-image6.jpg" data-toggle="lightbox" data-title="Image-6" data-gallery="gallery">
                                  <img src="public/images/gallery-image6.jpg" class="img-fluid mb-2" alt="Image-6"/>
                                </a>
                              </div>
                            
                            </div>
                          </div>
                        </div>
                      </div>
          
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
                        
                        
                    </div>

                </div>

            

                <!-- // END Page Content -->

                <!-- Footer -->

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