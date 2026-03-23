<?php
$popup_details=mysqli_fetch_array(mysqli_query($con,"select * from index_popup where id='1'"));
if($popup_details['status']=="ACTIVE"){
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>

  <style>
    /* Popup container */
    .popup-notice {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      animation: fadeIn 0.4s ease;
    }

    /* Popup box */
    .popup-content {
      /*background: #fff;*/
      background: linear-gradient(45deg, #ffffff, #b2caff);
      padding: 30px 20px;
      border-radius: 15px;
      width: 90%;
      max-width: 500px;
      text-align: center;
      position: relative;
      animation: slideDown 0.5s ease;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* Close button */
    .close-btn {
      position: absolute;
      top: 5px;
      right: 15px;
      font-size: 30px;
      cursor: pointer;
      color: #02022c;
      transition: color 0.3s;
    }
    .close-btn:hover {
      color: #8d9bbe;
    }

    /* Button */
    .popup-btn {
      display: inline-block;
      margin-top: 15px;
      background: #007bff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s ease;
    }
    .popup-btn:hover {
      background: #0056b3;
      transform: scale(1.05);
    }

    /* Animations */
    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    @keyframes slideDown {
      from {transform: translateY(-50px); opacity: 0;}
      to {transform: translateY(0); opacity: 1;}
    }

    /* Responsive */
    @media (max-width: 500px) {
      .popup-content {
        padding: 20px 15px;
      }
      .popup-content h2 {
        font-size: 20px;
      }
    }
    .button{
        padding: 10px 40px;
    }
  </style>
</head>
<body>

  <!-- Popup Notice -->
  <div class="popup-notice" id="popupNotice">
    <div class="popup-content">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <h2><?php echo $popup_details['hading']; ?></h2>
      <p><?php echo $popup_details['content']; ?></p>
      <!--<a href="about" class="btn btn-primary button">Explore Now</a>-->
      
      <?php
    if(!$popup_details['b_link']==""){
    //  if (!empty($row['b_name']) && !empty($row['b_link'])) {
        ?>  
   <a href="<?php echo $popup_details['b_link']; ?>"><button class="btn btn-primary button"><?php echo $popup_details['b_name']; ?></button></a> 
 <?php } ?>
    </div>
  </div>

  <script>
    function closePopup() {
      document.getElementById('popupNotice').style.display = 'none';
    }

    window.onload = function () {
      document.getElementById('popupNotice').style.display = 'flex';
    };
  </script>

<?php } ?>
