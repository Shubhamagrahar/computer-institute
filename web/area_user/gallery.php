<?php
include('session.php');


$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Gallery | <?php echo $brand_name; ?></title>
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
                $sqlgallary=mysqli_query($con,"select * from gallery order by id desc");
                while($row=mysqli_fetch_array($sqlgallary)){
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
				     <!--<img width="100%" style="border: 1px solid #c4f10c;" src="<?php echo $web_link.$row['img'] ?>">-->
				    <a href="<?php echo $web_link.$row['img'] ;?>" data-toggle="lightbox" data-title="<?php echo $row['name'] ;?>" data-gallery="gallery">
                      <img width="100%" src="<?php echo $web_link.$row['img'] ;?>" class="img-fluid mb-2" alt="<?php echo $row['name'] ;?>"/>
                    </a> 
				 </div>
				
				 </div>
                  
                  
                </div>
                <!-- /.card-body -->

              
            </div>
            </div>
    
   
                
            </div>
             <?php } ?>
            <br><br><br><br><br><br><br>
        </div>
       <br><br><br><br><br><br><br>
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