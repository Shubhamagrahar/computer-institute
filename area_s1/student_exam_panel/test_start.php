<?php 
include '../session.php';
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>DESKTOP PUBLISHING (DESIGNING) TEST Practice Test-1</title>
	
	<?php include 'head.php';?>
	<!--<link rel="manifest" href="public/assets/pwa/site.webmanifest">-->
	<!--<link rel="canonical" href="miscellaneous-m1-r5-multiple-choice-questions" />-->
	<!--<script src="public/assets/pwa/pwa7839.js?v=1.2"></script>-->
	<!-- Favicon -->
	<link rel="shortcut icon" href="public/assets/images/favicon.ico">
	<link href="public/assets/images/apple-touch-icon.png" rel="apple-touch-icon" />
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

			<div class="countdown-strip position-relative bg-red-medium d-none">
			<div class="container">
				<div class="countdown-container">
					<!-- Text -->
					<div class="countdown-text fs-4">
						🚀 Hurry! Offer Ends In
					</div>
					<!-- Timer -->
					<div class="countdown-timer">
						<div class="time-box text-red-medium">
							<span id="days">00</span>
							<span class="time-label">Days</span>
						</div>
						<div class="time-box text-red-medium">
							<span id="hours">00</span>
							<span class="time-label">Hours</span>
						</div>
						<div class="time-box text-red-medium">
							<span id="minutes">00</span>
							<span class="time-label">Mins</span>
						</div>
						<div class="time-box text-red-medium">
							<span id="seconds">00</span>
							<span class="time-label">Secs</span>
						</div>

						<div>
							<a href="../../../courses4b4f?utm_medium=enroll_btn&amp;utm_source=navbar&amp;utm_campaign=coupon" class="btn-enroll-now text-red-medium">Enroll Now</a>
						</div>
					</div>
					<!-- Button -->

				</div>


			</div>

			<div class="position-absolute close-btn-banner" onclick="this.parentNode.style.display='none';">
				<span role="button">X</span>
			</div>
		</div>
	
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
                    <!-- Title -->
                    <h1 class="text-white">DESKTOP PUBLISHING (DESIGNING) TEST-1 Multiple Choice Questions</h1>

                </div>

                <div class="col-lg-3">
                    <h6 class="text-white lead fw-light mb-3 text-center"><span id="showtime" class="digital-time d-block"><span class="text-blue fw-bold bg-light rounded-1 fs-5 p-2 me-2">00</span><span class="fw-bold text-blue bg-light rounded-1 fs-5 p-2 me-2">00</span><span class="fw-bold text-blue bg-light rounded-1 fs-5 p-2 me-2">00</span></span>
                        <p class="mb-0 mt-3">Remaining Time</p>
                    </h6>
                </div>

                <div class="col-12">
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5016085443148806" data-ad-slot="6643883179" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
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
                                <section class="pt-0">
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
        <p class="question mukta-regular fw-bold text-dark fs-5 mb-0"><?php echo $row['question']; ?></p>

        <?php
        // Options Array
        $options = [
            'A' => ['val' => $row['ans1'], 'id' => 'opt1'],
            'B' => ['val' => $row['ans2'], 'id' => 'opt2'],
            'C' => ['val' => $row['ans3'], 'id' => 'opt3'],
            'D' => ['val' => $row['ans4'], 'id' => 'opt4'],
        ];
        foreach ($options as $label => $opt) {
            // create unique input ID
            $inputId = "opt_ref_" . $qid . "_" . $opt['id'];
            $checked = ($row['your_ans'] == $opt['val']) ? 'checked' : '';
        ?>
        <div class="d-flex ques-option mb-2 fw-bold soft-success rounded-1 border-dark-1">
            <div class="me-1 p-2 bg-success text-white"><?php echo $label; ?>)</div>
            <input type="radio" class="d-none" name="ref[<?php echo $qid; ?>]" id="<?php echo $inputId; ?>" value="<?php echo $opt['val']; ?>" onclick="ans_test_question('<?php echo $qid; ?>', this.value)" <?php echo $checked; ?>>
            <label for="<?php echo $inputId; ?>" class="d-block w-100 p-2"><?php echo $opt['val']; ?></label>
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
                                                        <span class="question_position flex-fill text-center" style="align-self:center;"><span id="count_slide">1</span>/25</span>
                                                        <button type="button" style="line-height: 1;" class="btn btn-success btn-lg" id="next" data-bs-target="#quiz-wrapper" data-bs-slide="next">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 rounded-1 py-3" style="border: 3px solid #1d3b53;">

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

                                                        <!-- <div class="mini-card-sm mt-2">
                                                            <h6 class="bg-warning top-radius">NOT SEEN</h6>
                                                            <strong><span id="q_n_seen">00</span></strong>
                                                        </div> -->

                                                        <!-- <div class="mini-card-sm mt-2">
                                                            <h6 class="review-later text-white top-radius">REVIEW LATER</h6>
                                                            <strong><span id="q_r_later">00</span></strong>
                                                        </div> -->
                                                    </div>

                                                    <p class="mt-4 mb-2 fw-bold p-2 rounded-1 text-center" style="background: #1d3b53;color: #fff;">Question Palette</p>

                                                    <div class="mini-card d-flex justify-content-between gap-2 flex-wrap" style="border-radius:8px;">
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="0" data-qid="7989476">01</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="1" data-qid="7989477">02</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="2" data-qid="7989478">03</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="3" data-qid="7989479">04</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="4" data-qid="7989480">05</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="5" data-qid="7989481">06</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="6" data-qid="7989482">07</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="7" data-qid="7989483">08</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="8" data-qid="7989484">09</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="9" data-qid="7989485">10</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="10" data-qid="7989486">11</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="11" data-qid="7989487">12</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="12" data-qid="7989488">13</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="13" data-qid="7989489">14</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="14" data-qid="7989490">15</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="15" data-qid="7989491">16</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="16" data-qid="7989579">17</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="17" data-qid="7995941">18</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="18" data-qid="7995942">19</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="19" data-qid="7995943">20</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="20" data-qid="7996033">21</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="21" data-qid="7996034">22</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="22" data-qid="7996035">23</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="23" data-qid="7996036">24</div>
                                                            <div class="quick-btn rounded-1 bg-primary text-center" role="button" data-bs-target="#quiz-wrapper" data-bs-slide-to="24" data-qid="7996037">25</div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-md-2"></div>


                                            <div class="col-md-2"></div>
                                        </div>


                                    </div>
                                    <script>
                                        var total_question = 25;
                                        var req_url = '../../test-calculator';
                                    </script>


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
    <!-- =======================
Page content END -->

</main>

<audio loop="true" id="audio_interface" src="public/assets/audio/my-audio.mp3"></audio>


<!-- Modal -->
<!--<div class="modal fade" data-bs-backdrop="static" id="get_name" tabindex="-1" aria-labelledby="User name" aria-hidden="false" aria-modal="true" style="display: block;">-->
<!--    <div class="modal-dialog modal-dialog-centered">-->
<!--        <div class="modal-content border shadow-lg">-->

<!--            <div class="modal-body py-5 px-4">-->

<!--                <div class="text-center mb-4">-->
<!--                    <img src="../../../public/assets/images/logo.png" class="light-mode-item w-75" loading="lazy" alt="Examjila logo">-->
<!--                    <img src="../../../public/assets/images/logo-light.png" class="dark-mode-item w-75" loading="lazy" alt="Examjila logo">-->

<!--                </div>-->

<!--                <input type="text" placeholder="Enter your name" id="input_name__" class="form-control" />-->

<!--                <button type="button" class="btn btn-info mt-3 d-block w-100" id="ready__">Start Test</button>-->



<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- **************** MAIN CONTENT END **************** -->
<!--<link rel="preconnect" href="https://fonts.googleapis.com/">-->
<!--<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>-->
<!--<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">-->


<!--<link rel="stylesheet" href="public/assets/css/prism.css">-->
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
<!--<script src="code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>-->
<!--<script src="public/assets/js/quiz0b62.js?ver=04092024"></script>-->
<!--<script src="public/assets/js/prism.js"></script>-->
<!--<script src="public/assets/js/fireworks-animation.js"></script>-->
	<!-- =======================
Footer START -->

	<?php include 'footer.php';?>
	<!-- =======================
Footer END -->
<style>
	/*.whatsapp-icon {*/
	/*	position: fixed;*/
	/*	right: 17px;*/
	/*	bottom: 36px;*/
	/*	cursor: pointer;*/
	/*	z-index: 9999;*/
	/*}*/
</style>
<!--<div class="whatsapp-icon">-->
<!--	<div><a href="https://wa.me/917607418817?text=%2AHii%2A%2C+I+want+help+regarding+O+level%2C+A+level%2C+CCC+Course" target="_blank">-->
<!--			<svg width="50px" height="50px" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--				<g id="SVGRepo_bgCarrier" stroke-width="0"></g>-->
<!--				<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>-->
<!--				<g id="SVGRepo_iconCarrier">-->
<!--					<path fill-rule="evenodd" clip-rule="evenodd" d="M16 31C23.732 31 30 24.732 30 17C30 9.26801 23.732 3 16 3C8.26801 3 2 9.26801 2 17C2 19.5109 2.661 21.8674 3.81847 23.905L2 31L9.31486 29.3038C11.3014 30.3854 13.5789 31 16 31ZM16 28.8462C22.5425 28.8462 27.8462 23.5425 27.8462 17C27.8462 10.4576 22.5425 5.15385 16 5.15385C9.45755 5.15385 4.15385 10.4576 4.15385 17C4.15385 19.5261 4.9445 21.8675 6.29184 23.7902L5.23077 27.7692L9.27993 26.7569C11.1894 28.0746 13.5046 28.8462 16 28.8462Z" fill="#BFC8D0"></path>-->
<!--					<path d="M28 16C28 22.6274 22.6274 28 16 28C13.4722 28 11.1269 27.2184 9.19266 25.8837L5.09091 26.9091L6.16576 22.8784C4.80092 20.9307 4 18.5589 4 16C4 9.37258 9.37258 4 16 4C22.6274 4 28 9.37258 28 16Z" fill="url(#paint0_linear_87_7264)"></path>-->
<!--					<path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 18.5109 2.661 20.8674 3.81847 22.905L2 30L9.31486 28.3038C11.3014 29.3854 13.5789 30 16 30ZM16 27.8462C22.5425 27.8462 27.8462 22.5425 27.8462 16C27.8462 9.45755 22.5425 4.15385 16 4.15385C9.45755 4.15385 4.15385 9.45755 4.15385 16C4.15385 18.5261 4.9445 20.8675 6.29184 22.7902L5.23077 26.7692L9.27993 25.7569C11.1894 27.0746 13.5046 27.8462 16 27.8462Z" fill="white"></path>-->
<!--					<path d="M12.5 9.49989C12.1672 8.83131 11.6565 8.8905 11.1407 8.8905C10.2188 8.8905 8.78125 9.99478 8.78125 12.05C8.78125 13.7343 9.52345 15.578 12.0244 18.3361C14.438 20.9979 17.6094 22.3748 20.2422 22.3279C22.875 22.2811 23.4167 20.0154 23.4167 19.2503C23.4167 18.9112 23.2062 18.742 23.0613 18.696C22.1641 18.2654 20.5093 17.4631 20.1328 17.3124C19.7563 17.1617 19.5597 17.3656 19.4375 17.4765C19.0961 17.8018 18.4193 18.7608 18.1875 18.9765C17.9558 19.1922 17.6103 19.083 17.4665 19.0015C16.9374 18.7892 15.5029 18.1511 14.3595 17.0426C12.9453 15.6718 12.8623 15.2001 12.5959 14.7803C12.3828 14.4444 12.5392 14.2384 12.6172 14.1483C12.9219 13.7968 13.3426 13.254 13.5313 12.9843C13.7199 12.7145 13.5702 12.305 13.4803 12.05C13.0938 10.953 12.7663 10.0347 12.5 9.49989Z" fill="white"></path>-->
<!--					<defs>-->
<!--						<linearGradient id="paint0_linear_87_7264" x1="26.5" y1="7" x2="4" y2="28" gradientUnits="userSpaceOnUse">-->
<!--							<stop stop-color="#5BD066"></stop>-->
<!--							<stop offset="1" stop-color="#27B43E"></stop>-->
<!--						</linearGradient>-->
<!--					</defs>-->
<!--				</g>-->
<!--			</svg></span>-->
<!--		</a></div>-->
<!--</div>-->

<!-- authentication modal -->

	<!-- // authentication modal -->


<!-- Notification -->

<!-- // Notification -->

<!-- Notification detail -->
<!-- Modal -->
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
<!-- // Notification detail -->

<!-- report a bug model -->
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

<script>
// 	const openAuthModal = false;
// 	const openDefaultTab = 'login_tab_btn';
// 	const notification_obj = [{"id":"13","title":"O Level Practical Update","description":"O Level Practical Exam \u0938\u092c \u0915\u0941\u091b \u092c\u0926\u0932 \u0917\u092f\u093e","action_url":"https:\/\/www.youtube.com\/live\/N_Dm1sYifYo?si=Oswgb62h9tdF4Sc0","created_at":"1 month ago"},{"id":"12","title":"O Level New Rule","description":"Bakwaas Rule For All Students \ud83d\ude20","action_url":"https:\/\/youtu.be\/EVwjxoAgveI?si=3-FzR6aZzPXREkFC","created_at":"2 months ago"},{"id":"11","title":"M2-R5. Web Desinging January 2025","description":"10 \u0918\u0902\u091f\u0947 \u0915\u0940 \u092e\u0948\u0930\u093e\u0925\u0928 \u090f\u0915 class \u0938\u0947 \u090f\u0917\u094d\u091c\u093e\u092e \u092a\u093e\u0938 | O Level Marathon Class | 700 MCQs | o level web designing mcq questions","action_url":"https:\/\/youtu.be\/NOKzc2HvuRw?si=U7xEAZ5uTQbWFFvM","created_at":"2 months ago"},{"id":"10","title":"O Level Passing Marks, Exam Pattern, Grading","description":"Solved These Topics: O Level Exam Pattern 2025, O Level Exam Pattern 2025 Grading System in O Level","action_url":"https:\/\/youtu.be\/M8hiDbKcziY","created_at":"3 months ago"},{"id":"9","title":"O Level Exam Kaise hota hai ?","description":"\u0905\u0917\u0930 \u0906\u092a \u092a\u0939\u0932\u0940 \u092c\u093e\u0930 O Level Exam \u0926\u0947\u0928\u0947 \u091c\u093e \u0930\u0939\u0947 \u0939\u0948 \u0924\u094b \u0907\u0938 \u0935\u093f\u0921\u093f\u092f\u094b \u092e\u0947\u0902 \u0926\u093f\u0916\u093e\u092f\u093e \u0917\u092f\u093e \u0939\u0948 \u0915\u0948\u0938\u0947 \u0926\u0947\u0924\u0947 \u0939\u0948 O Level Exam Live","action_url":"https:\/\/youtu.be\/ri5l4q9ls3w","created_at":"3 months ago"},{"id":"8","title":"O Level Pass \u0915\u0948\u0938\u0947 \u0915\u0930\u0947\u0902 | O Level Syllabus 2025","description":"\u0907\u0938 \u0935\u093f\u0921\u093f\u092f\u094b \u092e\u0947\u0902  O Level Detailed Syllabus 2025 \u0935 O Level Exam Preparation \u0915\u0948\u0938\u0947 \u0915\u0930\u0947\u0902 \u0907\u0938\u0915\u0947 \u0932\u093f\u090f \u0930\u0923\u0928\u0940\u0924\u093f (Strategy) \u092d\u0940 \u092c\u0924\u093e\u092f\u0940 \u0917\u092f\u0940 \u0939\u0948 | 100% \u092a\u094d\u0930\u092d\u093e\u0935\u0936\u093e\u0932\u0940 \u091f\u094d\u0930\u093f\u0915","action_url":"https:\/\/youtu.be\/89v-xT7y3OA?si=Ve6uUOJ-Y6_AyS6M","created_at":"4 months ago"},{"id":"7","title":"O Level Paper Lock Date Extened","description":"PUBLIC NOTICE FOR CANDIDATES \/ INSTITUTES: The filling of Online Examination Application Form (OEAF) for O\/A\/B\/C Level (Theory & Practical) for January, 2025 has been extended for 02 days, i.e. till 13th November, 2024.","action_url":"https:\/\/youtu.be\/dxZTuHjYYys?si=Hh3aJJk7ul8WZpLE","created_at":"4 months ago"},{"id":"6","title":"O Level to A Level, Jan- 2025 It, A Level Registration","description":"Last Date Of Submission Of Online Registration Application For Direct Candidate: 08-Nov-2024 Last Date Of Submission Of Online Registration Application For Institute Candidate:08-Nov-2024","action_url":"https:\/\/youtu.be\/gyi2-3dkURY","created_at":"4 months ago"},{"id":"5","title":"A\/ O Level January 2025 Important Dates","description":"<ul type='I'>\n<li>O Level Examination Form January 2025 Filling Start From: <b>21 october 2024<\/b> <\/li>\n<li>O Level Examination Form January 2025 Filling Last Date: <b>11 November 2024<\/b> <\/li>\n<li>O Level January 2025 Theory Examination Date: <b>15th Janaury 2025 to 22th January 2025<\/b> <\/li>\n<li>O Level January 2025 Practical Examination Date: <b>8th February 2025 <\/b> <\/li>\n<li>O Level Result January 2025 Date: <b>Last week of April 2025<\/li><\/ul>","action_url":"https:\/\/www.youtube.com\/live\/8wl3uFbpI4w?si=xHLSoS9RiXMb_NUJ","created_at":"5 months ago"},{"id":"4","title":"O Level Result July 2024","description":"PUBLIC NOTICE FOR CANDIDATE \/ INSTITUTES : Result of O\/A\/B\/C Level Examination (Theory\/Practical) for July, 2024 Exam. cycle, has been declared.","action_url":"https:\/\/youtu.be\/UM7fDW89rDY?si=Qc5NFJmEldbk_-Ul","created_at":"5 months ago"}];
// 	window.n_obj = notification_obj;
// </script>


<!-- NOT for urgent load -->
<!--<link href="https://fonts.googleapis.com/css2?family=Reddit+Sans:ital,wght@0,200..900;1,200..900&amp;display=swap" rel="stylesheet">-->
<!--<link rel="stylesheet" type="text/css" href="../../../public/assets/vendor/tiny-slider/tiny-slider.css">-->
<!--<link rel="stylesheet" type="text/css" href="../../../public/assets/vendor/font-awesome/css/all.min.css">-->
<!--<link rel="stylesheet" type="text/css" href="../../../public/assets/vendor/bootstrap-icons/bootstrap-icons.css">-->
<!-- end here -->


<!-- Bootstrap JS -->
<script src="public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/assets/js/jquery.js"></script>

<!-- Vendors -->
<!--<script src="public/assets/vendor/tiny-slider/tiny-slider.js"></script>-->
<!--<script src="public/assets/vendor/glightbox/js/glightbox.js"></script>-->
<!--<script src="public/assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>-->

<!-- Template Functions -->
<!--<script src="public/assets/js/functions8f1b.js?ver=16032025"></script>-->
<!--<script src="public/assets/js/auth6549.js?ver=8102024"></script>-->

	<!-- Google tag (gtag.js) -->
	<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-0N2RLNR4J9"></script>-->
	<!--<script>-->
	<!--	window.dataLayer = window.dataLayer || [];-->

	<!--	function gtag() {-->
	<!--		dataLayer.push(arguments);-->
	<!--	}-->
	<!--	gtag('js', new Date());-->

	<!--	gtag('config', 'G-0N2RLNR4J9');-->
	<!--</script>-->


</body>

</html>