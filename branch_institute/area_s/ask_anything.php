<?php
include 'session.php';
if(add_on_check("EduAI") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>EduAI - Ask Anything  |  <?php echo $brand_name; ?></title>
        <!-- Favicons -->
        <link href="<?php echo $brand_logo; ?>" rel="icon">

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots" content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&amp;display=swap" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
        <!-- Material Icons from Google Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/css/preloader.css" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="public/css/app.css" rel="stylesheet">
        
        <style>
        
        .eduAI{
        	background: #157daf !important;
        }
        
        

            .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid {
                max-width: 100%;
            }
            
        .ekko-lightbox-container>div.ekko-lightbox-item {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
        }
        
        .fade:not(.show) {
            opacity: 0;
        }
        .fade {
            transition: opacity .15s linear;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .ekko-lightbox-nav-overlay {
            z-index: 1;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: -ms-flexbox;
            display: flex;
        }
        .ekko-lightbox-nav-overlay a {
            -ms-flex: 1;
            flex: 1;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            opacity: 0;
            transition: opacity .5s;
            color: #fff;
            font-size: 30px;
            z-index: 1;
        }
        .ekko-lightbox-nav-overlay a span {
            padding: 0 30px;
        }
        .ekko-lightbox-nav-overlay a>* {
            -ms-flex-positive: 1;
            flex-grow: 1;
        }
        .modal-content {
            margin-top: 50px;
        }
        [dir=ltr] .container, [dir=ltr] .page__container, [dir=ltr] .container-fluid {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
        }
        .image img {
            border: 1px solid lightgray;
            border-radius: 10px;
            width: 250px;
            height: 180px;
        }
        .image img:hover {
            transform: scale(1.04);
        }
        .image {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        [dir] .card-header {
            background-color: #303956;
        }
        [dir] .card-title {
            color: #ffffff;
        }
        
        [dir] .modal-dialog {
            margin: auto;
        }
        .ekko-lightbox-item img {
            padding: 20px;
        }
 
#chatBox {
  position: relative;
  width: 100%;
  height: 100%;
  overflow-y: auto;
  padding: 10px;
border-radius: 0.5rem;
    
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 14px;
    line-height: 1.5;
  background: url('<?php echo $brand_logo; ?>') no-repeat center center;
  background-size: 200px auto; 
  background-attachment: fixed;
  opacity: 1; 
}

#chatBox::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('<?php echo $brand_logo; ?>') no-repeat center center;
  background-size: 200px auto;
  opacity: 0.2;  
  pointer-events: none; 
  z-index: 0;
}

#chatBox > * {
  position: relative;
  z-index: 1; /* Keeps messages above watermark */
}

  #question {
    border-radius: 0.375rem;
  }

  .card-footer .btn {
    border-radius: 0.375rem;
  }

  #loadingIndicator .spinner-border {
    vertical-align: middle;
  }
 .code-block {
  position: relative;
  background: #1e1e1e;
  color: #d4d4d4;
  padding: 15px;
  border-radius: 8px;
  margin: 10px 0;
  font-family: 'Fira Code', monospace;
  font-size: 14px;
  overflow-x: auto;
}

.code-block button.copy-btn {
  position: absolute;
  top: 8px;
  right: 8px;
  background: #0d6efd;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 2px 6px;
  font-size: 12px;
  cursor: pointer;
}

.code-block button.copy-btn:hover {
  background: #0056b3;
}

.ai-msg, .user-msg {
  margin: 5px 0;
  line-height: 1.5;
  font-size: 16px;
}

.ai-msg b, .user-msg b {
  display: block;
  margin-bottom: 5px;
}
pre {
    display: block;
    font-size: 87.5%;
    color: #ffffff;
}
.chat-msg {
  max-width: 70%;
  padding: 10px 14px;
  border-radius: 15px;
  margin: 8px;
  font-size: 15px;
  line-height: 1.4;
  clear: both;
  word-wrap: break-word;
}

.user-msg {
  background: #007bff;
  color: white;
  float: right;
  border-bottom-right-radius: 5px;
}

.ai-msg {
  background: #f1f0f0;
  color: #333;
  float: left;
  border-bottom-left-radius: 5px;
}

.thinking-msg {
  background: #f1f0f0;
  color: #555;
  font-style: italic;
  padding: 8px 14px;
  border-radius: 15px;
  margin: 8px;
  font-size: 14px;
  float: left;
  border-bottom-left-radius: 5px;
}

.thinking-dots {
  display: inline-block;
  margin-left: 5px;
}

.thinking-dots span {
  height: 6px;
  width: 6px;
  margin: 0 1px;
  background-color: #555;
  border-radius: 50%;
  display: inline-block;
  animation: blink 1.4s infinite both;
}

.thinking-dots span:nth-child(2) { animation-delay: 0.2s; }
.thinking-dots span:nth-child(3) { animation-delay: 0.4s; }

@keyframes blink {
  0% { opacity: 0.2; }
  20% { opacity: 1; }
  100% { opacity: 0.2; }
}

        </style>

    </head>

    <body class="layout-app ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <?php include 'top-navbar.php'; ?>

              

                <div class="page-section bg-white border-bottom-2">

                    <div class="container page__container">
                        
                        
<!-- Main content -->
    <section class="content">
  <div class="col-md-8 mx-auto">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Ask EduAI</h4>
        <button id="resetBtn" class="btn btn-sm btn-light">Reset Chat</button>
      </div>
      <div id="chatBox" class="card-body" style="height:600px; overflow-y:auto; background:#f8f9fa;">
        <!-- Chat messages appear here -->
      </div>
      <div class="card-footer d-flex">
        <textarea id="question" class="form-control me-2" placeholder="Type your question..." autocomplete="off"></textarea>
        <button id="askBtn" class="btn btn-info">Ask</button>
      </div>
      <div id="loadingIndicator" style="display:none; text-align:center; margin:10px 0;">
        <div class="spinner-border text-info" role="status" style="width:25px; height:25px;"></div>
        <div style="font-size:12px; color:#555;">EduAI is thinking...</div>
      </div>
    </div>
  </div>
</section>


    <!-- /.content -->
                        
                        
                    </div>

                </div>

                <?php include 'footer.php'; ?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->

        <!-- jQuery -->
        <script src="public/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="public/vendor/popper.min.js"></script>
        <script src="public/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="public/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="public/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="public/vendor/material-design-kit.js"></script>

        <!-- App JS -->
        <script src="public/js/app.js"></script>

        <!-- Preloader -->
        <script src="public/js/preloader.js"></script>
        
        
        <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>

function escapeHtml(text) {
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;',
  };
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
function renderTextWithInlineCode(text) {
  
  return escapeHtml(text)
    .replace(/``(.*?)``/g, '<code>$1</code>') 
    .replace(/`(.*?)`/g, '<code>$1</code>')   
    .replace(/\n/g, "<br>");
}

const chatBox = document.getElementById("chatBox");
const input   = document.getElementById("question");


async function askGemini() {
  let q = input.value.trim();
  if (!q) return;

  // Show user's question (LEFT)
  chatBox.innerHTML += `
    <div class="chat-msg user-msg">
      ${escapeHtml(q)}
    </div>
    <div style="clear:both;"></div>
  `;
  input.value = "";

  let thinkingBubble = document.createElement("div");
  thinkingBubble.className = "thinking-msg";
  thinkingBubble.id = "thinkingBubble";
  thinkingBubble.innerHTML = `EduAI is thinking <span class="thinking-dots">
    <span></span><span></span><span></span>
  </span>`;
  chatBox.appendChild(thinkingBubble);
  chatBox.innerHTML += `<div style="clear:both;"></div>`;
  chatBox.scrollTop = chatBox.scrollHeight;

  $.ajax({
    url: "ask_anything_api.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({ question: q }),
    success: function(data) {
     
      let tb = document.getElementById("thinkingBubble");
      if (tb) tb.remove();

      if (data.status === "success") {
        let parts = data.answer.split(/```/); 

        let container = document.createElement("div");
        container.className = "chat-msg ai-msg";

        parts.forEach((part, i) => {
          if (i % 2 === 0) {
            let p = document.createElement("p");
            p.style.margin = "5px 0";
            p.innerHTML = renderTextWithInlineCode(part);
            container.appendChild(p);
          } else {
            let codeDiv = createCodeBlock(part.trim());
            container.appendChild(codeDiv);
          }
        });

        chatBox.appendChild(container);
      } else {
        chatBox.innerHTML += `
          <div class="chat-msg ai-msg">Error: ${data.message}</div>
          <div style="clear:both;"></div>
        `;
      }
      chatBox.innerHTML += `<div style="clear:both;"></div>`;
      chatBox.scrollTop = chatBox.scrollHeight;
    },
    error: function(err) {
      let tb = document.getElementById("thinkingBubble");
      if (tb) tb.remove();

      chatBox.innerHTML += `
        <div class="chat-msg ai-msg">Network error. Try again.</div>
        <div style="clear:both;"></div>
      `;
      chatBox.scrollTop = chatBox.scrollHeight;
    }
  });
}

function createCodeBlock(code) {
  const div = document.createElement("div");
  div.className = "code-block";

  const button = document.createElement("button");
  button.className = "copy-btn";
  button.innerText = "Copy";
  button.onclick = () => {
    navigator.clipboard.writeText(code).then(() => {
      button.innerText = "Copied!";
      setTimeout(() => button.innerText = "Copy", 1500);
    });
  };

  const pre = document.createElement("pre");
  pre.textContent = code;

  div.appendChild(button);
  div.appendChild(pre);
  return div;
}

async function resetChat() {
  await fetch("ask_anything_api.php", {
    method:"POST",
    headers:{ "Content-Type":"application/json" },
    body: JSON.stringify({ reset:true })
  });
  chatBox.innerHTML = "";
}

document.getElementById("askBtn").onclick = askGemini;
document.getElementById("resetBtn").onclick = resetChat;
input.addEventListener("keydown", e => { if(e.key==="Enter") askGemini(); });
</script>

    </body>

</html>