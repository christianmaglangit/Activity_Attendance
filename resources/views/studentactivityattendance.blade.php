<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success w-100">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="{{route('home')}}"><img id="mainlogo" class="h-25 w-25"src="images/ccs.png"></a>
            <a class="navbar-brand" href="{{route('home')}}">Activity Attendance Monitoring System</a>  
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('addstudent')}}">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('addactivity')}}">Add Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('studentlist')}}">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('activityAttendanceList')}}">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form id="activityForm" action="{{ route('studentAttendanceList') }}" method="POST">
    @csrf
    <label for="activityname" style="font-size:15px;">Activity Name:</label>
    <select class="form-control w-50" style="font-size:15px;" id="activityname" name="activityname" onchange="this.form.submit()">
        @foreach($activityNames as $activityName)
            <option value="{{ $activityName }}">{{ $activityName }}</option>
        @endforeach
    </select>
</form>

    <div id="activityInfo">
    <table class="table table-striped mt-3">
    <thead class="tableHead">
        <tr>
            <th>ID Number</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>College Department</th>
        </tr>
    </thead>
    <tbody>
    @foreach($studentlist as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{$student->course}}</td>
        <td>{{$student->yearlevel}}</td>
        <td>{{$student->collegedep}}</td>
    </tr>      
    @endforeach
</tbody>
</table>

    </div>
    <script>
        function submitForm() {
            document.getElementById('activityForm').submit();
        }
    </script>
</select>
</body>
</html>