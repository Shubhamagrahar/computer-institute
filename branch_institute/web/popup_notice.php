<?php
$popup_details=mysqli_fetch_array(mysqli_query($con,"select * from index_popup where id='1'"));
if($popup_details['status']=="ACTIVE"){
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
<style type="text/css">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;
display: none;
}
.cnt223 a{
text-decoration: none;
}
.popup{
width: 50%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
margin-top: 65px;
    margin-left: 430px;
  
}
.cnt223{
min-width:470px;
width: 470px;
min-height: 150px;
margin: 75px;
background: linear-gradient(306deg, #b7eded, #ffffff);
position: relative;
z-index: 103;
padding: 5px 5px;
margin-left:30px;
border-radius: 11px;
box-shadow: 0 2px 5px #000;

}
.cnt223 p{
clear: both;
    color: #555555;
    /* text-align: justify; */
    font-size: 14px;
    font-family: sans-serif;
}
.cnt223 p a{
color: #d91900;
font-weight: bold;
}
.cnt223 .x{
float: right;
height: 35px;
left: 22px;
position: relative;
top: -25px;
width: 34px;
}
.cnt223 .x:hover{
cursor: pointer;
}

.button1 {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}

 @media (max-width: 1199px) {
    
    }
    @media (max-width: 991px) {
   .popup{
width: 50%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
margin-top: 30px;
margin-left: 15px;
/*margin-right: 200px;*/
}

.cnt223{
min-width:300px;
width: 300px;
min-height: 150px;
margin: 75px;
background: linear-gradient(306deg, #b7eded, #ffffff);
position: relative;
z-index: 103;
padding: 5px 5px;
margin-left:35px;
border-radius: 11px;
box-shadow: 0 2px 5px #000;
}
    }
    }
    @media (max-width: 767px) {
    .popup{
width: 50%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
margin-top: 50px;
margin-left: 100px;
margin-right: 20px;
}

.cnt223{
min-width:250px;
width: 250px;
min-height: 150px;
margin: 75px;
background: linear-gradient(306deg, #b7eded, #ffffff);
position: relative;
z-index: 103;
padding: 5px 5px;
margin-left:30px;
border-radius: 11px;
box-shadow: 0 2px 5px #000;
}
    }
    @media (max-width: 640px) {
    
    }
    @media (max-width: 480px) {
    
    }
    @media (max-width: 360px) {
    .popup{
width: 50%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
margin-top: 30px;
margin-left: 7px;
margin-right: 20px;
}

.cnt223{
min-width:250px;
width: 260px;
min-height: 150px;
margin: 75px;
background: linear-gradient(306deg, #b7eded, #ffffff);
position: relative;
z-index: 103;
padding: 5px 5px;
margin-left:30px;
border-radius: 11px;
box-shadow: 0 2px 5px #000;
}
    }
    
</style>
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
$('.close').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
</script>



<div class='popup' >
<div class='cnt223' align="center">
	<a href='' class='close' ><i class="fa fa-close" style="font-size:24px; color:red; float: right;"></i></a><br>
<h4 style="color:black; font-size: 19px;"><strong><?php echo $popup_details['hading']; ?></strong></h4>
<div align="">
	
    <!--<h5 style="font-size:15px; color:black;"><strong>Load Wallet Offer:</strong></h5>-->
	<p style="color:black;"><?php echo $popup_details['content']; ?></p>
  <?php
    if(!$popup_details['b_link']==""){
        ?>  
   <a href="<?php echo $popup_details['b_link']; ?>"><button class="btn btn-success"><?php echo $popup_details['b_name']; ?></button></a> 
 <?php } ?>

   
    
<br><br><p>

</p></div>

</div>

</div>

<?php } ?>
