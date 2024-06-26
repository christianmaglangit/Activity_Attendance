<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css" />
    <link rel="stylesheet" href="css/studentlistAA.css">
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
    <h2 class="w-1oo d-flex justify-content-center">Student Activity Attendance</h2>
    <div class="content">
        @if (isset($activityNames))
        <div class="d-flex justify-content-around">
            <form class="d-flex gap-2" id="activityForm" action="{{ route('getTableData') }}" method="POST">
                @csrf
                <label for="activityname" class="d-flex justify-conten-center align-items-center" >Select Activity</label>
                <select class="form-control" id="activityname" name="activityname" onchange="this.form.submit()">
                    <option value="" selected>Select an activity</option>
                    @foreach($activityNames as $id => $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                </select>
            </form>
            <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-success ms-3" data-toggle="modal" data-target="#addActivity">
                    <img class="iconaddactivity " src="images/addstudent.png" alt="Add Student">
                    Add Activity
                </button>
            </div>
            
        </div>
        @endif
        
        @if (isset($tableData))
        <div class="tableclass">
            <div class="tableclass1">
                
                @if (!empty($selectedName))
                    <h4 class="dbname d-flex justify-content-center align-items-center">{{ strtoupper($selectedName) }}</h4>
                    <div class="d-flex justify-content-around align-content-center mb-2">
                        <div class="selection gap-2 mb-1 d-flex justify-content-center align-items-center">
                            <label for="yearlevel" class="d-flex justify-conten-center align-items-center">Year level</label>
                            <select class="form-control" style="font-size:15px; width:200px;" id="year" name="year">
                                <option value="all" selected>All Year Levels</option>
                                <option value="1ST YEAR">1st year</option>
                                <option value="2ND YEAR">2nd year</option>
                                <option value="3RD YEAR">3rd year</option>
                                <option value="4TH YEAR">4th year</option>
                            </select>
                        </div>
                        <h6 class="d-flex justify-content-center align-items-center">Student Total Number : <span id="rowCount">0</span></h6>
                        <div class="searchengine d-flex justify-conten-center align-items-center" >
                            <form id="searchForm " class="d-flex justify-conten-center align-items-center gap-2">
                                <label for="search">Search</label>
                                <input class="form-control me-2" type="text" id="searchInput" placeholder="ID Number">
                            </form>
                        </div>
                    </div>
                @endif
                <div class="tablerowculm">
                @if (!empty($tableData))
                    <table id="studentTable" class="container table table-bordered table-hover">
                        <thead class="tableHead">
                            <tr>
                            <th class="bg-success text-light">ID Number</th>
                            <th class="bg-success text-light">Name</th>
                            <th class="bg-success text-light">Year Level</th>
                            <th class="bg-success text-light">Course</th>
                            <th class="bg-success text-light">Time In AM</th> 
                            <th class="bg-success text-light">Time Out AM</th>
                            <th class="bg-success text-light">Time In PM</th> 
                            <th class="bg-success text-light">Time Out PM</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableData as $rowData)
                                <tr>
                                    @foreach ($rowData as $value)
                                        <td>{{ strtoupper($value) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                </div>
                    <p>No data available for the selected activity.</p>
                @endif
                </div>
            </div>   
        @endif
    </div>

    <!-- modal add activity -->
    <div class="modal fade" id="addActivity" tabindex="-1" aria-labelledby="AddActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="AddActivityModalLabel">Add Activity</h5>
                </div>
                <div class="modal-body">
                    <!-- Your form goes here -->
                    <form method="POST" action="{{ route('addactivityPost') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label title">Activity Name</label>
                            <input type="text" name="activityname" class="form-control" placeholder="Activity Name" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label timetitle">Time In Morning Start</label>
                                    <input class="form-control timefield" type="time" name="TImorningStartTime"  required>
                                </div>
                                <div class="col">
                                    <label class="form-label timetitle">Time In Morning End</label>
                                    <input class="form-control timefield" type="time" name="TImorningEndTime"  required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label timetitle">Time Out Morning Start</label>
                                    <input class="form-control timefield" type="time" name="TOmorningStartTime"  required>
                                </div>
                                <div class="col">
                                    <label class="form-label timetitle">Time Out Morning End</label>
                                    <input class="form-control timefield" type="time" name="TOmorningEndTime"  required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label timetitle">Time In Afternoon Start</label>
                                    <input class="form-control timefield" type="time" name="noonStartTime"  required>
                                </div>
                                <div class="col">
                                    <label class="form-label timetitle">Time In Afternoon End</label>
                                    <input class="form-control timefield" type="time" name="noonEndTime" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label timetitle">Time Out Afternoon Start</label>
                                    <input class="form-control timefield" type="time" name="afternoonStartTime" placeholder="Time Out Afternoon Start">
                                </div>
                                <div class="col">
                                    <label class="form-label timetitle">Time Out Afternoon End</label>
                                    <input class="form-control timefield" type="time" name="afternoonEndTime" placeholder="Time Out Afternoon End">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btnclose btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>    
                            <button type="submit" class="btn btn-success">Add Activity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-success gap-3"> 
        <a href="https://www.facebook.com/christian.bmaglangit" target=”_blank”><img src="images/facebook.png" alt="Facebook"></a>
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=new&to=christianmaglangit@gmail.com" target="_blank"><img src="images/gmail.png" alt="Gmail"></a>
        Developer - Christian bolohan maglangit - Developer 
        <a href="https://www.linkedin.com/in/christian-maglangit-8b65b8288/" target=”_blank”><img src="images/linkedin.png" alt="Linkedin"></a>
        <a href="https://github.com/christianmaglangit" target=”_blank”><img src="images/github.png" alt="GitHub"></a>
    </footer>
    <script src="javascript/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('searchInput');
        var allRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function () {
            filterTable();
        });

        function filterTable() {
            var input = searchInput.value.trim().toLowerCase();
            var rows = document.querySelectorAll('tbody tr');
            if (input === '') {
                resetTable();
                return;
            }
            rows.forEach(function (row) {
                var idNumber = row.querySelector('td:first-child').textContent.trim().toLowerCase();
                if (idNumber.startsWith(input)) {
                    row.classList.add('matched');
                } else {
                    row.classList.remove('matched');
                }
            });
            sortTable();
        }
        function sortTable() {
            var tbody = document.querySelector('tbody');
            var rows = document.querySelectorAll('tbody tr.matched');
            var sortedRows = Array.from(rows).sort((a, b) => {
                var aID = a.querySelector('td:first-child').textContent.trim();
                var bID = b.querySelector('td:first-child').textContent.trim();
                return aID.localeCompare(bID);
            });

            tbody.innerHTML = '';
            sortedRows.forEach(row => tbody.appendChild(row));
        }

        function resetTable() {
            var tbody = document.querySelector('tbody');
            tbody.innerHTML = '';
            allRows.forEach(row => tbody.appendChild(row));
        }
    });

        document.addEventListener("DOMContentLoaded", function() {
            function updateRowCount() {
                var rowCount = document.querySelectorAll('#studentTable tbody tr').length;
                document.getElementById('rowCount').innerText = rowCount;
            }
            
            updateRowCount();
        });

        document.addEventListener('DOMContentLoaded', function () {
        var button = document.querySelector('.btn-success');
        var modal = document.getElementById('addActivity');
            button.addEventListener('click', function () {
                modal.classList.add('show');
                modal.style.display = 'block'; 
                document.body.classList.add('modal-open');
                var backdrop = document.createElement('div');
                backdrop.classList.add('modal-backdrop', 'fade', 'show');
                document.body.appendChild(backdrop);
            });
            var closeButton = modal.querySelector('.btnclose');
            closeButton.addEventListener('click', function () {
                modal.classList.remove('show');
                modal.style.display = 'none'; 
                document.body.classList.remove('modal-open');
                var backdrop = document.querySelector('.modal-backdrop');
                backdrop.parentNode.removeChild(backdrop);
            });
        });
        
        document.getElementById('year').addEventListener('change', function() {
        var yearLevel = this.value;
        var rows = document.querySelectorAll('#studentTable tbody tr');
        var visibleRowCount = 0;
            rows.forEach(function(row) {
                var yearCell = row.querySelector('td:nth-child(3)').textContent.trim(); // Adjust nth-child based on your column index

                if (yearLevel === 'all' || yearCell === yearLevel) {
                    row.style.display = '';
                    visibleRowCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            document.getElementById('rowCount').textContent = visibleRowCount;
        });

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