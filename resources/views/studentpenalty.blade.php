<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css" />
    <link rel="stylesheet" href="css/studentpenalty.css">
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
    <h2 class="w-1oo d-flex justify-content-center">Student Penalty</h2>
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
                            @foreach($activityNames as $activityname)
                                <th>{{ $activityname }}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach($studentList as $student)
                            <tr>
                                <td>{{$student->idnumber}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->course}}</td>
                                <td>{{$student->yearlevel}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>total</td>
                            </tr>
                        @endforeach

                        </tr>   
                            
                    </tbody>
                </table>
            </div>
        </div>
    <script src="js/bootstrapjs/bootstrap.bundle.min.js"></script>
</body>
</html>