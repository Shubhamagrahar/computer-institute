<?php  
include('session.php');
$c_date=date("Y-m-d H:s:i");


if (isset($_POST['series_id']) && isset($_POST['row_id'])) {
    $row_id = VerifyData($_POST['row_id']);
    $series_id = VerifyData($_POST['series_id']);
    $userid = $_SESSION['userid'];

    if ($row_id !== "" && $series_id !== "") {
        $book_sql = mysqli_query($con, "SELECT * FROM test_pkg_book_details WHERE id='$row_id' AND userid='$userid' AND use_series<total_series AND status='RUN'");
        if (mysqli_num_rows($book_sql) === 1) {
            $book_details = mysqli_fetch_array($book_sql);
            $pkg_details = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM test_series_pkg_details WHERE id='$book_details[pkg_id]'"));
            $total_insert_q = $pkg_details['ques_no_each_series'];

            $insert_test_series = mysqli_query($con, "INSERT INTO test_series(userid, book_id, total_question, sdt) VALUES('$userid', '$row_id', '$total_insert_q', '$c_date')");
            if ($insert_test_series) {
                $test_series_id = mysqli_insert_id($con);
                if ($test_series_id != "") {
                    $i = 0; $go = 1;
                    $sql = mysqli_query($con, "SELECT * FROM test_series_questions_type_details WHERE test_series_type_id='$series_id' ORDER BY RAND()");
                    while ($row_data = mysqli_fetch_array($sql)) {
                        $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM test_series_at_question WHERE test_series_id='$test_series_id' AND question_id='$row_data[test_series_questions_id]'"));
                        if (!$check) {
                            $question_details = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM test_series_questions WHERE id='$row_data[test_series_questions_id]'"));
                            if ($question_details) {
                                $insert_question = mysqli_query($con, "INSERT INTO test_series_at_question(test_series_id, question_id, question, ans_a, ans_b, ans_c, ans_d, correct_ans) VALUES('$test_series_id', '$question_details[id]', '$question_details[test_question]', '$question_details[ans_a]', '$question_details[ans_b]', '$question_details[ans_c]', '$question_details[ans_d]', '$question_details[ans_final]')");
                                $i++;
                            }
                        }
                        if ($i == $total_insert_q) { $go = 2; break; }
                    }

                    if ($go == 2) {
                        $use_series = $book_details['use_series'] + 1;
                        $update = mysqli_query($con, "UPDATE test_pkg_book_details SET use_series='$use_series' WHERE id='$row_id' AND userid='$userid' AND status='RUN'");
                        if ($update) {
                            $_SESSION['test_series_ques_id'] = $test_series_id;
                            echo "success";
                            exit;
                        } else {
                            echo "Error: Could not update book usage.";
                            exit;
                        }
                    } else {
                        echo "Error: Insufficient number of questions available to start the test. Please contact support or try a different series.";
                        exit;
                    }
                } else {
                    echo "Error: Invalid test series ID.";
                    exit;
                }
            } else {
                echo "Error: Could not create test series.";
                exit;
            }
        } else {
            echo "Error: Invalid booking or already used.";
            exit;
        }
    } else {
        echo "Error: Missing series or row ID.";
        exit;
    }
}



if (isset($_GET['final_submit_test'])) {
    $submit_id = VerifyData($_GET['submit_id']);
    $test_series_id = VerifyData($_GET['test_series_id']);
    if ($submit_id != "") {
        if ($submit_id == $test_series_id) {
            $update_series = mysqli_query($con, "UPDATE test_series SET edt='$c_date', status='CLOSE' WHERE id='$test_series_id'");
            if ($update_series) {
                unset($_SESSION['test_series_ques_id']);
                mysqli_close($con);
                $url = "test_series_quies_details?ids=" . $test_series_id;
                echo 'Swal.fire("Success", "Final Submit successful.", "success").then(() => { window.location.href = "'.$url.'"; });';
                exit;
            } else {
                mysqli_close($con);
                echo 'Swal.fire("Error", "Something went wrong in final submit.", "error").then(() => { window.location.href = "test_series_quies"; });';
                exit;
            }
        } else {
            mysqli_close($con);
            echo 'Swal.fire("Error", "Final submit series ID does not match current series ID.", "error").then(() => { window.location.href = "test_series_quies"; });';
            exit;
        }
    } else {
        mysqli_close($con);
        echo 'Swal.fire("Error", "Submit Data is null.", "error").then(() => { window.location.href = "test_series_quies"; });';
        exit;
    }
}
if(isset($_GET['ans_test_question'])){
    $id=VerifyData($_GET['ans_test_question']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $sql=mysqli_query($con,"select * from test_series_at_question where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $id_details=mysqli_fetch_array($sql);
           if($id_details){ 
             $sql_series=mysqli_query($con,"select * from test_series where id='$id_details[test_series_id]'");
             if(mysqli_num_rows($sql_series)==1){
                 $series_details=mysqli_fetch_array($sql_series);
                 if($series_details['status']=="OPEN"){
                     $go_next="";
                     if($id_details['status']=="OPEN"){
                        $new_use=$series_details['attemp_question'] + 1;
                        $update_=mysqli_query($con,"update test_series set attemp_question='$new_use' where id='$series_details[id]'");
                        if($update_){
                           $go_next=1; 
                        }else{
                           $go_next="Error 105."; 
                        }
                     }else{
                        $go_next=1; 
                     }
                     
                    if($go_next==1){
                        $update_ans=mysqli_query($con,"update test_series_at_question set your_ans='$val', status='CLOSE' where id='$id_details[id]'");
                        if($update_ans){
                            
                        }else{
                            echo "Server Error 106.";
                        }
                    }else{
                        echo $go_next;
                    } 
                     
                 }else{
                     echo "This series already submited.";
                 }
             }else{
                 echo "Error 104.";
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
                    $sql=mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' order by id desc");
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
                  $sql=mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' order by id desc");
                  
                  while($row=mysqli_fetch_array($sql)){
                      $ii +=1;
                      if($ii==$present_q_no){
                 ?>
               
                   <div class="col-md-12">
                       <p class="q_content" style="color:#cf0199;"><?php echo $row['question']; ?></p>
                   </div>
                   <div class="col-md-3" >
                     <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans1']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans1']; ?>" id="ans1"> <label for="ans1" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans1']; ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                      <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans2']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans2']; ?>" id="ans2"> <label for="ans2" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans2']; ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                      <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans3']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans3']; ?>" id="ans3"> <label for="ans3" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans3']; ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                       <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans4']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans4']; ?>" id="ans4"> <label for="ans4" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans4']; ?></label>
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
                  $sql_series_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series where id='$test_series_id'"));
                 ?>
                 <span style="font-size: 13px;font-weight: 600;">Checked Question : <?php echo $sql_series_details['attemp_question']; ?> of <?php echo $sql_series_details['total_question']; ?> </span>
               <input type="submit" onclick="final_submit_series('<?php echo $test_series_id; ?>')" name="final_submit" class="btn btn-success" value="Submit" style="float: right;">
             </div>
         </div>
        </div>
        
       
        
        <?php
    }
}

if(isset($_GET['get_user_userid12'])){
    $pass=VerifyData($_GET['get_user_userid12']);
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
   
    if($sql['pass']==$pass){
        ?>
        <span style="color:Green;">Old Password Match.</span>
        <?php
    }else{
        ?>
        <span style="color:red;">Old Password Not Match.</span>
        <?php
    }
    
}



if(isset($_GET['get_user_id'])){
    $mobile=VerifyData($_GET['get_user_id']);
    if(!$mobile==""){
    $sql=mysqli_query($con,"select * from user where mobile='$mobile'");
    if(mysqli_num_rows($sql)==1){
       $result=mysqli_fetch_array($sql) ;
       echo $result['id'];
    }else{
        echo "NO";
    }
    }else{
        echo "NO";
    }
    
}


if(isset($_GET['name_id'])){
    $userid=VerifyData($_GET['name_id']);
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$userid'"));
    echo $sql['name'];
    
}

if(isset($_GET['fee_id'])){
    $userid=VerifyData($_GET['fee_id']);
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$userid'"));
    echo $sql['fee'];
    
}

?>
<?php  mysqli_close($con); ?>