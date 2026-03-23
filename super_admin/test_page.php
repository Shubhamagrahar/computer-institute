<?php
include 'session.php'; 



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Top Slider |  <?php echo $brand_name; ?></title>
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
  <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="ckeditor/ckeditor.js"></script>
  
 <style>
      .question-slide { display: none; }
        .question-slide.active { display: block; }
        .palette-btn {
            margin: 5px;
            width: 50px;
            height: 50px;
        }
        .editor-box {
            height: 300px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 10px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.4/ace.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader and Navbar -->
  

  <?php include 'top_navbar.php'; ?>
  
  <!-- /.navbar -->

  <!-- Main left Sidebar Container start-->
  
 <?php include 'left_side_navbar.php'; ?>
<!-- Main left Sidebar Container end-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
                
            
           
           <div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar: Question Palette -->
        

        <!-- Main Test Content -->
        <div class="col-md-9">
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">Coding Test</h4>
                </div>

                <form id="codeForm" method="POST" action="" onsubmit="return prepareSubmission();">
                
                    <div class="card-body question-slide active" id="slide1">
                        <strong>Q1. Write a Python function to check if a number is even.</strong>
                        <p>Input: Integer n<br>Output: true/false</p>
                        <div id="editor1" class="editor-box">// Your Python code here</div>
                        <input type="hidden" name="code[1]" id="code1">
                        <input type="hidden" name="language[1]" value="python">
                        
                        <button type="button" class="btn btn-success mt-2" onclick="submitQuestion(1)">Submit Q1</button>
                
                        <div id="result1" class="text-light mt-3 p-3 bg-dark rounded" style="min-height: 100px;">
                            <em>Waiting for submission...</em>
                        </div>
                    </div>
                
                    <div class="card-body question-slide" id="slide2">
                        <strong>Q2. Write a C++ function to calculate factorial.</strong>
                        <p>Input: Integer n<br>Output: factorial(n)</p>
                        <div id="editor2" class="editor-box">// Your C++ code here</div>
                        <input type="hidden" name="code[2]" id="code2">
                        <input type="hidden" name="language[2]" value="c_cpp">
                        
                        <button type="button" class="btn btn-success mt-2" onclick="submitQuestion(2)">Submit Q2</button>
                
                        <div id="result2" class="text-light mt-3 p-3 bg-dark rounded" style="min-height: 100px;">
                            <em>Waiting for submission...</em>
                        </div>
                    </div>
                
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary" onclick="prevSlide()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextSlide()">Next</button>
                    </div>
                </form>
                
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Question Palette</h5>
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <button type="button" class="btn btn-outline-light palette-btn" onclick="goToSlide(1)">Q1</button>
                                    <button type="button" class="btn btn-outline-light palette-btn" onclick="goToSlide(2)">Q2</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            
           
            
            
          </div>
        </div>
     </section>
   
    
    
    
  </div>
  <!-- /.content-wrapper -->
  <!--Footar start-->
  <?php include'footar.php'; ?>
  <!--Footar end-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script>
    CKEDITOR.replace('short_name');
     CKEDITOR.replace('short_about');
</script>
    



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

<script>
    let currentSlide = 1;
    const totalSlides = 2;

    const editor1 = ace.edit("editor1");
    editor1.setTheme("ace/theme/monokai");
    editor1.session.setMode("ace/mode/python");

    const editor2 = ace.edit("editor2");
    editor2.setTheme("ace/theme/monokai");
    editor2.session.setMode("ace/mode/c_cpp");

    const editors = { 1: editor1, 2: editor2 };

    function showSlide(num) {
        for (let i = 1; i <= totalSlides; i++) {
            document.getElementById("slide" + i).classList.remove("active");
        }
        document.getElementById("slide" + num).classList.add("active");
        document.getElementById("submitBtn").style.display = (num === totalSlides) ? 'inline-block' : 'none';
    }

    function nextSlide() {
        if (currentSlide < totalSlides) {
            currentSlide++;
            showSlide(currentSlide);
        }
    }

    function prevSlide() {
        if (currentSlide > 1) {
            currentSlide--;
            showSlide(currentSlide);
        }
    }

    function goToSlide(num) {
        currentSlide = num;
        showSlide(currentSlide);
    }

    function prepareSubmission() {
        for (let i = 1; i <= totalSlides; i++) {
            document.getElementById("code" + i).value = editors[i].getValue();
        }
        return true;
    }
</script>

   
    <script>
async function submitQuestion(qid) {
    const editor = editors[qid];
    const code = editor.getValue();
    const lang = document.querySelector(`input[name='language[${qid}]']`).value;
    const resultBox = document.getElementById(`result${qid}`);

    resultBox.innerHTML = `<span class="text-warning">⏳ Executing test cases...</span>`;

    const data = {
        qid: qid,
        code: code,
        language: lang
    };

    try {
        const res = await fetch('submit_code.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });

        const result = await res.text();
        resultBox.innerHTML = result;

    } catch (err) {
        console.error("Submission error:", err);
        resultBox.innerHTML = `<span class="text-danger">Submission failed. Please try again.</span>`;
    }
}


</script>

</body>
</html>
