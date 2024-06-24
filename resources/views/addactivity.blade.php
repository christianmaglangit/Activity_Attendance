<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css" />
    <link rel="stylesheet" href="css/addactivity.css">
    <link rel="icon" href="images/ccs.png">
    <title>College of Computer Studies</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success w-100">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="{{route('home')}}"><img id="mainlogo" src="images/ccs.png"></a>
            <a class="navbar-brand" href="{{route('home')}}">College of Computer Studies</a>  
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" id="logout" href="{{route('logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="form">
        <form method="POST" action="{{ route('addactivityPost') }}">
            @csrf
            <label class="title">Add Activity</label>
            <input type="text" name="activityname" placeholder="Activity Name">
            <div class="time">
                <div class="startendtime">
                    <label class="timetitle" for="">Time In Morning Start</label>
                    <input class="timefield" type="time" name="TImorningStartTime" placeholder="Time In Morning Start">
                </div>
                <div class="startendtime">
                    <label class="timetitle" for="">Time In Morning End</label>
                    <input class="timefield" type="time" name="TImorningEndTime" placeholder="Time In Morning End">
                </div>
            </div>
            <div class="time">
                <div class="startendtime">
                    <label class="timetitle" for="">Time Out Morning Start</label>
                    <input class="timefield" type="time" name="TOmorningStartTime" placeholder="Time Out Morning Start">
                </div>
                <div class="startendtime">
                    <label class="timetitle" for="">Time Out Morning End</label>
                    <input class="timefield" type="time" name="TOmorningEndTime" placeholder="Time Out Morning End">
                </div>
            </div>
            <div class="time">
                <div class="startendtime">
                    <label class="timetitle" for="">Time In Afternoon Start</label>
                    <input class="timefield" type="time" name="noonStartTime" placeholder="Time In Afternoon Start">
                </div>    
                <div class="startendtime">
                    <label class="timetitle" for="">Time In Afternoon End</label>
                    <input class="timefield" type="time" name="noonEndTime" placeholder="Time In Afternoon End">
                </div>
            </div>
            <div class="time1">
                <div class="startendtime">
                    <label class="timetitle" for="">Time Out Afternoon Start</label>
                    <input class="timefield" type="time" name="afternoonStartTime" placeholder="Time Out Afternoon Start">
                </div>
                <div class="startendtime">
                    <label class="timetitle" for="">Time Out Afternoon End</label>
                    <input class="timefield" type="time" name="afternoonEndTime" placeholder="Time Out Afternoon End">
                </div>  
            </div>
            <button type="submit" class="bg-success">Add Activity</button>
        </form>
    </div>
    <footer>Developer - Christian maglangit - Developer</footer>
    <script src="javascript/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  SweetAlert ang naa danhi na script -->
    <script>
        function checkSuccessMessage() {
            const successMessage = '{{ session('success') }}';
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
        checkSuccessMessage();
        function checkWarningMessage() {
            const warningMessage = '{{ session('warning') }}';
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
        checkWarningMessage();
    </script>
</body>
</html>