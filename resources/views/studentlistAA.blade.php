<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="w-1oo d-flex justify-content-center">College of Computer Studies - Activity Attendance</h2>
   
        @if (isset($activityNames))
        <div class="d-flex justify-content-around">
            <form class="d-flex" id="activityForm" action="{{ route('getTableData') }}" method="POST">
                @csrf
                <label for="activityname" class="d-flex justify-conten-center align-items-center" >Select Activity</label>
                <select class="form-control w-50" id="activityname" name="activityname" onchange="this.form.submit()">
    <option value="" selected disabled>Select an activity</option>
    @foreach($activityNames as $id => $name)
        <option value="{{ $name }}">{{ $name }}</option>
    @endforeach
</select>
            </form>
            <div class="d-flex justify-conten-center align-items-center">Student Total Number : <span id="rowCount">0</span></div>
            <div class="searchengine d-flex justify-conten-center align-items-center" >
                <form id="searchForm " class="d-flex justify-conten-center align-items-center gap-2">
                    <label for="search">Search</label>
                    <input class="form-control me-2" type="text" id="searchInput" placeholder="ID Number">
                </form>
            </div>
        </div>
        @endif
        

    @if (isset($tableData))
    <div class="tableclass">
        <div class="tableclass1">
        @if (!empty($selectedName))
            <h2 class="dbname d-flex justify-content-center align-items-center">{{ strtoupper($selectedName) }}</h2>
        @endif
        @if (!empty($tableData))
            <table id="studentTable" class="container table table-striped table-bordered table-hover">
                <thead class="tableHead">
                    <tr>
                        @foreach ($tableData->first() as $columnName => $value)
                            @if (!in_array($columnName, $columnsToExclude))
                                <th>{{ strtoupper($columnName) }}</th>
                            @endif
                        @endforeach
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
            <p>No data available for the selected activity.</p>
        @endif
        </div>
    </div>
    <footer>Developer - Christian maglangit - Developer</footer>
@endif

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
        
    </script>
</body>
</html>