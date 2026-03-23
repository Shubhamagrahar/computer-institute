<?php

$web_details=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='1'"));
 $brand_logo=$web_details['brand_logo'];
 $brand_logo_width=$web_details['brand_logo_width'];
 $brand_fav_logo=$web_details['fav_logo'];
 $brand_name=$web_details['name'];
 $brand_short_name=$web_details['short_name'];
 $brand_short_code=$web_details['short_code'];

 $brand_mob=$web_details['mob1'];
 $brand_mob2=$web_details['mob2'];
 $brand_mob3=$web_details['mob3'];
 $brand_call_no=$web_details['call_no'];
 $w_mob=$web_details['w_mob'];
 $brand_website=$web_details['brand_website'];
$brand_email=$web_details['email'];
$brand_email2=$web_details['email_2'];
$brand_add=$web_details['address'];
$brand_add2=$web_details['address_2'];
$brand_link=$web_details['brand_website'];
$add_map=$web_details['map'];
$playstore_link=$web_details['playstore_link'];
$twiter=$web_details['twiter'];
$facebook=$web_details['facebook'];
$instagram=$web_details['instagram'];
$youtube=$web_details['youtube'];
$linkedin=$web_details['linkedin'];
$telegram=$web_details['telegram'];
$threads=$web_details['threads'];
$skype=$web_details['skype'];

$visitor_count=$web_details['visiter_count'];
$visitor_counts=$visitor_count+1;
$count = $web_details['adm_count'];
?>