$('#search').click(function () {
    studentSearchResult(1);
});

$('#clear-search').click(function () {
    $('#name-search-input').val('');
    $('#date-search-input').val('');
    $('#class-search-input').val('');
    $('#student-id-input').val('');
});

$('#date-search-input').focus(function () {
    $('#date-search-input').attr('type', 'date');
});

$(document).on('click', '.page-link', function (event) {
    event.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    studentSearchResult(page);
});

$('#add-new').click(function () {
    $.ajax({
        url: "students/create",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#student-content').html(data.html);
        }
    });
});

function studentSearchResult(page = "") {
    let name = $('#name-search-input').val();
    let dateOfBirth = $('#date-search-input').val();
    let studentClass = $('#class-search-input').val();
    let studentId = $('#student-id-input').val();
    let url = $('#url_hidden').val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {
            'student_id': studentId,
            'name': name,
            'dateOfBirth': dateOfBirth,
            'studentClass': studentClass,
            'page': page
        },
        dataType: 'json',
        success: function (data) {
            $('#paging-student').empty();
            $('#paging-student').html(data.html);
        }
    });
}