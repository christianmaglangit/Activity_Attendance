<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/addstudent.css">
    <link rel="icon" href="images/ccs.png">
    <title>College of Computer Studies</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success w-100">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="{{route('home')}}"><img id="mainlogo" src="images/ccs.png"></a>
            <a class="navbar-brand" href="{{route('home')}}">College of Computer Studies</a>  
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('addstudent') ? 'active' : '' }}" href="{{route('addstudent')}}">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('addactivity') ? 'active' : '' }}" href="{{route('addactivity')}}">Add Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('studentlist') ? 'active' : '' }}" href="{{route('studentlist')}}">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('getTableData') ? 'active' : '' }}" href="{{route('getTableData')}}">Activity Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" id="logout" href="{{route('logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="form">
        <form action="{{route('addstudent')}}" method="POST">
            @csrf
            <h1>Add Student</h1>
            <label>Lastname, Firstname M.</label>
            <input type="text" name="name" placeholder="Fullname" required>
            <label>ex: 00-0000/0000-0000</label>
            <input type="text" name="idnumber" placeholder="ID - Number" required>
            <label>ex: BSIT</label>
            <input type="text" name="course" placeholder="Course" required>
            <label>ex: 1st</label>
            <input type="text" name="yearlevel" placeholder="Year Level" required>
            <label>ex: ccs</label>
            <input type="text" name="collegedep" placeholder="Department" required ">
            <button type="submit" class="bg-success">Add Student</button>
        </form>
    </div>
    <footer>Developer - Christian maglangit - Developer</footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkSuccessMessage() {
            const successMessage = '{{ session('success') }}';
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: successMessage,
                    timer: 1500,
                    showConfirmButton: false,
                });
            }
        }
        checkSuccessMessage();

        function checkAlreadyExistsMessage() {
            const AlreadyExistsMessage = '{{ session('alreadyexists') }}';
            if (AlreadyExistsMessage) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Already Exists!',
                    text: AlreadyExistsMessage,
                    timer: 2500,
                    showConfirmButton: false,
                });
            }
        }
        checkAlreadyExistsMessage();
    </script>
</body>
</html>