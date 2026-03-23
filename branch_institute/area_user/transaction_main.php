<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Transaction | <?php echo $brand_name; ?>
    </title>
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
 <h4 class="welcome_admin">Your Transaction Details</h4>
 
</div> 

<div class="col_m show_div_d">
   <div class="col-sm-12 tbl1 hscroll" >
             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Date</th>
                        <th>description</th>
                        <th>credit</th>
                        <th>debit</th>
                        <th>Balance</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $sql_d=mysqli_query($con,"select * from transaction where userid='$_SESSION[userid]' order by id desc");
                    while($row=mysqli_fetch_array($sql_d)){
                    $date=date_create($row['c_date']);
                    $date=date_format($date,"d-m-Y H:i A");
                    ?>
                    <tr>
                        <td><?php echo $i +=1; ?></td>
                        <td><?php echo $date ; ?></td>
                        <td><?php echo $row['des'] ;?></td>
                        <td><?php echo $row['credit'] ;?></td>
                        <td><?php echo $row['debit'] ;?></td>
                        <td><?php echo $row['cl_bal'] ;?></td>
                        
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
                    $sql_d=mysqli_query($con,"select * from transaction where userid='$_SESSION[userid]' order by id desc");
                    while($row=mysqli_fetch_array($sql_d)){
                    $date=date_create($row['c_date']);
                    $date=date_format($date,"d-m-Y H:i A");
                    ?>
            <tr>
              <td>
                 <div class="col_m">
                 
                  <span style="float:left;"><?php echo $i +=1; ?>. <strong>Date:</strong> <?php echo $date ; ?></span>
                  <?php 
                    if( $row['debit']>0 ){
                        ?>
                        <span style="float:right;color:red">Rs.<?php echo $row['debit'] ;?> Dr</span>
                        <?php
                    }
                    ?>
                     <?php 
                    if( $row['credit']>0 ){
                        ?>
                        <span style="float:right;color:green">Rs.<?php echo $row['credit'] ;?> Cr</span>
                        <?php
                    }
                    ?>
                </div><br>
                <div class="col_m">
                    <span ><strong>Description : </strong><?php echo $row['des'] ;?></span><br>
                    <span style="float:right;"><strong>Balance : </strong><?php echo $row['cl_bal'] ;?></span><br>
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