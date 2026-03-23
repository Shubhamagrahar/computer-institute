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
    <meta charset="utf-8">
    <title><?php echo $brand_name ?>| Photo Gallery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
 
    <style>
    .container-fluid {
        text-align: center;
    }
    .galley-pictures img {
        /*width: 100%;*/
        /*height: auto;*/
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 30px;
    }
    .galley-pictures{
            background: linear-gradient(135deg, #97b5c1, #ffffff) !important;
        }
        .galley-pictures img{
            width: 420px;
            height: 280px;
            border: 2px solid #0c3259;
            transition: transform 0.3s;
        }
        .galley-pictures img:hover {
            transform: scale(1.05);
        }
    
        .col-lg-3 {
            text-align: left;
        }
    .prev-btn { left: 20px; }
    .next-btn { right: 20px; }
    @media (max-width: 768px) {
        .popup-content img {
            width: 90%;
            height: auto;
        }
        .galley-pictures img {
        width: 280px;
        height: 200px;
        }
    .img {
        width: auto !important;
    }
    }
    .photo-container {
        max-width: 100% !important;
    }
    
    .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 10px;
}
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 2em;
    color: #04046e;
    cursor: pointer;
    display: none;
}


.popup-image {
    /* max-width: 100%; */
    width: 703px;
    /* max-height: 80%; */
    height: 500px;
    border-radius: 10px;
    transition: transform 0.3s;
    margin-top: 130px;
}
.caption {
    margin-top: 15px;
    color: #fff;
    font-size: 1.4em;
    text-align: center;
    padding: 0 10px;
    word-wrap: break-word;
}
prev {
    left: 10px;
}
.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 3em;
    background: none;
    color: #fff;
    border: none;
    cursor: pointer;
    z-index: 1001;
}
.next {
    right: 10px;
}
@media (max-width: 480px) {
    .prev, .next {
        top: 60%;
        font-size: 2rem;
    }
    .next {
        right: 0px;
    }
    .prev {
        left: 0px;
    }
}
.center {
    justify-content: center;
}
</style>
</head>

<body>
   


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


    <!-- Contact Start -->
    
    <h2 class="animated-heading"> Photo Gallery</h2>
    
<?php
$query = mysqli_query($con, "SELECT * FROM gallery ORDER BY id DESC");
?>

    <div class="container-xxxl py-5">
        
        <div class="container-fluid bg-primary py-5 mb-5 galley-pictures">
    <div class="container py-5 photo-container">
        <div class="row g-2 center">
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="col-4 img gallery-image"><img src="<?php echo $row['img']; ?>" data-caption="<?php echo $row['name']; ?>" alt="<?php echo $row['name']; ?>"></div>
            <?php } ?>
            <!--<div class="col-4 img"><img src="img/gallery/demo_img2.jpeg" alt=""></div>-->
            <!--<div class="col-4 img"><img src="img/gallery/demo_img5.jpg" alt=""></div>-->
            <!--<div class="col-4 img"><img src="img/gallery/demo_img4.jpg" alt=""></div>-->
            <!--<div class="col-4 img"><img src="img/gallery/demo_img5.jpg" alt=""></div>-->
            <!--<div class="col-4 img"><img src="img/gallery/demo_img1.jpeg" alt=""></div>-->
        </div>
    </div>
</div>

    <!-- Pop-up Viewer -->
<!--<div class="popup-overlay" id="popupOverlay">-->
<!--    <div class="popup-content">-->
<!--        <button class="close-btn" id="closeBtn">×</button>-->
<!--        <button class="prev-btn" id="prevBtn">❮</button>-->
<!--        <img id="popupImage" src="" alt="">-->
<!--        <button class="next-btn" id="nextBtn">❯</button>-->
<!--    </div>-->
<!--</div>-->

    </div>
    <!-- Contact End -->


<!-- Image Popup Modal -->
<div class="popup-overlay popup" id="popup">
  <div class="popup-content">
    <button class="close-btn close" id="close">&times;</button>
    <button class="prev-btn prev" id="prev">&lt;</button>
    <div style="text-align: center;">
      <img class="popup-image " id="popupImage" src="" alt="">
      <div class="caption" id="popupCaption" style="color: #fff; margin-top: 10px; font-size: 16px;"></div>
    </div>
    <button class="next-btn next" id="next">&gt;</button>
  </div>
</div>

<script>
const galleryImages = document.querySelectorAll('.gallery-image img');
const popup = document.getElementById('popup');
const popupImage = document.getElementById('popupImage');
const popupCaption = document.getElementById('popupCaption');
const closeBtn = document.getElementById('close');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');

let currentIndex = 0;

// Open popup
galleryImages.forEach((img, index) => {
  img.addEventListener('click', () => {
    currentIndex = index;
    showPopup();
  });
});

function showPopup() {
  popup.style.display = 'flex';
  const currentImage = galleryImages[currentIndex];
  popupImage.src = currentImage.src;
  popupCaption.textContent = currentImage.getAttribute('data-caption');
}

// Close popup
closeBtn.addEventListener('click', () => {
  popup.style.display = 'none';
});

// Navigate previous
prevBtn.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
  showPopup();
});

// Navigate next
nextBtn.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % galleryImages.length;
  showPopup();
});

// Close on overlay click
popup.addEventListener('click', (e) => {
  if (e.target === popup) {
    popup.style.display = 'none';
  }
});

// Keyboard navigation
document.addEventListener('keydown', (e) => {
  if (popup.style.display === 'flex') {
    if (e.key === 'ArrowRight') {
      currentIndex = (currentIndex + 1) % galleryImages.length;
      showPopup();
    } else if (e.key === 'ArrowLeft') {
      currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
      showPopup();
    } else if (e.key === 'Escape') {
      popup.style.display = 'none';
    }
  }
});
</script>



    <!-- Footer Start -->
    <?php  include 'footer.php'; ?>





<script>
    // const images = document.querySelectorAll('.galley-pictures img');
    // const popupOverlay = document.getElementById('popupOverlay');
    // const popupImage = document.getElementById('popupImage');
    // const closeBtn = document.getElementById('closeBtn');
    // const prevBtn = document.getElementById('prevBtn');
    // const nextBtn = document.getElementById('nextBtn');

    // let currentImageIndex = 0;

    // function openPopup(index) {
    //     currentImageIndex = index;
    //     popupImage.src = images[index].src;
    //     popupOverlay.style.display = 'flex';
    // }

    // function closePopup() {
    //     popupOverlay.style.display = 'none';
    // }

    // function showNextImage() {
    //     currentImageIndex = (currentImageIndex + 1) % images.length;
    //     popupImage.src = images[currentImageIndex].src;
    // }

    // function showPrevImage() {
    //     currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    //     popupImage.src = images[currentImageIndex].src;
    // }

    // images.forEach((img, index) => {
    //     img.addEventListener('click', () => openPopup(index));
    // });

    // closeBtn.addEventListener('click', closePopup);
    // popupOverlay.addEventListener('click', (e) => {
    //     if (e.target === popupOverlay) closePopup();
    // });
    // nextBtn.addEventListener('click', showNextImage);
    // prevBtn.addEventListener('click', showPrevImage);

    // document.addEventListener('keydown', (e) => {
    //     if (popupOverlay.style.display === 'flex') {
    //         if (e.key === 'ArrowRight') showNextImage();
    //         if (e.key === 'ArrowLeft') showPrevImage();
    //         if (e.key === 'Escape') closePopup();
    //     }
    // });
</script>


    <!-- JavaScript Libraries -->
    <script src="code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>