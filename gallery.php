<?php
include 'con.php';
include 'assets.php';


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link type="text/css" rel="stylesheet" href="style.html"/>
    <meta charset="utf-8">
    <title><?php echo $brand_name?> | Photo Gallery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    
    <?php include 'head.php'; ?>
    
    <style>
        .galley-pictures{
            background: linear-gradient(135deg, #97b5c1, #ffffff) !important;
        }
        .galley-pictures img{
            width: 420px;
            height: 280px;
        }
    </style>
    
    <style>
    /*body {*/
    /*    font-family: 'Arial', sans-serif;*/
    /*    background-color: #f4f4f4;*/
    /*    padding: 20px;*/
    /*}*/
    .container-fluid {
        text-align: center;
    }
    .galley-pictures img {
        /*width: 100%;*/
        /*height: auto;*/
        border-radius: 8px;
        cursor: pointer;
    }
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .popup-content {
        position: relative;
        max-width: 90%;
        max-height: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .popup-content img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 8px;
        object-fit: cover;
        width: 600px; 
        height: 400px;
    }
    .close-btn, .prev-btn, .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 18px;
        border-radius: 50%;
    }
    .close-btn {
        top: 20px;
        right: 20px;
        transform: none;
    }
    .prev-btn { left: 20px; }
    .next-btn { right: 20px; }
    @media (max-width: 768px) {
        .popup-content img {
            width: 90%;
            height: auto;
        }
        .galley-pictures img {
        width: 100%;
        height: auto;
        }
    .col-4 {
        width: auto;
    }
    }
</style>

</head>

<body>
    <!-- Spinner Start -->
    <!--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">-->
    <!--    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">-->
    <!--        <span class="sr-only">Loading...</span>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <?php include 'header.php'; ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header"
         style="background: linear-gradient(rgba(24, 29, 56, 0.7), rgba(24, 29, 56, 0.7)), url('<?php echo $bread_img; ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Photo Gallery</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Gallery / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> Photo Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Gallery Pictures Starts -->
    <!--<div class="container-fluid bg-primary py-5 mb-5 galley-pictures">-->
    <!--    <div class="container py-5">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="row g-2 pt-2">-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img1.jpeg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img1.jpeg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img2.jpeg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img2.jpeg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img5.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img5.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img4.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img4.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img5.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img5.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img1.jpeg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img1.jpeg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img2.jpeg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img2.jpeg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img5.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img5.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img4.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img4.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img5.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img5.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img1.jpeg"><img class="img-fluid bg-light p-1" src="img/gallery11.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img2.jpeg"><img class="img-fluid bg-light p-1" src="img/gallery12.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--                <div class="col-4">-->
    <!--                  <a href="img/gallery/demo_img5.jpg"><img class="img-fluid bg-light p-1" src="img/gallery/demo_img5.jpg" alt=""></a>-->
    <!--                </div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery14.jpg"><img class="img-fluid bg-light p-1" src="img/gallery14.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery15.jpg"><img class="img-fluid bg-light p-1" src="img/gallery15.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery16.jpg"><img class="img-fluid bg-light p-1" src="img/gallery16.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery17.jpg"><img class="img-fluid bg-light p-1" src="img/gallery17.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery18.jpg"><img class="img-fluid bg-light p-1" src="img/gallery18.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery19.jpg"><img class="img-fluid bg-light p-1" src="img/gallery19.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery20.jpg"><img class="img-fluid bg-light p-1" src="img/gallery21.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery21.jpg"><img class="img-fluid bg-light p-1" src="img/carousel-3.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery22.jpg"><img class="img-fluid bg-light p-1" src="img/gallery22.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery23.jpg"><img class="img-fluid bg-light p-1" src="img/gallery23.jpg" alt=""></a>-->
                    <!--</div>-->
                    <!--<div class="col-4">-->
                    <!--  <a href="img/gallery24.jpg"><img class="img-fluid bg-light p-1" src="img/gallery24.jpg" alt=""></a>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    
   <div class="container-fluid bg-primary py-5 mb-5 galley-pictures">
    <div class="container py-5">
        <div class="row g-2">
            <div class="col-4"><img src="img/gallery/demo_img1.jpeg" alt=""></div>
            <div class="col-4"><img src="img/gallery/demo_img2.jpeg" alt=""></div>
            <div class="col-4"><img src="img/gallery/demo_img5.jpg" alt=""></div>
            <div class="col-4"><img src="img/gallery/demo_img4.jpg" alt=""></div>
            <div class="col-4"><img src="img/gallery/demo_img5.jpg" alt=""></div>
            <div class="col-4"><img src="img/gallery/demo_img1.jpeg" alt=""></div>
        </div>
    </div>
</div>

<!-- Pop-up Viewer -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-content">
        <button class="close-btn" id="closeBtn">×</button>
        <button class="prev-btn" id="prevBtn">❮</button>
        <img id="popupImage" src="" alt="">
        <button class="next-btn" id="nextBtn">❯</button>
    </div>
</div>

<script>
    const images = document.querySelectorAll('.galley-pictures img');
    const popupOverlay = document.getElementById('popupOverlay');
    const popupImage = document.getElementById('popupImage');
    const closeBtn = document.getElementById('closeBtn');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentImageIndex = 0;

    function openPopup(index) {
        currentImageIndex = index;
        popupImage.src = images[index].src;
        popupOverlay.style.display = 'flex';
    }

    function closePopup() {
        popupOverlay.style.display = 'none';
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        popupImage.src = images[currentImageIndex].src;
    }

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        popupImage.src = images[currentImageIndex].src;
    }

    images.forEach((img, index) => {
        img.addEventListener('click', () => openPopup(index));
    });

    closeBtn.addEventListener('click', closePopup);
    popupOverlay.addEventListener('click', (e) => {
        if (e.target === popupOverlay) closePopup();
    });
    nextBtn.addEventListener('click', showNextImage);
    prevBtn.addEventListener('click', showPrevImage);

    document.addEventListener('keydown', (e) => {
        if (popupOverlay.style.display === 'flex') {
            if (e.key === 'ArrowRight') showNextImage();
            if (e.key === 'ArrowLeft') showPrevImage();
            if (e.key === 'Escape') closePopup();
        }
    });
</script>



    <!-- Gallery Pictures Ends -->


    <!-- 404 Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="./">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->
        

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="../code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>


<!-- Mirrored from www.ifiteducation.in/gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Feb 2025 06:04:31 GMT -->
</html>