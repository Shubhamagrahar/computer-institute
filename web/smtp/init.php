<?php
include('PHPMailerAutoload.php');

//echo send_mail("sanjay888das@gmail.com","Sunbjetc Test", "Ham abhi test kar rahe hai ");

function send_mail($to,$subject, $msg){
    global $brand_name;
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	//$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "mail.tvssolution.com";
	$mail->Port = 25; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->SMTPDebug = 0; 
	$mail->Username = "noreply@institute.edug.in";
	$mail->Password = "edug@123456@EDUG";
	$mail->SetFrom("noreply@institute.edug.in", $brand_name);
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}


function smtp_mailer_server($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	//$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "mail.tvssolution.com";
	$mail->Port = 25; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->SMTPDebug = 0; 
	$mail->Username = "info@tvssolution.com";
	$mail->Password = "darj@24052018@DARJ";
	$mail->SetFrom("info@tvssolution.com", "TVS SOLUTION");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}

function smtp_mailer_gmail($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "frsolution.in@gmail.com";
	$mail->Password = "wajjjukpix_kdsgfdks_fcjrog_uytutyu";
	$mail->SetFrom("frsolution.in@gmail.com", "TVS SOLUTION");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}


function smtp_mailer_fresh($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "email";
	$mail->Password = "password";
	$mail->SetFrom("email");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}
?>