(function ($, is_modal_open, open_tab) {
    var token_field = $('#form_token');
    const getToken = () => {
        return token_field.val();
    }

    const setToken = (token) => {
        token_field.val(token);
    }

    if(is_modal_open){
        var modal = new bootstrap.Modal(document.getElementById('authmodal'), {});
        modal.show();

        document.getElementById(open_tab).click();
    }

    const setErrorDiv = (ref) => {
        ref.find('#form_info').removeClass('alert-success d-none');
        if (ref.find('#form_info').hasClass('alert-danger')) return;
        ref.find('#form_info').addClass('alert-danger');
    }
    const setErrors = (errors, ref) => {

        setErrorDiv(ref);

        let msg = [];
        for (const key in errors) {
            msg.push(errors[key]);
        }
        ref.find('#form_info').html(msg.join('<br>'));
    }

    const setError = (error, ref) => {
        setErrorDiv(ref);
        ref.find('#form_info').html(error);
    }

    const setMessage = (msg, ref) => {

        ref.find('#form_info').removeClass('alert-danger d-none').addClass('alert-success').html(msg);
    }

    const resetErrors = (ref) => {
        ref.find('#form_info').addClass('d-none').html('');
    }

    const runResponseChecks = (obj, __ref) => {

        if ('token' in obj) setToken(obj.token);

        if ('errors' in obj) setErrors(obj.errors, __ref);

        if ('error' in obj) setError(obj.error, __ref);

        if ('msg' in obj) setMessage(obj.msg, __ref);

        if ('redirect' in obj) window.location.href = obj.redirect;

    }

    const makeRequest = (__ref, btnText) => {

        resetErrors(__ref);

        __ref.addClass('pe-none').find('[type="submit"]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        $.ajax({
            url: __ref.attr('action'),
            type: 'POST',
            data: __ref.serialize(),
            headers: {
                'X-CSRF-TOKEN': getToken()
            },
            success: function (response) {

                if (typeof response != 'object') return;

                runResponseChecks(response, __ref);

                __ref.removeClass('pe-none').find('[type="submit"]').html(btnText);

            },

            error : function(xhr, status, errorthrown){
                let error_obj = {
                    errors : ['Please refresh the page, Try again',status+' : '+errorthrown, 'If error not resolve please contact on <b>support@examjila.com</b>'],
                };

                runResponseChecks(error_obj, __ref);
                __ref.removeClass('pe-none').find('[type="submit"]').html(btnText);


            }
        })
    }

    $('#signupform').on('submit', function (e) {

        e.preventDefault();

        let __ref = $(this);

        makeRequest(__ref, 'Create Account');


    });

    $('#loginform').on('submit', function (e) {

        e.preventDefault();

        let __ref = $(this);

        makeRequest(__ref, 'Login');

    });

    $('#open_signup_tab').on('click', function(){
        document.getElementById('signup_tab_btn').click();
    });

    $('#open_login_tab').on('click', function(){
        document.getElementById('login_tab_btn').click();
    });

    $('body').on('submit','#newsletter_form', function(e){
        e.preventDefault();
        let dd = $(this);

        dd.find('[type="submit"]').attr('disabled', 'disabled').html('Processing..');
        $.ajax({
          type : 'POST',
          url : '/subscribe',
          data : $(this).serialize(),
          headers: {
            'X-CSRF-TOKEN': getToken()
        },
          success : function(res){
            setToken(res.token);
            dd.find('[type="submit"]').removeAttr('disabled').html('Subscribe');
            alert(res.msg)
            if(res.status == 'success'){
                dd.trigger('reset');
            }
          },
          error : function(x, xhr, status){
            console.error(x + xhr + status);
            alert('Some error occured');
          }
        })
      })

})(jQuery, openAuthModal, openDefaultTab);