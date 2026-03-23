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
           $date=date_format($date,"d MM Y");
           $fee_recv_by_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$result[by_rcv]'"));
       }else{
        echo '<script>window.close();</script>';  
        exit();
       } 
    }else{
        echo '<script>window.close();</script>';
        exit();
    }
}else{
    echo '<script>window.close();</script>';
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INVOICE | <?php echo $brand_name ;?></title>
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
	margin-right: 10px;
}
.invoice_header h2{
   margin-top: 5px;
    margin-bottom: 0;
    color: yellow;
    font-size: 16px;
    font-family: revert;
    /* margin-right: -6px; */
    margin-left: 106px;
}
.invoice_header p{
	margin-top: 6px;
    margin-bottom: 5px;
    font-size: 12px;
}
.logo_container img{
	height: 60px;
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
	</style>
</head>
<body>
	<div class="invoice_container">
		<div class="invoice_header">
			<div class="logo_container">
				<img width="100%;" src="<?php echo $brand_logo ; ?>"> 
			</div>
			<div class="company_address">
				<h2><?php echo $company_full_name1 ;?></h2>
				<p align="right" style="color:white;">
					<?php echo $address ;?> <br>
					<?php echo $mobile_number ;?>, <?php echo $mobile_number2 ;?><br>
					<?php echo $email ;?>
		
				</p>
			</div>
		</div>
		<div align="center" style="padding-top: 7px;">
		    <span style="font-size: 23px;font-weight: 600;background-color: #000080;color: white;padding: 4px; border-radius: 5px;">Fee Reciept</span>
		</div>
		<div class="customer_container">
			<div align="center">
				<span></span>
				<h4></h4>
				<p>
				
				</p>
			</div>
			<div class="in_details">
				
				<table>
					<tr>
						<td>Reciept No</td>
						<td>:</td>
						<td><b>#<?php echo $result['id']; ?></b></td>
					</tr>
					<tr>
						<td>Due Date</td>
						<td>:</td>
						<td><b><?php echo $date ; ?></b></td>
					</tr>
					
				</table>
			</div>
		</div>
		<div class="product_container">
			<!--<span>Name:.............................................................................................................................................</span>-->
		
			<!--<span>Total Amount:................................................... ,</span>-->
			<!--<span>Paid Amount:................................................... ,</span>-->
			<!--<span>Due Amount:................................................. </span>-->
			<table width="100%">
			    
			    <tr>
			        <td colspan="2">Name : <?php echo $fee_user_details['name']; ?></td>
			        
			    </tr>
			    <tr>
			        <td>Total Due Amount: Rs.<?php echo $total_due; ?></td>
			        <td >Paid Amount: Rs.<?php echo $amt ; ?></td>
			    </tr>
			    <tr>
			        <td >Due Amount: Rs.<?php echo $due ; ?></td>
			        <td>Received by : <?php echo $fee_recv_by_details['name']; ?></td>
			    </tr>
			</table>
			
		</div><br>
		<div class="invoice_footer" >
			
			<div class="product_container">
			<table class="item_table" border="1" cellspacing="0">
				
				<tr>
					<td><strong>Rs.</strong></td>
					<td style="padding-right: 142px;"><?php echo $amt ; ?></td>
					
				</tr>
				
			
			</table>
		</div>
		</div><br><br>
		<div  style="float:right; padding-top: 15px;
    padding-right: 25px;">
			
			<p style="font-size: 15px; font-weight: 600;">Authorised Signature</p>
			</div>
		<br><br>
		
	</div>
    <script type="text/javascript">
      window.print();
      window.oncancelprint = window.close;
      window.onafterprint = window.close;
    </script>
</body>
</html> 