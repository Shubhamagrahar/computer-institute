<?php  
include('session.php');
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['tsp_table_data_delete'])){
    $id=VerifyData($_GET['tsp_table_data_delete']);
    if(!$id==""){
       $delete =mysqli_query($con,"delete from test_course_pkg_wise_question_type where id='$id'");
       if($delete){
           echo 1;
       }else{
           echo "Server Error 101.";
       }
    }else{
        echo "Id emapty.";
    }
}

if(isset($_GET['tsp_pkg_series_insert'])){
    $pkg_id=VerifyData($_GET['tsp_pkg_series_insert']);
    $series_id=VerifyData($_GET['series_id']);
    if(!$pkg_id=="" and !$series_id==""){
        $check=mysqli_num_rows(mysqli_query($con,"select * from test_course_pkg_wise_question_type where pkg_id='$pkg_id' and series_type_id='$series_id'"));
        if(!$check>0){
            $insert=mysqli_query($con,"insert into `test_course_pkg_wise_question_type`(`pkg_id`, `series_type_id`) values('$pkg_id', '$series_id')");
            if($insert){
                echo 1;
            }else{
                echo "Server error 101.";
            }
        }else{
            echo "Already Bind.";
        }
    }
}

if(isset($_GET['tsp_seriest_table'])){
  $pkg_id=VerifyData($_GET['tsp_seriest_table']);
    if(!$pkg_id==""){
        
        ?>
        <br>
                                <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><?php //echo $course_details['name'] ?> Package Allowed Test Question Type</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th width="60px">Delete</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                            $i=0;
                                            $sql=mysqli_query($con,"select * from test_course_pkg_wise_question_type where pkg_id='$pkg_id' order by id desc");
                                             while($row=mysqli_fetch_array($sql)){
                                                 $sql_series_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_type where id='$row[series_type_id]'"));
                                                 ?>
                                                 <tr>
                                                     <td><?php echo $i +=1; ?></td>
                                                     <td><?php echo $sql_series_details['name']; ?></td>
                                                     <td><a style="color:red;" href="javascript:void(0)" onclick="tsp_table_data_delete('<?php echo $row['id'] ?>', '<?php echo $pkg_id; ?>')"><i class="fa fa-trash"></i> Delete</a></td>
                                                 </tr>
                                                 <?php 
                                             }
                                           ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
             <script>
                 $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                //"buttons": ["copy", "", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
             </script>
        <?php
    }  
}

if(isset($_GET['tsp_pkg_details'])){
    $pkg_id=VerifyData($_GET['tsp_pkg_details']);
    if(!$pkg_id==""){
        $sql=mysqli_query($con,"select * from test_series_pkg_details where id='$pkg_id' and status='OPEN'");
        if(mysqli_num_rows($sql)==1){
            $pkg_details=mysqli_fetch_array($sql);
      ?>
         <br>
            <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            
            td, th {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }
            
            tr:nth-child(even) {
              background-color: #dddddd;
            }
            </style>
            <table>
                <tr>
                    <th>Total Series</th>
                    <th>Question Each Series</th>
                    <th>Valid Day</th>
                    <th>Price</th>
                    <th>Free Series</th>
                    <th>Discount</th>
                </tr>
                <tr>
                    <td><?php echo $pkg_details['total_test_series']; ?></td>
                    <td><?php echo $pkg_details['ques_no_each_series']; ?></td>
                    <td><?php echo $pkg_details['validity_in_days']; ?></td>
                    <td><?php echo $pkg_details['price']; ?></td>
                    <td><?php echo $pkg_details['total_free_series']; ?></td>
                    <td><?php echo $pkg_details['discount_amt']; ?></td>
                </tr>
            </table>
      <?php    
        }
    }
}

if(isset($_GET['tsp_series_selector'])){
    $pkg_id=VerifyData($_GET['tsp_series_selector']);
    if(!$pkg_id==""){
      ?>
       <label>Select Series Question Type :</label>
       <select name="series_id" ID="series_id" class="form-control" required onchange="tsp_pkg_series_insert('<?php echo $pkg_id; ?>',this.value)">
           <option value="">Select</option>
           <?php 
            $sql=mysqli_query($con,"select * from test_series_type order by name");
            while($row=mysqli_fetch_array($sql)){
                $check=mysqli_num_rows(mysqli_query($con,"select * from test_course_pkg_wise_question_type where pkg_id='$pkg_id' and series_type_id='$row[id]'"));
                if(!$check>0){
                    ?>
                    <option value="<?php  echo $row['id']; ?>"><?php  echo $row['name']; ?></option>
                    <?php
                }
            }
           ?>
       </select>
      <?php    
    }
}


if(isset($_GET['question_course_insert'])){
    $course_id=VerifyData($_GET['question_course_insert']);
    $question_id=VerifyData($_GET['question']);
    if(!$course_id=="" and !$question_id==""){
        $check=mysqli_query($con,"select * from course_details where id='$course_id'");
        if(mysqli_num_rows($check)==1){
            $course_details=mysqli_fetch_array($check);
            if($course_details){
                $check_avail=mysqli_num_rows(mysqli_query($con,"select * from test_course_question_type where course_id='$course_id' and question_type_id='$question_id'"));
                if(!$check_avail>0){
                    $insert=mysqli_query($con,"insert into `test_course_question_type`(`course_id`, `question_type_id`) values('$course_id', '$question_id')");
                    if($insert){
                        echo 1;
                    }else{
                        echo "Server error 102.";
                    }
                }else{
                    echo "Package Already added.";
                }
            }else{
                echo "Server error 101.";
            }
        }else{
            echo "Course invalid.";
        }
    }else{
        echo "Somthing went wrong";
    }
}



if(isset($_GET['quertion_final_submit'])){
    $question_id=VerifyData($_GET['quertion_final_submit']);
    if(!$question_id==""){
       $sql=mysqli_query($con,"select * from test_series_questions where id='$question_id' and status='OPEN'");
       if(mysqli_num_rows($sql)==1){
         $result=mysqli_fetch_array($sql) ;
         if($result){
            if(!$result['test_question']==""){
                if(!$result['ans_a']==""){
                    if(!$result['ans_b']==""){
                        if(!$result['ans_c']==""){
                            if(!$result['ans_d']==""){
                                if(!$result['ans_final']==""){ 
                                 $sql_check=mysqli_num_rows(mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$question_id'"));
                                 if($sql_check>0){
                                    $update=mysqli_query($con,"update test_series_questions set status='ACT', date='$t_date' where id='$question_id'") ;
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
                    <label> This Question Type:</label>
                    <select name="test_question_type" id="ans_final" onchange="set_question_type_details('<?php echo $current_queryion_id ;?>',this.value)" class="form-control">
                        <option value="">Select</option>
                        <?php 
                        $sql=mysqli_query($con,"select * from test_series_type");
                        while($row=mysqli_fetch_array($sql)){
                           $sql_check=mysqli_num_rows(mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$current_queryion_id' and test_series_type_id='$row[id]'")) ;
                          if(!$sql_check>0){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        }
                        <?php } } ?>
                        
                    </select>
                    </div>
                    <div class="col-sm-8" style="margin-top: 30px;">
                       <p id="q_type_list"><?php 
                      
                       $sql=mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$current_queryion_id'");
                       while($row=mysqli_fetch_array($sql)){
                           $q_type_data=mysqli_fetch_array(mysqli_query($con,"select * from test_series_type where id='$row[test_series_type_id]'"));
                         
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
     $sql_check=mysqli_num_rows(mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$question_id' and id='$type_details_id'"));   
     if($sql_check>0){
         $delete_data=mysqli_query($con,"delete from test_series_questions_type_details where id='$type_details_id'");
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
     $sql_check=mysqli_num_rows(mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$question_id' and test_series_type_id='$type_id'"));   
     if(!$sql_check>0){
         $sql_insert=mysqli_query($con,"insert into `test_series_questions_type_details`(`test_series_questions_id`, `test_series_type_id`) values('$question_id', '$type_id')");
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
    
    $update=mysqli_query($con,"update test_series_questions set $colm='$data' where id='$id'");
}

if (isset($_GET['update_question_data_encoded'])) {
    $id = VerifyData($_GET['update_question_data_encoded']);
    $field = VerifyData($_GET['field']);
    $data = $_GET['data']; 

    
    $safe_data = mysqli_real_escape_string($con, $data);

    
    $allowed_fields = ['test_question', 'ans_a', 'ans_b', 'ans_c', 'ans_d'];
    if (in_array($field, $allowed_fields)) {
        $update = mysqli_query($con, "UPDATE test_series_questions SET $field = '$safe_data' WHERE id = '$id'");
        if ($update) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "invalid_field";
    }
}



if (isset($_GET['insert_type_name'])) {
    $type_name = VerifyData($_GET['type_name']);

    if ($type_name != "") {
        $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM test_series_type WHERE name='$type_name'"));

        if ($check == 0) {
            $insert = mysqli_query($con, "INSERT INTO test_series_type (name) VALUES ('$type_name')");
            if ($insert) {
                echo "Test Series type name created successfully.";
            } else {
                echo "Server error 101.";
            }
        } else {
            echo "This Test Series type name already exists.";
        }
    } else {
        echo "Please fill all the fields.";
    }
    exit;
}

if (isset($_GET['update_type_name'])) {
    $id = intval($_GET['id']);
    $new_name = VerifyData($_GET['new_name']);

    if ($new_name == '') {
        echo "Type name cannot be empty.";
        exit;
    }

    $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM test_series_type WHERE name='$new_name' AND id != $id"));

    if ($check > 0) {
        echo "This Test Series type name already exists.";
        exit;
    }

    $update = mysqli_query($con, "UPDATE test_series_type SET name='$new_name' WHERE id=$id");

    if ($update) {
        echo "Test Series type name updated successfully.";
    } else {
        echo "Server error: could not update.";
    }
    exit;
}
if (isset($_GET['change_permission'])) {
 

    $id = VerifyData($_GET['id']);
    $field = VerifyData($_GET['field']);
    $status = VerifyData($_GET['status']); 



    if (!empty($id) && !empty($field) && ($status === 'OPEN' || $status === 'CLOSE')) {
        $update = mysqli_query($con, "UPDATE test_series_pkg_details SET $field='$status' WHERE id='$id'");
       

        if ($update) {
            echo 'Success';
        } else {
            echo 'Error updating';
        }
    } else {
        echo 'Invalid request parameters';
    }

    exit;
}

mysqli_close($con);
?>