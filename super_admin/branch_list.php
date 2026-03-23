<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Franchise List | <?php echo $brand_name; ?></title>
    <!-- Favicons -->
    <link href="<?php echo $brand_logo; ?>" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    
    <style type="text/css">
          .branch_drop{
    	background: #157daf !important;
    }
    
    .branch_list1{
    	background: #157daf !important;
    }
     .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ff0000;
  transition: 0.4s;
  border-radius: 34px;
  text-align: right;
  padding-right:10px;
  line-height: 34px;
  font-weight: bold;
  color: white;
  font-size: 13px;
}

.slider:before {
    content: "NO";
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #28a745;
  text-align: left;
  padding-left: 10px;
  color: transparent;
}

input:checked + .slider:before {
    content: "NO";
  transform: translateX(26px);
}

input:checked + .slider::after {
  content: "YES";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
  padding-left: 8px;
}

input:checked + .slider {
  color: transparent;
}
      </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader and Navbar -->
        <?php include 'top_navbar.php'; ?>

        <!-- /.navbar -->

        <!-- Main left Sidebar Container start-->

        <?php include 'left_side_navbar.php'; ?>

        <!-- Main left Sidebar Container end-->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> Franchise List</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           
           
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Franchise Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Franchise Name</th>
                                                <th>Owner Name</th>
                                                <th>Mobile</th>
                                                
                                                <th>View</th>
                                                <th>Active</th>
                                                <th>Own Franchise</th>
                                                <th>Edit</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $i=0;
                                            
                                            
                                            $sql_franchise=mysqli_query($con,"select * from user where type='1' and own_branch='NO' order by id desc");
                                            while($row=mysqli_fetch_array($sql_franchise)){
                                           
                                             $date_register=date_create($row['r_date']);
                                             $date_register=date_format($date_register,"d-m-Y");
                                           $state_details=mysqli_fetch_array(mysqli_query($con,"select * from states where id='$row[state_id]'"));
                                           $fr_details=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$row[id]'"));
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['father_name']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                
                                                <td>
                                                <button
                                                          class="btn btn-info "
                                                          data-toggle="modal"
                                                          data-target="#franchiseModal"
                                                          data-franchise-name="<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>"
                                                          data-owner-name="<?php echo htmlspecialchars($row['father_name'], ENT_QUOTES); ?>"
                                                          data-mobile="<?php echo htmlspecialchars($row['mobile'], ENT_QUOTES); ?>"
                                                          data-whatsapp="<?php echo htmlspecialchars($row['w_mob'], ENT_QUOTES); ?>"
                                                          data-email="<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>"
                                                          data-due-amount="<?php echo htmlspecialchars($fr_details['wallet'], ENT_QUOTES); ?>"
                                                          data-state="<?php echo htmlspecialchars($state_details['name'], ENT_QUOTES); ?>"
                                                          data-pin-code="<?php echo htmlspecialchars($row['pin'], ENT_QUOTES); ?>"
                                                          data-address="<?php echo htmlspecialchars($row['full_add'], ENT_QUOTES); ?>"
                                                          data-register-date="<?php echo htmlspecialchars($date_register, ENT_QUOTES); ?>"
                                                          data-active-status="<?php echo ($row['status'] == '1') ? 'YES' : 'NO'; ?>"
                                                          data-own-franchise="<?php echo ($row['own_branch'] == 'YES') ? 'Yes' : 'No'; ?>"
                                                          data-branch-code="<?php echo htmlspecialchars($row['branch_code'], ENT_QUOTES); ?>"
                                                        >
                                                          View
                                                        </button>
                                                </td>
                                               <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggleStatus(this, <?php echo $row['id']; ?>)" <?php echo ($row['status'] == "1") ? 'checked' : ''; ?>>
                                                    <span class="slider round"><?php echo ($row['status'] == '1') ? 'YES' : 'NO'; ?></span>
                                                  </label>
                                                </td>

                                           
                                          
                                                <td>
                                                  <label class="switch">
                                                    <input 
                                                      type="checkbox" 
                                                      onchange="confirmAssign(<?php echo $row['id']; ?>, this)" 
                                                      <?php echo ($row['own_branch'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"><?php echo ($row['own_branch'] == 'YES') ? 'Yes' : 'No'; ?></span>
                                                  </label>
                                                </td>
                                            <td><a href="branch_new?btn=Update&id=<?php echo $row['id']; ?>" ><button class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button></a></td>   

                                            </tr>
                                            
                                          <?php }  ?>  
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            
                            
                        </div>
                        <!-- Modal -->
<div class="modal fade" id="franchiseModal" tabindex="-1" role="dialog" aria-labelledby="franchiseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong>Franchise Details</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="franchiseName">Franchise Name</label>
              <input type="text" class="form-control" id="franchiseName" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="franchiseName">Franchise Code</label>
              <input type="text" class="form-control" id="franchiseCode" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="ownerName">Owner Name</label>
              <input type="text" class="form-control" id="ownerName" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="mobile">Mobile</label>
              <input type="text" class="form-control" id="mobile" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="whatsapp">Whatsapp No.</label>
              <input type="text" class="form-control" id="whatsapp" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="dueAmount">Due Amount</label>
              <input type="text" class="form-control" id="dueAmount" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="state">State</label>
              <input type="text" class="form-control" id="state" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="pinCode">Pin Code</label>
              <input type="text" class="form-control" id="pinCode" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" rows="2" readonly></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="registerDate">Register Date</label>
              <input type="text" class="form-control" id="registerDate" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="activeStatus">Active</label>
              <input type="text" class="form-control" id="activeStatus" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="ownFranchise">Own Franchise</label>
              <input type="text" class="form-control" id="ownFranchise" readonly>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                        
                    </div>
                </div>
            </section>
            
           
            <!--Main content section end-->

            
        </div>
        <!-- /.content-wrapper -->
        <!--Footar start-->
        <?php include'footar.php'; ?>
        <!--Footar end-->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
     <script>
	
    		function get_fee(val){
    		  
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                        
                    document.getElementById("course_fee_label").style.display="block";
                   
                 $("#course_fee").val(data);
                    }
                }
              }
              );
    		}
    		
    	</script>
    	<script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "300";
            imagediv.appendChild(newimg);
        }
       
    </script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
            <script>
  function confirmAssign(id, checkbox) {
  const originalChecked = !checkbox.checked;
  const action = checkbox.checked ? 'assign' : 'remove'; 

  Swal.fire({
    title: 'Are you sure?',
    text: checkbox.checked
      ? "Are you sure you want to assign to own franchise?"
      : "Are you sure you want to remove from own franchise?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: checkbox.checked ? '#28a745' : '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: checkbox.checked ? 'Yes, assign it!' : 'Yes, remove it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "GET",
        url: "get_data",
        data: {
          own_branch_no: checkbox.checked ? 1 : 0,
          branch_id: id
        },
        success: function(response) {
          if (response === 'success') {
            Swal.fire('Success!', 
              checkbox.checked
                ? 'Own branch assigned successfully.'
                : 'Own branch remove successfully.', 
              'success').then(() => {
                checkbox.checked = checkbox.checked; 
                window.location.href = 'branch_list_own'; 
            });
          } else if (response.startsWith('error:')) {
            let message = response.split('error:')[1];
            Swal.fire('Error!', message, 'error');
            checkbox.checked = originalChecked; 
          } else {
            Swal.fire('Error!', 'Unexpected server response.', 'error');
            checkbox.checked = originalChecked; 
          }
        },
        error: function() {
          Swal.fire('Error!', 'Network error or server problem.', 'error');
          checkbox.checked = originalChecked; 
        }
      });
    } else {
      checkbox.checked = originalChecked; 
    }
  });
}

</script>
<script>
    function toggleStatus(checkbox, id) {
  let newStatus = checkbox.checked ? "1" : "2";
  let actionText = checkbox.checked ? "activate" : "deactivate";

  Swal.fire({
    title: 'Are you sure?',
    text: `Are you sure you want to ${actionText} this franchise?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: `Yes, ${actionText} it!`
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "get_data", 
        method: 'GET',
        data: { 
            update_status : 1,
            id: id, 
            status: newStatus
            },
        success: function(response) {
          if(response.trim() === 'success'){
            Swal.fire('Updated!', 'Franchise status updated.', 'success');
          } else {
            Swal.fire('Error!', response, 'error');
           
            checkbox.checked = !checkbox.checked;
          }
        },
        error: function() {
          Swal.fire('Error!', 'Server error or network issue.', 'error');
          
          checkbox.checked = !checkbox.checked;
        }
      });
    } else {
      checkbox.checked = !checkbox.checked;
    }
  });
}

</script>
<script>
    $('#franchiseModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);

  var modal = $(this);
  modal.find('#franchiseName').val(button.data('franchise-name'));
  modal.find('#franchiseCode').val(button.data('branch-code'));
  modal.find('#ownerName').val(button.data('owner-name'));
  modal.find('#mobile').val(button.data('mobile'));
  modal.find('#whatsapp').val(button.data('whatsapp'));
  modal.find('#email').val(button.data('email'));
  modal.find('#dueAmount').val(button.data('due-amount'));
  modal.find('#state').val(button.data('state'));
  modal.find('#pinCode').val(button.data('pin-code'));
  modal.find('#address').val(button.data('address'));
  modal.find('#registerDate').val(button.data('register-date'));
  modal.find('#activeStatus').val(button.data('active-status'));
  modal.find('#ownFranchise').val(button.data('own-franchise'));
});

</script>
</body>

</html>