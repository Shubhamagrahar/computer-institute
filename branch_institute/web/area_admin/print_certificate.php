<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['data_id'])){
    $data_id=VerifyData($_GET['data_id']);
    if(!$data_id==""){
      
     $sql=mysqli_query($con,"select * from student_certificate where id='$data_id' and status='VERIFY'");
       if(mysqli_num_rows($sql)==1){
           $result=mysqli_fetch_array($sql);
          $name=$result['name'];
        $father_name=$result['father_name'];
        $enrollment_no=$result['enrollment_no'];
        $certificate_no=$result['certificate_no'];
        $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$result[course_id]'"));
        $photo=$result['photo']; 
        $issue_date=date_create($result['upload_date']);
        $issue_date=date_format($issue_date,"d-m-Y");
        $dob=date_create($result['dob']);
        $dob=date_format($dob,"d-M-Y");
        $start_date=date_create($result['start_date']);
        $start_date=date_format($start_date,"d-m-Y");
        $complete_date=date_create($result['complete_date']);
        $complete_date=date_format($complete_date,"d-m-Y");
        $student_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$result[mobile]'"));
        
          if($student_details['branch_id']==$_SESSION['userid']){
             $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$student_details[branch_id]'"));  
           }else{
               mysqli_close($con);
           echo '<script>window.close();</script>';     
           } 
       }else{
           mysqli_close($con);
        echo '<script>window.close();</script>';  
        exit();
       } 
    }else{
        mysqli_close($con);
        echo '<script>window.close();</script>';
        exit();
    }
}else{
    mysqli_close($con);
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
	    <title> Certificate for <?php echo $name;?>-<?php echo $certificate_no;?></title>
	  <!-- Favicons -->
  <link href="<?php echo $brand_logo;?>" rel="icon">
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
			    -webkit-filter: drop-shadow(-1px 0 black) drop-shadow(0 1px black) drop-shadow(1px 0 black) drop-shadow(0 -1px black);
			}
		</style>
		
	</head>
	<body>
	  <style>
    	@font-face {
		  font-family: myFirstFont;
		  src: url(../softvision/GreatVibes-Regular.otf);
		}
		@font-face {
		  font-family: paragraph;
		  src: url(../softvision/JosefinSans-Regular.ttf);
		}
		
	.orange{
		color:#ed3442;
		 font-family: paragraph;
		 font-weight:700;
	}

	.print222{
		width:1020px; 
		height:715px;
	}


@page {
size: A4 landscape !important;
margin: 5px !important;
margin-bottom: 0px;
padding: 0px !important;
}

@media print {
  body {
    visibility: hidden;
  }
  .print222{
		width:100% !important; 
		height:auto !important;
  } 
}
    </style>
    <div class="print111" style="width: fit-content !important; visibility: visible;">
                <div style="position:absolute;margin: 362px 0 0 170px; width: 770px; font-size: 30px; text-align:center;font-family: math;font-weight: 700;">
					<?php echo $name;?>	</div>
					
						<?php 
                       
                       $max_mark=0;
                       $obt_mark=0;
                       
                       $sql_subject=mysqli_query($con,"select * from certificate_marks_details where student_certificate_id='$result[id]'");
                       while($row=mysqli_fetch_array($sql_subject)){
                       ?>
						<div class="marksheetLine">
							
							<div class="subjectName"><?php  $row['subject_name'] ; ?></div>
							<div class="mark"><?php $max_mark +=$row['max_mark'];  $row['max_mark'] ; ?></div>
							<div class="mark"><?php $obt_mark +=$row['obt_mark'];  $row['obt_mark'] ; ?></div>
						</div>
							<?php } ?>	
						<?php 
						 if($max_mark>0){
				 		 $marks_per=round(($obt_mark * 100 )/$max_mark,2 );
    					 }else{
    					   $marks_per=0;  
    					 }
						 
						if($marks_per>=80 and $marks_per<=100){
						     $result_status="Pass";
						     $result_grade="A";
						 }
						 if($marks_per>=65 and $marks_per<80){
						     $result_status="Pass";
						     $result_grade="B";
						 }
						if($marks_per>=50 and $marks_per<65){
						     $result_status="Pass";
						     $result_grade="C";
						 }
						 if($marks_per>=35 and $marks_per<50){
						     $result_status="Pass";
						     $result_grade="D";
						 }
						 if($marks_per<35 ){
						     $result_status="Faild";
						     $result_grade="F";
						 }
						?>
					<div style="position:absolute;margin: 398px 0 0 277px; width: 560px; font-size: 20px; text-align:justify;font-weight:500; ">
						
				 		<?php
						if($result['gender']=="Male"){
						    echo "S/O";
						}
						if($result['gender']=="Female"){
						    echo "D/O";
						}
						if($result['gender']=="Other"){
						    echo "C/O";
						}
					?>
						
					<span class="orange"><?php echo $father_name;?></span> On Successful Completion of <span class="orange"><?php echo $course_details['name']; ?></span> Condacted From <span class="orange"><?php echo $start_date; ?></span> to <span class="orange"><?php echo $complete_date; ?></span> in the <span class="orange" id="marksheet_grade"></span> grade from our training center <span class="orange" >
					<?php 
					if($student_details['branch_id']>0){
					    echo $branch_details['name'];
					}else{
					    echo "Student not registeres or Branch Not Assign.";
					} ?></span>.
						
					
						</div>
							<div style="position:absolute; margin: 225px 0 0 60px; font-size: 17px;font-weight: 600;">
						Certificate No.: <?php echo $certificate_no ; ?>
						</div>
							<div style="position:absolute; margin: 245px 0 0 60px; font-size: 17px;font-weight: 600;">
						Enrollment No.: <?php echo $enrollment_no; ?> 
						</div>
						
						<div style="position:absolute; margin: 518px 0 0 250px; font-size: 17px;font-weight: 600;">
					Issue Date: <?php echo $issue_date; ?>	
						</div>
					
						<img class="thing" src="<?php echo $web_link.$result['photo']; ?>" style="position: absolute;background:white; margin: 207px 0 0 880px;width: 124px;height: 144px;   ">
					
				<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $brand_link; ?>verify_certificate?data_id=<?php echo $certificate_no; ?>" style="position: absolute; margin-top: 430px;  margin-left: 910px; width: 104px;">	
					
					<img src="../super_admin/image/certificate.jpg" style="" class="print222" />
					</div>
		<script>
		document.getElementById("marksheet_grade").innerHTML = "<?php echo $result_grade; ?>";
		</script>	
		
			<script type="text/javascript">
      window.print();
      window.oncancelprint = window.close;
      window.onafterprint = window.close;
    </script>	
		
	</body>
	<?php 
  mysqli_close($con);
  ?>
</html>