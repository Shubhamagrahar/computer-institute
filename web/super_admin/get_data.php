<?php  
include('session.php');

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['edit_certificate'])){
    $table=VerifyData($_GET['edit_certificate']);
    $id=VerifyData($_GET['edit_where']);
    $clmn=VerifyData($_GET['edit_clmn']);
    $data=VerifyData($_GET['edit_data']);
    if(!$table=="" and !$id=="" and !$clmn=="" and !$data==""){
        $update=mysqli_query($con,"update $table set $clmn='$data' where id='$id'");
        if($update){
           echo 1; 
        }else{
          echo "Server Error 102.";  
        }
    }else{
        echo "Server Error 101.";
    }
}

if(isset($_GET['permission_grant'])){
    $id=VerifyData($_GET['permission_grant']);
    $data=VerifyData($_GET['data']);
    
    if(!$id=="" and !$data==""){
        $update=mysqli_query($con,"update session_menu_staff_permission set status='$data' where id='$id'");
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

if(isset($_GET['course_dated_data_get'])){
    $course_id=VerifyData($_GET['course_dated_data_get']);
    $mob=VerifyData($_GET['mob']);
    if(!$course_id=="" and !$mob==""){
        $chek_mob=mysqli_query($con,"select * from user where mobile='$mob'");
        if(mysqli_num_rows($chek_mob)==1){
            $result=mysqli_fetch_array($chek_mob);
            $course_sql=mysqli_query($con,"select * from course_book where userid='$result[id]' and course_id='$course_id'");
            if(mysqli_num_rows($course_sql)==1){
                $result_book_course_details=mysqli_fetch_array($course_sql);
                 ?>
            <div class="col-md-4" id="course_fee_label" >
                 <label >Course Start Date: <span style="color:red;">*</span></label>
                 <input type="date" id="start_date"  class="form-control" name="start_date"  value="<?php echo $result_book_course_details['start_date']; ?>" required >
            </div>
             <div class="col-md-4" id="course_fee_label" >
                 <label >Course Complete Date: <span style="color:red;">*</span></label>
                 <input type="date" id="complete_date"  class="form-control" name="complete_date"  value="<?php echo $result_book_course_details['complete_date']; ?>" required>
            </div>
            <div class="col-md-4" id="course_fee_label" >
                 <label >Issue Date: <span style="color:red;">*</span></label>
                 <input type="date" id="issue_date"  class="form-control" name="issue_date"  value="<?php echo $t_date; ?>" required>
            </div>
            <?php 
            }else{
                ?>
            <div class="col-md-4" id="course_fee_label" >
                 <label >Course Start Date: <span style="color:red;">*</span></label>
                 <input type="date" id="start_date"  class="form-control" name="start_date"  value="" required >
            </div>
             <div class="col-md-4" id="course_fee_label" >
                 <label >Course Complete Date: <span style="color:red;">*</span></label>
                 <input type="date" id="complete_date"  class="form-control" name="complete_date"  value="" required>
            </div>
            <div class="col-md-4" id="course_fee_label" >
                 <label >Issue Date: <span style="color:red;">*</span></label>
                 <input type="date" id="issue_date"  class="form-control" name="issue_date"  value="<?php echo $t_date; ?>" required>
            </div>
            <?php  
            }
        }else{
            ?>
            <div class="col-md-4" id="course_fee_label" >
                 <label >Course Start Date: <span style="color:red;">*</span></label>
                 <input type="date" id="start_date"  class="form-control" name="start_date"  value="" required >
            </div>
             <div class="col-md-4" id="course_fee_label" >
                 <label >Course Complete Date: <span style="color:red;">*</span></label>
                 <input type="date" id="complete_date"  class="form-control" name="complete_date"  value="" required>
            </div>
            <div class="col-md-4" id="course_fee_label" >
                 <label >Issue Date: <span style="color:red;">*</span></label>
                 <input type="date" id="issue_date"  class="form-control" name="issue_date"  value="<?php echo $t_date; ?>" required>
            </div>
            <?php 
        }
    }
}

function get_data_user_per($con,$id){
    if(!$id==""){
        $sql=mysqli_query($con,"select * from certificate_marks_details where id='$id'");
        if(mysqli_num_rows($sql)==1){
         $sql_details=mysqli_fetch_array($sql);
         if($sql_details){
           $data_mobile=$sql_details['mobile'];
           $data_course_id=$sql_details['course_id'];
           if(!$data_mobile=="" and !$data_course_id==""){
              $sum_max_mark=mysqli_fetch_array(mysqli_query($con,"select sum(max_mark) from certificate_marks_details where mobile='$data_mobile' and course_id='$data_course_id'"));
            //   $sum_min_mark=mysqli_fetch_array(mysqli_query($con,"select sum(min_mark) from certificate_marks_details where mobile='$data_mobile' and course_id='$data_course_id'"));
              $sum_obt_mark=mysqli_fetch_array(mysqli_query($con,"select sum(obt_mark) from certificate_marks_details where mobile='$data_mobile' and course_id='$data_course_id'"));
            //   $sum_prac_o_mark=mysqli_fetch_array(mysqli_query($con,"select sum(practical_obtain_mark) from certificate_marks_details where mobile='$data_mobile' and course_id='$data_course_id'"));
           $total_max_mark=$sum_max_mark['0'];
           $total_obt_mark=$sum_obt_mark['0'];   
           if(!$total_max_mark=="" and !$total_obt_mark==""){
               $def_per= ($total_obt_mark/$total_max_mark) * 100 ;
               $def_per =round($def_per,2);
               if(!$def_per=="" and $def_per>0){
                   return $def_per;
               }else{
                   return 0;
               }
           }else{
              return  0; 
           }
           }else{
               return  "Server Error 104.";
           }
         }else{
             return  "Server Error 103.";  
         }
        }else{
        
         return  "Server Error 102.";  
        }
    }else{
        return  "Server Error 101.";
    }
}

if(isset($_GET['data_per_get'])){
    $id=VerifyData($_GET['data_per_get']);
   echo get_data_user_per($con,$id); 
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
        
        // $check=mysqli_num_rows(mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile' and student_certificate_id>'0' and course_id='$course_id' "));
        // if(!$check>0){
        //  $check=mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile'  and course_id='$course_id' LIMIT 1");
        //  if(mysqli_num_rows($check)==1){
        //      $check_data=mysqli_fetch_array($check);
        // $user_data_mark_per=get_data_user_per($con,$check_data['id']);
          $check=mysqli_num_rows(mysqli_query($con,"select * from student_certificate where mobile='$mobile' and course_id='$course_id' "));
        if(!$check>0){
             $check=mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile'  and course_id='$course_id' LIMIT 1");
         if(mysqli_num_rows($check)==1){
             $check_data=mysqli_fetch_array($check);
        $user_data_mark_per=get_data_user_per($con,$check_data['id']);
        ?>
        
         <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Certificate Marks Details <?php echo $mobile; ?></h3>
                                    <span style="float:right;">Total Obt % : <b id="data_per_span"><?php echo $user_data_mark_per; ?></b></span>
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
         }else{ ?>
           <div class="card-footer">
               <button type="submit" name="final_submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
      <?php  }
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
      $check=mysqli_query($con,"select * from user where mobile='$mobile' and type='1'");
      if(mysqli_num_rows($check)==1){
          $result=mysqli_fetch_array($check);
          echo 1;
      }else{
          echo '<span style="color:red;">Mobile Number Not Registered with franchise base.</span>';
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
          $walletDetails=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$result[id]'"));
          echo $walletDetails['wallet'];
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
        $sql_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$userid'"));
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
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='$_SESSION[userid]'"));
   
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
if (isset($_GET['change_permission'])) {
    var_dump($_GET);

    $id = VerifyData($_GET['id']);
    $field = VerifyData($_GET['field']);
    $status = VerifyData($_GET['status']); 



    if (!empty($id) && !empty($field) && ($status === 'YES' || $status === 'NO')) {
        $update = mysqli_query($con, "UPDATE branch_details SET $field='$status' WHERE id='$id'");
       

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

if (isset($_GET['cancle_request']) && isset($_GET['cancel'])) {
    $id = VerifyData($_GET['cancel']);

    if ($id != "") {
        $update = mysqli_query($con, "UPDATE branch_application SET status='CANCEL' WHERE id='$id'");

        if ($update) {
            echo "success";
        } else {
            echo "error:Something went wrong while updating.";
        }
    } else {
        echo "error:Invalid ID provided.";
    }
}

if (isset($_GET['own_branch']) && isset($_GET['branch_id'])) {
    $id = VerifyData($_GET['branch_id']);

    if ($id != "") {
        $check = mysqli_num_rows(mysqli_query($con, "select * from user where id='$id' and type='1' and own_branch='NO'"));
        if ($check == 1) {
            $update = mysqli_query($con, "update user set own_branch='YES' where id='$id'");
            if ($update) {
                echo "success";
            } else {
                echo "error:Something went wrong while updating.";
            }
        } else {
            echo "error:No Data Found";
        }
    } else {
        echo "error:Invalid ID provided.";
    }
}

if (isset($_GET['own_branch_no']) && isset($_GET['branch_id'])) {
    $id = VerifyData($_GET['branch_id']);
    $own_branch_no = intval($_GET['own_branch_no']); 

    if ($id != "") {
        $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE id='$id' AND type='1'"));
        if ($check == 1) {
            if ($own_branch_no === 1) {
                $update = mysqli_query($con, "UPDATE user SET own_branch='YES' WHERE id='$id'");
            } else {
                $update = mysqli_query($con, "UPDATE user SET own_branch='NO' WHERE id='$id'");
            }

            if ($update) {
                echo "success";
            } else {
                echo "error:Something went wrong while updating.";
            }
        } else {
            echo "error:No Data Found";
        }
    } else {
        echo "error:Invalid ID provided.";
    }
}


if (isset($_GET['update_status'])) {
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);

   if(!$status=="" && !$id==""){
        
            $update =mysqli_query($con,"update user set status='$status' where id='$id'");
            if ($update) {
                echo "success";
            } else {
                echo "error:Something went wrong while updating.";
            }
        
    } else {
        echo "error:Invalid ID provided.";
    }
}


?>
<?php  mysqli_close($con); ?>