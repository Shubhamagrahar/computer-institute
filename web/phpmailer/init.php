<?php


require('class.phpmailer.php');


function send_mail($send_id,$subject1,$txt)
{
    $fromad="info@tvssolution.com";	
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = TRUE;
    $mail->Port     = 25;  
    $mail->Username = "info@tvssolution.com";
    $mail->Password = "darj@24052018@DARJ";
    $mail->Host     = "mail.tvssolution.com";
    $mail->Mailer   = "smtp";
    $mail->SetFrom($fromad, "TVS SOLUTION");
    $mail->AddReplyTo("info@tvssolution.com");
    $mail->AddAddress("$send_id");	
    $mail->Subject = $subject1;
    $mail->WordWrap   = 80;
    $mail->MsgHTML($txt);
    $mail->IsHTML(true);
    if(!$mail->Send())
    {
        return false;
    }
    else
    {
        return true;
    }
}

function send_mail2($send_id,$subject1,$txt)
{
     global $brand_name;
    $fromad="noreply@institute.edug.in";	
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = TRUE;
    $mail->Port     = 25;  
    $mail->Username = "noreply@institute.edug.in";
    $mail->Password = "edug@123456@EDUG";
    $mail->Host     = "institute.edug.in";
    $mail->Mailer   = "smtp";
    $mail->SetFrom($fromad, $brand_name);
    $mail->AddReplyTo("noreply@institute.edug.in");
    $mail->AddAddress("$send_id");	
    $mail->Subject = $subject1;
    $mail->WordWrap   = 80;
    $mail->MsgHTML($txt);
    $mail->IsHTML(true);
    if(!$mail->Send())
    {
        return false;
    }
    else
    {
        return true;
    }
}



?>