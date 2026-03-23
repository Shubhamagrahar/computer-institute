<?php
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Test Series System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 

if(isset($_POST['start'])){
    $row_id=VerifyData($_POST['row_id']);
    $series_id=VerifyData($_POST['series_id']);
    if(!$row_id=="" and !$series_id==""){
        $book_sql=mysqli_query($con,"select * from test_pkg_book_details where id='$row_id' and userid='$_SESSION[userid]' and use_series<total_series and status='RUN'");
        if(mysqli_num_rows($book_sql)==1){
            $book_details=mysqli_fetch_array($book_sql);
            $pkg_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_pkg_details where id='$book_details[pkg_id]'"));
            $total_insert_q= $pkg_details['ques_no_each_series'];
            $insert_test_series=mysqli_query($con,"insert into `test_series`(`userid`, `book_id`, `total_question`, `sdt`) values('$_SESSION[userid]', '$row_id', '$total_insert_q', '$c_date')");
            if($insert_test_series){
              $test_series_id=mysqli_insert_id($con);
              if(!$test_series_id==""){
                 
              
              
              $i=0;
              $go=1;
              $sql=mysqli_query($con,"select * from test_series_questions_type_details where test_series_type_id='$series_id' order by rand()");
               while($row_data=mysqli_fetch_array($sql)){
                   $check=mysqli_num_rows(mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' and question_id='$row_data[test_series_questions_id]'"));
                   if(!$check>0){
                       $question_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_questions where id='$row_data[test_series_questions_id]'"));
                       if($question_details){
                           $ans_final=$question_details['ans_final'];
                           $question_details_id=$question_details['id'];
                           $question_details_question=$question_details['test_question'];
                           $question_ans_a=$question_details['ans_a'];
                           $question_ans_b=$question_details['ans_b'];
                           $question_ans_c=$question_details['ans_c'];
                           $question_ans_d=$question_details['ans_d'];
                           $insert_question=mysqli_query($con,"insert into `test_series_at_question`(`test_series_id`, `question_id`, `question`, `ans_a`, `ans_b`, `ans_c`, `ans_d`, `correct_ans`) values('$test_series_id', '$question_details_id', '$question_details_question', '$question_ans_a', '$question_ans_b', '$question_ans_c', '$question_ans_d', '$ans_final')");
                        
                          $i +=1; 
                       }
                   }
                   if($i==$total_insert_q){
                     $go=2;  
                   }
                   if($go==2){
                       break;
                   }
               }
               if($go==2){
               $use_series=$book_details['use_series'] + 1; 
               $update =mysqli_query($con,"update test_pkg_book_details set use_series='$use_series' where id='$row_id' and userid='$_SESSION[userid]' and status='RUN'");
               if($update){
                   $_SESSION['test_series_ques_id']=$test_series_id;
                 echo '<script>alert("Started Test.");window.location.assign("test_start");</script>';    
               }else{
                  echo '<script>alert("Server Error 103.");window.location.assign("test_series_runing");</script>';   
               }
               }
              }else{
                echo '<script>alert("Server Error 102.");window.location.assign("test_series_runing");</script>';  
              }
                
            }else{
              echo '<script>alert("Server Error 101.");window.location.assign("test_series_runing");</script>';  
            }
            
        }else{
          echo '<script>alert("Bad Request.");window.location.assign("test_series_runing");</script>';
        }
    }else{
        echo '<script>alert("Somthing went wrong.");window.location.assign("test_series_runing");</script>';
    }
}


if(mysqli_num_rows(mysqli_query($con,"select * from test_pkg_book_details where userid='$_SESSION[userid]' and use_series=total_series and status='RUN'"))>0){
$update_equal=mysqli_query($con,"update test_pkg_book_details set status='CLOSE' where userid='$_SESSION[userid]' and use_series=total_series and status='RUN'");
}


//$_SESSION['test_series_ques_id']=42;
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
        <title>Test Series Running | <?php echo $brand_name; ?></title>
        
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
        <!--<link rel="stylesheet" href="dist/css/adminlte.min.css">-->

        
        <style>
        
          .test_series{
    	background: #157daf !important;
    }
    
    .test_series_runing{
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

                <!-- Header -->

                <!-- Navbar -->

                <?php include 'top-navbar.php'; ?>

                <!-- // END Navbar -->

                <!-- // END Header -->


                <!-- Page Content -->

                <div class="container page__container page-section pb-0">
                
                
                 <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Test Series Running</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./">Test Series</a></li>

                                    <li class="breadcrumb-item active"> Test Series Running </li>

                                </ol>

                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">

                    <div class="page-separator">
                        <div class="page-separator__text"> Test Series Running </div>
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
                                <th>Used Test Series</th>
                                <th>Start</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                $i=0;
                                $sql_p=mysqli_query($con,"select * from test_pkg_book_details where userid='$_SESSION[userid]' and use_series<total_series and status='RUN'");
                                while($row=mysqli_fetch_array($sql_p)){
                                $pkg_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_pkg_details where id='$row[pkg_id]'"));
                                ?>
                                            
                              <tr>
                                <td><?php echo $i +=1; ?></td>
                                <td><?php echo $pkg_details['package_name'] ; ?></td>
                                <td><?php echo $row['total_series'] ; ?></td>
                                <td><?php echo $row['use_series'] ; ?></td>
                                <td>
                                    <form id="start_form<?php echo $row['id']; ?>" name="start_form<?php echo $row['id'] ; ?>">
                                            <div class="row">
                                            <div class="col-md-8 form-group">
                                                <select name="series_id" id="series_id<?php echo $row['id']; ?>" required class="form-control"> 
                                                    <option value="">Select Series Type</option>
                                                    <?php 
                                                    $series_sql=mysqli_query($con,"select * from test_course_pkg_wise_question_type where pkg_id='$row[pkg_id]'");
                                                    while($row1=mysqli_fetch_array($series_sql)){
                                                        $series_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_type where id='$row1[series_type_id]'"));
                                                        ?>
                                                        <option value="<?php echo $series_details['id']; ?>"><?php echo $series_details['name']; ?></option>
                                                        <?php 
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                                <div class="col-md-4 form-group">
                                                        
                                                <input type="hidden" name="row_id" id="row_id<?php echo $row['id']; ?>" class="btn btn-success" value="<?php echo $row['id'] ; ?>" required>
                                                    <button type="button" id="startBtn<?php echo $row['id']; ?>" class="btn btn-success" onclick="startTest('<?php echo $row['id']; ?>')">Start</button>

                                                    <span style="color:blue;display:none;" id="span<?php echo $row['id']; ?>">Please wait..</span>
                                                       
                                            </div>
                                        </div> 
                                    </form>  
                                                    
                                </td>
                                
                              </tr>
                              <?php }  ?>
                            </tbody>
                            
                            <script>
                                function go_process(val){
                                    let series_id =$("#series_id"+val).val();
                                    let row_id=$("#row_id"+val).val();
                                if(series_id!==""){
                                    if(row_id!==""){
                                        document.getElementById("start"+val).style.display="none";
                                        document.getElementById("span"+val).style.display="block";
                                    }
                                } 
                                }
                            </script>
                                     
                          </table>
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
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>

document.addEventListener("visibilitychange", () => {
         
      
         if (document.hidden) {
        //   // output.innerHTML += "browser tab is changed </br>";
        //   if(alert("Attemp Close because you change your window tab or some suspecious activies.")==true){
        //       window.location.href="./"; 
        //   } ;
         
         } 
      });
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

<script>
function startTest(val) {
    let series_id = $("#series_id" + val).val();
    let row_id = $("#row_id" + val).val();
     let btn = $("#startBtn" + val);
     
     
    if (series_id === "" || row_id === "") {
        Swal.fire("Missing Info", "Please select a series.", "warning");
        return;
    }

    btn.prop("disabled", true).html("Please wait...");

    $.ajax({
        url: "get_data",
        type: "POST",
        data: {
            series_id: series_id,
            row_id: row_id
        },
        success: function(response) {
            response = response.trim();

           if (response === "success") {
                      Swal.fire({
                        title: "Test Started",
                        text: "Good luck! Wishing you success.",
                        icon: "success",
                        confirmButtonText: "Proceed"
                      }).then(() => {
                        window.location.href = "test_start";
                      });
                    }

                 else {
                Swal.fire("Error", response, "error");
                btn.prop("disabled", false).html("Start");
            }
        },
        error: function() {
            Swal.fire("Error", "Server connection failed.", "error");
            btn.prop("disabled", false).html("Start");
        }
    });
}
</script>

    </body>

</html>