<?php 
include('session.php');

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['update_session_data'])){
    $id=VerifyData($_GET['update_session_data']);
    $ssd=VerifyData($_GET['update_ssd']);
    $sed=VerifyData($_GET['update_sed']);
    
    if(!$id=="" && !$ssd=="" && !$sed==""){
        $check=mysqli_num_rows(mysqli_query($con,"select * from session_details where id='$id'"));
        if($check==1){
           $update=mysqli_query($con,"update session_details set ssd='$ssd', sed='$sed' where id='$id'") ;
           if($update){
               echo 1;
           }else{
               echo "Server error 102.";
           }
        }else{
            echo "Server error 101.";
        }
    }else{
        echo "Please select all details.";
    }
}

if(isset($_GET['new_create_session_data'])){
    $session_id=VerifyData($_GET['new_create_session_data']);
    if(session_id()==$session_id){
        ?>
         <div class="container-fluid">
                    <div class="row">
                    <div class="col-12">    
                       <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Session</h3>
                                </div>
                               <div class="card-body">
                                <div class="row">   
                                <div class="col-md-3">
                                    <lable>Session Start Date</lable>
                                    <input type="date" name="create_ssd" id="create_ssd" class="form-control" value="">
                                </div>
                                <div class="col-md-3">
                                    <lable>Session End Date</lable>
                                    <input type="date" name="create_sed" id="create_sed" class="form-control" value="">
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div id="create_data_btn">
                                       <button  class="btn btn-success" onclick="create_data_session()">Create</button>
                                       &nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="cancel_session_fld()">Cancel</button>
                                    </div>
                                    <div id="create_data_span" style="display:none;">
                                    <span style="color:blue;display:block;" >Please wait..</span>
                                    </div>
                                </div>
                                </div>
                               </div>    
                        </div> 
                        
                      </div>  

                    </div>
                    <!-- /.container-fluid -->
                    </div>
        <?php
    }
}


if(isset($_GET['get_edbl_data'])){
    $id=VerifyData($_GET['get_edbl_data']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from session_details where id='$id'");
       if(mysqli_num_rows($sql)==1){
        
        $result=mysqli_fetch_array($sql);
        
        $date_se1=date_create($result['sed']);
     $date_se=date_format($date_se1,"y");
     $date_ss1=date_create($result['ssd']);
     $date_ss=date_format($date_ss1,"Y");
     
        
        
        ?>
        
        <div class="container-fluid">
                    <div class="row">
                    <div class="col-12">    
                       <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $date_ss."-".$date_se ; ?> Session Update</h3>
                                </div>
                               <div class="card-body">
                                <div class="row">   
                                <div class="col-md-3">
                                    <lable>Session Start Date</lable>
                                    <input type="date" name="update_ssd" id="update_ssd" class="form-control" value="<?php echo $result['ssd']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <lable>Session End Date</lable>
                                    <input type="date" name="update_sed" id="update_sed" class="form-control" value="<?php echo $result['sed']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div id="create_data_btn">
                                       <button  class="btn btn-primary" onclick="update_data_session(<?php echo $result['id'] ;?>)">Update</button>
                                       &nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="cancel_session_fld()">Cancel</button>
                                    </div>
                                    <div id="create_data_span" style="display:none;">
                                    <span style="color:blue;display:block;" >Please wait..</span>
                                    </div>
                                </div>
                                </div>
                               </div>    
                        </div> 
                        
                      </div>  

                    </div>
                    <!-- /.container-fluid -->
                    </div>
        <?php
           
       }else{
           echo "102";
       }
    }else{
        echo "101";
    }
}




if(isset($_GET['selected_session_data'])){
    $id=VerifyData($_GET['selected_session_data']);
    if(!$id==""){
      $update_run=mysqli_query($con,"update session_details set status='RUN' where id='$id'");
      if($update_run){
         $update_stop=mysqli_query($con,"update session_details set status='STOP' where id!='$id'") ;
         if($update_stop){
             echo "Yes";
         }else{
             echo 103;
         }
      }else{
        echo 102;  
      }
      
    }else{
        echo 101;
    }
}

if(isset($_GET['session_table_data'])){
    $session_id=VerifyData($_GET['session_table_data']);
    if($session_id==session_id()){
       ?>
       
       <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Session</th>
                                                <th>Session Start Date</th>
                                                <th>Session End Date</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from session_details order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                             
                                             $date_se1=date_create($row['sed']);
                                             $date_se=date_format($date_se1,"y");
                                             $date_ss1=date_create($row['ssd']);
                                             $date_ss=date_format($date_ss1,"Y");
                                             $date_sed=date_format($date_se1,"d-m-Y");
                                             $date_ssd=date_format($date_ss1,"d-m-Y");
                                             
                                             ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date_ss."-".$date_se ; ?></td>
                                                <td><?php echo $date_ssd ;?></td>
                                                <td><?php echo $date_sed ;?></td>
                                                <td><?php 
                                                if($row['status']=="RUN"){
                                                    ?>
                                                 <span>Selected</span>    
                                                    <?php
                                                }
                                                
                                                if($row['status']=="STOP"){
                                                    ?>
                                                    <button class="btn btn-success" onclick="selected_session_y(<?php echo $row['id'] ;?>)">Select</button>
                                                    <?php 
                                                }
                                                
                                                ?></td>
                                                <td><span style="cursor: pointer;color: blue;font-size: 15px;" onclick="selected_session_edit(<?php echo $row['id'] ;?>)"><i class="fa fa-edit"></i>Edit</span></td>
                                               
                                                
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
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
       <?php
    }else{
        echo "E";
    }
}

if(isset($_GET['create_session_ssd'])){
    $ssd=VerifyData($_GET['create_session_ssd']);
    $sed=VerifyData($_GET['create_sed']);
     if(!$ssd=="" && !$sed==""){
         $sql_check=mysqli_num_rows(mysqli_query($con,"select * from session_details where ssd='$ssd' and sed='$sed'"));
         if(!$sql_check>0){
            $session=date_format(date_create($ssd),"Y")."-".date_format(date_create($sed),"y");
           
           $check_session=mysqli_num_rows(mysqli_query($con,"select * from session_details where session='$session' "));
             if(!$check_session>0){
           $insert=mysqli_query($con,"insert into `session_details`(`session`, `ssd`, `sed`) values('$session', '$ssd', '$sed')");   
         if($insert){
             echo 1;
         }else{
           echo '<span style="font-size:15px;">Server Error 102.</span>';  
         }
             }else{
              echo '<span style="font-size:15px;">Selected Year range session already created.</span>';   
             }    
         }else{
           echo '<span style="font-size:15px;">Selected date session already created.</span>';  
         }
     }else{
         echo '<span style="font-size:15px;">Server Error 101.</span>';
     }
}
?>
<?php  mysqli_close($con); ?>