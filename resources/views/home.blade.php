<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css" />
    <link rel="stylesheet" href="css/home.css">
    <link rel="icon" href="images/ccs.png">
    <title>College of Computer Studies</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success w-100">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="{{route('home')}}"><img id="mainlogo" src="images/ccs.png" alt="CCS"></a>
            <a class="navbar-brand" href="{{route('home')}}">College of Computer Studies</a>  
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('studentlist') ? 'active' : '' }}" href="{{route('studentlist')}}">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('getTableData') ? 'active' : '' }}" href="{{route('getTableData')}}">Activity Attendance</a>
                    </li>
                    <li class="nav-item ps-2">
                        <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" id="logout" href="{{route('logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="containerform d-flex justify-content-around">   
        <div class="logos d-flex justify-content-center align-items-center">
            <img class="w-100" src="images/ccslogo.gif" alt="">
        </div> 
        <form method="POST" action="{{route('attendancePost')}}" id="idform">
            @csrf
            <label for="activityname" style="font-size:15px;">Activity Name:</label>
            <select class="form-control w-50" style="font-size:15px;" id="activityname" name="activityname">
                @foreach($activityNames as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
            <label for="attendance" class="form-label">Attendance</label>
            <input id="idInput" type="text" name="idinput"  placeholder="Enter ID Number" required>
            <input type="hidden" id="realTime" name="realTime" value="">
            <button type="submit" class="btn btn-success w-50">Enter</button>
            <h1 id="realtime" class="mt-4"></h1>
            <h3 id="realdate"></h3>
        </form>
        <div class="logos d-flex justify-content-center align-items-center">
            <img class="w-100" src="images/ccslogo.gif" alt="">
        </div> 
    </div>
    <footer class="bg-success gap-3"> 
        <a href="https://www.facebook.com/christian.bmaglangit" target=”_blank”><img src="images/facebook.png" alt="Facebook"></a>
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=new&to=christianmaglangit@gmail.com" target="_blank"><img src="images/gmail.png" alt="Gmail"></a>
         - Christian bolohan maglangit -  
        <a href="https://www.linkedin.com/in/christian-maglangit-8b65b8288/" target=”_blank”><img src="images/linkedin.png" alt="Linkedin"></a>
        <a href="https://github.com/christianmaglangit" target=”_blank”><img src="images/github.png" alt="GitHub"></a>
    </footer>
    <script src="js/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- date na script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("idInput").focus();
        });
        function updateDateTime() {
            const date = document.getElementById('realdate');
            const time = document.getElementById('realtime');
            const realTimeInput = document.getElementById('realTime'); 
            const now = new Date();
            date.innerHTML = now.toLocaleDateString();
            time.innerHTML = now.toLocaleTimeString();
            realTimeInput.value = now.toLocaleTimeString(); 
        } 
        updateDateTime();
        setInterval(updateDateTime, 1000);        
    </script>
    <script src="javascript/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- sweeralert script -->
    <script>
        function checkSuccessMessage() {
            const successMessage = '{{ session("success") }}';
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: successMessage,
                    timer: 4000,
                    showConfirmButton: false,
                });
            }
        }
        checkSuccessMessage();

        function checkErrorMessage() {
            const errorMessage = '{{ session("Not Found") }}';
            if (errorMessage) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Not Found!',
                    text: errorMessage,
                    timer: 5000,
                    showConfirmButton: false,
                });
            }
        }
        checkErrorMessage();

        function checkWarningMessage() {
            const warningMessage = '{{ session("warning") }}';
            if (warningMessage) {
                Swal.fire({
                    icon: 'warning',
                    title: 'warning!',
                    text: warningMessage,
                    timer: 5000,
                    showConfirmButton: false,
                });
            }
        }
        checkWarningMessage();
    </script>
</body>
</html>
