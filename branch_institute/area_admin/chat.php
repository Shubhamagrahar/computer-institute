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
  <title>Chat System |  <?php echo $brand_name; ?></title>
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
  
  <style type="text/css">
 

.chat{
	background: #157daf !important;
}
.col-md-3 .card {
  height: 80vh;              
  display: flex;
  flex-direction: column;
}

.col-md-3 .card-body {
  flex: 1;
  overflow-y: auto;          
  padding: 0;
}

.col-md-9 .card {
  height: 80vh;              
  display: flex;
  flex-direction: column;
}

#chatWindow {
  display: none;
  flex: 1;
  display: flex;
  flex-direction: column;
}

#chatWindow .card-header {
  flex-shrink: 0;
}
 #chatWindow {
    display: flex;
    flex-direction: column;
    flex:1;
    height: 80%; 
  }
#chatMessages {
  /*flex: 1;*/
  overflow-y: auto; 
  overflow-x: hidden;
  padding: 15px;
  background-color: #f0f0f0;
  
  height:80vh;
   scrollbar-width: none;
  -ms-overflow-style: none;
  
}
#chatMessages::-webkit-scrollbar {
  display: none; 
}
#chatMessages::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;   
  height: 400px;  
  background-image: url('<?php echo $brand_logo; ?>');
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  opacity: 0.1;   
  transform: translate(-50%, -50%);
  pointer-events: none; 
}


#chatWindow .card-footer {
  flex-shrink: 0;
}

.chat-bubble {
  max-width: 70%;
  padding: 8px 12px;
  border-radius: 12px;
  margin-bottom: 10px;
  clear: both;
  word-wrap: break-word;
}

.sent {
  background: #17a2b8;   
  color: #fff;
  float: right;
  text-align: right;
}

.received {
  background: #6c757d;  
  color: #fff;
  float: left;
  text-align: left;
}

.contact-item:hover {
  background: #f1f1f1;
  cursor: pointer;
}
.contact-item.active {
  background: #17a2b8;
  font-weight: bold;
}
.msg-time {
  font-size: 9px;
  color: #00000;
  margin-top: 2px;
}
#contactListWrapper::-webkit-scrollbar,
#studentListWrapper::-webkit-scrollbar {
    display: none;
}
 #broadcastModal .modal-dialog {
    max-width: 800px; /* default ~500px */
  }

@media (max-width: 991.98px) {
  .col-md-3 { display: block; }
  .col-md-9 { display: none; width: 100%; }

   .col-md-9 .card {
    display:flex;
    flex-direction:column;
    height:100%;
  }

  #chatWindow {
    display: flex;
    flex-direction: column;
    flex:1;
    height: 100%; 
  }

  #chatWindow .card-header {
    flex: 0 0 auto; 
  }

  #chatMessages {
    flex: 1 1 auto;   
    overflow-y: auto;
    overflow-x: hidden;
    padding: 15px;
    background-color: #f0f0f0;
    height:60vh;
     scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none;
  }

  #chatWindow .card-footer {
    flex: 0 0 auto;  
  }
}

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <?php include 'top_navbar.php'; ?>
  
 
  
 <?php include 'left_side_navbar.php'; ?>
 

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
          <div class="col-md-8"></div>
        <div class="col-md-4">
          
           <button id="createBroadcast" class="btn btn-info mb-2">Create Broadcast</button>
        </div>
        </div>
      </div>
    </div>
   
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- LEFT COLUMN -->
      <div class="col-md-3">
        <div class="card card-info" style="height:80vh; overflow-y:hidden;">
          <div class="card-header p-2">
      <input type="text" id="searchBar" class="form-control form-control-sm" 
             placeholder="Search name or mobile...">
            

    </div>
          <div class="card-body p-0" id="contactListWrapper" style="height:calc(80vh - 45px); overflow-y:auto;">
            <ul class="list-group chat-list" id="chatContacts">
           <li class="list-group-item contact-item d-flex align-items-center" data-id="broadcast">
                  <img src="image/broadcast.webp" style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
                  <span>Broadcast</span>
                </li>
        <li class="list-group-item contact-item d-flex align-items-center"  data-id="0">
          <img src="<?php echo $brand_logo; ?>" 
               style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
          <span><?php echo $brand_name; ?></span>
          
        </li>
        
       
        
        <?php
        $branch_sql = mysqli_query($con, "
            SELECT * FROM user 
            WHERE status = '1' 
              AND id IN (
                  SELECT sender_id FROM messages WHERE receiver_id = '$current_branch_id'
                  UNION
                  SELECT receiver_id FROM messages WHERE sender_id = '$current_branch_id'
              )
            ORDER BY name ASC
        ");
        
        while($row = mysqli_fetch_array($branch_sql)){
        ?>
            <li class="list-group-item contact-item d-flex align-items-center" data-id="<?php echo $row['id']; ?>">
              <img src="<?php echo $web_link.$row['photo']; ?>" 
                   style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
              <span><b><?php echo $row['mobile'] ; ?></b> <br><p style="font_size:14px">(<?php echo $row['mobile']; ?>)</p></span>
              
            </li>
        <?php } ?>


            </ul>
          </div>
          <div class="card-body p-0" id="studentListWrapper" 
         style="display:none; height:calc(80vh - 45px); overflow-y:auto;">
      <ul class="list-group" id="studentList"></ul>
    </div>
        </div>
      </div>

      <div class="col-md-9" id="outer">
        <div class="card card-outline card-info">
            

          <div id="chatWindow" style="display:none;">
            
            <div class="card-header d-flex align-items-center">
                 <button id="backToContacts" class="btn btn-light d-md-none me-2">
                    <i class="fa fa-arrow-left"></i>
                  </button>
              <img id="chatUserImg" src="" 
                   style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
              <h3 class="card-title mb-0" id="chatWith">Chat</h3>
            </div>

            <div class="card-body chat-messages" id="chatMessages">
           
            </div>
            
            <div class="card-footer p-2">
              <form id="chatForm" class="d-flex">
                <input type="text" name="message" id="messageInput" class="form-control me-2" placeholder="Type a message..." autocomplete="off">
                <button type="submit" class="btn btn-info">Send</button>
              </form>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<div class="modal fade" id="broadcastModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Send Broadcast</h5>
        <button type="button" class="btn btn-danger text-white" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      
      <div class="modal-body">
        <div class="form-group mb-3">
          <label>Create Broadcast With</label>
          <select id="broadcastType" class="form-control">
            <option value="">-- Select --</option>
            <option value="course">By Course</option>
            <option value="batch">By Batch</option>
          </select>
        </div>
        
        <div class="row" id="courseSelector" style="display:none;">
          <div class="col-md-12">
              <label>Select Course</label>
              <select name="course_id" id="course_id" class="form-control">
                  <option value="">--Select--</option>
                  <?php
                  $course = mysqli_query($con, "select * from course_details where status='OPEN' order by id");
                  while($row = mysqli_fetch_array($course)){
                  ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                  <?php } ?>
              </select>
          </div>
        </div>
        
        <div class="row" id="batchSelector" style="display:none;">
          <div class="col-md-12">
              <label>Select Batch</label>
              <select name="batch_id" id="batch_id" class="form-control">
                  <option value="">--Select--</option>
                  <?php
                    $batch = mysqli_query($con, "select * from batch_details where branch_id = '$current_branch_id' order by id");
                    while($row = mysqli_fetch_array($batch)){
                  ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>
                  <?php } ?>
              </select>
          </div>
        </div>
        <div class="col-md-12 mt-2">
        <label>Message</label>
        <textarea id="broadcastMessageInput" cols="5" class="form-control mt-2" placeholder="Type message"></textarea>
      </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" id="sendBroadcast" class="btn btn-success">Send</button>
        <button type="button" class="btn btn-danger text-white" id="closeBroadcastModal">Cancel</button>
      </div>
      
    </div>
  </div>
</div>



    
    
    
    
  </div>

  <?php include'footar.php'; ?>
 
  <aside class="control-sidebar control-sidebar-dark">
  
  </aside>

</div>





<!-- jQuery -->
<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
let currentReceiver = null;

$(document).on("click", "#chatContacts .contact-item", function () {
    
    
    currentReceiver = $(this).data("id");
    let userName = $(this).find("span").text();
    let userImg  = $(this).find("img").attr("src");

    $(".contact-item").removeClass("active");
    $(this).addClass("active");

    $("#chatWindow").show();
    $("#chatWith").text(userName);
    $("#chatUserImg").attr("src", userImg);

     if (currentReceiver === "broadcast") {
       
        
         document.getElementById('chatForm').style.display = "none";
       const paragraph = document.getElementById('chatForm');
        paragraph.classList.remove('d-flex');
        loadBroadcastsMessages(function () {
            let chat = $("#chatMessages");
            chat.scrollTop(chat[0].scrollHeight);
        });
    } else {
        $("#chatForm").show();
        const paragraph = document.getElementById('chatForm');
        paragraph.classList.add('d-flex');
        loadMessages(function () {
            let chat = $("#chatMessages");
            chat.scrollTop(chat[0].scrollHeight);
        });
    }

    if (window.innerWidth < 992) {
        $(".col-md-3").hide();
        $(".col-md-9").show();
    }
    
   
});



function loadMessages(callback) {
    let currentBranchId = "<?php echo $current_branch_id; ?>";
    if (currentReceiver === null) return;

    $.ajax({
        url: "get_chat_data",
        method: "GET",
        data: { fetch_messages: 1, receiver_id: currentReceiver },
        success: function(res) {
            if (res.status === "success") {
                let html = "";
                
                res.messages.forEach(msg => {
                    let time = new Date(msg.timestamp).toLocaleString();

                    if (msg.sender_id == currentBranchId) {
                        html += `
                          <div class="chat-message my-message" data-id="${msg.id}" style="display: flex; align-items: flex-start; justify-content: flex-end; margin-bottom: 10px; position: relative;">
                        <div class="chat-bubble sent">
                            <div style="text-align: justify;">${msg.message}</div>
                            <div class="msg-time">${time}</div>
                        </div>
                        <img src="${msg.user_photo}" 
                             style="height:35px; width:35px; border-radius:50%; margin-left:10px; border:1px solid black;">
                              
                    </div>`;
                    } else {
                        html += `
                          <div  style="display: flex; align-items: flex-start; margin-bottom: 10px;">
                         
                          <img src="${msg.user_photo}" 
                               style="height:35px; width:35px; border-radius:50%; margin-right:10px; border:1px solid black;">
                        
                          <div class="chat-bubble received">
                            <div style="text-align: justify;">${msg.message}</div>
                            <div class="msg-time">${time}</div>
                          </div>
                        </div>
                        `;
                    }
                });

                $("#chatMessages").html(html);
                if (callback) callback();
                
            }
        }
    });
}

function loadBroadcastsMessages(callback) {
    if (!currentReceiver) return;
    $.ajax({
        url: "get_chat_data",
        method: "GET",
        data: { fetch_broadcast_messages: 1,},
        success: function(res) {
            if (res.status === "success") {
                let html = "";
                res.messages.forEach(msg => {
                     let time = new Date(msg.timestamp).toLocaleString();
                    if (msg.sender_id != 0) {
                        html += `
                          <div style="display: flex; align-items: flex-start; justify-content: flex-end; margin-bottom: 10px;">
                            <div class="chat-bubble sent">
                              <div style="text-align: justify;">${msg.message}</div>
                              <div class="msg-time">${time}</div>
                            </div>
                            <img src="${msg.user_photo}" 
                                 style="height:35px; width:35px; border-radius:50%; margin-left:10px; border:1px solid black;">
                          </div>`;
                    } else {
                        html += `
                          <div style="display: flex; align-items: flex-start; margin-bottom: 10px;">
                            <img src="${msg.user_photo}" 
                                 style="height:35px; width:35px; border-radius:50%; margin-right:10px; border:1px solid black;">
                            <div class="chat-bubble received">
                              <div style="text-align: justify;">${msg.message}</div>
                              <div class="msg-time">${time}</div>
                            </div>
                          </div>`;
                    }
                });
                $("#chatMessages").html(html);
                if (callback) callback();
            }
        }
    });
}
function loadContacts() {
    $.ajax({
        url: "get_chat_data",
        method: "GET",
        data: { fetch_contact: 1 },
        success: function(res) {
            if (res.status === "success") {
                $("#chatContacts").html(res.html);

                // keep highlight on current user
                if (currentReceiver !== null) {
                    $('#chatContacts .contact-item[data-id="'+currentReceiver+'"]').addClass('active');
                }
                if(currentReceiver == 'broadcast'){
                    loadBroadcastsMessages(function () {
        let chat = $("#chatMessages");
        chat.scrollTop(chat[0].scrollHeight);
    });
                }
            }
        }
    });
}

$("#chatForm").submit(function(e) {
    e.preventDefault();
    let msg = $("#messageInput").val().trim();
    if (msg == "" || currentReceiver === null) return;

    $.ajax({
        url: "get_chat_data",
        method: "GET",
        data: { send_message: 1, receiver_id: currentReceiver, message: msg },
        success: function(res) {
            if (res.status === "success") {
                $("#messageInput").val("");
                
                 loadMessages(function() {
                    let chat = $("#chatMessages");
                    chat.scrollTop(chat[0].scrollHeight);
                });
            }
        }
    });
});

let pressTimer;

$(document).on("touchstart", ".chat-message", function(e) {
    let msgId = $(this).data("id");
    pressTimer = setTimeout(() => {
        showDeleteConfirmation(msgId);
    }, 600); 
}).on("touchend touchmove", ".chat-message", function(e) {
    clearTimeout(pressTimer);
});

$(document).on("contextmenu", ".chat-message", function(e) {
    e.preventDefault(); 
    let msgId = $(this).data("id");
    showDeleteConfirmation(msgId);
});

function showDeleteConfirmation(msgId) {
    Swal.fire({
        title: "Delete this message?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "get_chat_data",
                method: "GET",
                data: { delete_message: 1, message_id: msgId },
                success: function(res) {
                    if (res.status === "success") {
                        $(`.chat-message[data-id="${msgId}"]`).fadeOut(300, function(){ 
                            $(this).remove();
                        });
                        Swal.fire("Deleted!", "Your message has been deleted.", "success");
                    } else {
                        Swal.fire("Error", "Unable to delete message.", "error");
                    }
                }
            });
        }
    });
}




$(document).ready(function() {
    $(".contact-item").click(function() {
        if (window.innerWidth < 992) {
            $(".col-md-3").hide();
            $(".col-md-9").show();
        }
    });

    $("#backToContacts").click(function() {
        $(".col-md-3").show();
        $(".col-md-9").hide();
    });
     loadContacts();
});


setInterval(function() {
    if (currentReceiver === "broadcast") {
        loadBroadcastsMessages();
    } else {
        // loadMessages();
    }
}, 2000);

setInterval(loadContacts, 5000);

</script>
<script>
$(document).ready(function() {
 
  $("#searchBar").on("focus", function() {
    $("#contactListWrapper").hide();
    $("#studentListWrapper").show();
    loadStudents(""); 
  });

  
  $("#searchBar").on("keyup", function() {
    let query = $(this).val();
    if (query.length > 0) {
      loadStudents(query);
    } else {
     
      loadStudents("");
    }
  });


//   $("#searchBar").on("blur", function() {
//     if ($(this).val().trim() === "") {
//       $("#studentListWrapper").hide();
//       $("#contactListWrapper").show();
//     }
//   });

$("#outer").on("click", function() {
    $("#studentListWrapper").hide();
     $("#contactListWrapper").show();
})

function loadStudents(query) {
    $.ajax({
        url: "get_chat_data",
        method: "GET",
        data: { search_students: 1, q: query },
        dataType: "json",
        success: function(res) {
            if (res.status === "success") {
                $("#studentList").html(res.html);
            } else {
                $("#studentList").html(
                    `<li class="list-group-item text-danger">Error loading students</li>`
                );
            }
        },
        error: function() {
            $("#studentList").html(
                `<li class="list-group-item text-danger">Error loading students</li>`
            );
        }
    });
}


  
  $(document).on("click", "#studentList .list-group-item", function() {
    let id = $(this).data("id");
    let name = $(this).find("span").text();
    let img  = $(this).find("img").attr("src");

  
    currentReceiver = id;
    $("#chatWith").text(name);
    $("#chatUserImg").attr("src", img);
    $("#chatWindow").show();
    
    $("#studentListWrapper").hide();
    $("#contactListWrapper").show();
    $("#searchBar").val("");
    loadMessages();
  });
});

</script>
<script>
 

$("#broadcastTarget").change(function() {
    if ($(this).val() === "course") {
        $("#broadcastCourse").show();
    } else {
        $("#broadcastCourse").hide();
    }
});

$("#sendBroadcast").click(function() {
    let batch_id = $("#batch_id").val();
    let course_id = $("#course_id").val() || null;
    let message = $("#broadcastMessageInput").val().trim();
    let branch_id = "<?php echo $current_branch_id; ?>";
    
    if (message === "") return alert("Message cannot be empty");

    $.ajax({
        url: "get_chat_data",
        method: "GET",
        data: { 
            student_broadcast : 1,
            branch_id: branch_id, 
            course_id: course_id, 
            batch_id: batch_id,
           
            message: message 
            
        },
        success: function(res) {
            alert("Broadcast sent!");
            $("#broadcastModal").hide();
            $("#broadcastMessageInput").val("");
            loadContacts(); // refresh chatContacts to show broadcast
        }
    });
});

</script>
<script>
  // Open modal on button click
  $("#createBroadcast").click(function(){
    $("#broadcastModal").modal("show");
  });

  // Toggle course/batch selectors
  $("#broadcastType").change(function(){
    let type = $(this).val();
    if(type === "course"){
      $("#courseSelector").show();
      $("#batchSelector").hide();
    } else if(type === "batch"){
      $("#batchSelector").show();
      $("#courseSelector").hide();
    } else {
      $("#courseSelector, #batchSelector").hide();
    }
  });

  // Close modal on cancel button
  $("#closeBroadcastModal").click(function(){
    $("#broadcastModal").modal("hide");
  });
</script>
</body>
</html>
