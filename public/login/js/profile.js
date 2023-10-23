function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});

$(document).ready(function () {
    let url = $("#image_hidden").val();
    $('#imagePreview').css('background-image', 'url(' + url + ')');
});

$('#re_pw').click(function () {
    let url = $('#change_password').val();
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            $('#pw_content').html(response.html);
        }
    });
});