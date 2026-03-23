<style>
    [dir] .sidebar-menu-button {
        padding: 0 1rem;
    }
    [dir=ltr] .sm-indent>.sidebar-menu-item .sidebar-menu-button {
        padding-left: 1.2rem;
    }
    [dir] .sidebar-brand {
        padding: 10px;
    }
    [dir] .sidebar-dark-pickled-bluewood hr {
        border-color: #7a7a7a;
    }
    [dir] hr {
    margin-top: .5rem;
    margin-bottom: .5rem;
    border: 0;
    border-top: 1px solid rgb(255 255 255);
    width: 100%;
}

[dir] .avatar-title  {
    background-color: #ffffff;
}
</style>


 <div class="mdk-drawer js-mdk-drawer"
                 id="default-drawer">
                <div class="mdk-drawer__content">
                    <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left"
                         data-perfect-scrollbar>
                        
                        <a href="./"
                           class="sidebar-brand mx-auto"  style="width:150px">
                            <!-- <img class="sidebar-brand-icon" src="public/images/illustration/student/128/white.svg" alt="Luma"> -->

                            <!--<span class="avatar avatar-xl sidebar-brand-icon h-auto">-->

                                <span class="avatar-title rounded"><img src="<?php echo $brand_logo; ?>"
                                         class="img-fluid"
                                         alt="logo" />
                                </span>

                            <!--</span>-->

                            
                        </a>
                        
                        <hr>


                        <a href="./"
                           class="sidebar-brand ">

                            <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                                <span class="avatar-title rounded "><img src="<?php echo $web_link.$login_details['photo']; ?>"
                                         class="img-fluid"
                                         alt="logo" /></span>

                            </span>

                            <span style="text-align:center;"><?php echo $login_details['name'];?></span>
                        </a>
                        
                        <hr>

                        <ul class="sidebar-menu">
                            
                            
                            <li class="sidebar-menu-item  ">
                                <a class="sidebar-menu-button drop_a1"
                                   data-toggle="collapse"
                                   href="#home">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                                    Home
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="home">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button select1"
                                           href="./" >
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                                            <span class="sidebar-menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button profile"
                                           href="profile">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person</span>
                                            <span class="sidebar-menu-text">Profile</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button password_change"
                                           href="change_password">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">vpn_key</span>
                                            <span class="sidebar-menu-text">Change Password</span>
                                        </a>
                                    </li>
                                    
                                    
                                </ul>
                            </li>
                            
                            <?php
                          if($login_details['bulk_aff']=="NO"){
                          ?>
                            
                             <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button drop_course"
                                   data-toggle="collapse"
                                   href="#course">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                                    Courses
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="course">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button course_book"
                                           href="course_book">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">add_box</span>
                                            <span class="sidebar-menu-text">Book Course</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button running_course_details"
                                           href="course_running ">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_list_bulleted</span>
                                            <span class="sidebar-menu-text">Running Courses</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button complete_course_details"
                                           href="course_complete">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment_turned_in</span>
                                            <span class="sidebar-menu-text">Complete Courses</span>
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
                            
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button test_series"
                                   data-toggle="collapse"
                                   href="#test">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">toc</span>
                                    Test Series
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="test">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button test_series_book"
                                           href="test_series_book">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                                            <span class="sidebar-menu-text">Book Series</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button test_series_runing"
                                           href="test_series_runing">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">directions_run</span>
                                            <span class="sidebar-menu-text">Running</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button test_series_report"
                                           href="test_series_report">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">receipt</span>
                                            <span class="sidebar-menu-text">Report</span>
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
                             <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button drop_lms"
                                   data-toggle="collapse"
                                   href="#lms">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment</span>
                                    LMS
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="lms">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button lms_content"
                                           href="lms_content">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">description</span>
                                            <span class="sidebar-menu-text">Content</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button lms_video"
                                           href="lms_video">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">video_library</span>
                                            <span class="sidebar-menu-text">Video</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button lms_document"
                                           href="lms_document">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">picture_as_pdf</span>
                                            <span class="sidebar-menu-text">Document</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button lms_live_class"
                                           href="lms_live_class">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">video_call</span>
                                            <span class="sidebar-menu-text">Live Class</span>
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
                            
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button drop_online_test"
                                   data-toggle="collapse"
                                   href="#exam">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">library_books</span>
                                    Online Exam
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="exam">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button online_test_detail"
                                           href="online_test_detail">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assessment</span>
                                            <span class="sidebar-menu-text">Upcoming/Ongoing Exam</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button online_test_prev_detail"
                                           href="online_test_prev_detail">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">skip_previous</span>
                                            <span class="sidebar-menu-text">Previous Exam</span>
                                        </a>
                                    </li>
                                    
                                    
                                    
                                </ul>
                            </li>
                            <?php } ?>
                            
                            <?php } ?>
                            
                            
                            <?php
                              if($login_details['bulk_aff']=="YES"){
                              ?>
                            
                            
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button drop_course"
                                   data-toggle="collapse"
                                   href="#affiliates">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">library_books</span>
                                    Affiliates
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="affiliates">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button course_affiliate"
                                           href="course_affiliate">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                                            <span class="sidebar-menu-text">Direct Affiliates</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button course_affiliate_global"
                                           href="course_affiliate_global">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">skip_previous</span>
                                            <span class="sidebar-menu-text">Global Affiliates</span>
                                        </a>
                                    </li>
                                    
                                    
                                    
                                </ul>
                            </li>
                            
                            
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button bank_drop"
                                   data-toggle="collapse"
                                   href="#banking">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_balance</span>
                                    Banking
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="banking">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button bank_fee_paid"
                                           href="bank_fee_paid">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">attach_money</span>
                                            
                                            <?php
                                              if($login_details['bulk_aff']=="YES"){
                                                ?>
                                                <span class="sidebar-menu-text">Pay Candidate Fee</span>
                                                <?php  
                                                  }else{
                                                  ?>
                                            
                                            <span class="sidebar-menu-text">Pay Due Fee</span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <?php } ?>
                            
                            
                            
                            
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button drop_t1"
                                   data-toggle="collapse"
                                   href="#transaction">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_balance_wallet</span>
                                    Transaction
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="transaction">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button transaction_main"
                                           href="transaction_main">
                                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">monetization_on</span>
                                            <span class="sidebar-menu-text">Transaction</span>
                                        </a>
                                    </li>
                                    
                                    
                                    
                                </ul>
                            </li>
                            
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button gallery1"
                                   href="gallery">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">photo</span>
                                    <span class="sidebar-menu-text">Gallery</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button chat"
                                   href="chat">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">chat</span>
                                    <span class="sidebar-menu-text">Chat</span>
                                </a>
                            </li>
                            <?php
                              $check_ai=mysqli_num_rows(mysqli_query($con,"select * from branch_details where userid='$login_details[branch_id]' and EduAI='YES'"));
                              if($check_ai==1){
                              ?>
                            <?php
                              if(add_on_check("EduAI") == 1){
                              ?>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button eduAI"
                                   href="ask_anything">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">memory</span>
                                    <span class="sidebar-menu-text">EduAI</span>
                                </a>
                            </li>
                            <?php } ?>
                            <?php } ?>
                            
                            <?php
                              if($login_details['bulk_aff']=="NO"){
                              ?>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button certificate_all1"
                                   href="certificate_all">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">ballot</span>
                                    <span class="sidebar-menu-text">Certificate</span>
                                </a>
                            </li>
                            
                            <?php } ?>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button announcement1"
                                   href="announcement">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">announcement</span>
                                    <span class="sidebar-menu-text">Announcement</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="logout">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">exit_to_app</span>
                                    <span class="sidebar-menu-text">Logout</span>
                                </a>
                            </li>
                            
                        </ul>


                    </div>
                </div>
            </div>