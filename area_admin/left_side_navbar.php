
<style>
      .img-circle {
        border-radius: 5px !important;
    }
</style>
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
      <img src="<?php echo $brand_logo; ?>" alt="Logo" class="brand-image img-circle elevation-3" style="background-color:white;">
      <span class="brand-text font-weight-light"><?php echo $brand_short_name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $web_link.$login_details['photo']; ?>" class="img-circle elevation-2" style="height: 2.1rem;background-color:white;" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block"><?php echo $login_details['name'];?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <?php
          $type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$login_details[id]'"))['type'];
         
          ?>
          
          <li class="nav-item ">
            <a href="#" class="nav-link drop_a1" >
              <i class="fa fa-home" style="font-size:18px;"></i>
              <p class="">
                Home
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview " style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item ">
                <a href="index" class="nav-link select1">
                  <i class="fa fa-dashboard "></i>
                  <p> Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="profile" class="nav-link profile">
                  <i class="fa fa-user"></i>
                  <p>Profile</p>
                </a>
              </li>
              <?php 
                if($type == 1){
              ?>
               <li class="nav-item">
                <a target="_blank" href="franchise_certificate?data_id=<?php echo $login_details['id']; ?>" class="nav-link franchise_certificate">
                  <i class="fa fa-id-card"></i>
                  <p>Franchise Certificate</p>
                </a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a href="change_password" class="nav-link password_change">
                  <i class="fa fa-key"></i>
                  <p>Change Password</p>
                </a>
              </li>
              
            </ul>
          </li>
          
        
         
        
        <?php if($branch_access_details['enquiry_system']=="YES"){ ?>
         <?php 
        if(main_menu_check("A", $_SESSION['userid'], $type)==1){
         ?>
        <li class="nav-item">
            <a href="#" class="nav-link drop_enquiry">
              <i class="fa fa-question-circle"></i>
              <p>
                Enquiry Details
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
               <?php
               if(sub_menu_check("A","A",$_SESSION['userid'], $type)==1){
               ?> 
                <li class="nav-item">
                <a href="enquiry_create" class="nav-link enquiry_create">
                  <i class="fa fa-plus"></i>
                  <p>Create Enquiry </p>
                </a>
              </li>
             <?php } ?>
             <?php
               if(sub_menu_check("A","B",$_SESSION['userid'], $type)==1){
               ?> 
              <li class="nav-item">
                <a href="enquiry_running" class="nav-link enquiry_running">
                  <i class="fas fa-running"></i>
                  <p>Enquiry Running</p>
                </a>
              </li>
             <?php } ?>
             <?php
               if(sub_menu_check("A","C",$_SESSION['userid'], $type)==1){
               ?> 
              <li class="nav-item">
                <a href="enquiry_complete" class="nav-link enquiry_complete">
                  <i class="fa fa-plus-square"></i>
                  <p>Enquiry Complete</p>
                </a>
              </li>
             <?php } ?>
             <?php
               if(sub_menu_check("A","D",$_SESSION['userid'], $type)==1){
               ?> 
              <li class="nav-item">
                <a href="enquiry_close" class="nav-link enquiry_close">
                  <i class="fa fa-times"></i>
                  <p>Enquiry Close</p>
                </a>
              </li>
              <?php } ?>
             <?php
               if(sub_menu_check("A","E",$_SESSION['userid'], $type)==1){
               ?> 
              <li class="nav-item">
                <a href="enquiry_report" class="nav-link enquiry_report">
                  <i class="fa fa-folder"></i>
                  <p>Enquiry Report</p>
                </a>
              </li>
             <?php } ?>
             
            </ul>
          </li>
          <?php } } ?>
          
          
          
          <?php 
        if(main_menu_check("B",$_SESSION['userid'], $type)==1){
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link drop_enroll">
              <i class="fa fa-book"></i>
              <p>
                Enrollment Details
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <?php
               if(sub_menu_check("B","A",$_SESSION['userid'], $type)==1){
               ?>
                <li class="nav-item">
                <a href="enroll_create" class="nav-link enroll_create">
                  <i class="fa fa-plus"></i>
                  <p>Create Enroll </p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("B","B",$_SESSION['userid'], $type)==1){
               ?>
              <li class="nav-item">
                <a href="enroll_new" class="nav-link enroll_new">
                  <i class="fa fa-plus-square"></i>
                  <p>New Enroll Request</p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("B","C",$_SESSION['userid'], $type)==1){
               ?>
              <li class="nav-item">
                <a href="enroll_runing" class="nav-link enroll_runing">
                  <i class="fa fa-paper-plane"></i>
                  <p>Running Enroll </p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("B","D",$_SESSION['userid'], $type)==1){
               ?>
              <li class="nav-item">
                <a href="enroll_complete" class="nav-link enroll_complete">
                  <i class="fa fa-check-square"></i>
                  <p>Complete Enroll </p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("B","E",$_SESSION['userid'], $type)==1){
               ?>
              <li class="nav-item">
                <a href="enroll_cancel" class="nav-link enroll_cancel">
                  <i class="fa fa-close"></i>
                  <p>Cancel Enroll </p>
                </a>
              </li>
           <?php } ?>
              
              
            </ul>
          </li>
          <?php } ?>
          
          
          <?php $show_menu=""; if($show_menu==1){?>
          <?php 
        if(main_menu_check("Z",$_SESSION['userid'], $type)==1){
          ?>
          <li class="nav-item ">
            <a href="#" class="nav-link utr_drop" >
              <i class="fa fa-money" style="font-size:18px;"></i>
              <p class=""> Online Pay Fee Details<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview " style="background-color: rgb(90 86 80 / 84%);">
                 <?php
               if(sub_menu_check("Z","A",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item ">
                <a href="utr_new" class="nav-link new_utr_verify">
                  <i class="fa fa-check-circle "></i>
                  <p>New Request</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("Z","B",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="utr_done" class="nav-link ">
                  <i class="fa fa-check-circle"></i>
                  <p>Done</p>
                </a>
              </li>
               <?php } ?>
               <?php
               if(sub_menu_check("Z","C",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="utr_cancel" class="nav-link ">
                  <i class="fa fa-check-circle"></i>
                  <p>Cancel</p>
                </a>
              </li>
               <?php } ?>
              
            </ul>
          </li>
          <?php } } ?>
          
          
          
          <?php 
        if(main_menu_check("C",$_SESSION['userid'], $type)==1){
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link bank_drop">
              <i class="fa fa-bank"></i>
              <p>
                Banking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <?php
               if(sub_menu_check("C","A",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="bank_credit"  class="nav-link bank_credit">
                  <i class="fa fa-check-circle"></i>
                  <p> Credit</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("C","B",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="bank_debit" class="nav-link bank_debit">
                  <i class="fa fa-check-circle"></i>
                  <p> Debit</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("C","C",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="bank_transaction" class="nav-link bank_transaction">
                  <i class="fa fa-check-circle"></i>
                  <p> Transaction</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("C","D",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="bank_exp" class="nav-link bank_exp">
                  <i class="fa fa-check-circle"></i>
                  <p>Expenses Entry</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("C","D",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="fee_refund" class="nav-link fee_refund">
                  <i class="fas fa-undo-alt"></i>
                  <p>Fee Refund</p>
                </a>
              </li>
              <?php } ?>
              
            </ul>
          </li>
          <?php } ?>
          
          
           <?php
           if(add_on_check("Student Attendance System") == 1){
           ?>
         <?php  
         if($branch_access_details['student_attendance_system']=="YES"){ ?>  
         <?php 
        if(main_menu_check("H",$_SESSION['userid'], $type)==1){
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link drop_attendance">
              <i class="fa fa-users"></i>
              <p>
                Student attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <?php
               if(sub_menu_check("H","A",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="student_daily_attendance" class="nav-link student_daily_attendance">
                  <i class="fa fa-plus-square"></i>
                  <p>Daily Attendance</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("H","B",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="student_date_wise_attendance_report" class="nav-link student_date_wise_attendance_report">
                  <i class="fa fa-paper-plane"></i>
                  <p>Date Wise Report</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("H","C",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="student_wise_attendance_report" class="nav-link student_wise_attendance_report">
                  <i class="fa fa-check-square"></i>
                  <p>Student Wise Report</p>
                </a>
              </li>
              <?php } ?>
              
            </ul>
          </li>
          
         <?php } } ?> 
          <?php } ?>
          
           <?php 
        if(main_menu_check("D",$_SESSION['userid'], $type)==1){
          ?>
           <li class="nav-item">
            <a href="#" class="nav-link drop_student">
              <i class="fa fa-user"></i>
              <p>
                 Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                
               <?php
               if(sub_menu_check("D","A",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="student_search"  class="nav-link student_search">
                  <i class="fa fa-search"></i>
                  <p> Details By Reg Number</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("D","B",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="student_all_details" class="nav-link student_all_details">
                  <i class="fa fa-users"></i>
                  <p> All Student Details</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("D","C",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="student_due_fee" class="nav-link student_due_fee">
                  <i class="fa fa-rupee"></i>
                  <p>Due Fee List</p>
                </a>
              </li>
              <?php } ?>
               <?php
               if(sub_menu_check("D","D",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="fee_paid_details" class="nav-link fee_paid_details1">
                  <i class="fa fa-rupee"></i>
                  <p>Fee Paid Details</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          
          
          <?php
          if(add_on_check("Staff Management System") == 1){
          ?>
          <?php
          if($branch_access_details['staff_system']=="YES"){ ?>
          <?php 
        if(main_menu_check("E",$_SESSION['userid'], $type)==1){
          ?>
           <li class="nav-item">
            <a href="#" class="nav-link staff_drop">
              <i class="fa fa-user"></i>
              <p>
                Staff
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                
               <?php
               if(sub_menu_check("E","A",$_SESSION['userid'],$type) == 1){
               ?> 
               <li class="nav-item">
                <a href="staff_add"  class="nav-link staff_add1">
                  <i class="fa fa-plus"></i>
                  <p> Add Staff</p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("E","B",$_SESSION['userid'],$type) == 1){
               ?> 
             <li class="nav-item">
                <a href="staff_details"  class="nav-link staff_details1">
                  <i class="fa fa-list"></i>
                  <p> Staff Details</p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("E","C",$_SESSION['userid'],$type) == 1){
               ?> 
             <li class="nav-item">
                <a href="staff_permission"  class="nav-link staff_permission">
                  <i class="fa fa-check-circle"></i>
                  <p> Staff Permission</p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("E","D",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="staff_daily_attendance"  class="nav-link staff_daily_attendance">
                  <i class="fa fa-check-circle"></i>
                  <p> Daily Attendance</p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("E","E",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="staff_report_date"  class="nav-link staff_report_date">
                  <i class="fa fa-check-circle"></i>
                  <p> Date Wise Attendance Report</p>
                </a>
              </li>
              <?php } ?>
              <?php
               if(sub_menu_check("E","F",$_SESSION['userid'],$type) == 1){
               ?> 
              <li class="nav-item">
                <a href="staff_report_staff"  class="nav-link staff_report_staff">
                  <i class="fa fa-check-circle"></i>
                  <p> Staff Wise Attendance Report</p>
                </a>
              </li>
              <?php } ?>
             
            </ul>
          </li>
          <?php } } ?>
          <?php } ?>
          
          <li class="nav-item">
            <a href="chat" class="nav-link chat">
              <i class="fas fa-comments" style="font-size:18px;"></i>
              <p>Chat</p>
            </a>
          </li>
          
          
          <?php if($branch_access_details['coupen_code']=="YES"){ ?>
          <?php if(add_on_check("Staff Management System") == 1){ ?>
           <?php  if(main_menu_check("J",$_SESSION['userid'],$type)==1){?>
           
          <li class="nav-item">
            <a href="coupen_code" class="nav-link coupen_code"><i class="fa fa-ticket" aria-hidden="true"></i>
              <p>Coupen Code</p></a>
          </li>
         
          <?php } ?>
          <?php } ?>
          <?php } ?>
          
          
            <?php 
        if(main_menu_check("I",$_SESSION['userid'],$type)==1){
          ?>
           
              <li class="nav-item">
            <a href="#" class="nav-link card_drop">
              <i class="fa fa-id-card"></i>
              <p>
                Id Card
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <?php
                if(sub_menu_check("I","A",$_SESSION['userid'],$type)==1){
                 ?>
              <li class="nav-item">
            <a href="student_id_card" class="nav-link student_id_card">
              <i class="fas fa-id-card"></i>
              <p> Student ID Card </p></a>
          </li>
          <?php } ?>
     
            </ul>
          </li>
          <?php } ?>  
          
          <?php 
          $tstrdst=2;
          if($tstrdst==1){
          ?>  
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link drop_course">-->
          <!--    <i class="fa fa-book"></i>-->
          <!--    <p>-->
          <!--      Courses-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="add_course" class="nav-link course_add">-->
          <!--        <i class="fa fa-plus"></i>-->
          <!--        <p>Add course</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="add_course_batch" class="nav-link course_batch">-->
          <!--        <i class="fa fa-plus"></i>-->
          <!--        <p>Add Batch</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="add_subjects" class="nav-link course_subjects">-->
          <!--        <i class="fa fa-plus"></i>-->
          <!--        <p>Add Subjects</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="bind_course_subjects" class="nav-link course_wise_subjects">-->
          <!--        <i class="fa fa-list"></i>-->
          <!--        <p>Course wise Subjects</p>-->
          <!--      </a>-->
          <!--    </li>-->
           
              
          <!--  </ul>-->
          <!--</li>-->
         <?php } ?> 
         
         
         <?php 
        if(main_menu_check("G",$_SESSION['userid'], $type)==1){
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link certificate_drop">
              <i class="fa fa-id-card-o"></i>
              <p>
                Certificate
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <?php
               if(sub_menu_check("G","A",$_SESSION['userid'],$type) == 1){
               ?> 
            <li class="nav-item">
                <a href="certificate_new_request"  class="nav-link certificate_new_request">
                  <i class="fa fa-plus"></i>
                  <p> New Request</p>
                </a>
              </li>
              <?php  } ?>
                <?php
               if(sub_menu_check("G","B",$_SESSION['userid'],$type) == 1){
               ?> 
              
              <li class="nav-item">
                <a href="certificate_all_request"  class="nav-link certificate_all_request">
                  <i class="fa fa-list"></i>
                  <p> Request Details</p>
                </a>
              </li>
                <?php  } ?>
                <?php
               if(sub_menu_check("G","C",$_SESSION['userid'],$type) == 1){
               ?> 
             
              <li class="nav-item">
                <a href="certificate_all"  class="nav-link certificate_all1">
                  <i class="fa fa-check-circle"></i>
                  <p> All Approved Certificate</p>
                </a>
              </li>
              <?php  } ?>
               
              
              
            </ul>
          </li>
          <?php  } ?>
          <?php 
          $tstrdst=2;
          if($tstrdst==1){
          ?>  
          
         
        
        
       
          <li class="nav-item menu-open">
            <a href="index" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:#503a19;">
              <li class="nav-item">
                <a href="pages/tables/simple" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          
          
        
         
         
       
     
       
       
      
      
        
         
         
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="fa fa-sign-out" style="font-size:18px;"></i>
              <p>Logout</p>
            </a>
          </li>
          
        
      
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>