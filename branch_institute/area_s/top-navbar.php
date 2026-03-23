<style>
    [dir=ltr] .dropdown-menu:after, [dir=ltr] .dropdown-menu:before {
        left: 125px;
    }
    [dir] .dropdown-menu.show, [dir] .show>.dropdown-menu {
        margin-left: -7px;
    }
    .nav-link dropdown-toggle {
        right: 20px;
    }
    [dir=ltr] .navbar-expand .navbar-nav .nav-link, [dir=rtl] .navbar-expand .navbar-nav .nav-link {
        gap: 10px;
    }
   .input-group {
       width: 75% !important;
   }
    @media(max-width: 768px) {
        .nav-item span {
            display: none;
        }
         .input-group {
        width: 52% !important;
    }
    }
   
    .input-group h4{
        padding-top: 9px;
    }


</style>


<div class="navbar navbar-expand navbar-light border-bottom-2"
                     id="default-navbar"
                     data-primary>

                    <!-- Navbar toggler -->
                    <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0"
                            type="button"
                            data-toggle="sidebar">
                        <span class="material-icons">short_text</span>
                    </button>

                    <!-- Navbar Brand -->
                    <a href="./"
                       class="navbar-brand mr-16pt d-lg-none">

                        <!--<span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">-->

                        <!--    <span class="avatar-title rounded bg-primary"><img src="https://luma.humatheme.com/public/images/illustration/student/128/white.svg"-->
                        <!--             alt="logo"-->
                        <!--             class="img-fluid" /></span>-->

                        <!--</span>-->

                        <span class="d-none d-lg-block">Luma</span>
                    </a>

                    <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                        <li class="nav-item active">
                            <a href="./"
                               class="nav-link"><i class="material-icons">home</i>Home</a>
                        </li>
                        
                    </ul>
                    
                    <div class="input-group" style="background-color:#ffffff00;">
                        <marquee width="100%" direction="left" height="50px">
                			<h4><strong><span style="color: #FF9933;"></span><?php echo $web_details['name']; ?></strong></h4>
                	</marquee>
                   </div>

                    <ul class="nav navbar-nav ml-auto mr-0">
                        <li class="nav-item">
                            <a href="announcement"
                               class="nav-link"
                               data-toggle="tooltip"
                               data-title="Announcement"
                               data-placement="bottom"
                               data-boundary="window"><i class="material-icons">notifications</i></a>
                        </li>
                        
                        
                        <li class="nav-item dropdown"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            data-boundary="window">
                            <a href="#"
                               class="nav-link dropdown-toggle"
                               data-toggle="dropdown"
                               data-caret="false">
                               <span><?php echo $login_details['name'];?></span> 
                               <img style="border: 1px solid black; width: 40px; height: 40px; border-radius: 25px;" src="<?php echo $web_link.$login_details['photo']; ?>">
                            </a>
                            <div class="dropdown-menu">
                                <!--<a href="teachers"-->
                                <!--   class="dropdown-item">Browse Teachers</a>-->
                                <a href="profile"
                                   class="dropdown-item"> Profile</a>
                                <a href="logout"
                                   class="dropdown-item">Logout</a>
                               
                            </div>
                        </li>
                    </ul>
                </div>
