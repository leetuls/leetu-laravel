<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    table, th, td {
        font-family: DejaVu Sans !important;
        font-size: 10px;
        border: 1px solid black !important;
    };
</style>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <table class="table table-success">
        <thead style="background-color: #04AA6D;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Mã học sinh</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Ngày sinh</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Lớp</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sudentList as $student)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$student->student_id}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->date_of_birth}}</td>
                <td>{{$student->gender}}</td>
                <td>{{$student->class_name}}</td>
                <td>{{$student->address}}</td>
                <td>{{$student->student_phone}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>