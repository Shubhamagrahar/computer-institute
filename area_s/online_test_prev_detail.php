<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 


//for exam over update 
 $sql_exam=mysqli_query($con,"select * from online_test_exam_details where status='OPEN' order by id desc");
 if(mysqli_num_rows($sql_exam)>0){
     $result=mysqli_fetch_array($sql_exam);
     $data_time=explode(":",$result['start_time']);
     $min=$data_time['1'];
     $next_minute=$min + $result['exam_time_min'];
     if($next_minute>59){
         $h=$data_time['0'] + 1;
         $m=$next_minute-60;
         $s="00";
         $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
     }else{
         $h=$data_time['0'] ;
         $m=$next_minute;
         $s="00";
         $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
     }
     if($c_date>$test_dt){
         $update=mysqli_query($con,"update online_test_exam_details set status='CLOSE' where id='$result[id]'");
     }
 }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Previous Online Exam Details | <?php echo $brand_name; ?></title>
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
          .drop_online_test{
            	background: #157daf !important;
            }
            
            .online_test_prev_detail{
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
                                <h2 class="mb-0">Previous Online Exam Details </h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./"> Online Exam </a></li>

                                    <li class="breadcrumb-item active"> Previous Online Exam Details </li>

                                </ol>

                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">

                    <div class="page-separator">
                        <div class="page-separator__text"> Previous Online Exam Details </div>
                    </div>
                    
                    <div class="table_container">
                          <!--<h4>Running Course Details</h4>-->
                          <div class="test_table">
                          <table id="courseTable" class="display responsive nowrap table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>S. No.</th>
                                <th>Exam Date</th>
                                <th>Course</th>
                                <th>Exam Start Time </th>
                                <th>Exam Time (Minutes)</th>
                                <th>Total Question</th>
                                <th>Action</th>
                                
                                
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                             
                                             
                                $i=0;
                                $sql_course_book=mysqli_query($con,"select * from course_book where userid='$login_details[id]' and (status='RUN' or status='CLOSE') order by id desc");
                                while($row=mysqli_fetch_array($sql_course_book)){
                                    $sql_exam=mysqli_query($con,"select * from online_test_exam_details where course_id='$row[course_id]' and status='CLOSE' order by id desc");
                                if(mysqli_num_rows($sql_exam)>0){
                                $exam_details=mysqli_fetch_array($sql_exam);
                                $exam_date=date_create($exam_details['exam_date']);
                                $exam_date=date_format($exam_date,"d-m-Y");
                                $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                ?>
                                            
                              <tr>
                                <td><?php echo $i +=1; ?></td>
                                <td><?php echo $exam_date ;?></td>
                                <td><?php echo $course_details['name'] ;?></td>
                                <td><?php echo date_format(date_create($exam_details['start_time']), "h:i A"); ?></td>
                                <td><?php echo $exam_details['exam_time_min']." Min."; ?></td>
                                <td><?php echo $exam_details['total_question']; ?></td>
                                <td>
                                    <a href="online_test_report?ids=<?php echo $exam_details['id'];?>" style="color:blue;cursor:pointer;"><i class="fa fa-eye"></i> View</a>
                                                    
                                </td>
                                
                              </tr>
                              <?php } }  ?>
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