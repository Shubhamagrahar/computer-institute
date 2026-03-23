<?php
include('session.php');

if (isset($_GET['final_submit_test'])) {
    $submit_id = VerifyData($_GET['submit_id']);
    $test_series_id = VerifyData($_GET['test_series_id']);
    if ($submit_id != "") {
        if ($submit_id == $test_series_id) {
             $end_time=date("H:s:i");
            $update_series = mysqli_query($con, "update online_test_attempt set end_time='$end_time', status='CLOSE' where id='$test_series_id'");
            if ($update_series) {
                unset($_SESSION['test_series_ques_id']);
                mysqli_close($con);
                
                echo 'Swal.fire("Success", "Final Submit successful.", "success").then(() => { window.location.href = "online_test_detail"; });';
                exit;
            } else {
                mysqli_close($con);
                echo 'Swal.fire("Error", "Something went wrong in final submit.", "error").then(() => { window.location.href = "online_test_detail"; });';
                exit;
            }
        } else {
            mysqli_close($con);
            echo 'Swal.fire("Error", "Final submit series ID does not match current series ID.", "error").then(() => { window.location.href = "online_test_detail"; });';
            exit;
        }
    } else {
        mysqli_close($con);
        echo 'Swal.fire("Error", "Submit Data is null.", "error").then(() => { window.location.href = "online_test_detail"; });';
        exit;
    }
}

if(isset($_GET['ans_test_question'])){
    $id=VerifyData($_GET['ans_test_question']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $sql=mysqli_query($con,"select * from online_test_use_details where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $id_details=mysqli_fetch_array($sql);
           if($id_details){ 
            $update=mysqli_query($con,"update online_test_use_details set ans_user='$val', status='YES' where id='$id'");
            if($update){
                
            }else{
                echo "Server error 104.";
            }
           }else{
               echo "Error 103.";
           } 
        }else{
            echo "Error 102.";
        }
    }else{
        echo "Error 101.";
    }
}



if(isset($_GET['get_series_question'])){
    $test_series_id=VerifyData($_GET['get_series_question']);
    $present_q_no=VerifyData($_GET['q_no']);
    if(!$test_series_id=="" and !$present_q_no==""){
        ?>
        <div class="col-md-12">
             <div class="card card-info">
             <div class="card-header" style="color:black;background-color: white;">
                 <div class="card-title">
                    
                     
                     <div class="row" style="padding-left: 10px;padding-right: 10px;padding-bottom: 6px;" align="center">
                   <?php 
                  
                   
                   $i=0;
                    $sql=mysqli_query($con,"select * from online_test_use_details where userid='$login_details[id]' and test_attempt_id='$test_series_id' order by id desc");
                    $count=mysqli_num_rows($sql);
                    while($row=mysqli_fetch_array($sql)){
                        $q_no_divstyle="";
                        $i +=1;
                        if($i==$present_q_no){
                            $q_no_divstyle='style=cursor:default;background-color:blue;color:white !importatnt"';
                        }else{
                            if($row['status']=="CLOSE"){
                               $q_no_divstyle='style="background-color:#80991070;" onclick="get_data('.$test_series_id.','.$i.')"';
                            }else{
                            $q_no_divstyle='onclick="get_data('.$test_series_id.','.$i.')"';
                            }
                            
                        }
                   ?>
                    <div class="q_count" id="q_no_div<?php echo $row['id']; ?>" <?php echo $q_no_divstyle; ?>><?php echo $i; ?></div>
                   <?php } ?>
                    
                    </div>
                     <p style="font-size: 20px;font-weight: 600;">Question No#:<?php echo $present_q_no;?> out <?php echo $count; ?></p>
                 </div>
                 
             </div>
             <div class="card-body">
                 <div class="row ">
                 <?php 
                 $ii=0;
                  $sql=mysqli_query($con,"select * from online_test_use_details where userid='$login_details[id]' and test_attempt_id='$test_series_id' order by id desc");
                  
                  while($row=mysqli_fetch_array($sql)){
                      $ii +=1;
                      if($ii==$present_q_no){
                 ?>
               
                   <div class="col-md-12">
                       <p class="q_content" style="color:#cf0199;"><?php echo htmlspecialchars(base64_decode($row['test_question'])); ?></p>
                   </div>
                   <div class="col-md-3" >
                     <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['status']=="YES"){if($row['ans_a']==$row[$row['ans_user']]){ echo "checked"; }} ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="ans_a" id="ans1"> <label for="ans1" style="cursor:pointer;">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_a'])); ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                      <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['status']=="YES"){if($row['ans_b']==$row[$row['ans_user']]){ echo "checked"; }} ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="ans_b" id="ans2"> <label for="ans2" style="cursor:pointer;">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_b'])); ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                      <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['status']=="YES"){if($row['ans_c']==$row[$row['ans_user']]){ echo "checked"; }} ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="ans_c" id="ans3"> <label for="ans3" style="cursor:pointer;">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_c'])); ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                       <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['status']=="YES"){if($row['ans_d']==$row[$row['ans_user']]){ echo "checked"; } }?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="ans_d" id="ans4"> <label for="ans4" style="cursor:pointer;">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_d'])); ?></label>
                     </div>
                  </div>
                  <?php } 
                  } ?>  
                   
                  <div class="col-md-12" align="center" style="padding-top: 17px;">
                      <hr>
                     <?php 
                     if($present_q_no==1){}else{
                     ?>
                     <button onclick="get_data('<?php echo $test_series_id ; ?>','<?php echo $present_q_no -1; ?>')" class="btn2">Previous</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                    <?php 
                    
                     if($count==$present_q_no){}else{
                     ?>
                     <button class="btn3" onclick="get_data('<?php echo $test_series_id ; ?>','<?php echo $present_q_no + 1; ?>')">Next</button>
                     <?php } ?>
                 </div> 
               </div>
               
               
              
              
             </div>
             <div class="card-footer">
                 <?php
                  $total_qes=mysqli_num_rows(mysqli_query($con,"select id from online_test_use_details where test_attempt_id='$test_series_id'"));
                  $total_aatempt_qes=mysqli_num_rows(mysqli_query($con,"select id from online_test_use_details where test_attempt_id='$test_series_id' and status='YES'"));
                 ?>
                 <span style="font-size: 13px;font-weight: 600;">Checked Question : <?php echo $total_aatempt_qes; ?> of <?php echo $total_qes; ?> </span>
               <input type="submit" onclick="final_submit_series('<?php echo $test_series_id; ?>')" name="final_submit" class="btn btn-success" value="Submit" style="float: right;">
             </div>
         </div>
        </div>
        
       
        
        <?php
    }
}

?>
<?php  mysqli_close($con); ?>