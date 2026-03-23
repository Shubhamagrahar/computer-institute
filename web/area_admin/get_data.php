<?php  
include('session.php');

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


if(isset($_GET['att_st_submit_st'])){
  $id=VerifyData($_GET['att_st_submit_st']);
   
    if(!$id=="" ){
        $sql=mysqli_query($con,"select * from attendance_student where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            if($result['in_time']>"00:00:00"){
                if($result['out_time']>"00:00:00"){
        $update=mysqli_query($con,"update attendance_student set status='P' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 101.";
        }
                }else{
                echo "Please select student Out time.";
            }
            }else{
                echo "Please select student in time.";
            }
        }else{
          echo "Server error 102.";  
        } 
    }else{
        echo "Server error 101.";
    }    
}

if(isset($_GET['att_st_edit_st'])){
    $id=VerifyData($_GET['att_st_edit_st']);
   
    if(!$id=="" ){
        $update=mysqli_query($con,"update attendance_student set status='A' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 102.";
        }
    }else{
        echo "Server Error 101.";
    }
}

if(isset($_GET['att_out_time_st'])){
    $id=VerifyData($_GET['att_out_time_st']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $update=mysqli_query($con,"update attendance_student set out_time='$val' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 101.";
        }
    }else{
        echo "Please select In time.";
    }
}


if(isset($_GET['att_in_time_st'])){
    $id=VerifyData($_GET['att_in_time_st']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $update=mysqli_query($con,"update attendance_student set in_time='$val' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 101.";
        }
    }else{
        echo "Please select In time.";
    }
}


if(isset($_GET['permission_grant'])){
    $id=VerifyData($_GET['permission_grant']);
    $data=VerifyData($_GET['data']);
    
    if(!$id=="" and !$data==""){
        $update=mysqli_query($con,"update session_menu_staff_permission set status='$data' where id='$id'");
    }
}


if(isset($_GET['get_data_report_view'])){
    $id=VerifyData($_GET['get_data_report_view']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from enquiry_details where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            ?>
             <div class="container-fluid">
        <div class="row">
           
            <div class="col-md-12">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Enquiry Details</h3>
                <!--<span style="float:right;">-->
                <!--    <button class="btn btn-warning" id="enquery_data_edit_btn" onclick="edit_enquery_data()">Edit</button>-->
                <!--    <button class="btn btn-default" id="enquery_data_update_btn" onclick="update_enquery_data()" style="display:none;">Update</button>-->
                    
                <!--</span>-->
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                  <div class="row">  
                  <div class="form-group col-md-4">
                    <label >Name:</label> <input type="text" readonly id="name" onkeyup="update_enquery_form_data('name',this.value,<?php echo $result['id'] ;?>)"  value="<?php echo $result['name'] ;?>" class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Guardian Name:</label><input type="text" readonly id="guardian_name" onkeyup="update_enquery_form_data('guardian_name',this.value,<?php echo $result['id'] ;?>)" value="<?php echo $result['guardian_name'] ;?>" class="form-control"> 
                  </div>
                  <div class="form-group col-md-4">
                    <label>Relation With Guardian:</label><input type="text" readonly id="guardian_relation" onkeyup="update_enquery_form_data('guardian_relation',this.value,<?php echo $result['id'] ;?>)" value="<?php echo $result['guardian_relation'] ;?>" class="form-control">  
                  </div>
                   <div class="form-group col-md-4">
                    <label>Guardian Occupation:</label>
                    <input type="text" id="guardian_occupation_input" readonly value="<?php echo $result['guardian_occupation'] ;?>" class="form-control">
                     <select name="guardian_occupation" style="display:none;" id="guardian_occupation" required="" onchange="update_enquery_form_data('guardian_occupation',this.value,<?php echo $result['id'] ;?>)" class="form-control">
                          <option value="">Select</option>
                          <option value="Gov. Job">Gov. Job</option>
                          <option value="Private Job">Private Job</option>
                          <option value="Business">Business</option>
                          <option value="IT Field">IT Field</option>
                          <option value="Farmer">Farmer</option>
                          <option value="Other">Other</option>
                      </select>
                    <script>
                        $("#guardian_occupation").val('<?php echo $result['guardian_occupation'] ;?>');
                    </script>
                    
                  </div>
                  <div class="form-group col-md-2">
                    <label>Category:</label> 
                    <input type="text" id="category_input" readonly value="<?php echo $result['category'] ;?>" class="form-control">
                    <select class="form-control" name="category" required="" style="display:none;" id="category" onchange="update_enquery_form_data('category',this.value,<?php echo $result['id'] ;?>)">
                         <option value="">Select</option>
                         <option value="Gen">Gen</option>
                         <option value="OBC">OBC</option>
                         <option value="SC/ST">SC/ST</option>
                     </select>
                     <script>
                        $("#category").val('<?php echo $result['category'] ;?>');
                    </script>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Mobile 1:</label>
                    <input type="number" readonly id="mobile1" onkeyup="update_enquery_form_data('mobile1',this.value,<?php echo $result['id'] ;?>)" value="<?php echo $result['mobile1'] ;?>" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Mobile 2:</label>
                    <input type="number" readonly id="mobile2" onkeyup="update_enquery_form_data('mobile2',this.value,<?php echo $result['id'] ;?>)" value="<?php echo $result['mobile2'] ;?>" class="form-control">
                  </div>
                <div class="form-group col-md-12">
                    <label>Address:</label> 
                    <textarea class="form-control" readonly id="address1" required="" onkeyup="update_enquery_form_data('address1',this.value,<?php echo $result['id'] ;?>)" name="address1" ><?php echo $result['address1'] ;?></textarea>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Employment status:</label> 
                   <input type="text" id="employment_status_input" readonly value="<?php echo $result['employment_status'] ;?>" class="form-control">
                    <select name="employment_status" required="" style="display:none;" id="employment_status" class="form-control" onchange="update_enquery_form_data('employment_status',this.value,<?php echo $result['id'] ;?>)">
                          <option value="">Select</option>
                          <option value="Employed">Employed</option>
                          <option value="Non Employed">Non Employed</option>
                      </select>
                      
                      <script>
                        $("#employment_status").val('<?php echo $result['employment_status'] ;?>');
                    </script>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Computer Literacy:</label> 
                    <input type="text" id="computer_literacy_input" readonly value="<?php echo $result['computer_literacy'] ;?>" class="form-control">
                    <select name="computer_literacy" required="" style="display:none;" id="computer_literacy" class="form-control">
                          <option value="">Select</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select>
                      <script>
                        $("#computer_literacy").val('<?php echo $result['computer_literacy'] ;?>');
                    </script>
                  </div>
                   <div class="form-group col-md-3">
                    <label>Qualification:</label>
                    <input type="text" id="qualification_input" readonly value="<?php echo $result['qualification'] ;?>" class="form-control">
                    <select name="qualification" id="qualification" style="display:none;" required="" class="form-control"> 
                          <option value="">Select</option>
                          <option value="Post Graduate">Post Graduate</option>
                          <option value="Graduate">Graduate</option>
                          <option value="Graduate">Intermediate</option>
                          <option value="High School">High School</option>
                      </select>
                      <script>
                        $("#qualification").val('<?php echo $result['qualification'] ;?>');
                    </script>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Stream:</label>
                    <input type="text" id="education_stream_input" readonly value="<?php echo $result['education_stream'] ;?>" class="form-control">
                    <select name="education_stream" required="" style="display:none;" id="education_stream" class="form-control">
                          <option value="">Select</option>
                          <option value="Art">Art</option>
                          <option value="Science">Science</option>
                          <option value="Graduate">Commerce</option>
                          <option value="High School">Any Othre</option>
                      </select>
                      <script>
                        $("#education_stream").val('<?php echo $result['education_stream'] ;?>');
                    </script>
                  </div>
                  <div class="form-group col-md-5">
                    <label>How did you to came to know of APCS :</label> <span><?php echo $result['know_about_it'] ;?></span>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Handbill :</label> <span><?php echo $result['handbill'] ;?></span>
                  </div>
                  <?php
                  if($result['handbill']=='Yes'){
                  ?>
                  <div class="form-group col-md-4">
                    <label>APCS Student :</label> <span><?php echo $result['institute_student'] ;?></span>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Friends :</label> <span><?php echo $result['institute_friends'] ;?></span>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Other :</label> <span><?php echo $result['institute_other'] ;?></span>
                  </div>
                  <?php } ?>
                   <div class="form-group col-md-4">
                    <label>Career Objective :</label> <span><?php echo $result['career_objective'] ;?></span>
                  </div>
                  <?php
                  $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$result[course_id]'"));
                  ?>
                  <div class="form-group col-md-6">
                    <label>Course Recommended :</label> <span><?php echo $course_details['name'] ;?></span>
                  </div>
                  
                  <?php
                  $enquiry_date=date_create($result['enquiry_date']);
                  $enquiry_date=date_format($enquiry_date,"d-m-Y");
                  ?>
                  <div class="form-group col-md-6">
                    <label>Enquiry Date :</label> <span><?php echo $enquiry_date ;?></span>
                  </div>
                  <?php
                  $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$result[batch_id]'"));
                  ?>
                   <div class="form-group col-md-6">
                    <label>Batch :</label> <span><?php echo $batch_details['batch_name'] ;?></span>
                  </div>
                  
                   <?php
                  $next_date=date_create($result['next_date']);
                  $next_date=date_format($next_date,"d-m-Y");
                  ?>
                  <div class="form-group col-md-6">
                    <label>To Be Come Again On(Date) :</label> <span><?php echo $next_date ;?></span>
                  </div>
                    <div class="form-group col-md-6">
                    <label>Enquiry Note :</label> <span><?php echo $result['enquiry_note'] ;?></span>
                  </div>
                   
                </div>
                <!-- /.card-body -->
            <div class="card-footer">
                  <button type="submit"  name="submit" onclick="data_view_close()" class="btn btn-danger">Close</button>
                </div>
             
            </div>
            </div>
            
              
          </div>
          </div>
        </div>
            <?php
        }
    }
}

if(isset($_GET['att_st_submit'])){
  $id=VerifyData($_GET['att_st_submit']);
   
    if(!$id=="" ){
        $sql=mysqli_query($con,"select * from attendance_staff where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            if($result['in_time']>"00:00:00"){
                if($result['out_time']>"00:00:00"){
        $update=mysqli_query($con,"update attendance_staff set status='P' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 101.";
        }
                }else{
                echo "Please select student Out time.";
            }
            }else{
                echo "Please select student in time.";
            }
        }else{
          echo "Server error 102.";  
        } 
    }else{
        echo "Server error 101.";
    }    
}

if(isset($_GET['att_st_edit'])){
    $id=VerifyData($_GET['att_st_edit']);
   
    if(!$id=="" ){
        $update=mysqli_query($con,"update attendance_staff set status='A' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 102.";
        }
    }else{
        echo "Server Error 101.";
    }
}

if(isset($_GET['att_out_time'])){
    $id=VerifyData($_GET['att_out_time']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $update=mysqli_query($con,"update attendance_staff set out_time='$val' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 101.";
        }
    }else{
        echo "Please select In time.";
    }
}

if(isset($_GET['att_in_time'])){
    $id=VerifyData($_GET['att_in_time']);
    $val=VerifyData($_GET['val']);
    if(!$id=="" and !$val==""){
        $update=mysqli_query($con,"update attendance_staff set in_time='$val' where id='$id'");
        if($update){
          echo 1;  
        }else{
            echo "Server error 101.";
        }
    }else{
        echo "Please select In time.";
    }
}

if(isset($_GET['data_insert_marks'])){
    $id=VerifyData($_GET['data_insert_marks']);
    $data=VerifyData($_GET['data']);
    if(!$id=="" ){
        
       $update=mysqli_query($con,"update certificate_marks_details set obt_mark='$data' where id='$id'");
       
    }
}


if(isset($_GET['get_subject_data_by_cr_mob'])){
    $mobile=VerifyData($_GET['get_subject_data_by_cr_mob']);
    $course_id=VerifyData($_GET['course_id']);
    if(!$mobile=="" and !$course_id==""){
        $sql=mysqli_query($con,"select * from course_wise_subject where course_id='$course_id'");
        while($row=mysqli_fetch_array($sql)){
            $check=mysqli_num_rows(mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile' and course_id='$course_id' and subject_wise_subject_id='$row[id]'"));
            if(!$check>0){
                $subject_details=mysqli_fetch_array(mysqli_query($con,"select * from subject_details where id='$row[subject_id]'"));
                $insert=mysqli_query($con,"insert into `certificate_marks_details`(`mobile`, `course_id`, `subject_wise_subject_id`, `subject_name`, `max_mark`) values('$mobile', '$course_id', '$row[id]', '$subject_details[subject_name]', '$row[max_marks]')");
            }
        }
        
        $check=mysqli_num_rows(mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile' and student_certificate_id>'0' and course_id='$course_id' "));
        if(!$check>0){
        ?>
        
         <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Certificate Marks Details <?php echo $mobile; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                    <div class="card-body">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th  width="100px">S.No.</th>
                                                <th>Subject Name</th>
                                                <th  width="200px">Max. Marks</th>
                                                <th width="200px">Mark Secured</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile' and course_id='$course_id'");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                             
                                                <td><?php echo $row['subject_name']; ?></td>
                                               
                                               <td><?php echo $row['max_mark'] ; ?></td>
                                               <td><input type="number" name="markSecured_<?php echo $row['id'] ?>" onkeyup="data_insert_marks(<?php echo $row['id'] ?>,this.value)" value="<?php echo $row['obt_mark'] ?>" class="form-control"></td>
                                                
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                  
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                         
                                        <button type="submit" name="final_submit" id="submit" class="btn btn-primary">Submit</button>
                                       
                                    </div>
                              
                            </div>
        
        
        <?php
        }else{
            echo "1";
        }
    }
}


if(isset($_GET['delete_course_bind_data'])){
    $id=VerifyData($_GET['delete_course_bind_data']);
    if(!$id==""){
        $delete =mysqli_query($con,"delete from course_wise_subject where id='$id'");
        if($delete){
            echo "1";
        }else{
         echo "server error 102.";   
        }
    }else{
        echo "server error 101.";
    }
}

if(isset($_GET['get_data_table_course_wise_subject'])){
    $course_id=VerifyData($_GET['get_data_table_course_wise_subject']);
    if(!$course_id==""){
        $sql_ch=mysqli_query($con,"select * from course_details where id='$course_id'");
        if(mysqli_num_rows($sql_ch)>0){
            $result=mysqli_fetch_array($sql_ch);
       
        ?>
        
        <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><b><?php echo $result['name']; ?> Subjects Details</b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Subject Name</th>
                                                <th>Max. Marks</th>
                                                <th>Delete</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from course_wise_subject where course_id='$course_id' ");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            $subject_details=mysqli_fetch_array(mysqli_query($con,"select * from subject_details where id='$row[subject_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                             
                                                <td><?php echo $subject_details['subject_name']; ?></td>
                                               
                                               <td><?php echo $row['max_marks'] ; ?></td>
                                                <td><a title="Delete this bind subject data." href="#" onclick="delete_selecte_bind_data(<?php echo $row['id'] ?>,<?php echo $course_id; ?>)"><span style="color:red;"> <i class="fa fa-trash"></i> Delete</span></a></td>
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <script>
                   $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
        
  
}


if(isset($_GET['create_subject_wise_course'])){
    $course_id=VerifyData($_GET['create_subject_wise_course']);
    $subject_id=VerifyData($_GET['subject_id']);
    $subject_marks=VerifyData($_GET['subject_marks']);
    if(!$course_id=="" and !$subject_id=="" and !$subject_marks==""){
      $sql_check=mysqli_num_rows(mysqli_query($con,"select * from course_wise_subject where course_id='$course_id' and subject_id='$subject_id'"));
        if(!$sql_check>0){ 
            
          $insert=mysqli_query($con,"insert into `course_wise_subject`(`course_id`, `subject_id`, `max_marks`) values('$course_id', '$subject_id', '$subject_marks')");  
          
          if($insert){
              echo "1";
          }else{
            echo "Server error 102";  
          }
            
        }else{
          echo "This subject already bind with selected course.";  
        }  
        
    }else{
        echo "Server error 101";
    }
}


if(isset($_GET['get_add_course_subject_data'])){
    $id=VerifyData($_GET['get_add_course_subject_data']);
    
    if(!$id==""){
       
      $sql=mysqli_query($con,"select * from course_details where id='$id'");
       if(mysqli_num_rows($sql)==1){
       
         ?>
           <div class="col-md-6 form-group">
                    <label for="subject_id">Select Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control">
                          <option value="">Select</option>
                          
                          <?php 
                           $sql_subject=mysqli_query($con,"select * from subject_details order by subject_name");
                           while($row=mysqli_fetch_array($sql_subject)){
                               
                               $sql_check=mysqli_num_rows(mysqli_query($con,"select * from course_wise_subject where course_id='$id' and subject_id='$row[id]'"));
                               if(!$sql_check>0){
                               ?>
                               <option value="<?php echo $row['id']; ?>"><?php echo $row['subject_name']; ?></option>
                               <?php 
                              }
                               
                           }
                           
                          ?>
                          
                      </select>
                  </div>
                  
                  
                  <div class="col-md-6 form-group">
                    <label for="subject_marks">Max. Marks</label>
                    <input type="number"  class="form-control"  id="subject_marks" name="subject_marks" value=""  placeholder="Enter Subject marks.">
               
                  </div>
         <?php   
      
       }
           
       }
         
   
    
}


if(isset($_GET['get_otp_fee'])){
    $course_id=VerifyData($_GET['get_otp_fee']);
    if(!$course_id==""){
        $sql=mysqli_query($con,"select * from course_details where id='$course_id'");
        if(mysqli_num_rows($sql)>0){
            $result=mysqli_fetch_array($sql);
            $monthlyFee=$result['fee']/$result['duration'];
            $monthlyFee=round($monthlyFee);
           ?>
                <div class="col-md-4">
                    <span></span>
                    <label>Course Fee:</label>
                    <input type="text" id="course_totalfee" readonly name="course_totalfee" class="form-control" value="<?php echo $result['fee'] ; ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Discount in %</label>
                    <input type="text" id="discount_in_per" name="discount_in_per" onkeyup="discount_value_details_rs()" class="form-control" value="0" required>
                </div>
                <div class="col-md-4">
                    <label>Discount in Rs.</label>
                    <input type="text" id="discount_in_rs" name="discount_in_rs" onkeyup="discount_value_details_pr()" class="form-control" value="0" required>
                </div>
                <div class="col-md-4">
                    <label>Final Fee:</label>
                    <input type="text" readonly id="course_final_fee" name="course_final_fee" class="form-control" value="<?php echo $result['fee'] ; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="pay_type">Pay Type</label>
                    <select id="pay_type" name="pay_type" class="form-control">
                        <option value="">Select</option>
                        <option value="CASH">Cash</option>
                        <option value="BYQRPAYORUPI">By QR Scan Pay Or UPI ID</option>
                        <option value="BYIMPS">By IMPS</option>
                        <option value="BYNEFT">By NEFT</option>
                        
                    </select>
                 
                  </div>
                  <div class="col-md-4">
                    <label for="pay_des">Description</label>
                    <textarea  class="form-control" id="pay_des"  name="pay_des"  placeholder="Enter Pay fee amount"></textarea>
                 
                  </div>
                 <script>
                     function discount_value_details_rs(){
                         var course_totalfee=Number($("#course_totalfee").val());
                         var discount_in_per=Number($("#discount_in_per").val());
                         var discount_in_rs=Number($("#discount_in_rs").val());
                          if(!discount_in_per==""){
                              var discount = (course_totalfee * discount_in_per )/100;
                              var course_final_fee = course_totalfee - discount ;
                              $("#discount_in_rs").val(discount);
                              $("#course_final_fee").val(course_final_fee);
                          }
                          if(discount_in_per==""){
                             $("#discount_in_rs").val("0");
                              $("#course_final_fee").val(course_totalfee); 
                          }
                      
                         
                     }
                     function discount_value_details_pr(){
                         var course_totalfee=Number($("#course_totalfee").val());
                         var discount_in_per=Number($("#discount_in_per").val());
                         var discount_in_rs=Number($("#discount_in_rs").val());
                       
                          if(!discount_in_rs==""){
                              var discount_per = (discount_in_rs * 100 )/course_totalfee;
                              var course_final_fee = course_totalfee - discount_in_rs ;
                              $("#discount_in_per").val(discount_per);
                              $("#course_final_fee").val(course_final_fee);
                          }
                          if(discount_in_rs==""){
                              $("#discount_in_per").val("0");
                              $("#course_final_fee").val(course_totalfee);
                          }
                         
                     }
                 </script> 
                  
           <?php 
        }
    }
}



if(isset($_GET['get_monthly_fee'])){
    $course_id=VerifyData($_GET['get_monthly_fee']);
    if(!$course_id==""){
        $sql=mysqli_query($con,"select * from course_details where id='$course_id'");
        if(mysqli_num_rows($sql)>0){
            $result=mysqli_fetch_array($sql);
            $monthlyFee=$result['fee']/$result['duration'];
            $monthlyFee=round($monthlyFee);
           ?>
                <div class="col-md-4">
                    <label>Per Month Fee</label>
                    <input type="text" id="monthly_fee" name="monthly_fee" class="form-control" value="<?php echo $monthlyFee ; ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Daily Late Fee</label>
                    <input type="text" id="daily_late_fee" name="daily_late_fee" class="form-control" value="10" required>
                </div>
                <div class="col-md-4">
                    <label>Late fee count after</label>
                    <input type="text" id="late_fee_count_after" name="late_fee_count_after" class="form-control" value="3" required>
                </div>
           <?php 
        }
    }
}

if(isset($_GET['checkUserByMobileNumber'])){
    $mobile=VerifyData($_GET['checkUserByMobileNumber']);
    if(!$mobile==""){
      $check=mysqli_query($con,"select * from user where branch_id='$_SESSION[userid]' and mobile='$mobile'");
      if(mysqli_num_rows($check)==1){
          $result=mysqli_fetch_array($check);
          echo 1;
      }else{
          echo '<span style="color:red;">Mobile Number Not Registered or not in your franchise.</span>';
      }
    }
}


if(isset($_GET['GetUserNameBymobileNumber'])){
    $mobile=VerifyData($_GET['GetUserNameBymobileNumber']);
    if(!$mobile==""){
      $check=mysqli_query($con,"select * from user where mobile='$mobile'");
      if(mysqli_num_rows($check)==1){
          $result=mysqli_fetch_array($check);
          echo $result['name'];
      }else{
         
      }
    }
}

if(isset($_GET['GetUserBalanceByMobileNumber'])){
    $mobile=VerifyData($_GET['GetUserBalanceByMobileNumber']);
    if(!$mobile==""){
      $check=mysqli_query($con,"select * from user where mobile='$mobile'");
      if(mysqli_num_rows($check)==1){
          $result=mysqli_fetch_array($check);
          $walletDetails=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$result[id]'"));
          echo $walletDetails['main_b'];
      }else{
         
      }
    }
}


if(isset($_GET['paid_due_fee'])){
    $userid=VerifyData($_GET['paid_due_fee']);
    $pay_fee=VerifyData($_GET['pay_fee']);
    $pay_type=VerifyData($_GET['pay_type']);
    $pay_des=VerifyData($_GET['pay_des']);
    
    if(!$userid=="" and !$pay_fee=="" and !$pay_type==""){
         $sql_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$userid'"));
         $sql_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$userid'"));
         
             $final_go_for_next=0;
               if($sql_user['fee_collect_type']=="YES"){
                        $date_due=date_create($sql_user['next_fee_date']);
                        $date_due=date_format($date_due,"d-m-Y");
                        $delay_fee_date=date('Y-m-d', strtotime($sql_user['next_fee_date']. ' + '.$sql_user['late_fee_count_after'].' day'));
                        $next_fee_date=date('Y-m-d', strtotime($sql_user['next_fee_date']. ' + 30 day'));
                    
                     if($delay_fee_date>$t_date) {
                         $lat_day=0;
                     }else{
                        $now=strtotime($t_date);
                        $last_date=strtotime($delay_fee_date);
                        $gap=$now - $last_date;
                        $lat_day=round($gap / (60 * 60 * 24));
                     }
                     $daily_late_fee= $lat_day * $sql_user['daily_late_fee'];
                     $go_for_next_step=0;
                     if($daily_late_fee>0){
                       $op_bal=$sql_wallet['main_b'];
                        $cl_bal=$op_bal - $daily_late_fee;
                        $update_wallet=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$userid'"); 
                        if($update_wallet){
                            $des="Late Course fee Rs.".$daily_late_fee." after due date :".$date_due;
                             $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `debit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$userid', '$des', '$daily_late_fee', '1', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                         if($insert_transaction){
                           $sql_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$userid'"));  
                           if($sql_wallet){
                              $go_for_next_step=1; 
                           }else{
                              $go_for_next_step="Server Error 503"; 
                           }
                             
                         }else{
                             $go_for_next_step="Server Error 502";
                         }
                            
                        }else{
                         $go_for_next_step="Server Error 501";   
                        }
                     }else{
                        $go_for_next_step=1; 
                     }
                     
                     if($go_for_next_step==1){
                     $update_user=mysqli_query($con,"update user set next_fee_date='$next_fee_date' where id='$userid'");
                     if($update_user){
                         $final_go_for_next=1;
                     }else{
                         $final_go_for_next="Server Error 504";
                     }
                     }else{
                      $final_go_for_next= $go_for_next_step ;  
                     }
                     
               }else{
                   $final_go_for_next=1;
               }         
         
             if($final_go_for_next==1){
                $op_bal=$sql_wallet['main_b'];
                $cl_bal=$op_bal + $pay_fee;
                $update_wallet=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$userid'");
                if($update_wallet){
                $des=$pay_type."/Course fee pay. ".$pay_des;
                $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$userid', '$des', '$pay_fee', '1', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                 if($insert_transaction){
                  
                    $insert_fee_collect_details=mysqli_query($con,"insert into `fee_collect_details`(`userid`, `by_rcv`, `amt`, `date`) values('$userid', '$_SESSION[userid]', '$pay_fee', '$t_date')");
                    if($insert_fee_collect_details){
                        
                       
                       $op_bal=$login_wallet['main_b'];
                       $cl_bal=$op_bal + $pay_fee;
                       $update_wallet_self=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$_SESSION[userid]'");
                       if($update_wallet_self){
                           
                           $des=$pay_type."/Course fee collect by :".$sql_user['mobile']."/ ".$pay_des;
                           $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$_SESSION[userid]', '$des', '$pay_fee', '2', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                           if($insert_transaction){
                              echo 1;
                           }else{
                             echo "Server Error 105.";
                           }
                       }else{
                        echo "Server Error 104.";   
                       }
                    }else{
                      echo "Server Error 103.";
                    }
                 }else{
                   echo "Server Error 102.";
                 }   
                }else{
                  echo "Server Error 101.";
                }
            }else{
               echo "Somthing went wrong"; 
            } 
         
    }else{
        echo "Please enter all feild.";
    }
}

if(isset($_GET['get_fee_pay_details'])){
    $userid=VerifyData($_GET['get_fee_pay_details']);
    if(!$userid==""){
        $sql_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$userid' and branch_id='$_SESSION[userid]'"));
        $sql_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$userid'"));
    ?>
     <section class="content" id="fee_collection">
      <div class="container-fluid">
        <div class="row">
           
                
            
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Collect Fee</h3>
                <span onclick="document.getElementById('fee_collection').style.display='none';" style="float:right;" class="btn btn-danger;"><i class="fa fa-close"></i></span>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">
                    <label for="student_name">Name and mobile</label>
                    <input type="text" readonly class="form-control" id="student_name" name="student_name" value="<?php echo $sql_user['name']." (".$sql_user['mobile'].")"; ?>" >
                    
                  </div>
                  <?php 
                  if($sql_user['fee_collect_type']=="YES"){
                        $date_due=date_create($sql_user['next_fee_date']);
                        $date_due=date_format($date_due,"d-m-Y");
                        $delay_fee_date=date('Y-m-d', strtotime($sql_user['next_fee_date']. ' + '.$sql_user['late_fee_count_after'].' day'));
                    
                     if($delay_fee_date>$t_date) {
                         $lat_day=0;
                     }else{
                        $now=strtotime($t_date);
                        $last_date=strtotime($delay_fee_date);
                        $gap=$now - $last_date;
                        $lat_day=round($gap / (60 * 60 * 24));
                     }
                     $daily_late_fee= $lat_day * $sql_user['daily_late_fee'];
                      ?>
                  <div class="form-group">
                    <label for="deu_fee_date">Due Fee Date</label>
                    <input type="text" readonly class="form-control" id="deu_fee_date" name="deu_fee_date" value="<?php echo $date_due ;?>">
                  </div>
                  <div class="form-group">
                    <label for="month_deu_fee">Month Due Fee</label>
                    <input type="text" readonly class="form-control" id="month_deu_fee" name="month_deu_fee" value="<?php echo $sql_user['monthly_fee'] ;?>">
                  </div>
                  <div class="form-group">
                    <label for="daily_late_fee">Late Fee</label>
                    <input type="text" readonly class="form-control" id="daily_late_fee" name="daily_late_fee" value="<?php  echo $daily_late_fee ;?>">
                  </div>
                  <div class="form-group">
                    <label for="deu_fee">Total Due Fee</label>
                    <input type="text" readonly class="form-control" id="deu_fee" name="deu_fee" value="<?php echo $sql_user['monthly_fee'] + $daily_late_fee ;?>">
                  </div>
                      <?php
                  }else{
                  ?>
                  <div class="form-group">
                    <label for="deu_fee">Due Fee</label>
                    <input type="text" readonly class="form-control" id="deu_fee" name="deu_fee" value="<?php echo $sql_wallet['main_b'] ;?>">
                  </div>
                  <?php } ?>
                  <div class="form-group">
                    <label for="pay_fee">Pay fee</label>
                    <input type="number" class="form-control" id="pay_fee" name="pay_fee"  placeholder="Enter Pay fee amount">
                 
                  </div>
                  <div class="form-group">
                    <label for="pay_type">Pay Type</label>
                    <select id="pay_type" name="pay_type" class="form-control">
                        <option value="">Select</option>
                        <option value="CASH">Cash</option>
                        <option value="BYQRPAYORUPI">By QR Scan Pay Or UPI ID</option>
                        <option value="BYIMPS">By IMPS</option>
                        <option value="BYNEFT">By NEFT</option>
                        
                    </select>
                 
                  </div>
                  <div class="form-group">
                    <label for="pay_des">Description</label>
                    <textarea  class="form-control" id="pay_des"  name="pay_des"  placeholder="Enter Pay fee amount"></textarea>
                 
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="change" onclick="fee_paid(<?php echo $userid; ?>)" class="btn btn-primary">Submit</button>
                </div>
          
            </div>
            </div>
            
            
           
            
            
          </div>
        </div>
     </section>
    
    <?php
    }
    
}


if(isset($_GET['fee_details'])){
    $id=VerifyData($_GET['fee_details']);
    if(!$id==""){
        $sql_data=mysqli_query($con,"select * from course_details where id='$id'");
        if(mysqli_num_rows($sql_data)==1){
            $result=mysqli_fetch_array($sql_data);
            echo $result['fee'];
        }
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


if(isset($_GET['update_ex_user'])){
    $id=VerifyData($_GET['id']);
    $data=VerifyData($_GET['update_ex_user']);
    $colom_name=VerifyData($_GET['data_name']);
    $sql=mysqli_query($con,"update user_education_details set $colom_name='$data' where id='$id'");
   
    
}

if(isset($_GET['update_enroll_user'])){
    $id=VerifyData($_GET['id']);
    $data=VerifyData($_GET['update_enroll_user']);
    $colom_name=VerifyData($_GET['data_name']);
    $sql=mysqli_query($con,"update user set $colom_name='$data' where id='$id'");
   
    
}

if(isset($_GET['add_new_ex_table'])){
    $userid=VerifyData($_GET['add_new_ex_table']);
    if(!$userid==""){
        $insert=mysqli_query($con,"insert into `user_education_details`(`userid`) values('$userid')");
    }
}

if(isset($_GET['refresh_ex_table'])){
  $userid=VerifyData($_GET['refresh_ex_table']);
  if(!$userid==""){
      ?>
                     <table >
                          <tr>
                              <th>Examination</th>
                               <th>Passing Year</th>
                               <th>Board/University</th>
                               <th>Marks</th>
                               <th>Subject</th>
                               <th width="20px;"></th>
                          </tr>
                          <?php 
                           $sql=mysqli_query($con,"select * from user_education_details where userid='$userid'");
                           while($row=mysqli_fetch_array($sql)){
                               ?>
                               <tr>
                                   <td><input type="text" onkeyup="update_ex_data('examination',this.value,'<?php echo $row['id'];?>')" name="examination<?php echo $row['id'];?>" class="form-control" value="<?php echo $row['examination'];?>"></td>
                                   <td><input type="text" onkeyup="update_ex_data('passing_year',this.value,'<?php echo $row['id'];?>')" name="passing_year<?php echo $row['id'];?>" class="form-control" value="<?php echo $row['passing_year'];?>"></td>
                                   <td><input type="text" onkeyup="update_ex_data('borad_un',this.value,'<?php echo $row['id'];?>')" name="borad_un<?php echo $row['id'];?>" class="form-control" value="<?php echo $row['borad_un'];?>"></td>
                                   <td><input type="text" onkeyup="update_ex_data('marks',this.value,'<?php echo $row['id'];?>')" name="marks<?php echo $row['id'];?>" class="form-control" value="<?php echo $row['marks'];?>"></td>
                                   <td><input type="text" onkeyup="update_ex_data('subject',this.value,'<?php echo $row['id'];?>')" name="subject<?php echo $row['id'];?>" class="form-control" value="<?php echo $row['subject'];?>"></td>
                                  <td><span onclick="delet_ex_row(<?php echo $row['id'];?>)" style="color:red; cursor: pointer;"><i class="fa fa-trash"></i></span></td>
                               </tr>
                               <?php
                           }
                          ?>
                      </table>
      
      <?php 
  }
}


if(isset($_GET['delete_ex_table'])){
    $id=VerifyData($_GET['delete_ex_table']);
    if(!$id==""){
        $delete=mysqli_query($con,"delete from user_education_details where id='$id'");
    }
}

if(isset($_GET['update_course_book_course'])){
    $id=VerifyData($_GET['update_course_book_course']);
    $course_id=VerifyData($_GET['course_id']);
    $fee=VerifyData($_GET['fee']);
    if(!$id=="" and !$course_id=="" and !$fee==""){
        $update=mysqli_query($con,"update course_book set course_id='$course_id', fee='$fee' where id='$id'");
    }
}

if(isset($_GET['update_course_batch'])){
    $id=VerifyData($_GET['update_course_batch']);
    $batch_id=VerifyData($_GET['batch_id']);
  
    if(!$id=="" and !$batch_id==""){
        $update=mysqli_query($con,"update course_book set batch_id='$batch_id' where id='$id'");
    }
}
if(isset($_GET['update_course_start_date'])){
    $id=VerifyData($_GET['update_course_start_date']);
    $start_date=VerifyData($_GET['start_date']);
  
    if(!$id=="" and !$start_date==""){
        $update=mysqli_query($con,"update course_book set start_date='$start_date' where id='$id'");
    }
}



?>
<?php  mysqli_close($con); ?>