<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Test Series System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 


if(isset($_GET['book'])){
    $pkg_id=VerifyData($_GET['book']);
    if(!$pkg_id==""){
        $sql=mysqli_query($con,"select * from test_series_pkg_details where id='$pkg_id' and status='OPEN'");
        if(mysqli_num_rows($sql)==1){
           $pkg_details=mysqli_fetch_array($sql);
           $ped = date('Y-m-d', strtotime($t_date. ' + '.$pkg_details['validity_in_days'].' day'));
           $insert=mysqli_query($con,"insert into `test_pkg_book_details`(`userid`, `pkg_id`, `pst`, `ped`, `total_series`, `price`, `discount`, `book_date`) values('$_SESSION[userid]', '$pkg_id', '$t_date', '$ped', '$pkg_details[total_test_series]', '$pkg_details[price]', '$pkg_details[discount_amt]', '$t_date')");
          if($insert){
              echo '<script>alert("Test Series book request successfully submited. Waiting for verify.");window.location.assign("test_series_book");</script>';
          }else{
            echo '<script>alert("Server Error 101.");window.location.assign("test_series_book");</script>';  
          }
        }else{
            echo '<script>alert("Invalid URL.");window.location.assign("test_series_book");</script>';
        }
    }else{
        echo '<script>alert("Somthing went wrong.");window.location.assign("test_series_book");</script>';
    }
}

if(isset($_GET['book_free'])){
    $pkg_id=VerifyData($_GET['book_free']);
    if(!$pkg_id==""){
        $sql=mysqli_query($con,"select * from test_series_pkg_details where id='$pkg_id' and status='OPEN'");
        if(mysqli_num_rows($sql)==1){
           $pkg_details=mysqli_fetch_array($sql);
           $ped = date('Y-m-d', strtotime($t_date. ' + '.$pkg_details['validity_in_days'].' day'));
           $insert=mysqli_query($con,"insert into `test_pkg_book_details`(`userid`, `pkg_id`, `type`, `pst`, `ped`, `total_series`, `price`, `discount`, `status`, `book_date`) values('$_SESSION[userid]', '$pkg_id', 'FREE', '$t_date', '$ped', '$pkg_details[total_free_series]', '$pkg_details[price]', '$pkg_details[discount_amt]', 'RUN', '$t_date')");
          if($insert){
              echo '<script>alert("Free Test Series book request successfully submited.");window.location.assign("test_series_runing");</script>';
          }else{
            echo '<script>alert("Server Error 101.");window.location.assign("test_series_book");</script>';  
          }
        }else{
            echo '<script>alert("Invalid URL.");window.location.assign("test_series_book");</script>';
        }
    }else{
        echo '<script>alert("Somthing went wrong.");window.location.assign("test_series_book");</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Test Series Book |  <?php echo $brand_name; ?></title>
        <!-- Favicons -->
        <link href="<?php echo $brand_fav_logo; ?>" rel="icon">

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
          <!-- DataTables -->
          <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
          <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
          <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
          
          <!-- DataTables core CSS  -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <!--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />-->

        
        <style>
        
        .test_series{
    	background: #157daf !important;
    }
    
    .test_series_book{
    	background: #157daf !important;
    }
    
            .mdk-drawer-layout .container {
                max-width: 100%;
            }
    
    .table_container {
      background: white;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    h4 {
      text-align: center;
      font-weight: bold;
      color: #333;
      margin-bottom: 2rem;
    }
    table.dataTable {
      border-collapse: collapse;
      width: 100%;
    }
    table.dataTable thead th {
      /*background-color: #343a40;*/
      background-color: #303956;
      color: white;
      text-align: center;
    }
    table.dataTable tbody td {
      text-align: center;
      vertical-align: middle;
    }
    table.dataTable tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child::before {
      background-color: #303956;
      color: white;
      border: none;
      border-radius: 50%;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      background-color: #303956;
      color: white !important;
      border-radius: 5px;
      margin: 0 2px;
      padding: 6px 12px;
    }
    [dir] .page-item.active .page-link {
        background-color: #303956;
        border-color: #303956;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background-color: #0056b3 !important;
    }
    .dataTables_wrapper .dataTables_filter input {
      border-radius: 5px;
      border: 1px solid #ccc;
      padding: 0.4rem;
      width: 200px;
    }
    .dataTables_wrapper .dataTables_length select {
      border-radius: 5px;
      padding: 0.4rem;
    }
    
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
        font-size: 15px;
    }
    [dir] .page-link {
        padding: 0;
    }
    [dir] .page-item.disabled .page-link {
        border: none;
    }
/*    @media (max-width: 768px) {*/
/*  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before {*/
/*    top: 50%;*/
/*    transform: translateY(-50%);*/
/*  }*/
/*}*/
/*table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before {*/
/*  background-color: #4e73df;*/
/*  color: white;*/
/*  border: none;*/
/*  border-radius: 50%;*/
/*}*/
table.dataTable.nowrap th, table.dataTable.nowrap td {
    white-space: wrap;
}
table.dataTable thead>tr>th.sorting {
    padding-right: 20px;
}

@media(max-width: 768px) {
    .table_container {
        width: 100%;
        overflow-x: scroll;
    }
}
.g-10 {
    gap: 10px;
}
thead tr {
    background-color: #303956;
    text-align: center;
}
.table thead th {
    color: #ffffff;
    padding: 12px !important;
}
.table tbody td {
    font-size: 15px;
    text-align: center;
}
@media(max-width: 768px) {
    
    [dir] .table td, [dir] .table th {
        padding: 4px;
    }
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


                <?php include 'top-navbar.php'; ?>


                <div class="container page__container page-section pb-0">
                
                
                 <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Test Series Book</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./">Test Series</a></li>

                                    <li class="breadcrumb-item active"> Test Series Book </li>

                                </ol>

                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">

                    <div class="page-separator">
                        <div class="page-separator__text"> Test Series Book </div>
                    </div>
                    
                    <div class="table_container">
                          <!--<h4>Running Course Details</h4>-->
                          <div class="test_table">
                          <table id="courseTable" class="display responsive nowrap table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>S. No.</th>
                                <th>Package Name</th>
                                <th>Total Test Series</th>
                                <th>Question On Each Series</th>
                                <th>Valid In Days</th>
                                <th>Total free Series</th>
                                <th>Price</th>
                                <th>Try Free</th>
                                <th>Apply</th>

                                
                                
                              </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                   $i=0;
                                   $sql_p=mysqli_query($con,"select * from test_series_pkg_details where status='OPEN' order by id desc");
                                   while($row=mysqli_fetch_array($sql_p)){
                                           
                                   ?>
                                            
                              <tr>
                                <td><?php echo $i +=1; ?></td>
                                <td><?php echo $row['package_name'] ;?></td>
                                <td><?php echo $row['total_test_series'] ;?></td>
                                <td><?php echo $row['ques_no_each_series'] ;?></td>
                                <td><?php echo $row['validity_in_days'] ;?></td>
                                <td><?php echo $row['total_free_series'] ;?></td>
                                <td>₹<?php echo $row['price'] ;?></td>
                                <td >
                                    <?php
                                    $data_free=mysqli_query($con,"select * from test_pkg_book_details where userid='$_SESSION[userid]' and pkg_id='$row[id]' and (status='RUN' or status='RUN' or status='CLOSE')");
                                    if(mysqli_num_rows($data_free)>0){ 
                                        echo "Free Used.";
                                    }else{
                                        ?>
                                    <a href="test_series_book?book_free=<?php echo $row['id'] ;?>"><button class="btn btn-primary">Try</button></a>
                                    <?php  } ?>
                                
                                </td>
                                    
                                    
                                <td >
                                    <?php 
                                    $data=mysqli_query($con,"select * from test_pkg_book_details where userid='$_SESSION[userid]' and pkg_id='$row[id]' and (status='OPEN' or status='RUN')");
                                    if(mysqli_num_rows($data)>0){
                                        if(mysqli_num_rows($data)==1){
                                            $data_details=mysqli_fetch_array($data);
                                            if($data_details['status']=="OPEN"){
                                                echo "Booking Request waiting for verify.";
                                            }
                                            if($data_details['status']=="RUN"){
                                                echo "Package Under Runing.";
                                            }
                                        }else{
                                            echo "Error 101. Contact your institute.";
                                        }
                                    }else{
                                    ?>
                                                
                                    <a href="test_series_book?book=<?php echo $row['id'] ;?>"><button class="btn btn-primary">Apply</button></a>
                                    
                                    <?php } ?>
                                </td>
                                
                              </tr>
                              
                               <?php }  ?>
                            </tbody>
                          </table>
                          </div>
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
        
        
        <!-- jQuery + DataTables -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
            
            


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


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#courseTable').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      responsive: false,
      lengthChange: false 
    });
  });
</script>

    </body>

</html>