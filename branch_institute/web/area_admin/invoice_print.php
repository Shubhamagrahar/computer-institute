<?php 
include 'session.php';

if(isset($_GET['fee_id'])){
    $fee_id=VerifyData($_GET['fee_id']);
    if(!$fee_id==""){
      
      $sql=mysqli_query($con,"select * from fee_collect_details where id='$fee_id'");
      if(mysqli_num_rows($sql)==1){
          $result=mysqli_fetch_array($sql);
          $fee_user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$result[userid]'"));
          $transaction=mysqli_fetch_array(mysqli_query($con,"select * from transaction where userid='$result[userid]' and credit='$result[amt]' and type='1' and date='$result[date]'"));
          $total_due=-$transaction['op_bal'];
          $due=-$transaction['cl_bal'];
          $amt=$result['amt'];
          $date=date_create($result['date']);
          $date=date_format($date,"d-M-Y");
          $fee_recv_by_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$result[by_rcv]'"));
          $course_book=mysqli_fetch_array(mysqli_query($con,"select * from course_book where userid='$result[userid]' and status='RUN' order by id desc LIMIT 1"));
        $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$course_book[course_id]'"));
        $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$course_book[batch_id]'"));
        
        
        
        
        $number = $amt;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        // $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $hundred = ($counter == 1 && $str[0]) ? '' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result_word = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
// $word_amt= $result_word . "Rupees  " . $points . " Paise";
$word_amt= $result_word . "Rupees only.";
     $word_amt=   ucwords($word_amt);
        
        
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INVOICE for <?php echo $fee_user_details['name']; ?>, Receipt No.<?php echo $result['id']; ?></title>
    <!-- Favicon -->
    <link href="<?php echo $brand_fav_logo; ?>" rel="icon">
	<!--<link rel="stylesheet" type="text/css" href="css/invoice_style.css">-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	    *{
	font-family: arial;
	padding:0px;
	margin:0px;
}
body{
    border: 3px solid #000080;
    border-radius: 12px;
}
.invoice_container{
	padding: 10px 10px;
}
.invoice_header{
	display: flex;
	justify-content: space-between;
	width: 100%;
	background: #000080;
	border-radius: 5px;
}
.logo_container{
	margin-top: auto;
	margin-bottom: auto;
	margin-left: 10px;
}
.company_address{
	margin-right: 85px;
}
.invoice_header h2{
   margin-top: 5px;
    margin-bottom: 0;
    color: yellow;
    font-size: 16px;
    font-family: revert;
    /* margin-right: -6px; */
    /*margin-left: 106px;*/
}
.invoice_header p{
	margin-top: 6px;
    margin-bottom: 5px;
    font-size: 12px;
}
.logo_container img{
	height: 60px;
	margin-top: 4px;
}
.customer_container{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.customer_container h2{
	margin-bottom: 10px;
}
.customer_container h4{
	margin-bottom: 10px;
	margin-top: 0;
}
.customer_container p{
	margin: 0;
}
.in_details{
	margin-top: auto;
	margin-bottom: auto;
}
.product_container{
	padding: 0 10px;
	margin-top: 10px;
}
.item_table{
	width: 100%;
    text-align: left;
}
.item_table td,th{
	padding: 5px 10px;
}
.invoice_footer{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.invoice_footer h2{
	margin-bottom: 10px;
}
.term_condition h4{
	font-size: 15px;
    font-weight: 800;
	    padding-top: 16px;
}
.note{
	width: 50%;
}
.invoice_footer_amount{
	margin: auto 0;
	background: #e7c9c9;
}
.amount_table td,th{
	padding: 5px 10px;
}
.in_head{
    margin: 0;
    text-align: center;
    background: #e7c9c9;
    padding: 5px;
}
 table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            /* border: 1px solid #dddddd; */
            text-align: left;
            padding: 5px;
			font-size: 13px;
			
			
        }

        tr:nth-child(even) {
            /* background-color: #dddddd; */
        }
	</style>
</head>
<body>
	<div class="invoice_container">
		<div class="invoice_header">
			<div class="logo_container">
				<img width="100%;" src="<?php echo $brand_logo ; ?>"> 
			</div>
			<div class="company_address" align="center">
				<h2><?php echo $brand_name ;?></h2>
				<p  style="color:white;">
				<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $brand_add ;?> <br>
				<i class="fa fa-phone" aria-hidden="true"></i> <?php echo $brand_mob ;?>, 
				<?php
                    if(!$brand_mob2==""){
                        ?>
				<i class="fa fa-phone" aria-hidden="true"></i> <?php echo $brand_mob2 ;?>, 
				<?php } ?>
				<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $brand_email ;?><br>
				</p>
			</div>
		</div>
		<div align="center" style="padding-top: 7px;">
		    <span style="font-size: 23px;font-weight: 600;background-color: #000080;color: white;padding: 4px; border-radius: 5px;">Fee Receipt</span>
		</div>
	
		
		<div class="product_container">
		    <br>
		 <table style="border">
			<tr>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Receipt No:</strong> <?php echo $result['id']; ?></td>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Fee Paid Date:</strong> <?php echo $date ; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Name:</strong> <?php echo $fee_user_details['name']; ?></td>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Course Name: </strong> <?php echo $course_details['name'] ?> </td>
			</tr>
			<tr>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Course Duration:</strong> </strong> <?php echo $course_details['duration'] ?> Month</td>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Batch Time:</strong> <?php echo $batch_details['batch_name'] ?></td>
			</tr>
			<tr>
    			<td style="text-align: right;"><strong>Total Due Amount:</strong> </td>
    			<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Rs.</strong> <?php echo $total_due; ?>.00/- </td>
			</tr>
			<tr>
		    	<td style="text-align: right;"><strong>Paid Amount:</strong> </td>
    			<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Rs.</strong> <?php echo $amt ; ?>/- </td>	
			</tr>
			<tr>
			   <td style="text-align: right;"><strong>Balance Amount:</strong> </td>
				<td style="border: 1px solid rgb(16, 139, 12); text-align: center;"><strong>Rs.</strong> <?php echo $due ; ?>.00/- </td>
			</tr>
		</table>
				
		</div><br>
		<div class="invoice_footer" >
			
			<div class="product_container">
		
			<table class="item_table"  cellspacing="0">
				
				<tr>
					<td style="font-size: 14px; font-weight: 600;"><strong>Paid Amount (In Word): </strong></td>
					<td style="font-size: 14px; padding-right: 80px;" ><?php echo $word_amt; ?></td>
				</tr>
				
			
			</table>
		</div>
		</div><br>
		<div style="display: grid;" align="right">
		    <div  style="float:right; padding-top: 2px; padding-right: 30px;">
			
			<!--<p style="font-size: 15px; font-weight: 600;"><strong>Received by: </strong><?php echo $fee_recv_by_details['name']; ?></p>-->
			<p style="font-size: 15px; font-weight: 600;"><strong>Received by: </strong><?php echo $brand_name; ?></p>
			</div>
		    <div  style="float:right; padding-top: 60px; padding-right: 30px;">
			
			<p style="font-size: 15px; font-weight: 600;">Authorised Signature</p>
			</div>
		</div>
		<br>
		
	</div>
    <script type="text/javascript">
     window.print();
      window.oncancelprint = window.close;
      window.onafterprint = window.close;
    </script>
    
</body>
   <?php
    mysqli_close($con);
    ?>
</html> 