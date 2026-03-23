
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo Date('Y'); ?> <a target="_blank" href="<?php echo $brand_link; ?>"><?php echo $brand_name; ?></a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      Developed by<a target="_blank" href="https://tvssolutions.in/"><b style="color: #007bff;"> TVS SOLUTIONS</b></a>
    </div>
  </footer>
  <?php 
  mysqli_close($con);
  ?>