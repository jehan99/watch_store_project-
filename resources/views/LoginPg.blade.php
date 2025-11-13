<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn Page</title>
</head>
@vite(['resources/css/loginPg.css'])

<body>
    
<div class="login-form">

<form action="{{ route('loginUser') }}" method="POST">
@csrf
<label>Email : </label> <input name="email" type="email"> <br>
<label>Password: </label> <input name="password" type="password">  <br>

<button type="submit" class="login-btn">Log In</button>

</form>

</div>


</body>
</html>