<?php
include('session.php');
//  include('../con.php');
//  include 'data.php'; 

 
// $user_sql=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]' "));
 
date_default_timezone_set('Asia/Kolkata');
$c_date=date("Y-m-d H:i:s");
$t_date=date("Y-m-d");

// include('payment_check.php');





?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Dashboard | <?php echo $company_full_name ?> </title>
    <meta name="theme-color" content="#f38e0c"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'header.php' ; ?>
  <script>
           window.onload = function() {
    document.getElementById("my_audio").play();
}
       </script>
       
<style>
.wallet1 {
    background: linear-gradient(45deg, #7f00ff, #e100ff)!important;
    margin-bottom: 11px;
    box-shadow: 0 9px 3px 0 rgba(0,0,0,0.14);
    border: none;
    border-radius: 7px;
    padding: 20px;
}

    .wallet3 {
    background: linear-gradient(45deg, #0badfb, #8bff50)!important;
    margin-bottom: 11px;
    box-shadow: 0 9px 3px 0 rgba(0,0,0,0.14);
    border: none;
    border-radius: 7px;
    padding:20px;
    
    }
</style>
</head>
<body >
<!--Top Page-->
<?php include 'top_page.php' ; ?>
<!-- Top Page -->

<div class="container-fluid">
<div class="row">



<!-- Popup -->

<?php
$popup=1;
if($popup=="2"){

     ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
<style type="text/css">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;
display: none;
}
.cnt223 a{
text-decoration: none;
}
.popup{
width: 50%%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}
.cnt223{
min-width:300px;
width: 300px;
min-height: 150px;
margin: 100px auto;
background: #f3f3f3;
position: relative;
z-index: 103;
padding: 15px 35px;
margin-left:30px;
border-radius: 5px;
box-shadow: 0 2px 5px #000;
}
.cnt223 p{
clear: both;
    color: #555555;
    /* text-align: justify; */
    font-size: 20px;
    font-family: sans-serif;
}
.cnt223 p a{
color: #d91900;
font-weight: bold;
}
.cnt223 .x{
float: right;
height: 35px;
left: 22px;
position: relative;
top: -25px;
width: 34px;
}
.cnt223 .x:hover{
cursor: pointer;
}
</style>
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
$('.close').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
</script>

<div class='popup'>
<div class='cnt223' align="center">
<h4>Your Trainer Notification</h4>
<div align="center">
    <p>Your trainer Mr. Kumar Sanu today not available. So please wait next trainer working day.</p>
<!--<a href="notice_p"><button class="btn2"> Click For Details</button></a>-->
<br><br><p>
<a href='' class='close'>Close</a>
</p></div>

</div>
</div>
<!-- popup End --->

<?php } ?>



<div class="col_m contant_1">


<div class="col_m">
 <div align="center" style="border: 2px solid blue; background-color:#f7e692;">
    	<p class="welcome_admin">Welcome <?php echo $login_details['name'];?> </p>
    	
    	<p style="font-size:10px;color:#177fca;">Role : STUDENT </p>
    	
    	<div class="col-sm-12" style="margin-bottom:10px; font-size: 16px; color: white;">
     
      
      <div class="col-sm-4"></div>
      <div class="col-sm-2">
        <div class="wallet3" style="text-align:center;">
           <h6 class="main_text_wallet fa fa-rupee"> <?php echo $login_wallet['main_b']; ?></h6>
           <p class="text_wallet">Balance</p>
		   </div>
		  </div>
		 
		  <?php
   $total_runing_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and (status='OPEN' or status='RUN')"));
        ?>
		 <div class="col-sm-2">
        <div class="wallet1" style="text-align:center;">
           <h6 class="main_text_wallet fa fa-book"> <?php echo $total_runing_course ; ?></h6>
           <p class="text_wallet">Total Running Course</p>
		   </div>
		  </div> 
     
       <div class="col-sm-5"></div>
     
  
 
    </div>	
   <?php
$section=1;
if($section=="2"){

     ?>
    <!--<p><h3 class="main_dtr2" align="center" style="margin-top:-5px; font-size:15px;color: #000000;">If you have any query then you can register your query by messaging on .</h3></p>-->
  
      <!--<h3 class="main_dtr2" align="center" style="margin-top:-5px; font-size:20px;color: #071cb1;"> So many users have withdrawn money in <?php echo $previous_date_show; ?>.</h3><br>-->
      <!--<h3 class="main_dtr2" align="center" style="margin-top:-5px; font-size:20px;color: #071cb1;"> Some of the user's latest amount transfer details are given below.</h3><br>-->
     
      <style>
          .marque_payment{
              color: #082e72;
    margin-bottom: 10px;
    margin-top: -16px;
    border: 2px solid #7be1ad;
    border-radius: 11px;
    background-color: #faffab;
    padding: 10px;
          }
      </style>
      <!--<marquee class="marque_payment" onMouseOver="this.stop()" onMouseOut="this.start()" direction="up" height="100" width="250"  scrollamount="4">-->
        
           
      <!--       <p>Name : <?php echo $data_user_details['name'] ; ?></p>-->
             
      <!--       <p>Withdrawal Amount : Rs.<?php echo $row['req_amount']; ?></p>-->
      <!--       <p>Withdrawal Count : <?php echo $payment_count; ?> Times</p><br>-->
            
          
      <!--</marquee>-->
      <?php } ?> 
      <br>
      
    
    <div align="center" class="col_m">
<p>&nbsp;</p>
</div><br>

 </div>
 
</div>

<?php
$section=1;
if($section=="2"){

     ?>

<!--<div class="col_m">-->
<!--    <div style="border: 2px solid green; background-color:#495bb7b5; margin-top:5px;  height: 105px;">-->
<!--       <h3 class="main_dtr2" align="center" style="color:white;">You are under training.</h3>-->
       
<!--       <h3 class="main_dtr2" align="center" style="color:white;margin-top: -4px;">Trainer Name: , Mobile No. : </h3>-->
      
<!--       <h3 class="main_dtr2" align="center" style="color:white;margin-top: -4px;">Start date :, End date :<?php echo $d_ed; ?> </h3>-->
       
<!--       <h3 class="main_dtr2" align="center" style="color:white;margin-top: -4px;">Time : , Sunday Holiday</h3>-->
        
<!--    </div>-->
<!--</div>-->





<!--    <div class="col_m">-->
<!--    <div style="border: 2px solid green; background-color:#4d35b147; margin-top:5px;  height: 105px;">-->
<!--        <div id="click_user_d" onclick="show_team_user_2()" class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95;cursor:pointer;">-->
<!--            <i style="font-size:30px" class="fa fa-book"></i>-->
<!--            <h6><strong>Course</strong></h6>-->
<!--        </div>-->
<!--        <div id="click_user_d2" onclick="show_team_user_2_2()" class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95;cursor:pointer; display:none;">-->
<!--            <i style="font-size:30px" class="fa fa-book"></i>-->
<!--            <h6><strong>Course</strong></h6>-->
<!--        </div>-->
<!--        <a href="certificate_all"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95;">-->
<!--            <i style="font-size:30px" class="fa fa-id-card-o"></i>-->
<!--            <h6><strong>Certificate</strong></h6>-->
<!--        </div></a>-->
<!--        <a href="gallery"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95;">-->
<!--            <i style="font-size:30px" class="fa fa-picture-o"></i>-->
<!--            <h6><strong>Gallery</strong></h6>-->
<!--        </div></a>-->
        
<!--    </div>-->
<!--</div>-->

<!--<div id="show_team_user" style="display:none;">-->
       
       
<!--   <div class="col_m">-->
<!--      <div style="border: 2px solid green; background-color:#443176b3; margin-top:5px;  height: 105px;">-->
<!--        <a href="course_book"><div class="id1" align="center" style="background: #ffffff99; padding-top:20px;color: green;">-->
<!--            <i style="font-size:20px" class="fa fa-plus"></i>-->
<!--            <h6><strong>Book Course</strong></h6>-->
<!--        </div></a>-->
       
<!--        <a href="course_running"><div class="id1" align="center" style="background: #ffffff99; padding-top:20px;color: green;">-->
<!--            <i style="font-size:20px" class="fa fa-list"></i>-->
<!--            <h6><strong>Running Course</strong></h6>-->
<!--        </div></a>-->
       
<!--        <a href="course_complete"><div class="id1" align="center" style="background: #ffffff99; padding-top:20px;color: green;">-->
<!--            <i style="font-size:20px" class="fa fa-graduation-cap"></i>-->
<!--            <h6><strong>Complete Course</strong></h6>-->
<!--        </div></a>-->
        
<!--      </div>-->
<!--   </div>-->
  
<!-- </div> -->
<?php } ?>     

<div class="col_m">
    <div style="border: 2px solid green; background-color:#4d35b147; margin-top:5px;  height: 105px;">
       
        <a href="course_book"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-book"></i>
            <h6><strong>Book Course</strong></h6>
        </div></a>
        
        <a href="course_running"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-list"></i>
            <h6><strong>Running Course</strong></h6>
        </div></a>
        <a href="course_complete"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-graduation-cap"></i>
            <h6><strong>Complete Course</strong></h6>
        </div></a>
        
    </div>
</div>

<?php
$section=1;
if($section=="2"){

     ?>
<!--<div class="col_m">-->
<!--    <div style="border: 2px solid green; background-color:#443176b3; margin-top:5px;  height: 105px;">-->
<!--        <a href="pay_fee"><div class="id1" align="center" style="background: #8ad877a3; padding-top:20px;color: #151befbf;">-->
<!--            <i style="font-size:30px" class="fa fa-rupee"></i>-->
<!--            <h6><strong>Upgrade</strong></h6>-->
<!--        </div></a>-->
<!--        <a href="bank_details"><div class="id1" align="center" style="background: #8ad877a3; padding-top:10px;color: #151befbf;">-->
<!--            <i style="font-size:30px" class="fa fa-bank"></i>-->
<!--            <h6><strong>Bank Details</strong></h6>-->
<!--        </div></a>-->
<!--        <a href="payment_request"><div class="id1" align="center" style="background: #8ad877a3; padding-top:20px;color: #151befbf;">-->
<!--            <i style="font-size:30px" class="fa fa-line-chart"></i>-->
<!--            <h6><strong>Withdrawal</strong></h6>-->
<!--        </div></a>-->
        
<!--    </div>-->
<!--</div>-->
<?php } ?>
<div class="col_m">
    <div style="border: 2px solid green; background-color:#495bb7b5; margin-top:5px;  height: 105px;">
        <a href="transaction_main"><div class="id1" align="center" style="background: #e6d271d1; padding-top:10px;color: #b93108; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-exchange"></i>
            <h6><strong>Transaction</strong></h6>
        </div></a>
      <a href="gallery"><div class="id1" align="center" style="background: #e6d271d1; padding-top:12px;color: #b93108; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-picture-o"></i>
            <h6><strong>Gallery</strong></h6>
        </div></a>
       
        <a href="certificate_all"><div class="id1" align="center" style="background: #e6d271d1; padding-top:12px;color: #b93108; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-id-card-o"></i>
            <h6><strong>Certificate</strong></h6>
        </div></a>
        
    </div>
</div>



    
 
    <div class="col_m">
    <div style="border: 2px solid green; background-color:#4d35b147; margin-top:5px;  height: 105px;">
       
        <a href="profile" ><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-user"></i>
            <h6><strong>Profile</strong></h6>
        </div></a>
        
        <a href="announcement"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-bell"></i>
            <h6><strong>Announce<br>ment</strong></h6>
        </div></a>
        <a href="change_password"><div class="id1" align="center" style="background: #da72bf99; padding-top:10px;color: #97ff95; border-radius: 8px;">
            <i style="font-size:30px" class="fa fa-key"></i>
            <h6><strong>Change Password</strong></h6>
        </div></a>
        
    </div>
</div>





 

<br><br><br><br><br><br><br>
 
</div>

</div>

 


</div>
  
<?php include 'footer.php'; ?>
  
</body>
<script>
    function show_team_user_2(){
        document.getElementById("show_team_user").style.display="block";
        document.getElementById("click_user_d").style.display="none";
        document.getElementById("click_user_d2").style.display="block";
        
    }
    function show_team_user_2_2(){
        document.getElementById("show_team_user").style.display="none";
        document.getElementById("click_user_d").style.display="block";
        document.getElementById("click_user_d2").style.display="none";
        
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