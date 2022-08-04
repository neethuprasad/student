<html>

<body>
    <a href="/add-student" style="float: right;font-style: bold;color:blue">ADD STUDENT</a><br />
    <a href="/add-marks" style="float: right;font-style: bold;color:blue">ADD MARKS</a><br />
    <a href="/students" style="float: right;font-style: bold;color:blue">VIEW STUDENT</a><br />
    <h1>Student Marks</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Maths</th>
            <th>Science</th>
            <th>History</th>
            <th>Term</th>
            <th>Total Marks</th>
            <th>Created On</th>
            <th>Actions</th>
        </tr>
        @foreach ($marks as $mark)
        <tr>
            <td align="center">{{$mark->id}}</td>
            <td>{{$mark->name}}</td>
            <td align="center">{{$mark->maths}}</td>
            <td align="center">{{$mark->science}}</td>
            <td align="center">{{$mark->history}}</td>
            <td align="center">{{ $mark->term == 1 ? "One" : "Two"}}</td>
            <td align="center">{{$mark->total_marks}}</td>
            <td align="center">{{\Carbon\Carbon::parse($mark->created_at)->format('F j, Y g i A')}}</td>
            <td align="center"><a href="/edit-mark/{{$mark->id}}">Edit</a>|<a href="/delete-mark/{{$mark->id}}">Delete</a></td>
        </tr>
        @endforeach
    </table>
</body>

</html>