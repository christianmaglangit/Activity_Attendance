<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/studentlist.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
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

        <h2 class="w-1oo d-flex justify-content-center">list of student</h2>
        
        <div class="d-flex gap-2">
        <label for="yearlevel" class="d-flex justify-conten-center align-items-center">Year level :</label>
        <select class="form-control" style="font-size:15px; width:200px;" id="year" name="year">
            <option value="all">All Year Levels</option>
            <option value="1st">1st year</option>
            <option value="2nd">2nd year</option>
            <option value="3rd">3rd year</option>
            <option value="4th">4th year</option>
        </select>
        <form action="">
        <input type="text" placeholder="ID Number">
        <button type="submit">Search</button>
        </form>
        </div>
        <table class="table table-striped mt-3">
            <thead class="tableHead">
                <tr>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>College Department</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($studentlist as $student)
                <tr class="year-level-{{ $student->yearlevel }}">
                    <td>{{$student->idnumber}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->course}}</td>
                    <td>{{$student->yearlevel}}</td>
                    <td>{{$student->collegedep}}</td>
         
                    <td class="d-flex gap-2 justify-content-start"><button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-studentId="{{ $student->id }}">Edit</button>
                        <form class="deleteForm" action="{{ route('addstudentdestroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form></td>
                </tr>      
                @endforeach
            </tbody>
        </table>

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


    <footer>All rights not reserved - Christian Maglangit</footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //modal
        document.addEventListener('DOMContentLoaded', function() {
    console.log("Event listener executed!");
    
    // Event listener to fill modal fields when the edit button is clicked
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

    // Event listener to save changes when the save button is clicked
    document.getElementById('saveChangesBtn').addEventListener('click', function() {
        // Here you can handle form submission if necessary
        
        // Close the modal
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.hide();
    });
});

        function filterRows() {
            var searchText = document.querySelector('input[type="text"]').value.trim().toLowerCase();
            var selectedYear = document.getElementById('year').value.toLowerCase();
            var tableRows = document.querySelectorAll('.table tbody tr');

            tableRows.forEach(function(row) {
                var idNumber = row.cells[0].textContent.trim().toLowerCase(); // ID Number is in the first cell (index 0)
                var rowYear = row.cells[3].textContent.trim().toLowerCase(); // Year level is in the fourth cell (index 3)
                var shouldDisplay = idNumber.includes(searchText) && (selectedYear === '' || rowYear === selectedYear || selectedYear === 'all');
                row.style.display = shouldDisplay ? '' : 'none';
            });
        }


        //sweet alert danhi
        console.log("Event listener executed!");
        document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
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
                    this.submit(); // Submit the form
                }
            });
        });
    });




    </script>


</body>
</html>