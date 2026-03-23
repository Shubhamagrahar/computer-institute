<?php 
include 'session.php'; 
//$test_series_id= $_SESSION['test_series_ques_id'];

if(isset($_GET['ids'])){
    $id=VerifyData($_GET['ids']);
    if(!$id==""){
      $sql=mysqli_query($con,"select * from test_series where id='$id' and (status='CLOSE' or status='OPEN')");
      if(mysqli_num_rows($sql)==1){
          $ids_details=mysqli_fetch_array($sql);
          $test_series_id= $ids_details['id'];
          
          if($ids_details['status']=="OPEN"){
             mysqli_close($con);
             $_SESSION['test_series_ques_id']=$test_series_id;
             echo '<script>window.location.assign("test_start");</script>';
             exit();
          }
          
      }else{
        mysqli_close($con);
        echo '<script>window.location.assign("test_series_report");</script>';
        exit();  
      }
    }else{
      mysqli_close($con);
      echo '<script>window.location.assign("test_series_report");</script>';
      exit();  
    }
    
}else{
 mysqli_close($con);
 echo '<script>window.location.assign("test_series_report");</script>';
 exit();
}

?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $brand_short_code." ".$test_series_id; ?> Test Series Details  |  <?php echo $brand_name; ?></title>
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
          
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        
        <style>
  .question-card {
    display: none;
  }
 button:disabled {
    cursor: not-allowed;
    opacity: 0.6;
  }

        .test_series{
    	background: #157daf !important;
        }
        
        .test_series_report{
        	background: #157daf !important;
        }
    
    .bg-purple{
          background-color: #9158dd !important; 
    }
    .span_head_s{
        border: 1px solid white;
        padding: 3px;
        margin: 4px;
        cursor: pointer;
    }

        .header {
            background: #1b3b58;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            font-size: 2rem;
            color: #ffffff !important;
        }

        nav a {
            color: #c1c1c1;
            text-decoration: none;
            margin: 0 5px;
            font-size: 0.9rem;
        }

        nav span {
            color: #ccc;
        }

        .result_container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .result-card {
            background: white;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
        }

        .info {
            display: flex;
            justify-content: space-between;
            /*padding-bottom: 20px;*/
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .stats {
            /*display: grid;*/
            text-align: left;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            font-size: 1rem;
        }
        .stat p{
            margin-bottom: 0;
        }

        .result-section img {
            width: 120px;
            margin: 20px 0;
        }

        .result-section p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .grade {
            font-size: 1.5rem;
        }

        .fail {
            color: red;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn1 {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 10px;
        }

        .correct {
            background: #007bff;
            color: white;
        }

        .wrong {
            background: #dc3545;
            color: white;
        }

        .btn1:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .info {
                flex-direction: column;
                text-align: left;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
            .btn1{
               font-size: 0.8rem; 
            }
        }
        .result-section span{
            font-weight: bold;
        }
        .view-btn {
          display: flex;
          justify-content: center;
          margin-top: -30px;
          margin-bottom: 20px;
        }

    .view-btn button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    .view-btn button:hover {
      background-color: #0056b3;
    }
    .text-dark {
        font-size: 18px;
        color: #303840 !important;
        font-weight: 500;
    }
    .test_id {
        font-size: 18px;
        font-weight: bolder;
    }
    .ui .page__container {
        max-width: 95%;
    }
    .gap-2 {
        gap: 0.5rem;
        font-size: 15px;
        font-weight: 700;
        color: gray;
    }
    [dir] hr {
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .text {
        font-size: 15px;
        font-weight: 700;
    }
    .fs-3 {
        font-size: 25px;
        font-weight: 500;
    }
    .f-20 {
        font-size: 20px;
    }
    .language-sql {
        font-size: 17px;
        font-family: sans-serif;
    }
    .options {
        /*display: flex;*/
        /*justify-content: space-between;*/
        font-size: 16px;
        padding-left: 20px;
        /*padding-right: 20px;*/
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


                <!-- Page Content -->

                <div class="container page__container page-section pb-0">
                
                 <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-4">Test Series Report Details</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./">Test Series</a></li>

                                    <li class="breadcrumb-item active"> Test Series Report Details </li>

                                </ol>

                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">

                    <div class="page-separator">
                        <div class="page-separator__text">Test Series Report Details</div>
                    </div>
                    
                    
                    <div class="card shadow-lg" style="transform: translateY(-100px);">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">

                      <div class="d-flex justify-content-between flex-wrap">
                        <p class="mb-0 fw-bold test_id"><span class="text-dark">Test Series Report of :</span> <?php echo htmlspecialchars($brand_short_code . " " . $test_series_id); ?></p>
                      </div>


                      <hr>
                      
<?php
$correct_q = 0;
$total_q = 0;

$sql_grade = mysqli_query($con, "SELECT correct_ans, your_ans FROM test_series_at_question WHERE test_series_id='$test_series_id'");
while ($row_grade = mysqli_fetch_array($sql_grade)) {
    $total_q++;
    if ($row_grade['correct_ans'] == $row_grade['your_ans']) {
        $correct_q++;
    }
}

// Calculate percentage
$percentage = ($total_q > 0) ? ($correct_q / $total_q) * 100 : 0;

// Assign grade
if ($percentage >= 90) {
    $grade = "A+";
} elseif ($percentage >= 80) {
    $grade = "A";
} elseif ($percentage >= 70) {
    $grade = "B+";
} elseif ($percentage >= 60) {
    $grade = "B";
} elseif ($percentage >= 50) {
    $grade = "C";
} elseif ($percentage >= 40) {
    $grade = "D";
} else {
    $grade = "F";
}
?>
                      
                      <?php 
                      $total_questions = (int) $ids_details['total_question'];
                
                      $attempted_questions = (int) $ids_details['attemp_question'];
                
                      $correct_q_count = (int) mysqli_num_rows(mysqli_query($con, "
                        SELECT * FROM test_series_at_question 
                        WHERE test_series_id = '$test_series_id' AND correct_ans = your_ans
                      "));
                
                      $wrong_questions = $attempted_questions - $correct_q_count;
                      if ($wrong_questions < 0) {
                          $wrong_questions = 0; 
                      }
                
                      $start_datetime = new DateTime($ids_details['sdt']);
                      $end_datetime = new DateTime($ids_details['edt']);
                      $diff = $start_datetime->diff($end_datetime);
                
                      $time_parts = [];
                      if ($diff->y > 0) $time_parts[] = $diff->y . " Year" . ($diff->y > 1 ? "s" : "");
                      if ($diff->m > 0) $time_parts[] = $diff->m . " Month" . ($diff->m > 1 ? "s" : "");
                      if ($diff->d > 0) $time_parts[] = $diff->d . " Day" . ($diff->d > 1 ? "s" : "");
                      if ($diff->h > 0) $time_parts[] = $diff->h . " Hour" . ($diff->h > 1 ? "s" : "");
                      if ($diff->i > 0) $time_parts[] = $diff->i . " Minute" . ($diff->i > 1 ? "s" : "");
                      if ($diff->s > 0) $time_parts[] = $diff->s . " Second" . ($diff->s > 1 ? "s" : "");
                      $total_time = $time_parts ? implode(" ", $time_parts) : "0 Seconds";
                    ?>

                    </div>
                    <div class="col-md-6">
                      <div class="row align-items-center fw-bold">
                        <div class="col-7"><span class="d-flex align-items-center gap-2"><i class="fs-5 bi bi-patch-question-fill text-dark"> </i> Total Questions :</span></div>
                        <div class="col-5"><span class="text-secondary text"><?php echo $total_questions; ?></span></div>

                        <div class="col-12">
                          <hr>
                        </div>

                        <div class="col-7"><span class="d-flex align-items-center gap-2"><i class="fs-5 bi bi-hand-index-thumb-fill text-warning"></i> Attempted Questions :</span></div>
                        <div class="col-5"><span class="text-warning text"><?php echo $attempted_questions; ?></span></div>

                        <div class="col-12">
                          <hr>
                        </div>


                        <div class="col-7"><span class="d-flex align-items-center gap-2"><i class="fs-5 bi bi-check-circle-fill text-success"></i> Correct :</span></div>
                        <div class="col-5"><span class="text-success text"> <?php echo $correct_q_count; ?></span></div>

                        <div class="col-12">
                          <hr>
                        </div>

                        <div class="col-7"><span class="d-flex align-items-center gap-2"><i class="fs-5 bi bi-x-circle-fill text-danger"></i> Incorrect :</span></div>
                        <div class="col-5"><span class="text-danger text"> <?php echo $wrong_questions; ?></span></div>

                        <div class="col-12">
                          <hr>
                        </div>
                        
                        <?php
                        // Optional: Dynamic color based on percentage
                        $scoreColor = 'text-danger';
                        if ($percentage >= 90) $scoreColor = 'text-success';
                        elseif ($percentage >= 60) $scoreColor = 'text-primary';
                        elseif ($percentage >= 40) $scoreColor = 'text-warning';
                        ?>

                        <div class="col-7">
                          <span class="d-flex align-items-center gap-2">
                            <i class="fs-5 bi bi-trophy-fill <?php echo $scoreColor; ?>"></i> Total Score :
                          </span>
                        </div>
                        <div class="col-5">
                          <span class="<?php echo $scoreColor; ?> text">
                            <?php echo round($percentage, 2); ?>%
                          </span>
                        </div>

                        <div class="col-12">
                          <hr>
                        </div>

                        <div class="col-7"><span class="d-flex align-items-center gap-2"><i class="fs-5 bi bi-smartwatch text-dark"></i> Time Taken :</span></div>
                        <div class="col-5"><span class="text-dark text"><?php echo htmlspecialchars($total_time); ?></span></div>
                      </div>
                    </div>
                    <div class="col-md-6 text-center">
                      <img class="d-md-block d-none mx-auto" src="public/images/trophy.png" alt="win celebration with trophy" style="width: 55%;">
                      <p class="mb-1 mt-3 text-dark fw-bold fs-5">You got <span class="text-info"><?php echo $correct_q_count; ?></span> out of <span class="text-primary"><?php echo $total_questions; ?></span></p>

                      <p class="fs-3">Grade : <span class="fw-bold text-danger"><?php echo $grade; ?></span></p>
                    </div>

                    <div class="col-12">

                      <hr>

                      <div class="view-btn">
                          <button onclick="toggleAnswerSheet()">View Answer</button>
                        </div>

                     <div class="tab-content">
                        <div class="tab-pane" class="answersheet" id="answerSheet">
                            
                            
                            

                            
                            <?php 
$i = 0;
$sql = mysqli_query($con, "SELECT * FROM test_series_at_question WHERE test_series_id='$test_series_id' ORDER BY id ASC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="question-block card question-card mb-3">
        <div class="card-body">
            <p class="mb-0 fw-bold fs-5 mukta-regular text-dark">Q.<?php echo ++$i; ?> <?php echo htmlspecialchars(base64_decode($row['question'])); ?></p>

            <br>

            <div class="options">
                <?php
                $options = ['a', 'b', 'c', 'd'];
                foreach ($options as $opt) {
                    $ans_key = 'ans_' . $opt;
                    $text = htmlspecialchars(base64_decode($row[$ans_key]));
                    $is_correct = $row['correct_ans'] == $ans_key;
                    $is_wrong = $row['your_ans'] == $ans_key && !$is_correct;
                    echo '<p class="mb-0 mukta-regular fs-17px ';
                    if ($is_correct) echo 'text-success fw-bold';
                    elseif ($is_wrong) echo 'text-danger fw-bold';
                    echo '">';
                    echo strtoupper($opt) . ') ' . $text;
                    if ($is_correct) echo ' <i class="bi bi-check-circle-fill text-success"></i>';
                    elseif ($is_wrong) echo ' <i class="bi bi-x-circle-fill text-danger"></i>';
                    echo '</p>';
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>
                        <div class="card-footer">
                           <input type="submit" onclick="window.location.assign('test_series_report')" name="final_submit" class="btn btn-success" value="Return">
                        </div>

                        
                         <div class="pagination mt-4 d-flex justify-content-center gap-2">
                            <button id="prevBtn" class="btn btn-sm btn-outline-primary" onclick="prevPage()">Previous</button>
                            <span id="pageInfo" class="px-3"></span>
                            <button id="nextBtn" class="btn btn-sm btn-outline-primary" onclick="nextPage()">Next</button>
                        </div>



                        </div>

                        
                      </div>


                    </div>

                  </div>
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
        
        
        <script>
            function toggleAnswerSheet() {
              const sheet = document.getElementById('answerSheet');
              sheet.style.display = sheet.style.display === 'block' ? 'none' : 'block';
            }
        </script>
        
        <script>
  document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.question-card');
    const pageInfo = document.getElementById('pageInfo');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const questionsPerPage = 1;
    let currentPage = 1;

    function showPage(page) {
      const totalPages = Math.ceil(cards.length / questionsPerPage);
      const start = (page - 1) * questionsPerPage;
      const end = start + questionsPerPage;

      cards.forEach((card, index) => {
        card.style.display = index >= start && index < end ? 'block' : 'none';
      });

      pageInfo.textContent = `Page ${page} of ${totalPages}`;

      // Disable or enable buttons
      prevBtn.disabled = page === 1;
      nextBtn.disabled = page === totalPages;
    }

    window.nextPage = function () {
      if (currentPage < Math.ceil(cards.length / questionsPerPage)) {
        currentPage++;
        showPage(currentPage);
      }
    }

    window.prevPage = function () {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    }

    // Initial display
    showPage(currentPage);
  });
</script>




        
        
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
        
        


    </body>

</html>