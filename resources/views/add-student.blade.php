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

        input[type=number] {
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
    <a href="/students" style="float: right;font-style: bold;color:blue">VIEW STUDENT</a><br />
    <h1>Add Student</h1>
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
    <form method="POST" action="{{ url('add-student') }}">
        @csrf

        <label for="name">Name</label>

        <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror" value={{ old('name') }}>

        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <label for="age">Age</label>

        <input id="age" type="number" name="age" class="@error('age') is-invalid @enderror" value={{ old('age') }}>

        @error('age')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <label for="gender">Gender</label>

        <input type="radio" name="gender" class="@error('gender') is-invalid @enderror" value="M" @if(old('gender')=='M' ) checked @endif> Male
        <input type="radio" name="gender" class="@error('gender') is-invalid @enderror" value="F" @if(old('gender')=='F' ) checked @endif> Female

        @error('gender')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <label for="teacher">Reporting Teacher</label>

        <select name="teacher">
            <option value="">--Select--</option>
            @foreach ($teachers as $teacher)
            <option value="{{$teacher->id}}" @if(old('teacher')==$teacher->id) selected @endif>{{$teacher->name}}</option>
            @endforeach
        </select>

        @error('teacher')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>