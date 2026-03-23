<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>All Certificate | <?php echo $company_full_name ?></title>
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
 <h4 class="welcome_admin">All Certificate</h4>
 
</div> 



<div class="col_m show_div_d">
   <div class="col-sm-12 tbl1 hscroll" >
             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date Of Birth</th>
                    <th>Enrollment No.</th>
                    <th>Course Name</th>
                    <th>create Date</th>
                    <th>Certificate</th>
                    
                    
                    
                </tr>
            </thead>
            <tbody>
             <?php
                $i=0;
                
                
                $sql_certificate=mysqli_query($con,"select * from student_certificate where mobile='$login_details[mobile]' order by id desc");
                while($row=mysqli_fetch_array($sql_certificate)){
                $date_dob=date_create($row['dob']);
                 $date_dob=date_format($date_dob,"d-m-Y");
                 $date_upload=date_create($row['upload_date']);
                 $date_upload=date_format($date_upload,"d-m-Y");
               $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                ?>
                <tr>
                    <td><?php echo $i +=1; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $date_dob; ?></td>
                    <td><?php echo $row['enrollment_no']; ?></td>
                    <td><?php echo $course_details['name'];?></td>
                    <td><?php echo $date_upload; ?></td>
                   <td><a  href="certificate_view?data_id=<?php echo $row['id'] ;?>"><span class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</span></a></td>
                    
                </tr>
                
              <?php }  ?>  
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
                $sql_certificate=mysqli_query($con,"select * from student_certificate where mobile='$login_details[mobile]' order by id desc");
                while($row=mysqli_fetch_array($sql_certificate)){
                $date_dob=date_create($row['dob']);
                 $date_dob=date_format($date_dob,"d-m-Y");
                 $date_upload=date_create($row['upload_date']);
                 $date_upload=date_format($date_upload,"d-m-Y");
               $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                ?>
            <tr>
              <td><div class="col_m">
                <span style="float:left"><?php echo $i +=1;?>.&nbsp;</span> 
                <!--<span style="float:right"><strong>Total Fee :</strong> Rs.<?php echo $row['fee']; ?></span>  -->
              </div>
              <div class="col_m"><br>
                <span ><strong>Name :</strong> <?php echo $row['name']; ?></span> <br>
                <span ><strong>Mobile No. :</strong> <?php echo $row['mobile']; ?></span> <br>
                <span ><strong>Email Id :</strong> <?php echo $row['email']; ?></span>  
              </div>
              <div class="col_m">
                <span ><strong>Date Of Birth :</strong> <?php echo $date_dob; ?></span> <br>
                <span ><strong>Enrollment No :</strong> <?php echo $row['enrollment_no']; ?></span>  <br>
                <span ><strong>Course Name: :</strong> <?php echo $course_details['name'];?></span> <br>
                <span ><strong>Create Date: :</strong> <?php echo $date_upload;?></span>
                
              </div>
              <div class="col_m" align="center">
                  <span ><strong>Certificate: :</strong> <a  href="certificate_view?data_id=<?php echo $row['id'] ;?>"><span class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</span></a></span>
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