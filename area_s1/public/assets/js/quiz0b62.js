// A small library for handling quiz

var __ref_item = $(".carousel-item");
var __ref_btns = $(".quick-btn");
var __ref_selected = $('body .checked-pr');
var viewed_item = [];
var seen_item = [];
var attempt_item = [];
var not_attempt_item = [];
var rel_att = [];
var a_ttempt = 0;
var atte = [];
var audio = null;
//Global event listener START =>********
$("label").on("click", function () {
  var class_name = $(this).attr("class").match(/ref_\w+/)[0];
  if ($(this).hasClass("form-check-label")) {
    return;
  }
  var __ref = $(this);
  $("." + class_name).each(function () {
    if ($(this).parent().hasClass("checked-pr")) {
      $(this).parent().removeClass("checked-pr bg-success text-white");
    }
  });

  __ref.parent().addClass("checked-pr bg-success text-white");

  attempt();
});

$("input[type='radio']").on("click", function () {
  var class_name = $(this).attr("class").match(/ref_\w+/)[0];
  var refer = $(this).parent().parent().data('radio-id');
//   enable_checkbox(refer);
  var __ref = $(this);
  $("." + class_name).each(function () {
    if ($(this).parent().parent().hasClass("checked-pr")) {
      $(this).parent().parent().removeClass("checked-pr");
    }
  });

  __ref.parent().parent().addClass("checked-pr");
  attempt();
});

$(".quick-btn").on("click", function () {
  let jump_slide = $(this).data("bs-slide-to");
  next_question(jump_slide);
});

$("#next").on("click", function () {
  $(this).attr("disabled", "disabled");
  setTimeout(function () {
    next_question();
    $("#next").removeAttr("disabled");
  }, 800);
});

$("#prev").on("click", function () {
  $(this).attr("disabled", "disabled");
  setTimeout(function () {
    previous_question();
    $("#prev").removeAttr("disabled");
  }, 800);
});

$("input[type='checkbox']").on("change", function () {
  if ($(this).is(":checked")) {
    rel_att.push(parseInt($(this).val()));
  } else {
    const index = rel_att.indexOf(parseInt($(this).val()));
    if (index > -1) {
      rel_att.splice(index, 1);
    }
  }

  review_later();

});
//Global event listener END =>*/*/*/*/*/*/*/*

var question_count = $("#count_slide");
var question_counter = 1;
// var total_question = 8;

function next_question(jump_to = null) {
  // submit_quiz();
  if (jump_to != null) question_counter = jump_to;
  if (question_counter >= total_question) {
    add_submit_quiz_button();
    question_counter = 1;
  } else {
    question_counter++;
  }

  question_count.text(question_counter);

  //handler for multiple function calling
  quiz_handler();
}

function previous_question() {
  if (question_counter <= 1) {
    question_counter = total_question;
    add_submit_quiz_button();
  } else {
    question_counter--;
  }
  question_count.text(question_counter);

  //handler for multiple function calling
  quiz_handler();
}
//if back button pressed
window.addEventListener( "pageshow",function ( event ) {
  var historyTraversal = event.persisted || 
  ( typeof window.performance != "undefined" && 
  window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
  // Handle page restore.
  // $("#questions").trigger("reset");
  window.location.reload();
  }});
//if back button pressed END
function quiz_handler() {
  // attempt();
  // review_later();
  not_attempt();
  not_seen();
  list_not_visited();
}

function list_not_visited() {
  let not_visited = 0;
  __ref_btns.each(function () {
    if (seen_item.includes($(this).data("qid")) != true && !$(this).hasClass('bg-success')) {
      $(this).addClass("bg-warning");
      not_visited++;
    } else {
      $(this).removeClass("bg-warning");
    }
  });

  $("#q_n_seen").text(not_visited);
}
//All function are calling in real time


function not_attempt() {
  let n_attempt = 0;
  __ref_btns.each(function () {
    if(!$(this).hasClass('bg-success') && !$(this).hasClass('rl-btn') && seen_item.includes($(this).data('qid'))){
      $(this).addClass('bg-danger');
      n_attempt++;
    }
  });

  $("#q_n_attempt").text(n_attempt);
}

function not_seen() {
  //color: warning
  __ref_item.each(function () {
    var qid = $(this).data("qid");
    if ($(this).hasClass("active") && seen_item.includes(qid) != true) {
      seen_item.push(qid);
      // console.log(qid);
    }
  });
}

function attempt(){
  $('.checked-pr').each(function(){
      if(!atte.includes($(this).data('radio-id')))
          atte.push($(this).data('radio-id'));
  });


    review_later();

}
function review_later() {
  //color: info
var rl = 0;
var a_ttempt = 0;

  __ref_btns.each(function(){
    $(this).removeClass('bg-success bg-danger rl-btn');
    let d_id = $(this).data('qid');
    // console.log(d_id);

    if(atte.includes(d_id) && rel_att.includes(d_id)){
      // console.log(d_id);
      $(this).removeClass('bg-warning');
        $(this).addClass('rl-btn');
        rl++;
        a_ttempt++;
    }else if(atte.includes(d_id) && !rel_att.includes(d_id)){
      $(this).removeClass('bg-warning');
      $(this).addClass('bg-success');
      a_ttempt++;
    }

  });

  not_attempt();
  $("#q_attempt").text(a_ttempt);
  $("#q_r_later").text(rl);

}

function enable_checkbox(ref){
  $("input[type='checkbox']").each(function(){
    if(ref==$(this).val()){
      $(this).removeAttr('disabled');
    }
  })
}

function calculate_marks_of_tests(){
  var loading_code_before = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing....`;
  var loading_code_after = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading Result....`;

  $('#calculate_marks').attr('disabled','disabled');
  $('#calculate_marks').html(loading_code_before);

  
  
  var token = document.querySelector('input[name="csrf_token"]').value;
  var formData = new FormData(document.getElementById('test_form'));

  clearInterval(s);

  $.ajax({
    type:'POST',
    url : req_url,
    data : formData,
    contentType :false,
    cache : false,
    processData : false,
    headers : {
      'X-CSRF-TOKEN' : token
    },
    success:function(data){

      if(data.status == 'success'){
        $('#calculate_marks').html(loading_code_after);
        // window.location.href = data.redirect;
       
        setTimeout(() => {

        $('#main-body').html(data.response);
        


        if(data.grade != 'F'){
        setupAudioInterface();  
        setTimeout(function(){

          celebrate(audio);

        },1000);

      }

      (adsbygoogle = window.adsbygoogle || []).push({});

      document.getElementById('main-body').scrollIntoView();


        },500);


      }else{
        document.querySelector('input[name="csrf_token"]').value = data.token;
        $('#calculate_marks').removeAttr('disabled');
        $('#calculate_marks').html('Submit');
        alert(data.msg);
      }
    }
  });
 
}

$('body').on('click','#calculate_marks',function(){
 
  
  if(confirm('Are you want to sure submit the test')){
      if(rel_att.length > 0){
        if(confirm(`You have ${rel_att.length} Question for review. Do you want to Review the question`)){
            return false;
        }else{
      
          calculate_marks_of_tests();
        }
      }else{
        
        calculate_marks_of_tests();
      }
  }

});


function add_submit_quiz_button(priority='LOW'){ //for future use
  let mybtn = `<button style="line-height:1" class="btn btn-warning btn-sm" id="calculate_marks">Submit</button>`;

  $('#next').replaceWith(mybtn);
}

var s = null;

function startTest(){
  document.getElementById('__ini__').value = Math.floor(Date.now() / 1000);
  var time = TIME_FOR_TEST;
  var min=Math.floor(time/60);var sec=time%60;
  s = setInterval(function(e){
  if(time==0){
  add_submit_quiz_button();
  calculate_marks_of_tests();
  clearInterval(s);
  }else{if(sec<=60){
  if(sec==0){
  sec=59;min--;}
  document.getElementById("showtime").innerHTML= `<span class="text-blue fw-bold bg-light rounded-1 fs-5 p-2 me-2">00</span><span class="fw-bold text-blue bg-light rounded-1 fs-5 p-2 me-2">${min}</span><span class="fw-bold text-blue bg-light rounded-1 fs-5 p-2 me-2">${sec}</span>`;
  sec--;}}time--;},1000);}

  if(typeof TIMER_STOP == 'undefined'){
    startTest();
  }
//handling correct question

$('#ready__').on('click',function(){

  let user_name = $('#input_name__').val();

  if(user_name.trim() == ''){
    $('#input_name__').addClass('border border-danger');
    return;
  }

  $('#stu_name').val(user_name);

  STARTUP_MODAL.hide();

  startTest();
});

quiz_handler();

function celebrate(__Source) {
  
  const duration = 3 * 1000,
  animationEnd = Date.now() + duration,
  defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

function randomInRange(min, max) {
  return Math.random() * (max - min) + min;
}

const interval = setInterval(function() {
  const timeLeft = animationEnd - Date.now();

  if (timeLeft <= 0) {
    return clearInterval(interval);
  }

  const particleCount = 50 * (timeLeft / duration);

  // since particles fall down, start a bit higher than random
  confetti(
    Object.assign({}, defaults, {
      particleCount,
      origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
    })
  );
  confetti(
    Object.assign({}, defaults, {
      particleCount,
      origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
    })
  );
}, 250);


__Source.play();

setTimeout(() => {

  __Source.pause();

},7000);

}

function setupAudioInterface(){
  audio = document.getElementById('audio_interface');
}