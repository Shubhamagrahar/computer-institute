<?php  
include('session.php');

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['update_exam_pass'])){
    $id=VerifyData($_GET['update_exam_pass']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $update=mysqli_query($con,"update online_test_exam_details set pass='$val' where id='$id'");
        if($update){
            echo "1";  
        }else{
            echo "Server error 101.";
        }
    }
}

if(isset($_GET['quertion_final_submit'])){
    $question_id=VerifyData($_GET['quertion_final_submit']);
    if(!$question_id==""){
       $sql=mysqli_query($con,"select * from online_test_question where id='$question_id' and status='OPEN'");
       if(mysqli_num_rows($sql)==1){
         $result=mysqli_fetch_array($sql) ;
         if($result){
            if(!$result['test_question']==""){
                if(!$result['ans_a']==""){
                    if(!$result['ans_b']==""){
                        if(!$result['ans_c']==""){
                            if(!$result['ans_d']==""){
                                if(!$result['ans_final']==""){ 
                                 $sql_check=mysqli_num_rows(mysqli_query($con,"select * from online_test_question_details where online_test_question_id='$question_id'"));
                                 if($sql_check>0){
                                    $update=mysqli_query($con,"update online_test_question set status='ACT', date='$t_date' where id='$question_id'") ;
                                    if($update){
                                       echo 1; 
                                    }else{
                                      echo "Error code 104.";   
                                    }
                                 }else{
                                  echo "Please select question type.";     
                                 }
                                }else{
                                   echo "Please select answer option this question."; 
                                }
                            }else{
                               echo "Please write your question Option D."; 
                            }
                        }else{
                           echo "Please write your question Option C."; 
                        }
                        
                    }else{
                      echo "Please write your question Option B."; 
                    }
                }else{
                  echo "Please write your question Option A.";   
                }
            }else{
              echo "Please write your question.";
            }
         }else{
           echo "Error code 103.";  
         }
       }else{
         echo "Error code 102.";  
       }
    }else{
        echo "Error code 101.";
    }
}

if(isset($_GET['question_type_refresh'])){
    $current_queryion_id=VerifyData($_GET['question_type_refresh']);
    ?>
    
    <div class="row">
                    <div class="col-sm-3" >   
                    <label> Course:</label>
                    <select name="test_question_type" id="ans_final" onchange="set_question_type_details('<?php echo $current_queryion_id ;?>',this.value)" class="form-control">
                        <option value="">Select</option>
                        <?php 
                        $sql=mysqli_query($con,"select * from course_details");
                        while($row=mysqli_fetch_array($sql)){
                           $sql_check=mysqli_num_rows(mysqli_query($con,"select * from online_test_question_details where online_test_question_id='$current_queryion_id' and course_id='$row[id]'")) ;
                          if(!$sql_check>0){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        }
                        <?php } } ?>
                        
                    </select>
                    </div>
                    <div class="col-sm-8" style="margin-top: 30px;">
                       <p id="q_type_list"><?php 
                      
                       $sql=mysqli_query($con,"select * from online_test_question_details where online_test_question_id='$current_queryion_id'");
                       while($row=mysqli_fetch_array($sql)){
                           $q_type_data=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                         
                       ?>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:20px;color:blue;"><?php echo $q_type_data['name'] ; ?> <i onclick="delete_select_q_type('<?php echo $current_queryion_id ;?>','<?php echo $row['id'] ;?>')" class="fa fa-close" style="font-size: 15px;position: absolute;color: red;cursor:pointer;"></i></span> 
                     <?php } ?></p>
                    </div>
                    </div>
    
    <?php
}

if(isset($_GET['set_question_type_details_delete'])){
    $question_id=VerifyData($_GET['set_question_type_details_delete']); 
    $type_details_id=VerifyData($_GET['type_details_data']);
    if(!$question_id=="" and !$type_details_id==""){
     $sql_check=mysqli_num_rows(mysqli_query($con,"select * from online_test_question_details where online_test_question_id='$question_id' and id='$type_details_id'"));   
     if($sql_check>0){
         $delete_data=mysqli_query($con,"delete from online_test_question_details where id='$type_details_id'");
         if($delete_data){
             echo 1;
         }else{
             echo "Error code 103.";
         }
         
     }else{
         echo "Error code 102.";
     }
        
    }else{
        echo "Error code 101.";
    }
}

if(isset($_GET['set_question_type_details'])){
    $question_id=VerifyData($_GET['set_question_type_details']);
    $type_id=VerifyData($_GET['type_data']);
    if(!$question_id=="" and !$type_id==""){
     $sql_check=mysqli_num_rows(mysqli_query($con,"select * from online_test_question_details where online_test_question_id='$question_id' and course_id='$type_id'"));   
     if(!$sql_check>0){
         $sql_insert=mysqli_query($con,"insert into `online_test_question_details`(`online_test_question_id`, `course_id`) values('$question_id', '$type_id')");
         if($sql_insert){
             echo 1;
         }else{
             echo "Error code 103.";
         }
         
     }else{
         echo "Error code 102.";
     }
        
    }else{
        echo "Error code 101.";
    }
}

if(isset($_GET['update_question_data'])){
    $id=VerifyData($_GET['update_question_data']);
    $colm=VerifyData($_GET['holder']);
    $data=VerifyData($_GET['data']);
    $update=mysqli_query($con,"update online_test_question set $colm='$data' where id='$id'");
    if($colm == 'test_level'){
        $update2 = mysqli_query($con, "UPDATE online_test_question_details SET test_level='$data' WHERE online_test_question_id='$id'");
    }
}

if (isset($_GET['update_question_data_encoded'])) {
    $id = VerifyData($_GET['update_question_data_encoded']);
    $field = VerifyData($_GET['field']);
    $data = $_GET['data']; 

    
    $safe_data = mysqli_real_escape_string($con, $data);

    
    $allowed_fields = ['test_question', 'ans_a', 'ans_b', 'ans_c', 'ans_d'];
    if (in_array($field, $allowed_fields)) {
        $update = mysqli_query($con, "UPDATE online_test_question SET $field = '$safe_data' WHERE id = '$id'");
        if ($update) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "invalid_field";
    }
}

?>
<?php  mysqli_close($con); ?>