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
          $owner_name=$result['father_name'];
          $full_address=$result['full_add'];
          $branch_id=$result['id'];
        //   $enrollment_no=$result['enrollment_no'];
        //   $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$result[course_id]'"));
           
          $issue_date=date_create($result['r_date']);
          $issue_date=date_format($issue_date,"d-m-Y");
        //   $dob=date_create($result['dob']);
        //   $dob=date_format($dob,"d-M-Y");
        //   $start_date=date_create($result['start_date']);
        //   $start_date=date_format($start_date,"d-m-Y");
        //   $complete_date=date_create($result['complete_date']);
        //   $complete_date=date_format($complete_date,"d-m-Y");
          
        //   $student_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$result[mobile]'"));
           
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
	    <title>ATC CERTIFICATE</title>
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
	<link href="https://fonts.googleapis.com/css?family=Germania+One|Lobster|Saira+Extra+Condensed" rel="stylesheet">

<div style="width: 1022px;
    overflow: hidden;">
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
	}
    </style>


    <div class="print111" style="width: fit-content !important; visibility: visible;">
                   
                   <div style="position:absolute;margin: 304px 0 0 332px; width: 344px; font-size: 20px;text-align:center; font-family: math; font-weight: 700;">
					
					<?php echo $owner_name;?>	</div>
					<div style="position:absolute;margin:413px 0 0 284px; width: 438px; font-size: 20px;text-align:center; font-family: math; font-weight: 700;">
					
					<?php echo $name; ?> - <?php echo $full_address; ?>	</div>
				
					<div style="position:absolute; margin: 433px 0 0 754px; width: 110px; font-size: 15px; text-align:center; font-family: inherit; font-weight: 700;">
					ATC Code <br><?php echo $brand_short_code."ATC".$branch_id; ?>
					</div>
				<div style="position:absolute; margin: 480px 0 0 228px; width: 300px; font-size: 15px; text-align:center; font-family: inherit; font-weight: 700;">
					Issue Date: <?php echo $issue_date; ?>
					</div>
					
		<div style="position: absolute;">
		    	<img class="thing" src="<?php echo $web_link.$result['photo'];?>" style="position: absolute;background:white; margin: 252px 0 0 775px;width: 79px;height: 99px;  border-radius: 8px; ">
		</div>
					
			<div style="position: absolute; margin-top: 360px;  margin-left: 779px;">
						<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Name: <?php echo $owner_name;?>, ATC Name: <?php echo $name; ?>, ATC Code: <?php echo $brand_short_code."ATC".$branch_id; ?>, Address: <?php echo $full_address;?>" style="width: 69px;">	
					</div>
					
					<img src="image/atc_certificate.jpg" style="width:1020px; height:720px;" class="print222" />
					
					
					
				</div>
							
				
				
		
		
			 <script type="text/javascript">
    // window.print();
      window.oncancelprint = window.close;
      window.onafterprint = window.close;
    </script>	 
		
	</body>
	<?php 
  mysqli_close($con);
  ?>
</html>