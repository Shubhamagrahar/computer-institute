<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<style>
    .input-group {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 60%;
}
@media screen and (max-width: 1024px) {
  .input-group {
   display:none;
}
}
@media screen and (max-width: 768px) {
  .input-group {
   display:none;
}
}
@media screen and (max-width: 425px) {
  .input-group {
   display:none;
}
}
@media screen and (max-width: 375px) {
  .input-group {
   display:none;
}
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo $brand_fav_logo; ?>" alt="Loading..." height="100px" width="100px">
  </div>
<?php
$check = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM website_data LIMIT 1"));

$today = date('Y-m-d');
$end_date = $check['end_date'];
$status = $check['status'];

$days_left = (strtotime($end_date) - strtotime($today)) / (60 * 60 * 24);
$formatted_end_date = date("d-M Y", strtotime($end_date));

if ($status == 1) {
    if ($days_left > 0 && $days_left <= 30) {
        echo "<marquee style='color:orange; font-size:24px;'>Important: Your software license is set to expire in $days_left days, on $formatted_end_date. To ensure uninterrupted access and continued support, please make sure to renew your license before the expiry date.</marquee>";
    } elseif ($days_left == 0) {
        echo "<marquee style='color:red; font-size:24px;'>Alert: Your software license expires today ($formatted_end_date). Immediate renewal is required to avoid service interruption and maintain access to all features.</marquee>";
    } elseif ($days_left < 0 && $days_left >= -5) {
        echo "<marquee style='color:red; font-size:24px;'>Important: Your software license expired " . abs($days_left) . " days ago (on $formatted_end_date). Please renew it immediately to restore full functionality and avoid potential data access issues.</marquee>";
    } elseif ($days_left < -5) {
        mysqli_query($con, "UPDATE website_data SET status = 2 WHERE id = {$check['id']}");
       echo "<script>window.location.href = '../expired';</script>";
    }
} elseif ($status == 2) {
    echo "<script>window.location.href = '../expired';</script>";
        exit;
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
    
    
           <?php
       $session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='0'"));
       $current_session = $session['session_id'];
    
      ?>
         
       
                        
                       <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="session_id" class="col-form-label fw-bold session">Session:</label>
                            </div>
                            <div class="col">
                                <select class="form-control" name="session_id" id="session_id" onchange="update_session()">
                                    <option value="">--Select--</option>
                                    <?php 
                                    $sql_session = mysqli_query($con, "SELECT * FROM session_details ORDER BY id DESC");
                                    while($row = mysqli_fetch_array($sql_session)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
    
                  <script src="plugins/jquery/jquery.min.js"></script>
                          <script>
                    $(document).ready(function() {
                        
                        
                        $("#session_id").val(<?php echo $current_session; ?>);
                    });
                    
                    
                    </script>
                     <script>
   function update_session() {
    var session_id = $('#session_id').val();

    $.ajax({
        url: 'update_session',
        type: 'POST',
        data: { session_id: session_id },
        success: function(response) {
            toastr.success("Session Updated Successfully");
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    });
}


            </script>

                 <div class="input-group" style="background-color:white;">
                                 <marquee width="100%" direction="left" height="50px" style="margin-left: 40px;">
                					 <h4>
                		</h4><h4><strong><span style="color: #FF9933;"></span><?php echo $web_details['name']; ?></strong></h4>
                	</marquee>
                   </div>
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
          <a class="nav-link" data-toggle="dropdown" style="margin-top: -13px;" href="#"><span><?php echo $login_details['short_name'];?></span>
        
            <img style="border: 1px solid black; width: 40px; height: 40px; border-radius: 25px;" src="<?php echo $brand_logo; ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 210px;">
          <span class="dropdown-item dropdown-header"><strong><?php echo $login_details['short_name'];?></strong></span>
          <div class="dropdown-divider"></div>
          <a href="change_password" class="dropdown-item"><i class="fa fa-user mr-2"></i>Change Passowrd</a>
          <!--<div class="dropdown-divider"></div>-->
          <!--<a href="contact_us" class="dropdown-item"><i class="fa fa-contact mr-2"></i>Contact Us</a>-->
          <!--<a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">-->
          <!--   <i class="fas fa-cog"></i> Setting</a>-->
          <div class="dropdown-divider"></div>
          <a href="logout" class="dropdown-item"><i class="fa fa-sign-out mr-2"></i>Logout</a>
         
         
        </div>
      </li>
    
    </ul>
  </nav>
  <script src="plugins/toastr/toastr.min.js"></script>