<?php
$web_details=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='1'"));
 $brand_logo=$web_details['brand_logo'];
 $brand_logo_width=$web_details['brand_logo_width'];
 $brand_fav_logo=$web_details['fav_logo'];
 $brand_name=$web_details['name'];
 $brand_short_name=$web_details['short_name'];
 $brand_short_code=$web_details['short_code'];
 //$company_full_name="SMART COMPUTER ZONE";
// $company_full_name1="SMART COMPUTER ZONE";
 
 $brand_mob=$web_details['mob1'];
 $brand_mob2=$web_details['mob2'];
 $brand_mob3=$web_details['mob3'];
 $w_mob=$web_details['w_mob'];
 $brand_website=$web_details['brand_website'];
$brand_email=$web_details['email'];
$brand_add=$web_details['address'];
$brand_link=$web_details['brand_website'];
$add_map=$web_details['map'];
$playstore_link=$web_details['playstore_link'];
$twiter=$web_details['twiter'];
$facebook=$web_details['facebook'];
$instagram=$web_details['instagram'];
$youtube=$web_details['youtube'];
$linkedin=$web_details['linkedin'];
?>