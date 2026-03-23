<?php 
include 'session.php';
$extra_class = '';
$c_date=date("Y-m-d H:s:i");
if(isset($_SESSION['test_series_ques_id'])){
$test_series_id= $_SESSION['test_series_ques_id'];
if(!$test_series_id==""){
    $sql=mysqli_query($con,"select * from test_series where id='$test_series_id' and status='OPEN'");
    if(mysqli_num_rows($sql)==1){
      
      if(isset($_GET['submit_id'])){
         $submit_id=VerifyData($_GET['submit_id']);
         if(!$submit_id==""){
             if($submit_id==$test_series_id){
               $update_series=mysqli_query($con,"update test_series set edt='$c_date', status='CLOSE' where id='$test_series_id'");
               if($update_series){
                 unset($_SESSION['test_series_ques_id']);
                 mysqli_close($con);
                 $url="test_series_quies_details?ids=".$test_series_id;
                 echo '<script>alert("Final Submit successfull done.");window.location.assign("'.$url.'");</script>';
                  exit();   
      
               }else{
               mysqli_close($con);
               echo '<script>alert("Somthing worng in final submit");window.location.assign("test_series_quies");</script>';
               exit();   
             }
                 
             }else{
              mysqli_close($con);
         echo '<script>alert("Final submit series Id dose not match with current series Id.");window.location.assign("test_series_quies");</script>';
         exit();   
             }
         }else{
          mysqli_close($con);
         echo '<script>alert("Submit Data Null.");window.location.assign("test_series_quies");</script>';
         exit();   
         }
      }
        
    }else{
        mysqli_close($con);
        
      echo '<script>alert("Series Id wrong.");window.location.assign("test_series_runing");</script>';
       exit();
}
}else{
     mysqli_close($con);
    echo '<script>alert("Series Id not found.");window.location.assign("test_series_runing");</script>';
    
    exit();
}
}else{
     mysqli_close($con);
    echo '<script>alert("Series Id not found Error.");window.location.assign("test_series_runing");</script>';
    
    exit();
}


 $book_id = mysqli_fetch_array(mysqli_query($con, "select book_id from test_series where id='$test_series_id'"))['book_id'];
$pkg_id = mysqli_fetch_array(mysqli_query($con, "select pkg_id from test_pkg_book_details where id='$book_id'"))['pkg_id'];
$pkg_name = mysqli_fetch_array(mysqli_query($con, "select package_name from test_series_pkg_details where id='$pkg_id'"))['package_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $pkg_name; ?> | <?php echo $brand_name; ?></title>
	
	<!-- Favicons -->
    <link href="<?php echo $brand_fav_logo; ?>" rel="icon">
	
	<?php include 'student_exam_panel/head.php';?>
	<!--<link rel="manifest" href="public/assets/pwa/site.webmanifest">-->
	<!--<link rel="canonical" href="miscellaneous-m1-r5-multiple-choice-questions" />-->
	<!--<script src="public/assets/pwa/pwa7839.js?v=1.2"></script>-->
	<!-- Favicon -->
	<!--<link rel="shortcut icon" href="public/assets/images/favicon.ico">-->
	<!--<link href="public/assets/images/apple-touch-icon.png" rel="apple-touch-icon" />-->
	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<!-- Plugins CSS -->
	<!--<link rel="stylesheet" type="text/css" href="public/assets/vendor/glightbox/css/glightbox.css">-->
	<!-- Theme CSS -->
	<!--<link rel="stylesheet" type="text/css" href="public/assets/css/styleed19.css?v=16032025">-->
	
		<style>
		.countdown-strip {
			color: #fff;
			text-align: center;
			padding: 6px 0;
			font-size: 1.2rem;
			font-weight: 700
		}

		.btn-enroll-now,
		.time-box {
			border-radius: 5px
		}

		.countdown-container {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
			gap: 32px
		}

		.countdown-text {
			text-align: left
		}

		.countdown-timer {
			display: flex;
			gap: 7px;
			align-items: center
		}

		.time-box {
			background: #fff;
			padding: 4px;
			text-align: center;
			min-width: 49px;
			font-size: 1.3rem;
			line-height: 1.2
		}

		.time-label {
			font-size: .8rem;
			display: block
		}

		.btn-enroll-now {
			background: #fff116;
			font-weight: 700;
			padding: 6px 15px;
			text-decoration: none;
			white-space: nowrap;
			margin-left: 31px;
			box-shadow: 2px 2px 3px #242424;
		}

		.close-btn-banner {
			right: 29px;
			top: 50%;
			transform: translateY(-50%)
		}
		.quick-btn.not-viewed {
          background-color: #ccc; /* Gray */
          color: black !important;
        }
        
        .quick-btn.viewed-not-answered {
          background-color: #dc3545; /* Bootstrap red */
          color: white !important;
        }
        
        .quick-btn.answered {
          background-color: #28a745; /* Bootstrap green */
          color: white !important;
        }


		@media (max-width:768px) {
			.countdown-container {
				flex-direction: column;
				text-align: center;
				gap: 1px;
				justify-content: left;
				align-items: flex-start
			}

			.btn-enroll-now {
				margin-left: 6px;
				font-size: 1rem;
				padding: 5px 7px
			}

			.time-box {
				font-size: 1rem;
				min-width: 38px
			}

			.time-label {
				font-size: .7rem
			}

			.countdown-text {
				text-align: center
			}

			.close-btn-banner {
				right: 10px;
				top: 24%;
				background: #ff7373;
				height: 27px;
				width: 27px;
				border-radius: 5px;
			}
		}
	</style>


	<script>
			</script>
</head>

<body>

		
			<!-- Header START -->
		<?php 
// 		include 'header.php';
		?>
		<!-- Header END -->
	<script async src="pagead/js/adsbygooglea3ac.js?client=ca-pub-5016085443148806" crossorigin="anonymous"></script>
<style>
    .ques-option {
        font-size: 18px;
    }

    .soft-success {
        background: rgba(12, 188, 135, 0.1);
    }

    .border-dark-1 {
        border: 1px solid #0cbc87;
    }

    .quick-btn {
        width: 45px;
        height: 45px;
        line-height: 45px;
        color: #ffff;
    }

    .mini-card-sm {

        background: #fff;
        border-radius: 4px;
        box-shadow: 1px 2px 2px #000;
        text-align: center;
        width: 50%;

    }

    @media print {
        body {
            display: none;
        }
    }
</style>

<!-- **************** MAIN CONTENT START **************** -->
<main id="main-body" oncontextmenu="return false;">

    <input type="hidden" id="test_type" value="MCQ">
    <section class="bg-blue py-7">
        <div class="container">
            <div class="row justify-content-lg-between">

                <div class="col-lg-8">
                    
                    <?php
                       
                    ?>
                    <!-- Title -->
                    <h1 class="text-white"><?php echo $pkg_name; ?></h1>
                    <h4 class="text-white">( Multiple Choice Questions)</h4>

                </div>

                <div class="col-lg-3">
  <h6 class="text-white lead fw-light mb-3 text-center">
    <span id="showtime" class="digital-time d-block">
      <span id="hours" class="text-blue fw-bold bg-light rounded-1 fs-5 p-2 me-2">00</span>
      <span id="minutes" class="fw-bold text-blue bg-light rounded-1 fs-5 p-2 me-2">00</span>
      <span id="seconds" class="fw-bold text-blue bg-light rounded-1 fs-5 p-2 me-2">00</span>
    </span>
    <p class="mb-0 mt-3">Time</p>
  </h6>
</div>


                
            </div>
        </div>
    </section>
    <!-- =======================
Page intro END -->

    <!-- =======================
Page content START -->
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <!-- Main content START -->
                <div class="col-12">
                    <div class="card shadow rounded-2 p-0 mt-n5">
                        
                        
<style>
.ques-option input:checked + label {
    background-color: #0cbc87 !important; 
    color: #fff !important;
    border: 2px solid #0cbc87 !important;
}

.ques-option label {
    transition: all 0.3s ease;
    cursor: pointer;
}

.ques-option:hover label {
    background-color: #ffffff;
}
</style>                        


                        <!-- Tab contents START -->
                        <div class="card-body p-0 p-md-4">
                            <div class="row">
                                <!-- START ONLINE TEST -->
                                <section class="pt-0 pb-0">
                                    <div class=".container">
                                        <div class="row gy-3">
                                            <div class="col-md-8">
                                                <div style="box-shadow: 1px 2px 5px #000;" class="rounded-3">
                                                    <form id="test_form" action="">
                                                        <input type="hidden" name="csrf_token" value="9d2b362c08d33b3b2046074d6e241faeafcebd5f6eef25721b2b676ba27be17d">                                                       
                                                        <input type="hidden" name="__ini__" id="__ini__" value="1742462942">
                                                        <div id="quiz-wrapper" class="carousel slide pt-4 ps-4 rounded-top-3" data-bs-touch="false" data-bs-interval="false" style="background: #fff;">

                                                            <div class="carousel-inner">
                                            <?php
                                            $q_no = 0;
                                            
                                            $sql = mysqli_query($con, "SELECT * FROM test_series_at_question WHERE test_series_id='$test_series_id' ORDER BY id ASC");
                                            while($row = mysqli_fetch_array($sql)) {
                                                $q_no++;
                                                $qid = $row['id'];
                                            ?>
                                            <div class="carousel-item <?php if($q_no == 1) echo 'active'; ?>" data-qid="<?php echo $qid; ?>">
                                                <div class="outer-wrapper pt-2 me-4">
                                                    <span class="text-info d-block fw-bold fs-5">Question <?php echo $q_no; ?></span>
                                                    <p class="question mukta-regular fw-bold text-dark fs-5 mb-3"><?php echo htmlspecialchars(base64_decode($row['question'])); ?></p>
                                            
                                                    <?php
                                                   
                                                    $options = [
                                                        'ans_a' => ['val' => htmlspecialchars(base64_decode($row['ans_a'])), 'label' => 'A', 'id' => 'opt1'],
                                                        'ans_b' => ['val' => htmlspecialchars(base64_decode($row['ans_b'])), 'label' => 'B', 'id' => 'opt2'],
                                                        'ans_c' => ['val' => htmlspecialchars(base64_decode($row['ans_c'])), 'label' => 'C', 'id' => 'opt3'],
                                                        'ans_d' => ['val' => htmlspecialchars(base64_decode($row['ans_d'])), 'label' => 'D', 'id' => 'opt4'],
                                                    ];
                                                    
                                                    $yourAns = isset($row['your_ans']) ? $row['your_ans'] : '';
                                                    
                                                    foreach ($options as $key => $opt) {
                                                        $inputId = 'opt_' . $qid . '_' . $opt['label'];
                                                        
                                                        $checked = ($yourAns !== '' && $yourAns === $key) ? 'checked' : '';
                                                        $highlightClass = ($yourAns !== '' && $yourAns === $key) ? 'bg-success text-white' : '';
                                                    
                                                    
                                                    ?>
                                                            <div class="d-flex ques-option mb-2 fw-bold soft-success rounded-1 border-dark-1">
                                                            <div class="me-1 p-2 bg-success text-white"><?php echo $opt['label']; ?>)</div>
                                                            <input type="radio" class="d-none"
                                                                   name="ref[<?php echo $qid; ?>]"
                                                                   id="<?php echo $inputId; ?>"
                                                                   value="<?php echo $key; ?>"
                                                                   onclick="ans_test_question('<?php echo $qid; ?>', '<?php echo $key; ?>')"
                                                                   <?php echo $checked; ?>>
                                                            <label for="<?php echo $inputId; ?>" class="d-block w-100 p-2 <?php echo $highlightClass; ?>">
                                                                <?php echo $opt['val']; ?>
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                            
                                                    <hr class="hr-ques">
                                                </div>
                                            </div>
                                            <?php } ?>


                                                                
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="551248" name="test_id" id="test_id" />
                                                        <input type="hidden" value="" name="stu_name" id="stu_name" />

                                                    </form>
                                                    <div class="d-flex" style="background:#fff;padding:1rem;  border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;">
                                                        <button type="button" class="btn btn-primary btn-lg" style="line-height: 1;" id="prev" data-bs-target="#quiz-wrapper" data-bs-slide="prev">Previous</button>
                                                        <span class="question_position flex-fill text-center" style="align-self:center;">
                                                              <span id="count_slide">1</span>/<span id="total_slide"><?php echo $q_no; ?></span>
                                                            </span>
                                                        <button type="button" style="line-height: 1;" class="btn btn-success btn-lg" id="next" data-bs-target="#quiz-wrapper" data-bs-slide="next">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 rounded-1 py-3" style="border: 3px solid #1d3b53; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

                                                <div class="jump_to">

                                                    <div class="d-flex" style="column-gap: 10%;">
                                                        <div class="mini-card-sm">
                                                            <h6 class="bg-success text-white top-radius p-2 rounded-top-1">Attempted</h6>
                                                            <strong><span id="q_attempt">00</span></strong>
                                                        </div>

                                                        <div class="mini-card-sm">
                                                            <h6 class="bg-danger text-white top-radius p-2 rounded-top-1">Not Attempted</h6>
                                                            <strong><span id="q_n_attempt">00</span></strong>
                                                        </div>

                                                       
                                                    </div>

                                                    <p class="mt-4 mb-2 fw-bold p-2 rounded-1 text-center" style="background: #1d3b53;color: #fff;">Question Palette</p>

                                                   <?php
$slideIndex = 0;
$sql_quick = mysqli_query($con, "SELECT id, your_ans FROM test_series_at_question WHERE test_series_id='$test_series_id' ORDER BY id ASC");
?>
<div class="mini-card d-flex justify-content-between gap-2 flex-wrap" style="border-radius:8px;">
<?php while($row_quick = mysqli_fetch_assoc($sql_quick)) {
    $qid = $row_quick['id'];
    $yourAns = $row_quick['your_ans'];

    // Determine button class
    $btnClass = 'bg-primary'; // default
    if ($yourAns === '' || is_null($yourAns)) {
        $btnClass = 'bg-danger'; // Not attempted
    } else {
        $btnClass = 'bg-success'; // Attempted
    }
?>
    <div class="quick-btn <?php echo $btnClass; ?> text-center text-white px-2 rounded-1"
         id="palette-<?php echo $qid; ?>"
         data-qid="<?php echo $qid; ?>"
         data-bs-target="#quiz-wrapper" 
         data-bs-slide-to="<?php echo $slideIndex; ?>">
         <?php echo str_pad($slideIndex + 1, 2, '0', STR_PAD_LEFT); ?>
    </div>
<?php $slideIndex++; } ?>

                                                    </div>

                                                </div>


                                            </div>
                                            <div class="row mt-4">
                                                <div class="col text-center">
                                                    <input type="submit" onclick="final_submit_series('<?php echo $test_series_id; ?>')" name="final_submit" class="btn btn-info btn-lg" value="Final Submit">
                                                </div>
                                            </div>

                                        </div>


                                       


                                    </div>
                                   


                                </section>
                                <!-- END ONLINE TEST -->
                            </div>
                        </div>
                        <!-- Tab contents END -->
                    </div>
                </div>

                <div class="col-12">
                    <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-5016085443148806" data-ad-slot="2162720213"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <!-- Main content END -->
            </div><!-- Row END -->
        </div>
    </section>
  
</main>

<audio loop="true" id="audio_interface" src="public/assets/audio/my-audio.mp3"></audio>



<script>
    document.querySelector('body').style.userSelect = 'none';
    var TIMER_STOP = true;
    var STARTUP_MODAL = null;
    var TIME_FOR_TEST = 1350;
    document.addEventListener('DOMContentLoaded', function() {

        STARTUP_MODAL = new bootstrap.Modal(document.getElementById('get_name'));
        STARTUP_MODAL.show();
    })

    document.body.setAttribute('oncontextmenu', 'return false;');
</script>


	<?php include 'student_exam_panel/footer.php';?>

<div class="modal fade" id="view_noti_details" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>

<div class="modal" id="report_a_bug">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Report an Error</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="https://examjila.com/bug" onsubmit="this.classList.add('pe-none');">
					<input type="hidden" name="csrf_token" value="8720c3a5a8a51acb3d987e4bc54b8d3cb5c548d6ce99048206f51e6d091473ef">					<input type="hidden" name="id" id="report_q_id">
					<input type="hidden" name="report_question_type" id="report_question_type">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Select type of error <span class="text-danger fw-bold">*</span></label>
						<select name="error_type" class="form-control" id="error_type" required>
							<option value="">Select error type</option>
							<option value="typing_error">Typing error</option>
							<option value="wrong_answer">Wrong answer</option>
							<option value="wrong_options">Wrong options</option>
							<option value="incomplete_questions">Incomplete Questions</option>
							<option value="other">Other</option>
						</select>
					</div>

					<textarea name="explanation" class="form-control" rows="4" placeholder="Please specify the error if possible..."></textarea>
					<p class="mb-3 text-end">Max Characters: <span class="text-danger">255</span></p>

					<div class="d-flex column-gap-3 mb-3">
						<div class="w-50">
							<label for="report_by_name" class="form-label">Your Name <span class="text-danger fw-bold">*</span></label>
							<input type="text" class="form-control" id="report_by_name" name="report_by_name" required>
						</div>


						<div class="w-50">
							<label for="report_by_email" class="form-label">Email address <span class="text-danger fw-bold">*</span></label>
							<input type="email" class="form-control" id="report_by_email" name="report_by_email" required>
						</div>

					</div>

					<p>We’ll inform you as soon as the issue is resolved.</p>
					<button type="submit" class="btn btn-primary ms-auto d-block">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END -->


<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/assets/js/jquery.js"></script>
<script>
    $('#quiz-wrapper').on('slid.bs.carousel', function () {
    let currentSlide = $(this).find('.carousel-item.active');
    let qid = currentSlide.data('qid');

    let anySelected = currentSlide.find('input[type="radio"]:checked').length > 0;

    if (!anySelected) {
        updateQuestionStatus(qid, false); // red
    }
});

</script>
<script>
    $(document).ready(function () {
    updateAttemptedCount();
});

    

    
   function ans_test_question(at_id,val){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'ans_test_question='+at_id+'&val='+val,
                success: function(data){
                    console.log("Submitted");
                if(data!==""){
                    alert(data);
                }
                attemptedSet.add(String(at_id));
            localStorage.setItem('attemptedQuestions', JSON.stringify(Array.from(attemptedSet)));
               updateQuestionStatus(at_id, true);
            updateAttemptedCount();
                }
              }
              );
   }
   
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const quizWrapper = document.getElementById('quiz-wrapper');
    const countSlide = document.getElementById('count_slide');

    quizWrapper.addEventListener('slid.bs.carousel', function () {
      const activeSlide = quizWrapper.querySelector('.carousel-item.active');
      const allSlides = quizWrapper.querySelectorAll('.carousel-item');
      const currentIndex = Array.from(allSlides).indexOf(activeSlide) + 1;
      countSlide.textContent = currentIndex;
    });
  });
</script>
<script>
    const totalQuestions = <?php echo $q_no; ?>;

    let attemptedSet = new Set(JSON.parse(localStorage.getItem('attemptedQuestions') || '[]'));
    

    function saveAttemptedSet() {
        localStorage.setItem('attemptedQuestions', JSON.stringify(Array.from(attemptedSet)));
    }

    function updatePalette(qid, answered) {
        const btn = document.querySelector(`.quick-btn[data-qid="${qid}"]`);
        if (!btn) return;

        if (answered) {
            btn.classList.remove('bg-primary', 'bg-danger');
            btn.classList.add('bg-success');
            attemptedSet.add(qid);
        } else {
            btn.classList.remove('bg-primary', 'bg-success');
            btn.classList.add('bg-danger');
            attemptedSet.delete(qid);
        }

        saveAttemptedSet();

        updateAttemptedCount();
    }

    function updateQuestionStatus(qid, answered) {
        let quickBtn = $(`.quick-btn[data-qid="${qid}"]`);
        if (quickBtn.length > 0) {
            quickBtn.removeClass("bg-primary bg-danger bg-success");

            if (answered) {
                quickBtn.addClass("bg-success"); 
            } else {
                quickBtn.addClass("bg-danger"); 
            }
        }
    }

    function updateAttemptedCount() {
        let total = $(".quick-btn").length;
        let attempted = $(".quick-btn.bg-success").length;
        let notAttempted = $(".quick-btn.bg-danger").length;

        $("#q_attempt").text(attempted.toString().padStart(2, '0'));
        $("#q_n_attempt").text(notAttempted.toString().padStart(2, '0'));
    }

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('click', function () {
            const qid = this.name.match(/\d+/)[0];
            updatePalette(qid, true);
        });
    });
    document.querySelectorAll('.quick-btn, #next, #prev').forEach(btn => {
        btn.addEventListener('click', function () {
            setTimeout(() => {
                const active = document.querySelector('.carousel-item.active');
                if (!active) return;
                const qid = active.getAttribute('data-qid');
                const answered = !!document.querySelector(`input[name="ref[${qid}]"]:checked`);
                updatePalette(qid, answered);
            }, 300);
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
       // Don't override server-based bg-success or bg-danger
// Only add to attemptedSet if bg-success was already present
document.querySelectorAll('.quick-btn').forEach(btn => {
    const qid = btn.getAttribute('data-qid');
    if (btn.classList.contains('bg-success')) {
        attemptedSet.add(qid); // preserve tracking
    }
});


        document.querySelectorAll('.carousel-item').forEach(item => {
            const qid = item.getAttribute('data-qid');
            const answered = !!item.querySelector(`input[name="ref[${qid}]"]:checked`);
            if (answered && !attemptedSet.has(qid)) {
                attemptedSet.add(qid);
                updateQuestionStatus(qid, true);
            }
        });

        updateAttemptedCount();
        saveAttemptedSet();
    });
</script>

    
    
    <script>
    
    document.querySelectorAll('.ques-option input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const name = this.name;  
        const radios = document.querySelectorAll('input[name="' + name + '"]');

        radios.forEach(r => {
            const label = document.querySelector('label[for="' + r.id + '"]');
            if (r.checked) {
                label.classList.add('bg-success', 'text-white');
            } else {
                label.classList.remove('bg-success', 'text-white');
            }
        });
    });
});

</script>
<script>
function final_submit_series(val) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to final submit this test series?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Submit',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const endTime = new Date().toISOString().slice(0, 19).replace('T', ' '); 
            $.ajax({
                url: 'get_data',
                type: 'GET',
                data: {
                    final_submit_test: 1,
                    submit_id: val,
                    test_series_id : <?php echo $test_series_id; ?>,
                    end_time: endTime
                },
                success: function(response) {
                    
                    eval(response);
                },
                error: function() {
                    Swal.fire('Error', 'Something went wrong with the request.', 'error');
                }
            });
        }
    });
}
</script>
<script>
  const testSeriesId = '<?php echo $test_series_id; ?>';

  const startTimeKey = 'startTime_test_' + testSeriesId;

  let startTime = localStorage.getItem(startTimeKey);
  if (!startTime) {
    startTime = Date.now();
    localStorage.setItem(startTimeKey, startTime);
  } else {
    startTime = parseInt(startTime);
  }

  function updateTimer() {
    const now = Date.now();
    const elapsed = now - startTime; // milliseconds
    const totalSeconds = Math.floor(elapsed / 1000);

    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
  }

  setInterval(updateTimer, 1000);
  updateTimer();
</script>


</body>

</html>