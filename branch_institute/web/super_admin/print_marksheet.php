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
        $father_name=$result['father_name'];
        $enrollment_no=$result['enrollment_no'];
        $certificate_no=$result['certificate_no'];
        $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$result[course_id]'"));
        $photo=$result['photo']; 
        $issue_date=date_create($result['upload_date']);
        $issue_date=date_format($issue_date,"d-M-Y");
        $dob=date_create($result['dob']);
        $dob=date_format($dob,"d-M-Y");
        $start_date=date_create($result['start_date']);
        $start_date=date_format($start_date,"d-m-Y");
        $complete_date=date_create($result['complete_date']);
        $complete_date=date_format($complete_date,"d-m-Y");
        $student_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$result[mobile]'"));
        $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$student_details[branch_id]'"));
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
	   <title>Marksheet for <?php echo $name;?>-<?php echo $certificate_no;?></title>
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
			}

.print222{
		width:715px; 
		height:1020px;
	}

@page {
size: A4 portrait !important;
margin: 9px !important;
padding: 0px !important;
}

@media print {
  body {
    visibility: hidden;
  }
  .print222{
		width:100% !important; 
		height:100% !important;
  } 
}
			
		</style>
	</head>
	<body>
	<div style="width: fit-content !important; visibility: visible;">	
	<!--<div style="position: relative; width:715px; height:1021px;">-->
	   
						
					<div style="position:absolute;margin: 303px 0 0 114px;font-weight: bold; width: 560px; font-size: 19px; text-align:center; color: #E80E13;">
						<!--Course Name Title -->
						<?php echo $course_details['name']; ?>					
						</div>
							<div style="position:absolute; margin: 373px 0 0 173px; font-weight: bold; color: #000000; font-size: 14px;">
				<?php echo $certificate_no; ?>	</div>
					<div style="position:absolute; margin: 372px 0 0 542px; font-weight: bold; color: #000000; font-size: 14px;">
				<?php echo $enrollment_no; ?>
				</div>
					<div style="position:absolute; margin: 919px 0 0 100px; font-weight: bold; color: #000000; font-size: 15px;">
						<?php echo $issue_date; ?>
						</div>
				
				    	<div style="position:absolute; margin: 394px 0 0 173px; font-weight: bold; color: #000000; font-size: 14px;">
					<?php echo $name;?>
						</div>
						<div style="position:absolute; margin: 415px 0 0 173px; font-weight: bold; color: #000000; font-size: 14px;">
					<?php echo $father_name;?>
						</div>
						<div style="position:absolute; margin: 437px 0 0 173px; font-weight: bold; color: #000000; font-size: 14px;">
					<?php 
					if($student_details['branch_id']>0){
					    echo $branch_details['name'];
					}else{
					    echo "Student not registeres or Branch Not Assign.";
					} ?>
						</div>
				
					<div style="position:absolute; margin: 548px 0 0 44px; font-weight: bold; color: #000000; font-size: 13px;">
					<style>
						.subjectName{
							width:413px;
							float:left;
							text-align:left;
							margin-bottom:3px;
							font-size: 14px;
							font-weight:600;
						}
						.mark{
							float:left;
							width:105px;
							text-align:center;
							margin-bottom:3px;
							font-size: 14px;
							font-weight:600;
						}
						.mark2{
							float:left;
							width:65px;
							text-align:center;
							margin-bottom:3px;
							font-size: 14px;
							font-weight:600;
						}
						
					</style>
                      
                       <?php 
                       
                       $max_mark=0;
                       $obt_mark=0;
                        $i=0;
                       $sql_subject=mysqli_query($con,"select * from certificate_marks_details where student_certificate_id='$result[id]'");
                       while($row=mysqli_fetch_array($sql_subject)){
                           
                       ?>
                       <?php
                       $section=1;
                       if($section==2){
                       ?>
                     <div class="marksheetLine">
						     <div class="mark2"><?php echo $i +=1; ?></div>
							<div class="subjectName"><?php echo $row['subject_name'] ; ?></div>
							<div class="mark"><?php $max_mark +=$row['max_mark']; echo $row['max_mark'] ; ?></div>
							<div class="mark"><?php $obt_mark +=$row['obt_mark']; echo $row['obt_mark'] ; ?></div>
						</div>
					<?php } ?>	
					<table>
					    <tr>
					        <td class="mark2"><?php echo $i +=1; ?>.</td>
					        <td class="subjectName"><?php echo $row['subject_name'] ; ?></td>
					        <td class="mark"><?php $max_mark +=$row['max_mark']; echo $row['max_mark'] ; ?></td>
					        <td class="mark"><?php $obt_mark +=$row['obt_mark']; echo $row['obt_mark'] ; ?></td>
					    </tr>
					</table>
					  	<?php } ?>	
					</div>
					
					<div style="position:absolute; margin: 806px 0 0 563px; font-weight: bold; color: #000000; font-size: 15px; width:182px; line-height: 1.5;">
					 <?php echo $max_mark ; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $obt_mark ; ?><br/>
					
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
																	
					</div>
					<div style="position:absolute; margin: 808px 0 0 340px; font-weight: bold; color: #000000; font-size: 15px;">
			<?php echo $result_grade; ?></div>
			<div style="position:absolute; margin: 808px 0 0 149px; font-weight: bold; color: #000000; font-size: 15px;">
			<?php echo $marks_per; ?>%</div>
		
					 <script>
					     document.getElementById("marksheet_grade").innerHTML = "<?php echo $result_grade; ?>";
					 </script>
					
					<!--<img class="thing" src="<?php echo $web_link.$student_details['photo']; ?>" style="position: absolute;background:white; margin: 225px 0 0 15px;width: 110px;height: 149px;   padding: 4px;">-->
					
				<div style="position: absolute; margin-top: 965px;  margin-left: 75px; width: 72px; height: 72px; overflow: hidden; ">
						<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $brand_link; ?>verify_marksheet?data_id=<?php echo $certificate_no; ?>" style="position: absolute; margin-top: -6px;  margin-left: -6px; width: 83px;">	
					</div>
					
										
					<img src="image/marksheet.jpg" style="" class="print222" />
					
				</div>		
				
		
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