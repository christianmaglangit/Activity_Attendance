<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('register')}}" method="POST">
        @if(Session:: has('success'))
            <div class="alert" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @csrf
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password</label><br>
        <input type="Password" id="password" name="password" required><br><br>
        <button class="btn"> Register</button><br>
        <a href="{{route('login')}}">Already have an account</a>
    </form>
</body>
</html>