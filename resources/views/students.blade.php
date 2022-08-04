<html>

<body>
    <a href="/add-student" style="float: right;font-style: bold;color:blue">ADD STUDENT</a><br />
    <a href="/add-marks" style="float: right;font-style: bold;color:blue">ADD MARKS</a><br />
    <a href="/marks" style="float: right;font-style: bold;color:blue">VIEW MARKS</a>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif
    <h1>View Students</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Reporting Teacher</th>
            <th>Actions</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td align="center">{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td align="center">{{$student->age}}</td>
            <td align="center">{{$student->gender}}</td>
            <td align="center">{{$student->teacher_name}}</td>
            <td align="center"><a href="/edit-student/{{$student->id}}">Edit</a>|<a href="/delete-student/{{$student->id}}">Delete</a></td>
        </tr>
        @endforeach
    </table>
</body>

</html>