
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
                <a href="./" class="nav-link select1">
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
              <li class="nav-item">
                <a href="change_password" class="nav-link password_change">
                  <i class="fa fa-key"></i>
                  <p>Change Password</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <?php
          if($login_details['bulk_aff']=="NO"){
          ?>
          
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
                <a href="course_book" class="nav-link course_book">
                  <i class="fa fa-plus"></i>
                  <p>Book Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="course_running" class="nav-link running_course_details">
                  <i class="fa fa-list"></i>
                  <p>Running Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="course_complete" class="nav-link complete_course_details">
                  <i class="fa fa-graduation-cap"></i>
                  <p>Complete Course</p>
                </a>
              </li>
            
            </ul>
          </li>
          
          
          <?php } ?>
          
         <?php
          $check_tsc=mysqli_num_rows(mysqli_query($con,"select * from branch_details where userid='$login_details[branch_id]' and test_series_system='YES'"));
          if($check_tsc==1){
          ?>
          <?php
          if(add_on_check("Test Series System") == 1){
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link test_series">
              <i class="fa fa-align-justify"></i>
              <p>
                Test Series
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="test_series_book" class="nav-link test_series_book">
                  <i class="fa fa-book"></i>
                  <p>Book Series</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_series_runing" class="nav-link test_series_runing">
                  <i class="fas fa-running"></i>
                  <p>Runing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="test_series_report" class="nav-link test_series_report">
                  <i class="fa fa-list"></i>
                  <p>Report</p>
                </a>
              </li>
             
              
            </ul>
          </li> 
          <?php } ?>
          <?php
          }
          ?> 
         <?php
          $check_lms=mysqli_num_rows(mysqli_query($con,"select * from branch_details where userid='$login_details[branch_id]' and lms_system='YES'"));
          if($check_lms==1){
          ?>  
          
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
                <a href="lms_content"  class="nav-link lms_content">
                  <i class="fa fa-check-circle"></i>
                  <p> Content</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="lms_video"  class="nav-link lms_video">
                  <i class="fa fa-check-circle"></i>
                  <p> Video</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="lms_document"  class="nav-link lms_document">
                  <i class="fa fa-check-circle"></i>
                  <p> Document</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="lms_live_class"  class="nav-link lms_live_class">
                  <i class="fa fa-check-circle"></i>
                  <p> Live Class</p>
                </a>
              </li>
              </ul>
          </li>  
          <?php } ?>
       <?php
          }
          ?> 
          
         <?php
          $check_tsc=mysqli_num_rows(mysqli_query($con,"select * from branch_details where userid='$login_details[branch_id]' and online_exam_system='YES'"));
          if($check_tsc==1){
          ?>
          <?php
          if(add_on_check("Online Test & Admit Card") == 1){
          ?>
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link drop_online_test">
              <i class="fa fa-book"></i>
              <p>
               Online Exam
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="online_test_detail" class="nav-link online_test_detail">
                  <i class="fa fa-list"></i>
                  <p>Upcoming/Ongoing Exam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="online_test_prev_detail" class="nav-link online_test_prev_detail">
                  <i class="fa fa-list"></i>
                  <p>Previous Exam</p>
                </a>
              </li>
             
              
            </ul>
          </li>
          <?php } ?>
          <?php } ?>
         
          <?php
          if($login_details['bulk_aff']=="YES"){
          ?>
          
           <li class="nav-item">
            <a href="#" class="nav-link drop_course">
              <i class="fa fa-book"></i>
              <p>
                Affiliates
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              
              
              
              <li class="nav-item">
                <a href="course_affiliate" class="nav-link affiliate_course_details">
                  <i class="fa fa-handshake-o"></i>
                  <p>Direct Affiliates</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="course_affiliate_global" class="nav-link affiliate_course_details_global">
                  <i class="fa fa-handshake-o"></i>
                  <p>Global Affiliates</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
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
                <a href="bank_fee_paid"  class="nav-link fee_payment">
                  <i class="fa fa-rupee"></i>
                  <?php
                  if($login_details['bulk_aff']=="YES"){
                    ?>
                    <p> Pay Candidate Fee</p>
                    <?php  
                  }else{
                  ?>
                  <p> Pay Due Fee</p>
                  <?php } ?>
                </a>
              </li>
            
              
              
            </ul>
          </li>
          <?php } ?>
          
          <?php 
         
          if($login_details['task_pr']=="YES"){ 
          ?>
           <li class="nav-item">
            <a href="#" class="nav-link drop_p_work">
              <i class="fa fa-tasks"></i>
              <p>
                 Promoter Work
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="b_task"  class="nav-link business_task">
                  <i class="ffa fa-id-badge"></i>
                  <p> Business Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="r_task" class="nav-link promotion_task">
                  <i class="fa fa-globe"></i>
                  <p>Promotiona Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="task_details_b" class="nav-link business_task_details">
                  <i class="fa fa-list"></i>
                  <p>Business Task Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="task_details_p" class="nav-link promotion_task_details">
                  <i class="fa fa-list"></i>
                  <p>Promotiona Task Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="daily_work_count" class="nav-link task_count_daily">
                  <i class="fa fa-bars"></i>
                  <p>Task Collection</p>
                </a>
              </li>
              
            </ul>
          </li>
         <?php } ?>
         <li class="nav-item">
            <a href="#" class="nav-link drop_t1">
              <i class="fa fa-exchange"></i>
              <p>
                Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(90 86 80 / 84%);">
              <li class="nav-item">
                <a href="transaction_main" class="nav-link transaction_main">
                  <i class="fa fa-rupee"></i>
                  <p>Transaction</p>
                </a>
              </li>
             
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="gallery" class="nav-link gallery1">
              <i class="fa fa-picture-o"></i>
              <p>
                Gallery
                
              </p>
            </a>
           </li>
           
          <?php
          if($login_details['bulk_aff']=="NO"){
          ?>
          <li class="nav-item">
            <a href="certificate_all" class="nav-link certificate_all1">
              <i class="fa fa-id-card-o"></i>
              <p>
                Certificate
                
              </p>
            </a>
           </li>
           <?php } ?>
          <li class="nav-item">
            <a href="announcement" class="nav-link announcement1">
              <i class="fa fa-bullhorn"></i>
              <p>
                Announcement
                
              </p>
            </a>
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
 