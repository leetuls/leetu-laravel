$('#search').click(function () {
    let url = $('#url_hidden').val();
    studentSearchResult(1, url, 'GET', 'search');
});

$('#clear-search').click(function () {
    $('#name-search-input').val('');
    $('#date-search-input').val('');
    $('#date-search-input').attr('type', 'text');
    $('#class-search-input').val('');
    $('#student-id-input').val('');
    $('#gender-search-input').val('');
});

$('#date-search-input').focus(function () {
    $('#date-search-input').attr('type', 'date');
});

if (window.location.href.includes("/students")) {
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let url = $('#url_hidden').val();
        studentSearchResult(page, url, 'GET', 'search');
    });
}

$('#add-new').click(function () {
    $.ajax({
        url: "students/create",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#student-content').html(data.html);
        },
        error: function (data) {
            if (data.status == '403') {
                alert('Bạn không có quyền thao tác này!');
            }
        }
    });
});

var countStudent = $('#count_student').val();
this.applyActionEditStudents(countStudent);

function applyActionEditStudents(countStudent) {
    for (let i = 1; i <= countStudent; i++) {
        $(document).on('click', '.student-edit' + i, function (event) {
            let autoID = $('.auto_id' + i).val();
            $.ajax({
                url: "students/edit",
                method: 'GET',
                data: { 'auto_id': autoID },
                dataType: 'json',
                success: function (data) {
                    $('#student-content').html(data.html);
                },
                error: function (data) {
                    if (data.status == '403') {
                        alert('Bạn không có quyền thao tác này!');
                    }
                }
            });
        });
        $(document).on('click', '.student-delete' + i, function (event) {
            let autoID = $('.auto_id' + i).val();
            if (!confirm('Xóa học sinh này?')) {
                event.preventDefault();
            }
        });
    };
}

$('#export-excel').click(function () {
    let url = $('#url_hidden_excel').val();
    studentSearchResult(1, url, 'POST', 'excel');
});

$('#export-pdf').click(function () {
    let url = $('#url_hidden_pdf').val();
    exportPdf(1, url, 'POST');
});

function studentSearchResult(page = "", url, method, type) {
    let data = this._prepareDataInput(page);
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json',
        success: function (data) {
            if (type === 'search') {
                $('#paging-student').empty();
                $('#paging-student').html(data.html);
            } else if (type === 'excel') {
                var a = document.createElement("a");
                a.href = data.file;
                a.download = data.name;
                document.body.appendChild(a);
                a.click();
                a.remove();
            }
        },
        error: function (data) {
            if (data.status == '403') {
                alert('Bạn không có quyền thao tác này!');
            }
        }
    });
}

function exportPdf(page = "", url, method) {
    let data = this._prepareDataInput(page);
    $.ajax({
        url: url,
        method: method,
        data: data,
        xhrFields: {
            responseType: 'blob'
        },
        success: function (data) {
            let blop = new Blob([data]);
            let a = document.createElement('a');
            a.href = window.URL.createObjectURL(blop);
            a.download = 'students.pdf';
            a.click();
            a.remove();
        },
        error: function (data) {
            if (data.status == '403') {
                alert('Bạn không có quyền thao tác này!');
            }
        }
    });
}

function _prepareDataInput(page) {
    let data = {};
    let name = $('#name-search-input').val();
    let dateOfBirth = $('#date-search-input').val();
    let studentClass = $('#class-search-input').val();
    let studentId = $('#student-id-input').val();
    let gender = $('#gender-search-input').val();
    let token = $('#token').val();
    data = {
        'student_id': studentId,
        'name': name,
        'dateOfBirth': dateOfBirth,
        'studentClass': studentClass,
        'gender': gender,
        'page': page,
        '_token': token
    };
    return data;
}