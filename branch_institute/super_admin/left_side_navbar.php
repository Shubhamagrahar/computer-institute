<?php include 'data.php';
 
 

?>
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
          <img src="<?php echo "$brand_logo"; ?>" class="img-circle elevation-2" style="height: 2.1rem;background-color:white;" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block"><?php echo $login_details['short_name']." Super Admin";?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          
          <li class="nav-item ">
            <a href="#" class="nav-link drop_a1" >
              <i class="fa fa-dashboard" style="font-size:18px;"></i>
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
                <a href="change_password" class="nav-link password_change">
                  <i class="fa fa-key"></i>
                  <p>Change Password</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
         
          
          <li class="nav-item ">
            <a href="#" class="nav-link session_drop" >
              <i class="fa fa-calendar-alt" style="font-size:18px;"></i>
              <p class="">
                Session
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview " style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item ">
                <a href="session_manage" class="nav-link session_manage">
                  <i class="fa fa-calendar-check"></i>
                  <p> Session Management</p>
                </a>
              </li>
              
             
              
            </ul>
          </li>
          
          
          <li class="nav-item ">
            <a href="#" class="nav-link branch_drop">
              <i class="fa fa-home" style="font-size:18px;"></i>
              <p class="">
                Franchise
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview " style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="branch_apply_req_list" class="nav-link branch_apply_req_list1">
                  <i class="fa fa-plus"></i>
                  <p>Online Request</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="branch_new" class="nav-link branch_new1">
                  <i class="fa fa-plus "></i>
                  <p> Direct Add</p>
                </a>
              </li>
               
              <li class="nav-item">
                <a href="branch_cancel_req_list" class="nav-link branch_cancel_req_list">
                  <i class="fa fa-close"></i>
                  <p>Cancel Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch_list" class="nav-link branch_list1">
                  <i class="fa fa-list"></i>
                  <p>Franchise List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch_list_own" class="nav-link branch_list_own">
                  <i class="fa fa-list"></i>
                  <p>Own Franchise List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="franchise_permission" class="nav-link franchise_permission">
                  <i class="fa fa-lock"></i>
                  <p>Franchise Permission</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          
          <li class="nav-item">
            <a href="#" class="nav-link drop_enroll">
              <i class="fa fa-book"></i>
              <p>
                Enrollment Details
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                
              <li class="nav-item">
                <a href="enroll_new" class="nav-link enroll_new">
                  <i class="fa fa-plus-square"></i>
                  <p>New Enroll Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="enroll_runing" class="nav-link enroll_runing">
                  <i class="fa fa-paper-plane"></i>
                  <p>Running Enroll </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="enroll_complete" class="nav-link enroll_complete">
                  <i class="fa fa-check-square"></i>
                  <p>Complete Enroll </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="enroll_cancel" class="nav-link enroll_cancel">
                  <i class="fa fa-close"></i>
                  <p>Cancel Enroll </p>
                </a>
              </li>
           
              
            </ul>
          </li>
          <?php $show_menu=""; if($show_menu==1){?>
          <li class="nav-item ">
            <a href="#" class="nav-link utr_drop" >
              <i class="fa fa-money" style="font-size:18px;"></i>
              <p class=""> Online Pay Fee Details<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview " style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item ">
                <a href="utr_new" class="nav-link new_utr_verify">
                  <i class="fa fa-check-circle "></i>
                  <p>New Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="utr_done" class="nav-link ">
                  <i class="fa fa-check-circle"></i>
                  <p>Done</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="utr_cancel" class="nav-link ">
                  <i class="fa fa-check-circle"></i>
                  <p>Cancel</p>
                </a>
              </li>
              
            </ul>
          </li>
          
           <?php } ?>
          
          
          
          <li class="nav-item">
            <a href="#" class="nav-link bank_drop">
              <i class="fa fa-bank"></i>
              <p>
                Banking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="bank_credit"  class="nav-link bank_credit">
                  <i class="fa fa-check-circle"></i>
                  <p> Credit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="bank_debit" class="nav-link bank_debit">
                  <i class="fa fa-check-circle"></i>
                  <p> Debit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="bank_transaction" class="nav-link bank_transaction">
                  <i class="fa fa-check-circle"></i>
                  <p> Transaction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="bank_exp" class="nav-link bank_exp">
                  <i class="fa fa-check-circle"></i>
                  <p>Expenses Entry</p>
                </a>
              </li>
              
            </ul>
          </li>
            
            
 <?php
            if(add_on_check("Online Test & Admit Card") == 1){
        ?>
            <li class="nav-item">
            <a href="#" class="nav-link drop_online_test">
              <i class="fa fa-book"></i>
              <p>
                Online Test & Admit Card
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="online_test_add_question" class="nav-link online_test_add_question">
                  <i class="fa fa-plus"></i>
                  <p>Create Test Question</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="online_test_questions_detail" class="nav-link online_test_questions_detail">
                  <i class="fa fa-list"></i>
                  <p>Test Question Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="online_test_add_exam" class="nav-link online_test_add_exam">
                  <i class="fa fa-plus"></i>
                  <p>Create Exam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="online_test_student_admit_card" class="nav-link online_test_student_admit_card">
                  <i class="fa fa-list"></i>
                  <p>Student Admit Card</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="student_result" class="nav-link student_result">
                  <i class="fa fa-list"></i>
                  <p>Student Result</p>
                </a>
              </li>
           
              
            </ul>
          </li>
          <?php } ?>
          
          
            <?php
            if(add_on_check("Test Series System") == 1){
        ?>
           <li class="nav-item">
            <a href="#" class="nav-link test_drop">
              <i class="fa fa-file-text"></i>
              <p>
                Test Series
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="test_package_manage"  class="nav-link test_package_manage">
                  <i class="fa fa-plus"></i>
                  <p> Manage Package</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_series_type"  class="nav-link test_series_type">
                  <i class="fa fa-plus"></i>
                  <p> Test Series Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_question_create" class="nav-link test_question_create">
                  <i class="fa fa-plus"></i>
                  <p> Create Test Question</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="test_question_details" class="nav-link test_question_details">
                  <i class="fa fa-list"></i>
                  <p> Test Question Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_series_new_apply" class="nav-link test_series_new_apply">
                  <i class="fa fa-check-circle"></i>
                  <p> New Pkg Apply</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="test_series_runing_pkg" class="nav-link test_series_runing_pkg">
                  <i class="fa fa-check-circle"></i>
                  <p> Runing PKG</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_series_pkg_bind" class="nav-link test_series_pkg_bind">
                  <i class="fa fa-check-circle"></i>
                  <p> Package Wise Bind</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_series_report" class="nav-link test_series_report">
                  <i class="fas fa-file"></i>
                  <p>Student Report</p>
                </a>
              </li>
            </ul>
          </li>
           
<?php } ?>
          
           <?php
            if(add_on_check("Learning Management System") == 1){
        ?>
          <li class="nav-item">
            <a href="#" class="nav-link drop_lms">
              <i class="fa fa-book"></i>
              <p>
                LMS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <li class="nav-item">
                <a href="lms_content" class="nav-link lms_content">
                  <i class="fa fa-plus"></i>
                  <p>Content</p>
                </a>
              </li>
          
                <li class="nav-item">
                <a href="lms_video" class="nav-link lms_video">
                  <i class="fa fa-plus"></i>
                  <p>Video</p>
                </a>
              </li>
         
                <li class="nav-item">
                <a href="lms_document" class="nav-link lms_document">
                  <i class="fa fa-plus"></i>
                  <p>Document</p>
                </a>
              </li>
         
                <li class="nav-item">
                <a href="lms_live_class" class="nav-link lms_live_class">
                  <i class="fa fa-plus"></i>
                  <p>Live Class</p>
                </a>
              </li>
         
                <li class="nav-item">
                <a href="lms_project_create" class="nav-link lms_project_create">
                  <i class="fa fa-plus"></i>
                  <p>Create Project</p>
                </a>
              </li>
         
                <li class="nav-item">
                <a href="lms_project_details" class="nav-link lms_project_details">
                  <i class="fa fa-list"></i>
                  <p>Project Details</p>
                </a>
              </li>
          </ul>
          </li> 
       <?php } ?>
          
           <li class="nav-item">
            <a href="#" class="nav-link drop_student">
              <i class="fa fa-user"></i>
              <p>
                 Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="student_search"  class="nav-link student_search">
                  <i class="fa fa-search"></i>
                  <p> Details By Reg Number</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="student_all_details" class="nav-link student_all_details">
                  <i class="fa fa-users"></i>
                  <p> All Student Details</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="student_all_fee_deu" class="nav-link student_all_fee_deu">
                  <i class="fa fa-rupee"></i>
                  <p>Student Fee Due</p>
                </a>
              </li>
              
              
              <!--<li class="nav-item">-->
              <!--  <a href="student_due_fee" class="nav-link student_due_fee">-->
              <!--    <i class="fa fa-rupee"></i>-->
              <!--    <p>Deu Fee List</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="fee_paid_details" class="nav-link fee_paid_details1">-->
              <!--    <i class="fa fa-rupee"></i>-->
              <!--    <p>Fee Paid Details</p>-->
              <!--  </a>-->
              <!--</li>-->
              
              <!-- <li class="nav-item">-->
              <!--  <a target="_blank" href="application_form" class="nav-link student_due_feef">-->
              <!--    <i class="fa fa-wpforms"></i>-->
              <!--    <p>Application Form</p>-->
              <!--  </a>-->
              <!--</li>-->
              
              
             
            </ul>
          </li>
          <?php
          if(add_on_check("Coupen Code") == 1){
          ?>
          <li class="nav-item">
            <a href="coupen_code" class="nav-link coupen_code">
              <i class="fa fa-ticket" aria-hidden="true"></i>
              <p>
               Coupen Code
                
              </p>
            </a>
            
          </li>
          <?php } ?>
          
          <li class="nav-item">
            <a href="#" class="nav-link drop_course">
              <i class="fa fa-book"></i>
              <p>
                Courses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <li class="nav-item">
                <a href="add_course_type" class="nav-link add_course_type">
                  <i class="fa fa-plus"></i>
                  <p>Add course Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_course" class="nav-link course_add">
                  <i class="fa fa-plus"></i>
                  <p>Add course</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="add_course_batch" class="nav-link course_batch">-->
              <!--    <i class="fa fa-plus"></i>-->
              <!--    <p>Add Batch</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
                <a href="add_subjects" class="nav-link course_subjects">
                  <i class="fa fa-plus"></i>
                  <p>Add Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="bind_course_subjects" class="nav-link course_wise_subjects">
                  <i class="fa fa-list"></i>
                  <p>Course wise Subjects</p>
                </a>
              </li>
           
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="chat" class="nav-link chat">
              <i class="fas fa-comments" style="font-size:18px;"></i>
              <p>Chat</p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="#" class="nav-link drop_query">
              <i class="fa fa-question"></i>
              <p>
                Query
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="query" class="nav-link query">
                  <i class="fa fa-plus"></i>
                  <p>Your Query</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="query_complete" class="nav-link query_complete">
                  <i class="fa fa-check"></i>
                  <p>Complete Query</p>
                </a>
              </li>
              
           
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link certificate_drop">
              <i class="fa fa-id-card-o"></i>
              <p>
                Certificate & Marksheet
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
                <li class="nav-item">
                <a href="certificate_request"  class="nav-link certificate_request">
                  <i class="fa fa-check-circle"></i>
                  <p>Request Certificate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="certificate_create"  class="nav-link certificate_create1">
                  <i class="fa fa-check-circle"></i>
                  <p> Create Certificate</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="certificate_gbc"  class="nav-link certificate_create1">-->
              <!--    <i class="fa fa-check-circle"></i>-->
              <!--    <p> Create Certificate</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="#" onclick="alert('Please add-on this option.')" class="nav-link details_staff">-->
              <!--    <i class="fa fa-check-circle"></i>-->
              <!--    <p> Serch Certificate</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
                <a href="certificate_pending"  class="nav-link certificate_pending">
                  <i class="fa fa-check-circle"></i>
                  <p>Pending Certificate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="certificate_all"  class="nav-link certificate_all1">
                  <i class="fa fa-check-circle"></i>
                  <p> Verified Certificate</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="certificate_all_gbc"  class="nav-link certificate_all_gbc1">-->
              <!--    <i class="fa fa-check-circle"></i>-->
              <!--    <p> All Certificate</p>-->
              <!--  </a>-->
              <!--</li>-->
              
              
            </ul>
          </li>
          
          <li class="nav-item ">
            <a href="#" class="nav-link website_drop" >
              <i class="fa fa-globe" style="font-size:18px;"></i>
              <p class=""> Website Manage<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview " style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item ">
                <a href="web_contact" class="nav-link web_contact">
                  <i class="fa fa-check-circle "></i>
                  <p>Contact Details</p>
                </a>
              </li>
              
              <li class="nav-item ">
                <a href="web_theme" class="nav-link web_theme">
                  <i class="fa fa-check-circle "></i>
                  <p>Theme</p>
                </a>
              </li>
              
              <li class="nav-item ">
                <a href="web_slider_area" class="nav-link web_short_about">
                  <i class="fa fa-check-circle "></i>
                  <p>Top Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="web_intro_area" class="nav-link web_intro_area">
                  <i class="fa fa-check-circle"></i>
                  <p>About / Intro Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="web_news" class="nav-link web_news">
                  <i class="fa fa-check-circle"></i>
                  <p>Announcement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="web_index_popup" class="nav-link web_index_popup1">
                  <i class="fa fa-check-circle"></i>
                  <p>Home Popup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="web_director_message" class="nav-link web_director_message1">
                  <i class="fa fa-check-circle"></i>
                  <p>Director Message</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="web_vision_mission" class="nav-link web_vision_mission1">
                  <i class="fa fa-check-circle"></i>
                  <p>Vision & Mission</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="staff" class="nav-link staff">
                  <i class="fa fa-check-circle"></i>
                  <p>Teacher & Staff</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="web_reg_aff" class="nav-link web_reg_aff">-->
              <!--    <i class="fa fa-check-circle"></i>-->
              <!--    <p>Registration & Affiliation</p>-->
              <!--  </a>-->
              <!--</li>-->
             
              <li class="nav-item">
                <a href="testimonials"  class="nav-link testimonials">
                  <i class="fa fa-check-circle"></i>
                  <p>Student Testimonials</p>
                </a>
              </li>
                 <li class="nav-item">
                <a href="gallery" class="nav-link gallery1">
                  <i class="fa fa-check-circle"></i>
                  <p>Photo Gallary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="video" class="nav-link video1">
                  <i class="fa fa-check-circle"></i>
                  <p>Video Gallery</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="query_new"  class="nav-link query_new1">
                  <i class="fa fa-check-circle"></i>
                  <p>New Query</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="query_close"  class="nav-link query_close1">
                  <i class="fa fa-check-circle"></i>
                  <p>Close Query</p>
                </a>
              </li>
              
            </ul>
          </li>
         
        
        
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