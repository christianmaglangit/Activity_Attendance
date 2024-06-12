<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h2 class="w-1oo d-flex justify-content-center">College of Computer Studies - List of Student</h2>
        <div class="d-flex justify-content-around">
            <div class="selection d-flex gap-2">
                <label for="yearlevel" class="d-flex justify-conten-center align-items-center">Year level</label>
                <select class="form-control" style="font-size:15px; width:200px;" id="year" name="year">
                    <option value="all">All Year Levels</option>
                    <option value="1st">1st year</option>
                    <option value="2nd">2nd year</option>
                    <option value="3rd">3rd year</option>
                    <option value="4th">4th year</option>
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
        <div class="tableclass">
            <div class="tableclass1">
                <table  id="studentTable" class="container table table-striped table-bordered table-hover">
                    <thead class="tableHead">
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>College Department</th>
                            <th class="d-flex justify-content-center">Edit / Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentlist as $student)
                        <tr>
                            <td>{{strtoupper($student->idnumber)}}</td>
                            <td>{{strtoupper($student->name)}}</td>
                            <td>{{strtoupper($student->course)}}</td>
                            <td>{{strtoupper($student->yearlevel)}}</td>
                            <td>{{strtoupper($student->collegedep)}}</td>
                
                            <td class="d-flex gap-2 justify-content-center border"><button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-studentId="{{ $student->id }}">Edit</button>
                                <form class="deleteForm" action="{{ route('addstudentdestroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form></td>
                        </tr>      
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <footer>Developer - Christian maglangit - Developer</footer>

        <!-- modal ni para pang edit -->
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
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="idnumber" class="form-label">ID Number:</label>
                        <input type="text" class="form-control" id="idnumber" name="idnumber" value="{{ $student->idnumber }}">
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
                    <!-- Add more input fields as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    //modal
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Event listener executed!");
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var parentRow = this.closest('tr');
                var studentId = this.getAttribute('data-studentId');
                
                // Fill modal fields with data from the clicked row
                document.getElementById('editForm').setAttribute('action', '/addstudent/' + studentId);
                document.getElementById('name').value = parentRow.cells[1].textContent.trim();
                document.getElementById('idnumber').value = parentRow.cells[0].textContent.trim();
                document.getElementById('course').value = parentRow.cells[2].textContent.trim();
                document.getElementById('yearlevel').value = parentRow.cells[3].textContent.trim();
                document.getElementById('collegedep').value = parentRow.cells[4].textContent.trim();
            });
        }); 
        document.getElementById('saveChangesBtn').addEventListener('click', function() {
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.hide();
        });
    });

    document.getElementById('year').addEventListener('change', function() {
        var yearLevel = this.value;
        var rows = document.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            var yearCell = row.querySelector('td:nth-child(4)').textContent;

            if (yearLevel === 'all' || yearCell === yearLevel) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
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
                        icon: "success"
                        
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