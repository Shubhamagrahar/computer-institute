<?php
include('session.php');

$c_date=date("Y-m-d H:i:s");
$t_date=date("Y-m-d");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Running Course | <?php echo $company_full_name ?></title>
    <meta name="theme-color" content="#f38e0c"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'header.php' ; ?>
<style>
    .show_div_d{
        display:block;
       
    }
    .show_div_m{
        display:none;
        
    }
    
    @media screen and (max-width : 768px){
      .show_div_d{
        display:none;
        
    }
    .show_div_m{
        display:block;
         
    }
      
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
 <h4 class="welcome_admin">Running Course Details</h4>
 
</div> 



<div class="col_m show_div_d">
   <div class="col-sm-12 tbl1 hscroll" >
             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
                  <tr>
                    <th>S. No.</th>
                    <th>Book Date</th>
                    <th>Course Name</th>
                    <th>Batch</th>
                    <th>Duration</th>
                    <th>Total Fee</th>
                    <th>Status</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $i=0;
                      $sql=mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and (status='OPEN' or status='RUN') order by id desc");
                      while($row=mysqli_fetch_array($sql)){
                          $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                          $date=date_create($row['book_date']);
                          $date=date_format($date,"d-m-Y");
                          $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"))
                      ?>
                  <tr>
                    <td><?php echo $i +=1; ?></td>
                    <td><?php echo $date ; ?></td>
                    <td><?php echo $course_details['name']; ?></td>
                 <td><?php echo $batch_details['batch_name']; ?></td>
                    <td><?php echo $course_details['duration'] ;?> Month</td>
                    <td>Rs.<?php echo $row['fee']; ?></td>
                    
                    <td>
                        <?php 
                        if($row['status']=="OPEN"){
                            echo "Waiting for training start.";
                        }
                        if($row['status']=="RUN"){
                            echo "Under Training.";
                        }
                        
                        ?>
                        </td>
                  </tr>
                  <?php } ?>
                 
                  </tbody>
        </table>
      </div>
</div>


<div class="col_m show_div_m">
    <div class="col-sm-12 tbl1 hscroll" >
             <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                <th></th>
                
              
            </tr>
          </thead>
          
          <tbody>
              <?php 
                      $i=0;
                      $sql=mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and (status='OPEN' or status='RUN') order by id desc");
                      while($row=mysqli_fetch_array($sql)){
                          $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                          $date=date_create($row['book_date']);
                          $date=date_format($date,"d-m-Y");
                          $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"))
                      ?>
            <tr>
              <td><div class="col_m">
                <span style="float:left"><?php echo $i +=1;?>.&nbsp;<strong> Book Date:</strong> <?php echo $date ; ?></span> 
                <span style="float:right"><strong>Total Fee :</strong> Rs.<?php echo $row['fee']; ?></span>  
              </div>
              <div class="col_m"><br>
                <span ><strong>Course Name :</strong> <?php echo $course_details['name']; ?></span> <br>
                <span ><strong>Batch :</strong> <?php echo $batch_details['batch_name']; ?></span>  
              </div>
              <div class="col_m">
                <span ><strong>Duration :</strong> <?php echo $course_details['duration'] ;?> Month</span> <br>
                <span ><strong>Status:</strong> <?php 
                        if($row['status']=="OPEN"){
                            echo "Waiting for training start.";
                        }
                        if($row['status']=="RUN"){
                            echo "Under Training.";
                        }
                        
                        ?></span>  
              </div>
             
              </td>
              
              
        
              
            </tr>
            <?php }?>
            
          </tbody>
        </table>
      </div>
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
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
</html>