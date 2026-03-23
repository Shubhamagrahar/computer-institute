<?php 
session_start();
include 'session.php';
if(sub_menu_check("I","A",$_SESSION['userid'])==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("./");</script>'; 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['template'])) {
    
    $template = $_POST['template'];

    $stmt_school = $con->prepare("UPDATE website_data SET template = ?");
    $stmt_school->bind_param("i", $template);
    
    if ($stmt_school->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}

    $stmt = $con->prepare("SELECT template FROM website_data WHERE id = '1'");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $selectedTemplate = $result['template'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student ID CARD</title>
    
    <!-- Favicons -->
  <link href="<?php echo $brand_logo; ?>" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/theme_style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- AdminLTE CSS -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AOS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

<!-- Bootstrap CSS -->
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
<!-- Bootstrap JS + Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <!--<link rel="stylesheet" href="dist/css/adminlte.min.css">-->
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <!-- Styles and Scripts -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style type="text/css">
        .student_id_card {
            background: #157daf !important;
        }
        .card_drop {
            background: #157daf !important;
        }
        .bg-purple {
            background-color: #9158dd !important;
        }
        
        .selected {
            border: 2px solid #3399ff; /* soft blue border */
            border-radius: 6px;
            box-shadow: 0 0 6px rgba(51, 153, 255, 0.25);
        }
        
        .selected:hover {
            box-shadow: 0 0 10px rgba(51, 153, 255, 0.4);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar and Sidebar -->
        <?php
          include 'top_navbar.php';
          include 'left_side_navbar.php';
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5>Student List</h5>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content" id="data_table">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <form name="search_form" method="get">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Select Class</label>
                                                <select name="select_class" id="select_class" class="form-control">
                                                      <option value="">Please select</option>
                                                   <?php 
                                                $sql_class=mysqli_query($con,"select * from class_details order by id desc");
                                                 while($row=mysqli_fetch_array($sql_class)){
                                                     ?>
                                                     <option value="<?php echo $row['id'] ;?>"><?php echo $row['name'] ;?></option>
                                                     <?php
                                                 }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Select Section</label>
                                                <select name="class_section" id="class_section" class="form-control">
                                                  <option value="">Select</option>
                                                      
                                                      <?php
                                                        $section_query=mysqli_query($con, "select * from section_details where status='1' order by id ");
                                                        while($section_row=mysqli_fetch_array($section_query)){
                                                           ?>
                                                           <option value="<?php echo $section_row['id']; ?>"><?php echo $section_row['name']; ?></option>
                                                           <?php
                                                           
                                                           
                                                        }
                                                      
                                                      ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <br>
                                                <button style="margin-top: 6px;" name="show_search_data" class="btn btn-success">Show</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <?php
                                $show_table_data = 0;
                                if (isset($_GET['show_search_data'])) {
                                    $select_class = !empty($_GET['select_class']) ? mysqli_real_escape_string($con, $_GET['select_class']) : null;
                                    $class_section = !empty($_GET['class_section']) ? mysqli_real_escape_string($con, $_GET['class_section']) : null;
                                    $session=mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"));
                                    $session_id=$session['session_id'];
                                    if ($select_class && $class_section) {
                                        
                                        $sql_d = mysqli_query($con, "SELECT * FROM student_admission_details WHERE class_id = '$select_class' AND class_section = '$class_section' and session_id = '$session_id' ORDER BY id DESC");
                                        $show_table_data = 1;
                                    } else {
                                        echo '<script>alert("Please select both class and section.");window.location.assign("student_list.php");</script>';
                                    }
                                    
                                } else {
                                    $sql_d = mysqli_query($con, "SELECT * FROM student_admission_details where session_id='$session_id' ORDER BY id DESC");
                                }
                                ?>
                                
                                
                                <!-- Modal to show the templates for ID Cards -->
                                <!-- The Modal -->
                                <div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="templateModalLabel">Select a Template</h5>
                                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                      </div>
                                      <div class="modal-body">
                                        <!-- Template options container -->
                                        <div class="row">
                                          <!-- Template Option 1 -->
                                          <div class="col-md-3 template-option" data-template="1" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template1.PNG" alt="Template 1" class="img-fluid">
                                            <p class="text-center">Template 1</p>
                                          </div>
                                          <!-- Template Option 2 -->
                                          <div class="col-md-3 template-option" data-template="2" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-Template2.jpg" alt="Template 2" class="img-fluid">
                                            <p class="text-center">Template 2</p>
                                          </div>
                                          <!-- Template Option 3 -->
                                          <div class="col-md-3 template-option" data-template="3" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template3.PNG" alt="Template 3" class="img-fluid">
                                            <p class="text-center">Template 3</p>
                                          </div>
                                          <!-- Template Option 4 -->
                                          <div class="col-md-3 template-option" data-template="4" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template4.PNG" alt="Template 4" class="img-fluid">
                                            <p class="text-center">Template 4</p>
                                          </div>
                                          <!-- Template Option 5 -->
                                          <div class="col-md-3 template-option" data-template="5" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template5.PNG" alt="Template 5" class="img-fluid">
                                            <p class="text-center">Template 5</p>
                                          </div>
                                          <!-- Template Option 6 -->
                                          <div class="col-md-3 template-option" data-template="6" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template6.PNG" alt="Template 6" class="img-fluid">
                                            <p class="text-center">Template 6</p>
                                          </div>
                                          <!-- Template Option 7 -->
                                          <div class="col-md-3 template-option" data-template="7" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template7.PNG" alt="Template 7" class="img-fluid">
                                            <p class="text-center">Template 7</p>
                                          </div>
                                          <!-- Template Option 8 -->
                                          <div class="col-md-3 template-option" data-template="8" style="cursor:pointer;">
                                            <img draggable="false" src="uploads/idCardTemplate/card-template8.PNG" alt="Template 8" class="img-fluid">
                                            <p class="text-center">Template 8</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" id="selectTemplateConfirm" class="btn btn-primary">Select Template</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                

                                <?php if($show_table_data==1){ ?>
                                <div style="overflow-x: auto" class="card-body">
                                    <div class="row">
                                        
                                        <button id="bulkPrintBtn" class="btn btn-success mb-3" style="display: block;" onclick="bulkPrint('<?php echo $row['userid']; ?>','<?php echo $session_id; ?>')">Print Selected</button>
                                        <button id="selectTemplateBtn" class="btn btn-primary mb-3 ml-3" data-bs-toggle="modal" data-bs-target="#templateModal"> Select Template
                                        </button>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="selectAll">
                                                </th>
                                                <th>S.No</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Date of Birth</th>
                                                <th>Address</th>
                                                <th>Class</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($sql_d)) {
                                              
                                                
                                                $user_details = mysqli_fetch_array(mysqli_query($con, "select name, full_add_permanent, gender, email, photo, dob from user where id='$row[userid]'"));
                                                $class_details = mysqli_fetch_array(mysqli_query($con, "select name from class_details where id='$row[class_id]'"));
                                                $section_details = mysqli_fetch_array(mysqli_query($con, "select name from section_details where id='$row[class_section]'"))
                                            ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="select-row" value="<?php echo $row['userid']; ?>">
                                                    </td>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><img draggable="false" width="60px" src="<?php echo $web_link.$user_details['photo']; ?>"></td>
                                                    <td><?php echo $user_details['name']; ?></td>
                                                    <td><?php echo $user_details['dob']; ?></td>
                                                    <td><?php echo $user_details['full_add_permanent']; ?></td>
                                                    <td><?php echo $class_details['name'] . " " . $section_details['name']; ?></td>
                                                    <td><?php echo $user_details['gender']; ?></td>
                                                    <td><?php echo $user_details['email']; ?></td>
                                                    <td><button id="print_single" onclick="print_single_id_card('<?php echo $row['userid']; ?>','<?php echo $session_id; ?>')" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include'footar.php'; ?>
    </div>
    



    <script>
    
    $('.template-option').on('click', function () {
        $('.template-option').removeClass('selected');
        $(this).addClass('selected');
        selectedTemplate = $(this).data('template');
    });

    $('#selectTemplateConfirm').on('click', function () {
        if (!selectedTemplate) {
            alert('Please select a template before proceeding.');
            return;
        }
        
        $.ajax({
            url: 'student_id_card.php',
            type: 'POST',
            data: { template: selectedTemplate},
            success: function (response) {
                alert('Template saved successfully!');
                window.location.reload();
                // $('#bulkPrintBtn').removeAttr('disabled');
                $('#templateModal').modal('hide');
            },
            error: function () {
                alert('Failed to save template. Try again.');
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        
        const selectAllCheckbox = document.getElementById('selectAll');
        const rowCheckboxes = document.querySelectorAll('.select-row');
        const bulkPrintBtn = document.getElementById('bulkPrintBtn');
        
        // Handle "Select All" functionality
        selectAllCheckbox.addEventListener('change', function () {
            const isChecked = selectAllCheckbox.checked;
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            // toggleBulkPrintButton();
        });
        
        // Handle individual row selection
        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = [...rowCheckboxes].every(cb => cb.checked);
                const someChecked = [...rowCheckboxes].some(cb => cb.checked);
                
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = !allChecked && someChecked;
                
                // toggleBulkPrintButton();
            });
        });
        
    });
  
    function bulkPrint(userid, session_id) {
        const selectedTemplate = <?= json_encode($selectedTemplate) ?>;
        const selectedIds = Array.from(document.querySelectorAll('.select-row:checked')).map(checkbox => checkbox.value);
        
        if (selectedIds.length > 0) {
            const receipts = [];
            let completedRequests = 0;
            selectedIds.forEach(student_id => {
                $.ajax({
                    url: 'generate_id_card.php',
                    method: 'GET',
                    data: { userid: student_id,
                    session_id: session_id,
                    template: selectedTemplate
                },
                    success: function(response) {
                        if (response.trim()) {
                            receipts.push(response);
                        } else {
                            alert(`Error: Could not print ID card.`);
                        }
                    },
                    error: function() {
                        alert(`Error: Failed to print ID card`);
                    },
                    complete: function() {
                        completedRequests++;
                        if (completedRequests === selectedIds.length) {
                            if (receipts.length > 0) {
                                const printWindow = window.open('', '_blank');
                                if(selectedTemplate === 1 || selectedTemplate === 2 ||selectedTemplate === 3 ||selectedTemplate === 4){
                                    printWindow.document.write(`
                                        <html>
                                            <head>
                                                <style>
                                                    .id-card-container {
                                                        display: grid;
                                                        grid-template-columns: repeat(auto-fit, minmax(5.5cm, 1fr));
                                                        gap: 55px;
                                                        page-break-inside: always;
                                                    }
                                                </style>
                                            </head>
                                            <body>
                                                <div class="id-card-container">
                                                    ${receipts.map(receipt => `<div class="">${receipt}</div>`).join('')}
                                                </div>
                                            </body>
                                        </html>
                                    `); 
                                }else{
                                    printWindow.document.write(`
                                        <html>
                                            <head>
                                                <style>
                                                    .id-card-container {
                                                        display: grid;
                                                        grid-template-columns: repeat(auto-fit, minmax(8cm, 1fr));
                                                        gap: 50px;
                                                        page-break-inside: always;
                                                    }
                                                </style>
                                            </head>
                                            <body>
                                                <div class="id-card-container">
                                                    ${receipts.map(receipt => `<div class="">${receipt}</div>`).join('')}
                                                </div>
                                            </body>
                                        </html>
                                    `);
                                }
                                printWindow.document.close();
                                setTimeout(function() {
                                    printWindow.print();
                                    printWindow.close();
                                }, 100);
                            } else {
                                alert('No ID card was generated.');
                            }
                        }
                    }
                });
            });
        } else {
            alert('No rows selected!');
        }
    }

    
    function print_single_id_card(userid, session_id) {
        const selectedTemplate = <?= json_encode($selectedTemplate) ?>;
        if(selectedTemplate){
            $.ajax({
            url: 'generate_id_card.php',
            method: 'GET',
            data: { userid: userid,
                    session_id: session_id,
                    template: selectedTemplate
                },
            success: function(response) {
                if (response.trim()) {
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write(`
                                <html>
                                    <head>
                                        <style>
                                        </style>
                                    </head>
                                    <body><div class="">`);
                    printWindow.document.write(response);
                    printWindow.document.write(`</div></body></html>`);
                    setTimeout(function() {
                        printWindow.print();
                        // printWindow.close();
                    }, 1000);
                } else {
                    alert('Error: Could not generate ID card.');
                }
            },
            error: function() {
                alert('Error generating ID card.');
            }
        });
        }else{
            alert('Select a Template First');
        }
        
        
    }



    </script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--<script src="dist/js/adminlte.min.js"></script>-->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>


<!-- Admin LTE 3 chart-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<!-- jQuery -->
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
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <!--<script src="dist/js/adminlte.min.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": -1,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>
</html>
