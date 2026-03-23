<?php
    include 'con.php';
    include 'assets.php';
    $check = mysqli_fetch_assoc(mysqli_query($con, "SELECT status, renewal_charge FROM website_data LIMIT 1"));

if ($check['status'] == 1) {
    header("Location: ./");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Software Expired  |  <?php echo $brand_name; ?></title>
    <!-- Favicons -->
  <link href="<?php echo $brand_logo; ?>" rel="icon">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/theme_style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
  
  <style type="text/css">
     body {
  background: rgba(96, 196, 196, .3);
  font-family: 'Open-sans', sans-serif;
}

svg {
  width: 30%;
  margin: 0 5% 3vh !important;
}

.st0{fill:#EFCBB4;}
.st1{fill:#FFE1CA;}
.st2{fill:#473427;}
.st3{
    fill:none;
    stroke:#473427;
    stroke-width:7;
    stroke-linecap:round;
    stroke-miterlimit:10;
}
.st4{fill:#D37D42;stroke:#D37D42;stroke-miterlimit:10;}

.smile {
  display: none;
}
.uhoh {
  display: none;
}
path.smile {
    fill-opacity: 0;
    stroke: #000;
    stroke-width: 6;
    stroke-dasharray: 870;
    stroke-dashoffset: 870;
    animation: draw 7s infinite linear;
  }
@keyframes draw {
  to {
    stroke-dashoffset: 0;
  }
}
#path {
  stroke-dasharray: 628.3185307179587;
  animation: dash 5s linear forwards;
}
@keyframes dash {
  from {
    stroke-dashoffset: 628.3185307179587;
  }
  to {
    stroke-dashoffset: 0;
  }
}

.message {
  float: right;
  margin: 0em 0em 0 0;
  padding: 0 2em;
  text-align: center;
}
.message h1 {
  color: #3698DC;
  font-size: 3vw !important;
  font-weight: 400;
}
.message p {
  color: #262C34;
  font-size: 1.3em;
  font-weight: lighter;
  line-height: 1.1em;
}
.light {
  position: relative;
  top: -36em;
}
.light_btm {
  position: relative;
}
.light span:first-child {
  display: block;
  height: 6px;
  width: 150px;
  position: absolute;
  top:5em;
  left: 20em;
  background: #fff;
  border-radius: 3px;
/*   transform: rotate(40deg); */
}
.light span:nth-child(2) {
  display: block;
  height: 6px;
  width: 200px;
  position: absolute;
  top:6em;
  left: 19em;
  background: #fff;
  border-radius: 3px;
/*   transform: rotate(40deg); */
}
.light span:nth-child(3) {
  display: block;
  height: 6px;
  width: 100px;
  position: absolute;
  top:7em;
  left: 24em;
  background: #fff;
  border-radius: 3px;
/*   transform: rotate(40deg); */
}

.light_btm span:first-child {
  display: block;
  height: 6px;
  width: 150px;
  position: absolute;
  bottom:6em;
  right: 20em;
  background: #fff;
  border-radius: 3px;
/*   transform: rotate(40deg); */
}
.light_btm span:nth-child(2) {
  display: block;
  height: 6px;
  width: 200px;
  position: absolute;
  bottom: 7em;
  right: 21em;
  background: #fff;
  border-radius: 3px;
/*   transform: rotate(40deg); */
}
.light_btm span:nth-child(3) {
  display: block;
  height: 6px;
  width: 100px;
  position: absolute;
  bottom:8em;
  right: 24em;
  background: #fff;
  border-radius: 3px;
/*   transform: rotate(40deg); */
}
.use-desktop {
  font-weight: 400;
  color: #3698DC;
  border: 1px solid white;
  height: 3.4em;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  border-radius: 25px;
  line-height: 1.1em;
  font-size: 5vw;
}
.expired {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
@media (max-width: 767.98px) {
  svg {
    width: 125%;
    margin: 0 5% 3vh !important;
  }
}


  </style>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="expired">
  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 464 390.4" style="enable-background:new 0 0 464 390.4;" xml:space="preserve">

  <circle class="st0" cx="126" cy="175.4" r="12"/>
  <circle class="st0" cx="339" cy="175.4" r="12"/>
  <circle class="st1" cx="232.5" cy="170.9" r="106.5"/>
  <path class="st2" d="M126,164.4c0,0,4.5-15.4,10.5-19.6c0,0,31,0,65-26.5c0,0,110,85.9,176-30.8c0,0-33,28.6-116-41.4
    c0,0-131-16.2-135.5,106V164.4z"/>
  <path class="st2" d="M339,164.4c0,0,6.2-13.3-8.2-32.4l-6.3,3.9C324.5,135.9,333.5,142.9,339,164.4z"/>
  <path class="st2" d="M247.8,45.3c0,0,47.7-5.3,76.7,53.7L247.8,45.3z"/>
  <circle class="st2" cx="192" cy="175.4" r="9"/>
  <circle class="st2" cx="271" cy="175.4" r="9"/>
  <path class="st4" d="M101.4,390.1c22.1-106.8,75.7-114.1,137.1-114.1c61.4,0,104,18.8,130.1,114.1
    C368.7,390.6,101.3,390.6,101.4,390.1z"/>

  <circle id="path" class="st3 uhoh" cx="234.5" cy="230.5" r="20"/>
  <path class="st3 smile" d="M191,214.4c-1.1-1.5,38.6,49.3,83,0"/>
  </svg>

  <div class="message">
    <h1 class="mb-3">Oops, Your Software License Has Expired</h1>
    <p>
    Your current subscription has expired. To continue enjoying uninterrupted access to our software, a renewal payment of 
    <strong style="color: #007bff;">₹<?php echo number_format($check['renewal_charge'], 2); ?></strong> is required.
  </p>
  <p>
    Kindly complete your renewal at the earliest to ensure continued services and support.
  </p>
    <a href="https://tvssolutions.in/" target="_blank">Go to TVS SOLUTIONS</a>
   
<div class="mt-3" >
       <a href="tel:+918899117706" style="flex: 1;">
      <button class="btn btn-success"><i class="fa fa-phone"></i>
        Call Now
      </button>
    </a>
        <a href="https://wa.me/915514050395?text=Hello,%20I%20would%20like%20to%20renew%20my%20subscription." target="_blank" style="flex: 1;">
      <button class= "btn btn-info">
        WhatsApp Now
      </button>
    </a>
    </div>
  </div>
  

</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script>
    
var $elem = $('.smile'), l = $elem.length, i = 0;
var $elem2 = $('.uhoh'), l = $elem2.length, i = 0;

var $elem = $('.smile');
var $elem2 = $('.uhoh');

function comeOn() {
      for( var i=0; i < 3; i++ ){
            if(i % 2){
            $elem.fadeIn(700);
            // $elem2.fadeOut(700);
            }
            else{
            $elem.fadeOut(700);
            $elem2.hide().delay(700).fadeIn(700);
            }
      }
}
comeOn();

</script>
</body>
</html>
