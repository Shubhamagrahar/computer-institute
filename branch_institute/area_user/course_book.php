<?php
include('session.php');


$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['book'])){
    $course_id=VerifyData($_GET['book']);
    if(!$course_id==""){
        $check_course=mysqli_query($con,"select * from course_details where id='$course_id' and status='OPEN'");
        if(mysqli_num_rows($check_course)==1){
         $course_details=mysqli_fetch_array($check_course);
          $chek_pre_booking=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and course_id='$course_id' and status!='CANCEL'"));
          if(!$chek_pre_booking>0){
            
            $insert_course_book=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$_SESSION[userid]', '$course_id', '$course_details[fee]', '$t_date')");
            if($insert_course_book){
             
                   echo '<script>alert("Course enrollment successfully done.");window.location.assign("course_running");</script>'; 
               
                
            }else{
             echo '<script>alert("Server error 101.");window.location.assign("course_book");</script>';     
            } 
              
          }else{
            echo '<script>alert("Hello dear, You have already done this course.");window.location.assign("course_book");</script>';  
          }
            
        }else{
          echo '<script>alert("Course not found or not active.");window.location.assign("course_book");</script>';   
        }
    }else{
       echo '<script>alert("Somthing Went wrong.");window.location.assign("course_book");</script>'; 
    }
} 
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>All Course | <?php echo $brand_name; ?></title>
    <meta name="theme-color" content="#f38e0c"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'header.php' ; ?>
<style>
    .course_box{
    box-shadow: 0 2px 7px rgba(34, 48, 53, 0.81)!important;
    margin-right: 11px;
    margin-left: 9px;
    margin-top: 12px;
    padding-bottom: 10px;
    background-color: white;
    }
   
</style>
</head>
<body >
<!--Top Page-->
<?php include 'top_page.php' ; ?>
<!-- Top Page -->

<div class="container-fluid">
<div class="row">






<div class="col_m contant_1">


<div align="center" class="col_m">
 <h4 class="welcome_admin">All Course</h4>
 
</div> 

<div class="col_m">
    <div class="col-sm-12">
   <div class="col-sm-4"></div>
   <?php 
            
            $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
            while($row=mysqli_fetch_array($sql_course)){
                
            ?> 
 <div class="col-sm-4 course_box" id="fees_div" >
       <div class="col-sm-12 page_heading_all2">
       
      </div>
   
    <div class="col-md-4">
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
             
              
                <div class="card-body">
                  <div class="row" >
				 <div >
				     <img width="100%" style="border: 1px solid #c4f10c;" src="<?php echo $web_link.$row['img'] ?>">
				 </div>
				 <div class="col-md-12">
					     <p style="text-align:center;font-size: 24px; font-weight:800; font-family: 'Frank Ruhl Libre', serif;"><?php echo $row['name'] ?></p>
					 </div>
					  <div class="col-md-12">
					     <p style="text-align:center;font-size: 20px;font-style: italic;">Course Code: <?php echo $row['course_code']; ?> Month</p>
					 </div> 
					 <div class="col-md-12">
					     <p style="text-align:center;font-size: 20px;font-style: italic;">Duration: <?php echo $row['duration']; ?> Month</p>
					 </div> 
					 <div class="col-md-12" align="center"><h5>Total Fees</h5></div>
					 <div class="col-md-12" align="center">
					     <!--<h5 style="font-weight: 700; font-family: 'Frank Ruhl Libre', serif;">Rs.<del><?php echo ($row['duration']*600)-1; ?>.00</del></h5>-->
					     <h3 style="color: #5d9913; font-weight: 700; font-family: 'Frank Ruhl Libre', serif;">Rs: <?php echo $row['fee']; ?></h3>
					 </div>
					 <div class="col-md-12" id="des_div<?php echo $row['id'];?>" style="display:none;">
					     <?php echo $row['des']; ?>
					     <div align="center">
					     <button  type="submit" style="margin-bottom: 10px;" name="hide_des" onclick="hide_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')" class="btn btn-danger">Hide Details</button> 
					     </div>
					     
					   </div>
					 <div class="col-md-12" align="center" id="des_btn<?php echo $row['id'];?>" >
					     <br>
					    <button type="submit" style="margin-bottom: 10px;" name="show_des" class="btn btn-info" onclick="show_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')">View Details</button> 
					 </div>
					
					 
				 </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="center">
                  <a href="course_book?book=<?php echo $row['id']; ?>"><button type="submit" onclick="return confirm('Are you sure for book <?php echo $row['name'] ?> ?')" name="enroll_now" class="btn btn-success">Enroll Now</button></a>
                </div>
              
            </div>
            </div>
    
   
            <br><br><br><br><br><br><br>    
            </div>
             <?php } ?>
             <br><br><br><br><br><br><br>
        </div>
       
       </div>
   
   </div>
</div>


<div class="col_m">
    
</div>

<div class="col_m">
    
</div>




<br><br><br><br><br><br><br>
 
</div>

</div>

 


</div>
  
<?php include 'footer.php'; ?>
  
</body>
 <script>
                function show_des_function(val,val1){
                    document.getElementById(val).style.display="block";
                    document.getElementById(val1).style.display="none";
                }
                function hide_des_function(val,val1){
                    document.getElementById(val).style.display="none";
                    document.getElementById(val1).style.display="block";
                }
            </script>
<script>
    
    function get_user_pass(val){
        var userid =$("#userid").val();
        
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_user_userid12='+val+'&userid='+userid,
                success: function(data){
                 $("#mathc1").html(data);
                }
              }
              );
              
         
    }
    function get_match(val){
            var new2 =$("#new_pass").val(); 
            if((val== new2)){
              document.getElementById("mathc2").style.display="none";
              document.getElementById("mathc3").style.display="block";
            }else{
              document.getElementById("mathc2").style.display="block";
              document.getElementById("mathc3").style.display="none";  
            }
            
    }
</script>
<script>
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
</html>