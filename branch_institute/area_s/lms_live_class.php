<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Learning Management System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 

$check_lms=mysqli_num_rows(mysqli_query($con,"select * from branch_details where userid='$login_details[branch_id]' and lms_system='YES'"));
if($check_lms==1){

}else{
mysqli_close($con);
echo '<script>window.location.assign("index");</script>';  
exit();
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
        <title>LMS Live Class | <?php echo $brand_name; ?></title>
        
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

        
        <style>
        
           .drop_lms{
            	background: #157daf !important;
            }
            
            .lms_live_class{
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
    table.dataTable.nowrap th, table.dataTable.nowrap td {
    white-space: wrap;
}
table.dataTable thead>tr>th.sorting {
    padding-right: 20px;
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
    .table_container {
        width: 100%;
        overflow-x: scroll;
    }
    [dir] .table td {
        padding: 4px !important;
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

                <!-- Header -->

                <!-- Navbar -->

                <?php include 'top-navbar.php'; ?>

                <div class="container page__container page-section pb-0">
                
                
                 <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0"> LMS Live Class </h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./"> LMS </a></li>

                                    <li class="breadcrumb-item active"> LMS Live Class </li>

                                </ol>

                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">

                    <div class="page-separator">
                        <div class="page-separator__text"> LMS Live Class </div>
                    </div>
                    
                    <div class="table_container">
                          <!--<h4>Running Course Details</h4>-->
                          <div class="test_table">
                          <table id="courseTable" class="display responsive nowrap table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>S. No.</th>
                                <th>Date & Time</th>
                                <th>Course</th>
                                <th>Heading</th>
                                <th>Google Meet/Zoom Link</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                $i=0;
                                    $course_book=mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and status='RUN'");
                                        while($rows=mysqli_fetch_array($course_book)){
                                    $sql_video=mysqli_query($con,"select * from lms_live_class where course_id='$rows[course_id]' and status='SHOW' order by id desc");
                                while($row=mysqli_fetch_array($sql_video)){
                                $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                $date=date_create($row['date']);
                                $date=date_format($date,"d-m-Y H:i:s");   
                                ?>
                                            
                              <tr>
                                <td><?php echo $i +=1; ?></td>
                                <td><?php echo $date;?></td>
                                <td><?php echo $course_details['name']; ?></td>
                                <td><?php echo $row['heading']; ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo $row['link'];?>"><button class="btn btn-success"><i class="fa fa-video-camera"></i> Join</button></a>
                                </td>
                                
                              </tr>
                              <?php } } ?>
                            </tbody>
                          </table>
                          </div>
                        </div>



                </div>
                
                <?php include 'footer.php'; ?>

            </div>

            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>

        <!-- jQuery + DataTables -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
            


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