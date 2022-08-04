<html>

<head>
    <style>
        .alert-danger {
            color: red;
        }

        .alert-success {
            color: green;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }

        input[type=submit] {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }

        form {
            border: 1px solid;
            width: 50%;
            padding: 10px;
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <a href="/marks" style="float: right;font-style: bold;color:blue">VIEW MARKS</a><br />
    <h1>Add Marks</h1>
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

    <form method="POST" action="{{ url('update-mark', $mark->id) }}">
        @csrf

        <label for="student">Student</label>

        <select name="student">
            <option value="">--Select--</option>
            @foreach ($students as $student)
            <option value="{{$student->id}}" @if($mark->student_id==$student->id) selected @endif>{{$student->name}}</option>
            @endforeach
        </select>

        @error('student')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <label for="maths">Maths Mark</label>

        <input id="maths" type="text" name="maths" class="@error('maths') is-invalid @enderror" value={{ $mark->maths }}>

        @error('maths')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />

        <br />
        <label for="science">Science Mark</label>

        <input id="science" type="text" name="science" class="@error('science') is-invalid @enderror" value={{ $mark->science }}>

        @error('science')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />

        <br />
        <label for="history">History Mark</label>

        <input id="history" type="text" name="history" class="@error('history') is-invalid @enderror" value={{ $mark->history }}>

        @error('history')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />

        <label for="term">Term</label>

        <input type="radio" name="term" class="@error('term') is-invalid @enderror" value="1" @if($mark->term=='1' ) checked @endif> One
        <input type="radio" name="term" class="@error('term') is-invalid @enderror" value="2" @if($mark->term=='2' ) checked @endif> Two

        @error('term')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>