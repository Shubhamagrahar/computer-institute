<?php 
include 'data.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Application | <?php echo $company_name ;?></title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext" rel="stylesheet">
	<!--<link rel="stylesheet" type="text/css" href="css/invoice_style.css">-->
	<link href="https://vci.edug.in/web/css/fontawesome-all.css" rel="stylesheet">
	<link href="https://vci.edug.in/web/css/bootstrap.css" rel="stylesheet">
	<link href="https://vci.edug.in/web/css/swiper.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	    *{
	font-family: arial;
	padding:0px;
	margin:0px;
}
.invoice_start{
    border: 5px solid #000080;
   /* border-radius: 12px;*/.
   margin:5px;
   
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
    font-size: 24px;
    font-family: revert;
    font-weight: 800;
}
.invoice_header p{
	margin-top: 6px;
    margin-bottom: 5px;
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
	width: 80%;
    text-align: left;
}
.item_table td,th{
	padding: 5px 10px;
	height: 25px;
    text-align: center;
}
th{
    background-color: #5f8cdb;
    color: yellow;
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
.heading{
    color:yellow;
    text-align: center;
    background: #89aff3;
    padding: 5px;
    margin-left: 40%;
    margin-right: 533px;
    margin-top: 10px;
    font-weight: 600;
}
.image_div{
    border: 2px solid black;
}
.image{
    width: 50%;
    max-height: 309px;
    border:2px solid black;
    padding:5px;
    
}

	</style>
</head>
<body style="margin: 13px;">
  <div class="container">
      
  <div class="row">
  <div class="col-md-12 invoice_start">
	<div class="invoice_container">
		<div class="col-md-12 invoice_header">
		 
			<div class="logo_container">
				<img width="100%;" src="<?php echo $brand_logo ; ?>"> 
			</div>
			<div class="company_address">
				<h2><?php echo $company_full_name1 ;?></h2>
				<p align="right" style="color:white;">
					<i class="fas fa-map-marker-alt"></i> <?php echo $address ;?> <br>
				<i class="fa fa-phone"></i>	<?php echo $number ;?>,<?php echo $number2 ;?> <br>
				<i class="fa fa-envelope"></i>	<?php echo $email ;?>
		
				</p>
			</div>
		</div>
		<div align="center" style="margin-top:10px;" class="col-md-12">
		    <!--<h4 class="heading">Application Form</h4>-->
		    <span style="background-color:#000080;color:yellow;padding:10px;">
		        
		            <b style="border:3px solid white; padding:4px;">Application Form</b>
		        
		    </span>
		</div>
		<br>
		<div class="col-md-12 customer_container">
			<div>
			    <table class="item_table" border="2" cellspacing="5">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Registration No.</td>
					<td style="padding-right: 142px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="5">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Date:</td>
					<td style="padding-right: 142px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="5">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Course Applied For:</td>
					<td style="padding-right: 142px;"></td>
				</tr>
			    </table>
			    <br>
			    
				
			</div>
			<div >
				<img class="image"  src="https://i.pinimg.com/736x/90/f7/a4/90f7a49893bc987858e13e10ffc72a23.jpg" alt="image">
				
			</div>
			
		</div>
		<div class="col-md-12 customer_container">
		    
		    <div>
		        <table class="item_table" border="2" cellspacing="0" width="97%">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:400;">Name (in block letters): Mr.Mrs.:</td>
					<td style="padding-right: 993px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Father's Name/Guardian's Name:</td>
					<td style="padding-right: 974px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Permanent Address:</td>
					<td style="padding-right: 974px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
				    <td style="padding-right: 100px;"></td>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Mobile No:</td>
					<td style="padding-right: 100px;"></td>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;"><i class="fa fa-whatsapp"></i></td>
					<td style="padding-right: 100px;"></td>
				</tr>
			    </table>
			     <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Present Address:</td>
					<td style="padding-right: 974px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
				    <td style="padding-right: 100px;"></td>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Contact tel. No: (R)Mobile:</td>
					<td style="padding-right: 100px;"></td>
					
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Email Id:</td>
					<td style="padding-right: 974px;"></td>
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
				    <td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Date of Birth:</td>
				    <td style="padding-right: 100px;"></td>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Sex:</td>
					<td style="padding-right: 50px;">Male</td>
					<td style="padding-right: 50px;">Female</td>
					
				</tr>
			    </table>
			    <br>
			    <table class="item_table" border="2" cellspacing="0">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Education Qualification (Higher to Lower):</td>
					<td style="padding-right: 900px;"></td>
				</tr>
			    </table>
		    </div>
		</div>
		<div class="col-md-12 product_container">
			<table class="item_table" border="1" cellspacing="0" width="97%">
				<tr>
					<th>Examination</th>
					<th>yr. of Passing</th>
					<th>Board/University</th>
					<th>Mark</th>
					<th>Subject</th>
					
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
				</tr>
				<tr>
				    <td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
				    <td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			
			
			</table>
		</div><br>
		<div class="customer_container">
			<div>
			    <table class="item_table" border="2" cellspacing="5">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Condition:-</td>
				</tr>
			    </table>
			    	</div>
			</div>
		<div class="invoice_footer" >
			<div class="note">
				<p>
				<span>1. Paid Fee donot return any condition.</span>	<br>
				<span>2. <strong>Do not Paid fee on due date then Rs.20 rupees Fine Perday.</strong></span> <br>
				<span>3. Continues Absent without information 4 days then Admission Terminate</span><br>
				
				</p>
			</div>
			<div class="invoice_footer_amount" >
				<table class="amount_table"   cellspacing="0">
				
					<tr>
						<td>Grand Total</td>
						<td>: <b>Rs. 3000.00/-</b></td>
					</tr>
				
				</table>
			</div>
		</div><br>
		
		<br>
		<div class="customer_container">
			<div>
			    <table class="item_table" border="2" cellspacing="5">
				<tr>
					<td style="background-color: #5f8cdb; color:yellow;font-weight:700;">Computer knowledge:</td>
				</tr>
			    </table>
			    	</div>
			</div>
		<div class="invoice_footer" >
			<div class="note">
				<p>
				<span>I will obey the rules & regulations throughout the course.</span>	<br>
				<span>I hereby confirm that the above information is correct. I've gone through the prospectus carefully.</span><br>
				
				</p>
			</div>
		<div  style="float:left; padding-top: 15px;
    padding-right: 25px;">
			
			<p style="font-size: 15px; font-weight: 600;">Date:.......................</p>
			</div>
			<div  style="float:right; padding-top: 15px;
    padding-right: 25px;">
			
			<p style="font-size: 15px; font-weight: 600;">Signature of Applicant</p>
			</div>	
		</div>
		
		
	</div>
	
	</div>
	 <!-- Scripts -->
     </div>
    </div>
   <script type="text/javascript">
      window.print();
      window.onafterprint = window.close;
    </script>
</body>
</html> 