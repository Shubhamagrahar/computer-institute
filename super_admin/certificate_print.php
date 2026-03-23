<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['data_id'])){
    $data_id=VerifyData($_GET['data_id']);
    if(!$data_id==""){
      
      $sql=mysqli_query($con,"select * from student_certificate where id='$data_id'");
       if(mysqli_num_rows($sql)==1){
           $result=mysqli_fetch_array($sql);
          
           $name=$result['name'];
           $enrollment_no=$result['enrollment_no'];
           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$result[course_id]'"));
           
          $date=date_create($result['upload_date']);
          $date=date_format($date,"d-M-Y");
          $dob=date_create($result['dob']);
          $dob=date_format($dob,"d-M-Y");
          
          $student_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$result[mobile]'"));
           
       }else{
        echo '<script>window.close();</script>';  
        exit();
       } 
    }else{
        echo '<script>window.close();</script>';
        exit();
    }
}else{
    echo '<script>window.close();</script>';
    exit();
}



function get_number_in_word($data){
            $number = $data;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        // $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $hundred = ($counter == 1 && $str[0]) ? '' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result_word = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
// $word_amt= $result_word . "Rupees  " . $points . " Paise";
$word_amt= $result_word ;//. "Rupees only.";
     $word_amt=   ucwords($word_amt);
     return $word_amt;
}


?>
<html>
	<head>
	    <title>Certificate | <?php echo $brand_name ;?></title>
    <!-- Favicon -->
    <link href="<?php echo $brand_fav_logo; ?>" rel="icon">
		<style>
		body{
			-webkit-print-color-adjust:exact;
		}
			*{
				margin:0;
				font-family:Arial, Helvetica, sans-serif;
				padding:0;
				color:#000000;
			}

		  span{
		  	color:#00308F;
		  	font-family: serif;
		  	
		  }
		  .thing {
			    -webkit-print-color-adjust:exact;
			    -webkit-filter:opacity(1);
			}
			
		</style>
	</head>
	<body>
	<div style="position: relative; width:715px; height:1021px;">
					<div style="position:absolute;margin: 173px 0 0 140px;font-weight: bold; width: 560px; font-size: 19px; text-align:center; color: #E80E13;">
						<!--Course Name Title -->
						<!--<?php echo $course_details['name']; ?>					-->
						</div>
					<div style="position:absolute; margin: 360px 0 0 485px; font-weight: bold; color: #000000; font-size: 15px;">
						Certificate No.: <?php echo $enrollment_no; ?>					</div>
					<div style="position:absolute; margin: 360px 0 0 140px; font-weight: bold; color: #000000; font-size: 15px;">
												Issue Date: <?php echo $date; ?>					</div>
					
										
					<div style="position: absolute;font-family: serif;font-style: italic;margin: 220px 0 0 140px;width: 560px;font-size: 16px;font-weight: bold;text-align: justify;line-height: 1.5;">
						This is to certify that <span><?php echo $name; ?> </span> 
						has been awarded <span><?php echo $course_details['name']; ?></span> 
						having completed the curriculum from our center with grade 
						<span id="marksheet_grade"></span> and <span><?php echo $course_details['duration']; ?></span> months 
						given under our supervision.<br/>
						
												<br/>
														<div style="font-size: 83%;">
								Date of Birth : <span><?php echo $dob; ?></span> 
								</div>
								 
					</div>
						
					
					<div style="position:absolute; margin: 430px 0 0 25px; font-weight: bold; color: #000000; font-size: 14px;">
					<style>
						.subjectName{
							width:320px;
							float:left;
							margin-bottom:5px;
						}
						.mark{
							float:left;
							width:81px;
							text-align:center;
							margin-bottom:5px;
						}
						
					</style>
                      
                       <?php 
                       
                       $max_mark=0;
                       $obt_mark=0;
                       
                       $sql_subject=mysqli_query($con,"select * from certificate_marks_details where student_certificate_id='$result[id]'");
                       while($row=mysqli_fetch_array($sql_subject)){
                       ?>
                      
						<div class="marksheetLine">
							<div class="subjectName"><?php echo $row['subject_name'] ; ?></div>
							<div class="mark"><?php $max_mark +=$row['max_mark']; echo $row['max_mark'] ; ?></div>
							<div class="mark"><?php $obt_mark +=$row['obt_mark']; echo $row['obt_mark'] ; ?></div>
						</div>
					  	<?php } ?>	
					</div>
					
					<div style="position:absolute; margin: 430px 0 0 512px; font-weight: bold; color: #000000; font-size: 15px; width:182px; line-height: 1.5;">
						Total : <?php echo $max_mark ; ?> / <?php echo $obt_mark ; ?><br/>
						(<?php echo get_number_in_word($obt_mark) ;?>)<br/><br/>
						<?php 
						 $marks_per=round(($obt_mark * 100 )/$max_mark );
						 
						 if($marks_per>=80 and $marks_per<=100){
						     $result_status="Pass";
						     $result_grade="Excellent";
						 }
						 if($marks_per>=70 and $marks_per<80){
						     $result_status="Pass";
						     $result_grade="Good";
						 }
						 if($marks_per>=60 and $marks_per<70){
						     $result_status="Pass";
						     $result_grade="Fair";
						 }
						 if($marks_per>=50 and $marks_per<60){
						     $result_status="Pass";
						     $result_grade="Satisfactory";
						 }
						 if($marks_per<50 ){
						     $result_status="Faild";
						     $result_grade="Poor";
						 }
						?>
																		Percentage : <?php echo $marks_per; ?>% <br/><br/>
						Result : <?php echo $result_status; ?> <br/><br/>
						Grade : <?php echo $result_grade; ?>						
					</div>
					
					 <script>
					     document.getElementById("marksheet_grade").innerHTML = "<?php echo $result_grade; ?>";
					 </script>
					
					<img class="thing" src="<?php echo $web_link.$student_details['photo']; ?>" style="position: absolute;background:white; margin: 225px 0 0 15px;width: 110px;height: 149px;   padding: 4px;">
					
					
					<!--<img src="http://api.qrserver.com/v1/create-qr-code/?data=https://ucc.edug.in/web/verify_certificate?data_id=<?php echo $enrollment_no; ?>" style="position: absolute; margin-top: 700px;  margin-left: 580px; width: 110px;">-->
					
					<div style="position: absolute; margin-top: 674px;  margin-left: 558px; width: 140px; height: 140px; overflow: hidden">
						<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $brand_link; ?>verify_certificate?data_id=<?php echo $enrollment_no; ?>" style="position: absolute; margin-top: -15px;  margin-left: -15px; width: 170px;">	
					</div>
					
										
					<img src="image/certificate4.jpg?ph=400" style="width:715px; height:1021px;" />
					
				</div>		<div>
			<img src="image/back.jpg?ph=301" style="width:715px; height:1021px;" />
		</div> 
				
		
		
		
	</body>
</html>