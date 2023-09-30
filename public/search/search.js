$('#search').click(function () {
    studentSearchResult();
    function studentSearchResult() {
        let name = $('#name-search-input').val();
        let dateOfBirth = $('#date-search-input').val();
        let studentClass = $('#class-search-input').val();
        let url = $('#url_hidden').val();
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                'name': name,
                'dateOfBirth': dateOfBirth,
                'studentClass': studentClass
            },
            dataType: 'json',
            success: function (data) {
                $('#table_search').empty();
                $('#table_search').html(data.html);
            }
        });
    }
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