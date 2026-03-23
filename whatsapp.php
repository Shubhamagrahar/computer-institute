<style>

    .notification {
    font-size: 25px;
    position: relative;
}
.bx {
    font-family: boxicons!important;
    font-weight: 400;
    font-style: normal;
    font-variant: normal;
    line-height: 1;
    text-rendering: auto;
    display: inline-block;
    text-transform: none;
    speak: none;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.notification .num {
    position: absolute;
    top: -7px;
    right: -4px;
    width: 18px;
    height: 17px;
    border-radius: 50%;
    border: 2px solid var(--light);
    background: var(--red);
    color: var(--light);
    font-weight: 700;
    font-size: 11px;
    display: flex;
    justify-content: center;
    align-items: center;
    
}

.ringing-bell{
    position:absolute;
    left:50%;
    top:50%;
    transition:translate(-50%,-50%);
}


.faa-ring{
    color:blue;
}


@-webkit-keyframes ring {
  0% {
    -webkit-transform: rotate(-15deg);
    transform: rotate(-15deg);
  }

  2% {
    -webkit-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  4% {
    -webkit-transform: rotate(-18deg);
    transform: rotate(-18deg);
  }

  6% {
    -webkit-transform: rotate(18deg);
    transform: rotate(18deg);
  }

  8% {
    -webkit-transform: rotate(-22deg);
    transform: rotate(-22deg);
  }

  10% {
    -webkit-transform: rotate(22deg);
    transform: rotate(22deg);
  }

  12% {
    -webkit-transform: rotate(-18deg);
    transform: rotate(-18deg);
  }

  14% {
    -webkit-transform: rotate(18deg);
    transform: rotate(18deg);
  }

  16% {
    -webkit-transform: rotate(-12deg);
    transform: rotate(-12deg);
  }

  18% {
    -webkit-transform: rotate(12deg);
    transform: rotate(12deg);
  }

  20% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}

@keyframes ring {
  0% {
    -webkit-transform: rotate(-15deg);
    -ms-transform: rotate(-15deg);
    transform: rotate(-15deg);
  }

  2% {
    -webkit-transform: rotate(15deg);
    -ms-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  4% {
    -webkit-transform: rotate(-18deg);
    -ms-transform: rotate(-18deg);
    transform: rotate(-18deg);
  }

  6% {
    -webkit-transform: rotate(18deg);
    -ms-transform: rotate(18deg);
    transform: rotate(18deg);
  }

  8% {
    -webkit-transform: rotate(-22deg);
    -ms-transform: rotate(-22deg);
    transform: rotate(-22deg);
  }

  10% {
    -webkit-transform: rotate(22deg);
    -ms-transform: rotate(22deg);
    transform: rotate(22deg);
  }

  12% {
    -webkit-transform: rotate(-18deg);
    -ms-transform: rotate(-18deg);
    transform: rotate(-18deg);
  }

  14% {
    -webkit-transform: rotate(18deg);
    -ms-transform: rotate(18deg);
    transform: rotate(18deg);
  }

  16% {
    -webkit-transform: rotate(-12deg);
    -ms-transform: rotate(-12deg);
    transform: rotate(-12deg);
  }

  18% {
    -webkit-transform: rotate(12deg);
    -ms-transform: rotate(12deg);
    transform: rotate(12deg);
  }

  20% {
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}

.faa-ring.animated,
.faa-ring.animated-hover:hover,
.faa-parent.animated-hover:hover > .faa-ring {
  -webkit-animation: ring 4s ease infinite;
  animation: ring 4s ease infinite;
  transform-origin-x: 50%;
  transform-origin-y: 0px;
  transform-origin-z: initial;
}


#wa-widget-send-button {
    margin: 0 8px 100px 0 !important;
}
</style> 
 
 
 
  <!--Whatsapp start-->
<script>
    // var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?26862';
		var url = 'https://tvssolution.com/wa.js?26862';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    //s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#4dc247",
      "ctaText":"",
      "borderRadius":"25",
      "marginLeft":"25",
      "marginBottom":"80",
      "marginRight":"10",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"<?php echo $brand_name; ?>",
      "brandSubTitle":"Support system",
      "brandImg":"<?php echo $brand_logo; ?>",
      "welcomeText":"Hi there!\nHow can I help you?",
    
      <?php $msg="Hello, I have a question about ".$brand_name; ?>
	  "messageText":"<?php echo $msg;?>",
      "backgroundColor":"#0d7769",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"<?php echo $w_mob; ?>"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script> 
<!--whatsapp end-->