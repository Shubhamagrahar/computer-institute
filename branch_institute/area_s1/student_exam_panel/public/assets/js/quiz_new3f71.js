var question_no = 1;
var errors = {
    'TOKEN_ERROR': { title: 'Token Error', text: 'Invalid csrf token ! Try again' },
    'COURSE_ERROR': { title: 'Course Error', text: 'You have not enrolled in this course, So you cannot give the test' },
    'QUESTION_ERROR': { title: 'Question Error', text: 'Select at least one question' },
    'WRONG': { title: 'Something Went Wrong', text: 'Something goes wrong try again ! if problem exist again please contact on 7607418817' }
}
$('body').on('click', '.__submit_btn', function () {

    let visible_slide = $('.mcq_slide:visible');
    let elem = visible_slide.hide().next();
    if(elem.hasClass('mcq_slide')){
        let active_slide_id = visible_slide.hide().next().show().attr('id').replace('id_', '');

        if(!$("[data-jumpto='" + active_slide_id + "']").hasClass('btn-success')){
            $("[data-jumpto='" + active_slide_id + "']").addClass('btn-warning').removeClass('btn-danger');
        }
        
    }else{
        visible_slide.hide();
        let first_slide = document.body.querySelector('.mcq_slide');
        first_slide.style.display= 'block';
        if(!$("[data-jumpto='" + first_slide.getAttribute('id').replace('id_', '') + "']").hasClass('btn-success')){
            $('._jump_to').removeClass('btn-warning').addClass('btn-danger');
            $("[data-jumpto='" + first_slide.getAttribute('id').replace('id_', '') + "']").addClass('btn-warning').removeClass('btn-danger').focus();
        }
        question_no = 0;
    }

    let ids = visible_slide.attr('id').replace('id_', '');
    
    //checking if any option checked
    if (visible_slide.find('input:checked').length > 0) {
        $("[data-jumpto='" + ids + "']").addClass('btn-success').removeClass('btn-danger').removeClass('btn-warning');
    } else {
        $("[data-jumpto='" + ids + "']").addClass('btn-danger').removeClass('btn-success').removeClass('btn-warning');
    }

    question_no++;

    update();


})

$('body').on('click', '.__reset_btn', function () {

    let visible_slide = $('.mcq_slide:visible');
    visible_slide.find('input').prop('checked', false);

    let ids = visible_slide.attr('id').replace('id_', '');

    $("[data-jumpto='" + ids + "']").addClass('btn-warning').removeClass('btn-success').removeClass('btn-danger').focus();

    update();

})

$('body').on('click', '._jump_to', function () {
    if(!$(this).hasClass('btn-success')){
        $('._jump_to').removeClass('btn-warning').addClass('btn-danger');
        $(this).addClass('btn-warning').removeClass('btn-danger');
    }
    let visible_slide = $('.mcq_slide:visible');
    let jump_slide_no = $(this).data('jumpto');
    visible_slide.hide();

    $('#id_' + jump_slide_no).show();
    question_no = $(this).text();


    update();

});

$('body').on('click', '.mcq_slide:visible input', function () {

    if ($(this).is(':checked')) {
        let visible_slide = $('.mcq_slide:visible');
        let ids = visible_slide.attr('id').replace('id_', '');

        $("[data-jumpto='" + ids + "']").addClass('btn-success').removeClass('btn-danger').removeClass('btn-warning');
    }

    update();

});

function update() {
    $('.question_no').text(question_no);
    let attempted = $('.q-btn.btn-success').length;
    $('.attempted').text(attempted);
    $('.n_attempted').text(total_questions - attempted);
}

function errorHandler(jsonObj) {

    Swal.fire({
        icon: "error",
        title: jsonObj.title,
        text: jsonObj.text,
    });

    return;

}

function finish_exam() {

    $('#finish_exam').attr('disabled', 'disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);

    var mcq_data = $('#mcq_form').serialize();

    window.localStorage.setItem('__examjila_candidate_test_data', mcq_data);

    $.ajax({
        url: BASE_URL + '/test/submit',
        type: 'POST',
        data: mcq_data,
        success: function (response) {

            if (response.includes('SUCCESS')) {
                Swal.fire({
                    icon: "success",
                    title: "Submitted !!",
                    text: "Test Submitted Successfully ! Redirecting...",
                });

                if(response.includes('REDIRECT')){
                    setTimeout(function () { window.location.href = BASE_URL+'old-paper/report' }, 2000);
                    return ;
                }

                setTimeout(function () { window.location.href = BASE_URL }, 2000);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error !!",
                    text: response,
                });
                // alert(response);
            }

            $('#finish_exam').removeAttr('disabled').html('Finish');
        }
    })

}
$('body').on('click', '#finish_exam', function () {

    let checkIfSelectedAny = $('.q_input:checked').length;

    if (checkIfSelectedAny === 0) {
        errorHandler({ title: 'Question Error', text: 'Attempt at least one question' });
        return;
    }
    finish_exam();


});

function convertSecondsToHMS(seconds) {
    if (seconds < 0) {
        return 0;
    }

    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;

    return {
        hours: hours,
        minutes: minutes,
        seconds: remainingSeconds
    };
}

function startTimer(seconds, callback = false) {
    const timerElement = document.getElementById('time_remaining');
    let remainingTime = seconds;

    function updateTimer() {
        const timeObj = convertSecondsToHMS(remainingTime);
        const hours = timeObj.hours.toString().padStart(2, '0');
        const minutes = timeObj.minutes.toString().padStart(2, '0');
        const seconds = timeObj.seconds.toString().padStart(2, '0');
        timerElement.textContent = `${hours}:${minutes}:${seconds}`;

        if (remainingTime > 0) {
            remainingTime--;
            if(callback && typeof callback =='function'){
                callback(remainingTime);
            }
            setTimeout(updateTimer, 1000);
        } else {
            finish_exam();
            timerElement.textContent = 'Timer Expired!';
        }
    }

    updateTimer();
}

document.body.oncontextmenu = function () {
    return false;
};
document.addEventListener("keydown", function (donotallow) {
    if (donotallow.ctrlKey) {
        donotallow.preventDefault();
    }
});

document.addEventListener("keyup", function (e) {
    var keyCode = e.keyCode ? e.keyCode : e.which;
    if (keyCode == 44) {
        stopPrntScr();
    }
});
function stopPrntScr() {

    var inpFld = document.createElement("input");
    inpFld.setAttribute("value", ".");
    inpFld.setAttribute("width", "0");
    inpFld.style.height = "0px";
    inpFld.style.width = "0px";
    inpFld.style.border = "0px";
    document.body.appendChild(inpFld);
    inpFld.select();
    document.execCommand("copy");
    inpFld.remove(inpFld);
}
function AccessClipboardData() {
    try {
        window.clipboardData.setData('text', "Access   Restricted");
    } catch (err) {
    }
}
setInterval("AccessClipboardData()", 300);


setInterval(function () {
    $.ajax({
        type: 'GET',
        url: BASE_URL+'/refresh',
        data: {
            token_uri__interface: 'eee44bbjnqw0lmoXyEo.mFedfg$&kkklllqqq',
        },
        success: function (data) {
            if (data) {
                // alert(data);
            }
        }
    })
}, 40000);