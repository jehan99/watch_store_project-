<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Page</title>
    <link rel="stylesheet" href="HomeStyles.css">

    

    <script src="UserRegPg.js" defer> </script>
    
    @vite(['resources/css/userRegStyles.css','resources/css/HomeStyles.css'])
    
   

    
</head>


  

<body>

    

<form action="register" method="POST">
    
    <div class="reg-sec">
@csrf
    <h1> Register Now!</h1>

        <div class="reg-elements">
        <label class="reg-el2"> Create User Name :            </label>  <input  name="name"         type="text" > <br>
        <label class="reg-el2"> Email:                        </label>  <input  name="email"        type="email" > <br>
        <label for ="psw" class="reg-el2">Create Password :   </label>  <input  name="password"     type="Password" id="psw" > <br>
        <label   class="reg-el2">Confirm Password :           </label>  <input  name="con-password" type="password"  id="con-pass" > <br> 

        <button id="reg1" class="reg-btn" > Register </button>   <br>
        <button type="submit" class="userLogIn-btn">  <a href="{{route('displaylLoginPage')}}">LogIn </a></button> 
    </div>
    
    </form>

<div id="err-msg">
    <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>

</div>


<div id="con-msg">
<p>Entered characters did not match</p>

</div>

</div>

    


    
</body>
</html>