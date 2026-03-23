<?php
include 'session.php';
$c_date=date("Y-m-d H:s:i");
if(isset($_GET['submit_id'])){
         $submit_id=VerifyData($_GET['submit_id']);
         if(!$submit_id==""){
         
                 $end_time=date("H:s:i");
               $update_series=mysqli_query($con,"update online_test_attempt set end_time='$end_time', status='CLOSE' where id='$submit_id'");
               if($update_series){
                 unset($_SESSION['test_series_ques_id']);
                 mysqli_close($con);
                // $url="online_test_detail?ids=".$test_series_id;
                 echo '<script>alert("Auto Final Submit successfull done. Because your time is end.");window.location.assign("online_test_detail");</script>';
                  exit();   
      
               }else{
               mysqli_close($con);
               echo '<script>alert("Somthing worng in final submit");window.location.assign("online_test_detail");</script>';
               exit();   
             }
                 
             
         }else{
          mysqli_close($con);
         echo '<script>alert("Submit Data Null.");window.location.assign("online_test_detail");</script>';
         exit();   
         }
      }
?>