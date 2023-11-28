function toggleResetPswd(e) {
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
};

function toggleSignUp(e) {
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
};

$(() => {
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
});

$('.google-btn').click(function () {
    let url = $('#google_url').val();
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            window.location.replace(data);
        },
        error: function (data) {
            if (data.status == '403') {
                alert('Bạn không có quyền thao tác này!');
            }
        }
    });
});

$('.facebook-btn').click(function () {
    let url = $('#facebook_url').val();
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            window.location.replace(data);
        },
        error: function (data) {
            if (data.status == '403') {
                alert('Bạn không có quyền thao tác này!');
            }
        }
    });
});

$('.form-signin').on("submit", function (event, FormData) {

});