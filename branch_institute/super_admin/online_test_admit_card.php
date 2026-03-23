<?php 
include'con.php'; 
include'asset.php';
$t_date=date("Y-m-d");
$exmatch_time=date("Y-m-d H:i");
$trs=1;
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
	             <div style="position:absolute;margin: 203px 0 0 220px;font-size: 14px;">
                  <?php echo $course_details['name'];?>				
					</div>
                    <div style="position:absolute;margin: 243px 0 0 220px;font-size: 14px;">
                  <?php echo $student_exam_details['exam_subject'];?>				
					</div>
                    <div style="position:absolute;margin: 287px 0 0 220px;font-size: 14px;">
                 <?php echo "UCC".$data_details['id'];?>				
					</div>
            	     <div style="position:absolute;margin: 330px 0 0 220px;font-size: 14px;">
                   <?php echo $student_exam_details['exame_no'];?>			
					</div>
	                 <div style="position:absolute;margin: 375px 0 0 220px;font-size: 14px;">
                <?php echo $exam_date;?>				
					</div>
                    <div style="position:absolute;margin: 418px 0 0 220px;font-size: 14px;">
                <?php echo $reporting_time;?>					
					</div>
                    <div style="position:absolute;margin: 375px 0 0 537px;font-size: 14px;">
                <?php echo $exam_start_time;?>					
					</div>
					<div style="position:absolute;margin: 417px 0 0 537px;font-size: 14px;">
			    <?php echo $exam_entry_close;?>					
					</div>
					<div style="position: absolute;margin: 476px 0 0 36px;width: 392px;font-size: 14px;text-align: justify;line-height: 1.5;">
				<?php echo $student_exam_details['exam_venue'];?>
								 
					</div>
					
					
					<div style="position:absolute;margin: 607px 0 0 148px;font-size: 14px;">
			<?php echo $data_details['name'];?>					
					</div>
					<div style="position:absolute; margin: 657px 0 0 148px;  color: #000000; font-size: 14px;">
				    <?php echo $dob;?>
					</div>
					<div style="position:absolute; margin: 700px 0 0 148px;  color: #000000; font-size: 14px;">
				<?php echo $data_details['mobile'];?>							
					</div>
					<div style="position: absolute;margin: 757px 0 0 30px;width: 392px;font-size: 14px;text-align: justify;line-height: 1.5;">
			<?php echo $data_details['full_add'];?>
								 
					</div>
						
				
					<img class="thing" src="<?php echo "$web_link".$data_details['photo'];?>	" style="position: absolute;background:white; margin: 591px 0 0 432px;width: 124px;height: 137px;   padding: 4px;" alt="Photo">
					
					<img class="thing" src="<?php echo "$web_link".$data_details['sign_img'];?>" style="position: absolute;background:white; margin: 737px 0 0 432px;width: 118px;height: 87px;   padding: 4px;" alt="signature">

					<!--<div style="position: absolute; margin-top: 675px;  margin-left: 553px; width: 116px; height: 116px; overflow: hidden">-->
					<!--	<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $web_link;?>verify_certificate?data_id=<?php echo $enrollment_no; ?>" style="position: absolute; margin-top: -15px;  margin-left: -15px; width: 145px;">	-->
					<!--</div>-->
					
										
					<img src="image/admit_card.jpg" style="width:715px; height:1021px;" />
					
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
<!--<script>-->
<!-- $(document).ready(function(){-->

    
<!--var element = $("#html-content-holder"); // global variable-->
<!--var getCanvas; // global variable-->
 
    
<!--         html2canvas(element, {-->
<!--         onrendered: function (canvas) {-->
<!--                $("#previewImage").append(canvas);-->
<!--                getCanvas = canvas;-->
<!--             }-->
<!--         });-->
 

<!--    $("#btn-Convert-Html2Image").on('click', function () {-->
<!--    var imgageData = getCanvas.toDataURL("image/png");-->
    <!--// Now browser starts downloading it instead of just showing it-->
<!--    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");-->
<!--    $("#btn-Convert-Html2Image").attr("download", "<?php echo $data_details['name']; ?>_admit_card.png").attr("href", newData);-->
<!--    });-->

<!--});-->

<!--</script>-->
</html>