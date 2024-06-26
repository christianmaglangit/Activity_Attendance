<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>
    <form action="{{route('login')}}" method="POST">
        @csrf
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password</label><br>
        <input type="Password" id="password" name="password" required><br><br>
        <button class="btn"> Login</button><br>
        <a href="{{route('register')}}">Dont have an account</a>
    </form>
</body>
</html>
