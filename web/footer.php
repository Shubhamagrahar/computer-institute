    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="about">About Us</a>
                    <a class="btn btn-link" href="courses">Courses</a>
                    <a class="btn btn-link" href="certificate">Certificate</a>
                    <a class="btn btn-link" href="marksheet">Marksheet</a>
                    <a class="btn btn-link" href="gallery">Gallery</a>
                    <a class="btn btn-link" href="contact">Contact Us</a>
                    <a class="btn btn-link" href="login">Login</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker me-3"></i><?php echo $brand_add ; ?></p>
                    <p class="mb-2"><i class="fa fa-phone me-3"></i><a href="tel:<?php echo $brand_mob ; ?>"><?php echo $brand_mob ; ?></a></p>
                    <?php
                    if(!$brand_mob2==""){
                        ?>
                        <p class="mb-2"><i class="fa fa-phone me-3"></i><a href="tel:<?php echo $brand_mob2 ; ?>"><?php echo $brand_mob2 ; ?></a></p>
                       <?php
                    }
                    if(!$brand_mob3==""){
                        ?>
                        <p class="mb-2"><i class="fa fa-phone me-3"></i><a href="tel:<?php echo $brand_mob3 ; ?>"><?php echo $brand_mob3 ; ?></a></p>
                        
                        <?php
                    }
                    ?>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><a href="mailto:<?php echo $brand_email ; ?>"><?php echo $brand_email ; ?></a></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo $twiter ; ?>"><i class="fa-brands fa-x-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo $facebook ; ?>"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo $instagram ; ?>"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo $youtube ; ?>"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo $linkedin ; ?>"><i class="fab fa-linkedin-in"></i></a>
                        
                    </div>
                </div>
                 <?php
             $section=1;
             if($section==2){
             ?>
                <!--<div class="col-lg-3 col-md-6">-->
                <!--    <h4 class="text-white mb-3">Gallery</h4>-->
                <!--    <div class="row g-2 pt-2">-->
                <!--        <div class="col-4">-->
                <!--            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">-->
                <!--        </div>-->
                <!--        <div class="col-4">-->
                <!--            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">-->
                <!--        </div>-->
                <!--        <div class="col-4">-->
                <!--            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">-->
                <!--        </div>-->
                <!--        <div class="col-4">-->
                <!--            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">-->
                <!--        </div>-->
                <!--        <div class="col-4">-->
                <!--            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">-->
                <!--        </div>-->
                <!--        <div class="col-4">-->
                <!--            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <?php } ?>
                <?php
                $section=1;
                if($section==1){ ?>
                 <div class="col-lg-4 col-md-6">
                    <!--<h4 class="text-white mb-3">Newsletter</h4>-->
                    <h4 class="text-white mb-3">Mobile Application</h4>
                    <p>We Are Now Available On Google Play Store.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                         <?php
             $section=1;
             if($section==2){
             ?>
                        <!--<input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">-->
                        <!--<button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>-->
                        <?php } ?>
                    <?php 
                        if ($playstore_link==""){
                            ?>
                          <a href="#" onclick="alert('After the finalization of the project, the mobile application will be created and uploaded to the Play Store.')"><img src="img/google_play_store.png" alt="Google Play Store" width="250" height="100"></a>  
                         <?php   
                        }else{
                         ?>
                          <a target="_blank" href="<?php echo $playstore_link; ?>" ><img src="img/google_play_store.png" alt="Google Play Store" width="250" height="100"></a>  
                         <?php   
                        }
                        ?>
                    </div>
                </div>    
               <?php }else{ ?>
                   <div class="col-lg-4 col-md-6">
                    <!--<h4 class="text-white mb-3">Newsletter</h4>-->
                    <h4 class="text-white mb-3">Location</h4>
                    <!--<p>We Are Now Available On Google Play Store.</p>-->
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                    <iframe class="position-relative rounded w-100 h-100"
                       src="<?php echo $add_map; ?>"

                        frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                    </div>
                </div> 
              <?php }
                ?>
               
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                        &copy; 2025 <a class="border-bottom" href="javascript:void(0)"><?php echo $brand_name; ?></a> All Right Reserved.

                      
                    </div>
                    <div class="col-md-4 text-center text-md-end">
                        Developed By <a class="border-bottom" target="_blank" href="https://tvssolution.in/">TVS SOLUTION</a>
                     <?php
             $section=1;
             if($section==2){
             ?>
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
     <?php 
  mysqli_close($con);
  ?>