<?php

// Fetch header background and text color
$query = mysqli_query($con, "SELECT footer_bg_color, footer_text_color FROM website_data LIMIT 1");
$color_data = mysqli_fetch_assoc($query);

$footer_bg_color = $color_data['footer_bg_color'] ?? '#ffffff'; // Default white background
$footer_text_color = $color_data['footer_text_color'] ?? '#000000'; // Default black text

?>
<!-- Font Awesome CDN (for version 4.7) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.back-to-top {
    margin-right: -40px !important;
}
.bg-dark {
    /*background-color: #0c3259 !important;*/
}
.counter {
    margin-top: 30px;
}
.counter h5, h4 {
    color: white;
}
.app img {
    width: 225px;
    margin-top: 15px;
    margin-left: -20px;
    
}
.text-color {
    color : <?php echo $footer_text_color;?> !important;
    color: white;
}
.btn-outline-light {
    border: 1px solid <?php echo $footer_text_color;?> !important;
}
.btn-social img {
    width: 22px;
}


/*Visiter Count*/
    
    .glow-visitor-counter {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 5px 15px;
    background: #0a0a0a;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    border-top: 3px solid #00ffcc;
    box-shadow: 0 0 15px #00ffcc55;
    text-align: left;
    width: fit-content;
    /*margin: 30px auto;*/
    border-radius: 10px;
    animation: pulse-glow 2s infinite;
    margin-top: 50px;
}

.glow-visitor-counter .icon {
    font-size: 28px;
    color: #00ffcc;
    animation: eye-bounce 2s infinite;
}

.glow-visitor-counter .text small {
    display: block;
    font-size: 14px;
    color: #ffffff;
    /*margin-bottom: 4px;*/
    letter-spacing: 1px;
    font-weight: bold;
}

.glow-visitor-counter .text h3 {
    font-size: 24px;
    font-weight: bold;
    color: #00ffcc;
    margin: 0;
}
.about p {
    text-align: justify;
}

@keyframes pulse-glow {
    0% { box-shadow: 0 0 10px #00ffcc66; }
    50% { box-shadow: 0 0 25px #00ffccaa; }
    100% { box-shadow: 0 0 10px #00ffcc66; }
}

@keyframes eye-bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}

</style>

<?php

        $query = "SELECT  intro_des FROM website_data LIMIT 1";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        ?>

 <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s" style="background-color: <?php echo $footer_bg_color; ?> !important">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6" style = "text-align:center;">
                    <img src="<?php echo $brand_logo?>" style="width: 80%">
                </div>
                
                <div class="col-lg-3 col-md-6 about">
                    <h4 class="text-white text-color mb-3"><?php echo $brand_name?></h4>
                    <p><?php echo nl2br(implode(' ', array_slice(explode(' ', $row['intro_des']), 0, 35)) . '...'); ?></p>
                   
                </div>
                
                
                <div class="col-lg-2 col-md-6">
                    <h4 class="text-white mb-3 text-color">Quick Link</h4>
                    <a class="btn btn-link text-color" href="about">About Us</a>
                    <a class="btn btn-link text-color" href="contact">Contact Us</a>
                    <a class="btn btn-link text-color" href="course">Courses</a>
                    <a class="btn btn-link text-color" href="registration">Registration</a>
                    <a class="btn btn-link text-color" href="photo_gallery">Gallery</a>
                    
                    <div class="glow-visitor-counter">
                        <div class="icon"><i class="fa fa-eye"></i></div>
                        <div class="text" style="text-align: center;">
                            <small>Visitors Count</small>
                            <h3><?php echo $visitor_counts;?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3 text-color">Contact</h4>
                    <?php if($brand_add !== ""){ ?>
                    <p class="mb-2 text-color" ><i class="fa fa-map-marker-alt me-3 text-color"></i><?php echo $brand_add?></p>
                    <?php } ?>
                    <?php if($brand_add2 !== ""){ ?>
                    <p class="mb-2 text-color" ><i class="fa fa-map-marker-alt me-3 text-color"></i><?php echo $brand_add2?></p>
                    <?php } ?>
                    <p class="mb-2 text-color">
                        <?php if($brand_mob !== ""){  ?>
                        <a class="text-color" href="tel:<?php echo $brand_mob ; ?>"><i class="fa fa-phone-alt me-3 text-color"></i><?php echo $brand_mob; ?></a>
                        <?php } ?>
                        <?php if($brand_mob2 !== ""){  ?>
                        <a class="text-color" href="tel:<?php echo $brand_mob2 ; ?>"><?php echo ' | ' . $brand_mob2; ?></a>
                        <?php } ?>
                        </p>
                    <p class="mb-2 text-color">
                        <?php if($brand_email !== ""){  ?>
                        <a class="text-color" href="mailto:<?php echo $brand_email ; ?>"><i class="fa fa-envelope me-3 text-color"></i><?php echo $brand_email; ?></a>
                        <?php } ?>
                        <?php if($brand_email2 !== ""){  ?>
                        <a class="text-color" href="mailto:<?php echo $brand_email2 ; ?>"><?php echo ' | '. $brand_email2; ?></a>
                        <?php } ?>
                        </p>
                    <div class="d-flex pt-2">
                        
                        <?php if($facebook !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $facebook?>" target="_blank"><img src="img/logo/facebook.png"></a><?php } ?>
                        <?php if($instagram !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $instagram?>" target="_blank"><img src="img/logo/instagram.png"></a><?php } ?>
                        <?php if($twiter !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $twiter?>" target="_blank"><img src="img/logo/twitter.png"></a><?php } ?>
                        <?php if($youtube !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $youtube?>" target="_blank"><img src="img/logo/youtube.png"></a><?php } ?>
                        <?php if($linkedin !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $linkedin?>" target="_blank"><img src="img/logo/linkedin.png"></a><?php } ?>
                        <?php if($telegram !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $telegram?>" target="_blank"><img src="img/logo/telegram.png"></a><?php } ?>
                        <?php if($threads !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $threads?>" target="_blank"><img src="img/logo/threads.png"></a><?php } ?>
                        <?php if($skype !== ""){  ?><a class="btn btn-outline-light btn-social text-color" href="<?php echo $skype?>" target="_blank"><img src="img/logo/skype.png"></a><?php } ?>
                    </div>
                   <div class="app">
                          <a target="_blank" href="<?php echo $playstore_link?>">  <img src="img/logo/google_play_store.png"></a>
                    </div>
                </div>
               
                
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-12 text-center mb-3 mb-md-0 text-color">
                        &copy; <a class="border-bottom text-color" href="./"><?php echo $brand_name ?></a>, All Right Reserved.

                        Developed By <a class="border-bottom text-color" style="font-weight: bold;" href="https://tvssolutions.in/" target="_blank">TVS SOLUTIONS</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    
    <?php include 'whatsapp.php'; ?>
    <?php include 'call.php'; ?>
    
    <?php 
  mysqli_close($con);
  ?>