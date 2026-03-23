<?php 
include 'session.php'; 
$t_date=date("Y-m-d");
$exmatch_time=date("Y-m-d H:i");
$trs=1;
if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
if(isset($_GET['exam_id'])){
    $exam_id=VerifyData($_GET['exam_id']);
    $user_id=VerifyData($_GET['user_id']);
    if(!$exam_id=="" and !$user_id==""){
        $exam_details=mysqli_fetch_array(mysqli_query($con,"select * from online_test_exam_details where id='$exam_id'"));
        $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$user_id'"));
        $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$user_details[branch_id]'"));
        $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$exam_details[course_id]'"));
        $exam_date=date_create($exam_details['exam_date']);
        $exam_date=date_format($exam_date,"d-m-Y");
        $dob=date_create($user_details['dob']);
        $dob=date_format($dob,"d-m-Y");
    }else{
        mysqli_close($con);
        echo'<script>alert("Something went wrong. Please select the correct student admit card.");window.location.assign("online_test_student_admit_card")</script>';
        exit();    
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admit card | <?php echo $brand_name; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo $brand_fav_logo; ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
   
</head>

<body>


    <!-- Gallery Start -->
    <div class="container-xxl py-5">
        <div class="container">
          
            
            <div class="col-md-12">
                       <div class="contact-part">
                      
                     <div align="center">
                     <div id="printableArea" class="col-sm-12">
                        <div style="position: relative; width:715px; height:1021px;">
                  <style>
          .head_content1{
            font-size: 30px;
            text-transform: uppercase;
            font-weight: 600;
          }
      </style>      
      <!--<div style="position:absolute;margin: 19px 0 0 21px;width: 672px;text-align:center;"> -->
                    <div style="position:absolute;margin: 50px 0 0 21px;width: 672px;text-align:center;">
                        <span class="head_content1"><?php //echo $brand_name;?>	</span><br>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $brand_add ;?> <br>
				<i class="fa fa-phone" aria-hidden="true"></i> <?php echo $brand_mob ;?>,
				<?php
                    if(!$brand_mob2==""){
                        ?>
				<i class="fa fa-phone" aria-hidden="true"></i> <?php echo $brand_mob2 ;?>, 
				<?php } ?>
				<?php
                    if(!$brand_mob3==""){
                        ?>
				<i class="fa fa-phone" aria-hidden="true"></i> <?php echo $brand_mob3 ;?>, 
				<?php } ?>
				<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $brand_email ;?>
                  			
					</div>          
                    <div style="position:absolute;margin: 174px 0 0 220px;font-size: 14px;">
                  <?php echo $branch_details['name'];?>				
					</div>        
	             <div style="position:absolute;margin: 213px 0 0 220px;font-size: 14px;">
                  <?php echo $course_details['name'];?>				
					</div>
                    <div style="position:absolute;margin: 250px 0 0 220px;font-size: 14px;">
                  <?php echo $exam_details['test_level'];?>				
					</div>
                    <div style="position:absolute;margin: 289px 0 0 220px;font-size: 14px;">
                 	<?php echo $exam_date;?>			
					</div>
            	    
                    <div style="position:absolute;margin: 291px 0 0 540px;font-size: 14px;">
                <?php echo date_format(date_create($exam_details['start_time']), "h:i A"); ?>					
					</div>
				
					<div style="position: absolute;margin: 339px 0 0 36px;width: 392px;font-size: 14px;text-align: justify;line-height: 1.5;">
				<?php echo $branch_details['full_add'];?>
								 
					</div>
					<div style="position:absolute;margin: 444px 0 0 154px;font-size: 14px;">
			<?php echo $user_details['id'];?>					
					</div>	
					
					<div style="position:absolute;margin: 483px 0 0 154px;font-size: 14px;">
			<?php echo $user_details['name'];?>					
					</div>
					
					<div style="position:absolute; margin: 521px 0 0 154px;  color: #000000; font-size: 14px;">
				<?php echo $user_details['mobile'];?>							
					</div>
					<div style="position:absolute; margin: 556px 0 0 154px;  color: #000000; font-size: 14px;">
				    <?php echo $dob;?>
					</div>
					<div style="position: absolute;margin: 610px 0 0 30px;width: 522px;font-size: 14px;text-align: justify;line-height: 1.5;">
			<?php echo $user_details['full_add'];?>
								 
					</div>
						
				
					<img class="thing" src="<?php echo "$web_link".$user_details['photo'];?>	" style="position: absolute;background:white; margin: 432px 0 0 563px;width: 123px;height: 144px;   padding: 2px;" alt="Photo">
					
					
										
					<img src="image/admit_card_bibhan.jpg" style="width:715px; height:1021px;" />
					
				</div> 
                    </div>
                    
                    
                     <input type="button" onclick="printDiv('printableArea')" value="Print" style="color: white;background-color: #0d6efd;border-radius: 5px;">
                     </div>
                   
                                        </div>
                                        <br>
                                       
                                    </div>
                                    <!-- /.card-body -->
                                <!--</form>-->
                              
                        </div>
                        
                     </div>
                    
        </div>
    </div>
    <!-- Gallery End -->


   
    <script>
        function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script>
</body>
<script>
    
</script>

</html>