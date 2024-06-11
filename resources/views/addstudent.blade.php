<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="stylesheet" href="css/addstudent.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success w-100">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="{{route('home')}}"><img id="mainlogo" src="images/ccs.png"></a>
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
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
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
            <label>ex: 1st year</label>
            <input type="text" name="yearlevel" placeholder="Year Level" required>
            <label>ex: ccs</label>
            <input type="text" name="collegedep" placeholder="College Department" required>
            <button type="submit">Add Activity</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Check for success message and display SweetAlert -->
    <script>
        // Function to check for success message and display SweetAlert
        function checkSuccessMessage() {
            // Get the success message from the page
            const successMessage = '{{ session('success') }}';
            // If success message exists, display SweetAlert
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
        // Call the function when the page loads
        checkSuccessMessage();

        function checkAlreadyExistsMessage() {
            // Get the success message from the page
            const AlreadyExistsMessage = '{{ session('alreadyexists') }}';
            // If success message exists, display SweetAlert
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
        // Call the function when the page loads
        checkAlreadyExistsMessage();
    </script>
</body>
</html>