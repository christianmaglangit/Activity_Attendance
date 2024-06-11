<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="stylesheet" href="css/addactivity.css">
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
    <form method="POST" action="{{ route('addactivityPost') }}">
        @csrf
        <label>Add Activity for Attendance</label>
        <input type="text" name="activityname" placeholder="Activity Name"><br><br>
        <input type="time" name="TImorningStartTime" placeholder="Time In Morning Start"><br><br>
        <input type="time" name="TImorningEndTime" placeholder="Time In Morning End"><br><br>
        <input type="time" name="TOmorningStartTime" placeholder="Time Out Morning Start"><br><br>
        <input type="time" name="TOmorningEndTime" placeholder="Time Out Morning End"><br><br>
        <input type="time" name="noonStartTime" placeholder="Time In Afternoon Start"><br><br>
        <input type="time" name="noonEndTime" placeholder="Time In Afternoon End"><br><br>
        <input type="time" name="afternoonStartTime" placeholder="Time Out Afternoon Start"><br><br>
        <input type="time" name="afternoonEndTime" placeholder="Time Out Afternoon End"><br><br>
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
                    timer: 2500,
                    showConfirmButton: false,
                });
            }
        }
        // Call the function when the page loads
        checkSuccessMessage();
        function checkWarningMessage() {
            // Get the success message from the page
            const warningMessage = '{{ session('warning') }}';
            // If success message exists, display SweetAlert
            if (warningMessage) {
                Swal.fire({
                    icon: 'warning',
                    title: 'warning!',
                    text: warningMessage,
                    timer: 2500,
                    showConfirmButton: false,
                });
            }
        }
        // Call the function when the page loads
        checkWarningMessage();
    </script>
</body>
</html>