<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css" />
    <link rel="stylesheet" href="css/studentlist.css">
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
    <h2 class="w-1oo d-flex justify-content-center"> List of Student</h2>
    <div class="d-flex justify-content-around">
        <div class="selection d-flex gap-2">
            <label for="yearlevel" class="d-flex justify-conten-center align-items-center">Year level</label>
            <select class="form-control" style="font-size:15px; width:200px;" id="year" name="year">
                <option value="all" selected>All Year Levels</option>
                <option value="1ST YEAR">1st year</option>
                <option value="2ND YEAR">2nd year</option>
                <option value="3RD YEAR">3rd year</option>
                <option value="4TH YEAR">4th year</option>
            </select>
        </div>
        <div class="d-flex justify-conten-center align-items-center">Student Total Number : <span id="rowCount">0</span></div>
        <div class="searchengine d-flex justify-conten-center align-items-center" >
            <form id="searchForm " class="d-flex justify-conten-center align-items-center gap-2">
                <label for="search">Search</label>
                <input class="form-control me-2" type="text" id="searchInput" placeholder="ID Number">
            </form>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStudentModal">
            <img class="addstudent" src="images/addstudent.png" alt="Add Student">
            Add Student
        </button>
    </div>
    <div class="tableclass">
        <table  id="studentTable" class="container table  table-bordered table-hover">
            <thead class="tableHead">
                <tr>
                    <th class="bg-success text-light">ID Number</th>
                    <th class="bg-success text-light">Name</th>
                    <th class="bg-success text-light">Course</th>
                    <th class="bg-success text-light">Year Level</th>
                    <th class="bg-success text-light">College Department</th>
                    <th class="bg-success text-light d-flex justify-content-center">Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse($studentlist as $student)
                <tr>
                    <td>{{strtoupper($student->idnumber)}}</td>
                    <td>{{strtoupper($student->name)}}</td>
                    <td>{{strtoupper($student->course)}}</td>
                    <td>{{strtoupper($student->yearlevel)}}</td>
                    <td>{{strtoupper($student->collegedep)}}</td>
        
                    <td class="d-flex gap-2 justify-content-center align-items-center">
                        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#editModal" data-studentId="{{ $student->id }}">Edit</button>
                        <form class="deleteForm" action="{{ route('addstudentdestroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger d-flex align-items-center" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>      
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <footer class="bg-success gap-3"> 
        <a href="https://www.facebook.com/christian.bmaglangit" target=”_blank”><img src="images/facebook.png" alt="Facebook"></a>
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=new&to=christianmaglangit@gmail.com" target="_blank"><img src="images/gmail.png" alt="Gmail"></a>
        Developer - Christian bolohan maglangit - Developer 
        <a href="https://www.linkedin.com/in/christian-maglangit-8b65b8288/" target=”_blank”><img src="images/linkedin.png" alt="Linkedin"></a>
        <a href="https://github.com/christianmaglangit" target=”_blank”><img src="images/github.png" alt="GitHub"></a>
    </footer>

    <!-- modal ni para pang edit sa student-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit student -->
                    <form id="editForm" action="{{ route('addstudentupdate', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="idnumber" class="form-label">ID Number:</label>
                            <input type="text" class="form-control" id="idnumber" name="idnumber" value="{{ $student->idnumber }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" value="{{ $student->course }}">
                        </div>
                        <div class="mb-3">
                            <label for="yearlevel" class="form-label">Year Level:</label>
                            <input type="text" class="form-control" id="yearlevel" name="yearlevel" value="{{ $student->yearlevel }}">
                        </div>
                        <div class="mb-3">
                            <label for="collegedep" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="collegedep" name="collegedep" value="{{ $student->collegedep }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="editForm" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal para sa add student -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form goes here -->
                    <form action="{{route('addstudent')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Fullname</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="ex: John d. doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="idnumber" class="form-label">ID - Number</label>
                            <input type="text" name="idnumber" id="idnumber" class="form-control" placeholder="ex: 00-0000 / 0000-0000 " required>
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" name="course" id="course" class="form-control" placeholder=" ex: BSIT" required>
                        </div>
                        <div class="mb-3">
                            <label for="yearlevel" class="form-label">Year Level</label>
                            <input type="text" name="yearlevel" id="yearlevel" class="form-control" placeholder="ex: 1st year " required>
                        </div>
                        <div class="mb-3">
                            <label for="collegedep" class="form-label">Department</label>
                            <input type="text" name="collegedep" id="collegedep" class="form-control" placeholder=" ex: ccs" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //modal
        document.addEventListener('DOMContentLoaded', function() {
        console.log("Event listener executed!");
        
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var parentRow = this.closest('tr');
                var studentId = this.getAttribute('data-studentId');
                var backdrop = document.createElement('div');
                backdrop.classList.add('modal-backdrop', 'fade', 'show');
                document.body.appendChild(backdrop);
                
                document.getElementById('editForm').setAttribute('action', '/addstudent/' + studentId);
                document.getElementById('name').value = parentRow.cells[1].textContent.trim();
                document.getElementById('idnumber').value = parentRow.cells[0].textContent.trim();
                document.getElementById('course').value = parentRow.cells[2].textContent.trim();
                document.getElementById('yearlevel').value = parentRow.cells[3].textContent.trim();
                document.getElementById('collegedep').value = parentRow.cells[4].textContent.trim();
            });
        });

        document.querySelectorAll('.btn-close').forEach(button => {
            button.addEventListener('click', function() {
                var backdrop = document.querySelector('.modal-backdrop');
                backdrop.parentNode.removeChild(backdrop);
            });
        });

        document.getElementById('saveChangesBtn').addEventListener('click', function() {
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.hide();
            
            var backdrop = document.querySelector('.modal-backdrop');
            backdrop.parentNode.removeChild(backdrop);
        });
    });

        // add modal
        document.addEventListener('DOMContentLoaded', function () {
        var button = document.querySelector('.btn-success');
        var modal = document.getElementById('addStudentModal');
            button.addEventListener('click', function () {
                modal.classList.add('show');
                modal.style.display = 'block'; 
                document.body.classList.add('modal-open');
                var backdrop = document.createElement('div');
                backdrop.classList.add('modal-backdrop', 'fade', 'show');
                document.body.appendChild(backdrop);
            });
            var closeButton = modal.querySelector('.btn-close');
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
        var rows = document.querySelectorAll('tbody tr');
        var visibleRowCount = 0;

        rows.forEach(function(row) {
            var yearCell = row.querySelector('td:nth-child(4)').textContent;

            if (yearLevel === 'all' || yearCell === yearLevel) {
                row.style.display = '';
                visibleRowCount++;
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('rowCount').textContent = visibleRowCount;
        });


        //search
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

        //sweet alert danhi
        function checkSuccessMessage() {
            const successMessage = '{{ session('addsuccess') }}';
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
        
        console.log("Event listener executed!");
        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); 
                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                    showConfirmButton: false
                    });
                    this.submit();
                }
                });

            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            function updateRowCount() {
                var rowCount = document.querySelectorAll('#studentTable tbody tr').length;
                document.getElementById('rowCount').innerText = rowCount;
            }
            
            updateRowCount();
        });
    </script>

</body>
</html>