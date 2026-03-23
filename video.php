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
    <title><?php echo $brand_name ?> Video Gallery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <style>
        .vdo-content {
            position: absolute;
            top: 35px;
            text-align: center;
            /*left: 12rem;*/
            width: 100%;
        }
        .vdo-content p, h4{
            color: white;
        }
        .modal-content {
            margin: 0px auto;
            margin-top: 130px ;
        }
        
        @media (max-width: 375px){
            .modal-content {
                margin-top: 350px !important;
            }
            .vdo-content h4 {
                font-size: 14px;
            }
            .vdo-content p{
                font-size: 10px;
            }
            .vdo-content{
                /*left: 2.5rem;*/
                width: 95%;
                top: 15px;
            }
            .thumbnail .play-button {
                top: 45% !important;
            }
            
        }
        @media (max-width: 768px) {
    .modal-content{
            margin-top: 75px !important;
        }
         .vdo-content h4 {
                font-size: 16px;
            }
            .vdo-content p{
                font-size: 13px;
            }
            .thumbnail .play-button {
                top: 65%;
            }
    }
    /*Video-Gallery*/

 .body{
  overflow-x:hidden;
}

.video-gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 100px;
      padding: 20px;
      /*margin-top:80px;*/
      margin-bottom: 80px;
      
  }

  .thumbnail {
      position: relative;
      cursor: pointer;
      width: 100%;
      max-width: 500px;
      height: 300px;
      flex: 1 1 calc(50.333% - 40px);
      border:none !important;
  }

  .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      opacity:0.7;
  }

  .thumbnail .play-button {
      position: absolute;
      top: 80%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 25px;
      color: white;
      background: rgba(0, 0, 0, 0.6);
      /* border-radius: 50%; */
      border: none;
      padding: 10px;
  }

  .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      justify-content: center;
      align-items: center;
      overflow-y: auto;
      z-index: 9999;
  }

  .modal.active {
      display: flex;
  }

  .modal-content {
      position: relative;
      width: 100%;
      max-width: 70%;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
      /*margin-top: 130px !important;*/
  }

  .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      color: white;
      background: red;
      border: none;
      border-radius: 50%;
      padding: 1px 13px;
      cursor: pointer;
  }

  .slider {
      display: flex;
      transition: transform 0.3s ease-in-out;
      width: 100%;
      margin-top:50px;
      margin-bottom:-9px;
  }

  .slider .video-wrapper {
  flex: 0 0 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}


  @media (max-width: 768px) {
      .thumbnail {
          /*flex: 1 1 calc(50% - 20px); */
          flex:auto;
          /*max-width: 100%;*/
      }

      .thumbnail img {
          height: auto;
      }
      
      button #yt-button{
          background-color:#2a8f6100 !important;
           margin-left: 100px;
          position: absolute;
          margin-top: -113px;
          background-color: #2a8f6100;
      }

      .modal-content {
          width: 100%;
      }

      .close-button {
          font-size: 18px;
          padding: 4px 8px;
      }
  }
  
  @media( max-width: 480px ) {
      .modal-content {
          /*margin-top: 350px !important;*/
      }
  }

  @media (max-width: 480px) {
      .thumbnail {
          /*flex: 1 1 100%; */
          flex:auto;
          margin-bottom: -130px;
          /*max-width: 100%;*/
      }
      .thumbnail img {
          height: auto;
          
      }

      .play-button {
          font-size: 36px;
          padding: 8px;
      }
       .modal-content {
          max-width: 100%;
          
      }

      .slider-controls button {
          font-size: 14px;
          padding: 5px 10px;
      }
  }
  
  @media (max-width: 375px ){
      .thumbnail{
          margin-bottom: -170px;
      }
  }
  .video-wrapper iframe{
      width:949;
      height:534;
      margin-bottom: 40px;
  }
  @media (max-width: 768px){
      .video-wrapper iframe{
      width:383px;
      height:535;
  }
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
                    <h1 class="display-3 text-white animated slideInDown">Video Gallery</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Gallery / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Video Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Video Gallery Start -->
    
    <?php
$query = "SELECT * FROM video_details WHERE status='OPEN' ORDER BY date DESC";
$result = mysqli_query($con, $query);
?>

 <!--Video thumbnails -->
 
  <h2 class="animated-heading"> Video Gallery</h2>
  
 <div class="video-gallery">
    
     
     <?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <div class="thumbnail play-button" 
  data-video="<?php echo $row['link']; ?>" 
              aria-label="Play" title="Play" style="background-color: #2a8f6100;">
      <img src="img/background/blank_img.jpg" alt="Video 1">
      <div class="vdo-content">
          <h4><?php echo $row['name']; ?></h4>
          <p><?php echo $row['short_desc']; ?></p>
      </div>
      <!--<button class="ytp-large-play-button ytp-button ytp-large-play-button-red-bg play-button" id="yt-button" aria-label="Play" title="Play" style="background-color: #2a8f6100;">-->
      <button class="ytp-large-play-button ytp-button ytp-large-play-button-red-bg play-button" 
              data-video="<?php echo $row['link']; ?>" 
              aria-label="Play" title="Play" style="background-color: #2a8f6100;"> 
              
          <svg height="35px" version="1.1" viewBox="0 0 68 48" width="100%">
              <path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path>
              <path d="M 45,24 27,14 27,34" fill="#fff"></path>
          </svg>
      </button>
  </div>
  
  <?php } ?>
  
</div>


     <!--Modal -->
     <div class="modal" id="videoModal">
      <div class="modal-content">
          <button class="close-button" id="closeModal">×</button>
          <div class="slider" id="videoSlider">
              <div class="video-wrapper">
                  <iframe id="videoFrame" width="100%" height="400px"
                        src=""
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                  </iframe>
              </div>
              
          </div>
      </div>
  </div>


    
    <!-- Video Gallery End -->


    <!-- Footer Start -->
    <?php  include 'footer.php'; ?>
    
    
    <script>
document.querySelectorAll('.play-button').forEach(button => {
    button.addEventListener('click', function () {
        const videoId = this.getAttribute('data-video');
        const videoUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        document.getElementById('videoFrame').src = videoUrl;
        document.getElementById('videoModal').style.display = 'block';
    });
});

document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('videoModal').style.display = 'none';
    document.getElementById('videoFrame').src = '';
});
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