<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['data_id'])){
    $data_id=VerifyData($_GET['data_id']);
    if(!$data_id==""){
      
      $sql=mysqli_query($con,"select * from user where id='$data_id'");
      if(mysqli_num_rows($sql)==1){
          $result=mysqli_fetch_array($sql);
          
          $name=$result['name'];
          $id=$result['id'];
          $enrollment_no=$result['enrollment_no'];
          $photo=$result['photo'];
          $mobile=$result['mobile'];
          $gender=$result['gender'];
          
          $course_book=mysqli_fetch_array(mysqli_query($con,"select * from course_book where status='RUN' and userid='$result[id]'"));
        //   echo $course_book['course_id'];
          
            $course_book_date=date_create($course_book['start_date']);
         $course_book_date=date_format($course_book_date,"d-m-Y");
          
          $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$course_book[course_id]'"));
           
        
        //  $dob=date_create($result['dob']);
        //  $dob=date_format($dob,"d-M-Y");
        
        //  $student_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$result[mobile]'"));
           
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



?>

			
<html>
	<head>
	    <title>ID card for <?php echo $name; ?>, ID No.<?php echo $brand_short_code.$id; ?></title>
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
	    
	<div style="position: relative; width:715px; height:1021px;">
					<div style="position:absolute;margin: 173px 0 0 140px;font-weight: bold; width: 560px; font-size: 19px; text-align:center; color: #E80E13;">
						<!--Course Name Title -->
						</div>
				
			
					
					<div style="position:absolute; margin: 186px 0 0 3px; font-weight: bold; color: #ffffff; font-size: 14px;min-width: 157px; max-width: 157px; width: 157px;">
		<?php echo $name; ?>
						</div>
						<div style="position:absolute; margin: 225px 0 0 116px; font-weight: bold; color: #ffffff; font-size: 14px;">
					STUDENT
						</div>
						<div style="position:absolute; margin: 253px 0 0 3px; font-weight: bold; color: #000000; font-size: 11px;">
						ID Card No. : <?php echo $brand_short_code.$id; ?>	
						</div>
						
						<div style="position:absolute; margin: 265px 0 0 3px; font-weight: bold; color: #000000; font-size: 12px;">
				Date of issue :	<?php echo $course_book_date; ?>
						</div>
					<div style="position:absolute; margin: 277px 0 0 3px; font-weight: bold; color: #000000; font-size: 12px;">
							Gender : <?php echo $gender;  ?>		</div>
							
						<div style="position:absolute; margin: 290px 0 0 3px; font-weight: bold; color: #000000; font-size: 12px;">
							Contact No. : <?php echo $mobile;  ?></div>
							
							
							<div style="position:absolute; margin: 302px 0 0 3px; font-weight: bold; color: #000000; font-size: 12px; max-width: 172px; width: 172px;">
						Course : <?php echo $course_details['name']; ?>		</div>
							
				
					
				
					
					<div>
					    <img class="thing" src="<?php echo $web_link. $photo ?>" style="position: absolute;background:white; margin: 49px 0 0 54px;width: 117px;height: 111px;   padding: 4px; border-radius: 65px;">
					</div>
				
					<div style="position: absolute; margin: 253px 0 0 175px; width: 55px; height: 51px; overflow: hidden">
					
				<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $name; ?>/<?php echo $brand_short_code.$id; ?>&size=110x110" style="position: absolute; margin-top: -8px;  margin-left: -6px; width: 67px;">	
					</div>
					
										
					<img  src="image/id_card.jpg" style="width:230px; height:345px; border:1px solid black; border-radius: 7px;" />
					
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