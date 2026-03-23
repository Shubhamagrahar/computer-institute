<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Announcement | <?php echo $brand_name; ?></title>
        
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
        
        <!-- Bootstrap 5 -->
          <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
        
          <!-- DataTables with Responsive Extension -->
          <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
          <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
          
          <!-- Font Awesome -->
          <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      
        <style>
        
          .certificate_drop{
            	background: #157daf !important;
            }
            
            .announcement1{
            	background: #157daf !important;
            }
    
            .mdk-drawer-layout .container {
                max-width: 100%;
            }
            .card-header {
                display: flex;
                justify-content: space-between;
                background-color: #303956 !important;
            }
            .card-title {
                color: #fff;
                margin-bottom: 0;
                align-items: center;
                display: flex;
            }
            .btn-tool {
                color: white;
            }
            .btn-tool:hover {
                color: #5567ff;
            }
            .announce {
                margin-top: 20px;
                border: 2px solid #e5e5e5;
                padding: 10px;border-radius: 12px;
                background-color: #fbfbfb;
                height: 300px;
                overflow-y: scroll;
            }
    
    
  </style>

    </head>

    <body class="layout-app ui ">

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

                <!-- Navbar -->

                <?php include 'top-navbar.php'; ?>

                <div class="container page__container page-section pb-0">
                
                
                 <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0"> Announcement </h2>


                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">
                    
                    <div class="card card-success shadow-lg">
                      <div class="card-header">
                        <h3 class="card-title">LATEST ANNOUNCEMENT</h3>
        
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                       <div class="announce " style="margin-top: 20px;border: 2px solid #e5e5e5;padding: 10px;border-radius: 12px;background-color: #fbfbfb;">
                                    <!--<marquee height="350px" direction="up" scrollamount="2" onmouseover="this.stop()" onmouseout="this.start()">-->
                                        <p align="justify" style="color: #303956; font-style:italic; font-size: 20px; margin-top:7px; font-weight:700;"><i style="color: #e7b59f;" class="fas fa-hands-praying"></i>Welcome to <?php echo $brand_name; ?>.</p>
                                        
                                        <?php 
                                        $sql_news=mysqli_query($con,"select * from web_news where status='OPEN' order by id desc");
                                        while($row=mysqli_fetch_array($sql_news)){
                                            ?>
                                    
                                        <p align="justify" style="color: #000000;font-size: 15px; margin-top:7px;"><i style="color: #e7b59f;" class="fas fa-hand-point-right"></i>&nbsp;<?php echo $row['des'] ?>                                                                               
                                        <!--<img src="public/images/m-new.gif"> </p>-->
                                        <?php
                                        if($row['new']=="YES"){
                                            ?>
                                                        <img src="../img/m-new.gif">
                                                        <?php } ?>
                                                </p>
                                                <?php } ?>
                                        
                                        
                                    <!--</marquee>-->
                                </div>
                      </div>
              <!-- /.card-body -->
            </div>



                </div>
                
                <?php include 'footer.php'; ?>

            </div>

            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>
            
            
            
            <script>
	
    		function get_fee(val){
    		  
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                        
                    document.getElementById("course_fee_label").style.display="block";
                   
                 $("#course_fee").val(data);
                    }
                }
              }
              );
    		}
    		
    	</script>
    	<script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "300";
            imagediv.appendChild(newimg);
        }
       
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
        <!-- List.js -->
        <script src="public/vendor/list.min.js"></script>
        <script src="public/js/list.js"></script>
        <!-- Tables -->
        <script src="public/js/toggle-check-all.js"></script>
        <script src="public/js/check-selected-row.js"></script>
        
           <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
        

    </body>

</html>