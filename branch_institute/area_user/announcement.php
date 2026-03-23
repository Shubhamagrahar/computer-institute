<?php
include('session.php');



$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>View Certificate | <?php echo $brand_name; ?></title>
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
       .container_box {
	margin: 0 auto;
	max-width: 1000px;
	padding: 20px;
	/*background-color: #fff;*/
	border-radius: 10px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	 /*background-image: url(https://www.pngkey.com/png/full/724-7247106_confetti-party-celebrate-parties-celebrations.png);*/
	 background-image: linear-gradient(148deg, #07A3B2, #D9ECC7);
}

.verify_logo{
    max-width: 156px;
    width: 57%;
}

.certificate_img{
    max-width: 800px;
    width: 80%;
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
 <h4 class="welcome_admin">LATEST ANNOUNCEMENT</h4>
 
</div> 

<div class="col_m">
    <div class="col-sm-12">
   <div class="col-sm-4"></div>
   
 <div class="col-sm-4 " id="fees_div" >
       <div class="col-sm-12 page_heading_all2">
       
      </div>
   
    <div class="">
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
             
              
                <div class="card-body">
                  <div style="margin-top: 20px;border: 2px solid #e5e5e5;padding: 10px;border-radius: 12px;background-color: #fbfbfb;">
                            <marquee height="350px" id="mymarquee" direction="up" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()">
                                <p  align="justify" style="color: #214427;font-style: italic;margin-top:7px;"><i style="color: #e7b59f;" class="fa fa-hands-praying"></i>Welcome to <?php echo $company_full_name; ?>.</p>
                                <?php 
                                $sql_news=mysqli_query($con,"select * from web_news where status='OPEN' order by id desc");
                                while($row=mysqli_fetch_array($sql_news)){
                                    ?>
                                    <p  align="justify" style="color: #214427;font-style: italic;margin-top:7px;"><i style="color: #e7b59f;" class="fas fa-hand-point-right"></i>&nbsp;<?php echo $row['des'] ?></p>
                                    <?php } ?>
                            </marquee>
                        </div>
                    <div align="center">
                     <br> 
                     <button class="btn btn-success"  onClick="document.getElementById('mymarquee').start();"><i class="fa fa-play"></i></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" onClick="document.getElementById('mymarquee').stop();"><i class="fa fa-pause"></i></button>
                    
                    </div>
                  
                </div>
                <!-- /.card-body -->

        </div>
            </div>
    
    </div>
            
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