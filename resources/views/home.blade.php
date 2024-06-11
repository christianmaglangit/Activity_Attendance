<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
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
    <div class="container w-50 d-flex align-items-center justify-content-center">    
    <form method="POST" action="{{route('attendancePost')}}" class="w-70 h-100 bg-light" id="idform">
        @csrf
        <label for="activityname" style="font-size:15px;">Activity Name:</label>
        <select class="form-control w-50" style="font-size:15px;" id="activityname" name="activityname">
            @foreach($activityName as $name)
                <option value="{{ $name }}">{{ $name }}</option>
            @endforeach
        </select>
        <label for="attendance" class="form-label">Attendance</label>
        <input type="text" name="idinput" class="form-control mb-3 w-75" placeholder="Enter ID Number">
        <input type="hidden" id="realTime" name="realTime" value="">
        <button type="submit" class="btn btn-success w-50">Enter</button>
        <h1 id="realtime" class="mt-4"></h1>
        <h3 id="realdate"></h3>
    </form>
</div>

<script>
        function updateDateTime() {
            const date = document.getElementById('realdate');
            const time = document.getElementById('realtime');
            const realTimeInput = document.getElementById('realTime'); // Fetch hidden input field
            const now = new Date();
            date.innerHTML = now.toLocaleDateString();
            time.innerHTML = now.toLocaleTimeString();
            realTimeInput.value = now.toLocaleTimeString(); // Set the value of the hidden input field
        } 

        // Update the current date and time when the page loads
        updateDateTime();

        // Update the current date and time every second
        setInterval(updateDateTime, 1000);
        
        // Function to validate the form before submission
        
    </script>
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
        function checkErrorMessage() {
            // Get the success message from the page
            const errorMessage = '{{ session('Not Found') }}';
            // If success message exists, display SweetAlert
            if (errorMessage) {
                Swal.fire({
                    icon: 'info',
                    title: 'Not Found!',
                    text: errorMessage,
                    timer: 2500,
                    showConfirmButton: false,
                });
            }
        }
        // Call the function when the page loads
        checkErrorMessage();

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
