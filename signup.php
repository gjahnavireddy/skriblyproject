<?php

$user="root";
$pass="";
$db="testlogin";
$conn=mysqli_connect("localhost",$user,$pass,$db) or die("unable to connect");
echo "connected";
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if($_POST["password"]==$_POST["cfmpassword"])
    {
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=md5($_POST['password']);
        $profile_url="localhost/skribly/".$username.".html";
        $sql = "INSERT INTO users(username, email, password,profile_url)
                VALUES ('$username', '$email', '$password','$profile_url')";

        if ($conn->query($sql) === true) 
        {
            echo "Insertion Successful";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
    <title>SKRIBLY</title>
    <link rel="stylesheet" href="basic.css">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
</head>
<style>
        body{
        background-image: url('bg3.jpg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
        }
    
        input[type=text],
        input[type=email],
        input[type=password] {
        padding: 12px 10px;
        margin: 8px 0;
        display: flex;
        box-sizing: border-box;
        border: 1.5px solid #ccc;
        
        }
        .signup{
        width:400px;
        height:540px;
        background:white;
        color:black;
        top:50%;
        left:50%;
        position: absolute;
        transform: translate(-50%,-25%);
        box-sizing: border-box;
        padding: 25px 35px;
        border-radius: 15px;
        opacity:0.9;
        }
       
        label{
            
            font-family: Arial, sans-serif;
            font-size:18px;
        }
        h1{
            
            font-family:Arial, sans-serif;
            font-size:35px;
            text-align: center;
        }
        .button{
            background-color: palevioletred;
            text-align: center;
            padding: 15px 10px;
            margin: 10px 5px;
            border: none;
            cursor: pointer;
            width: 96%;
            border-radius: 18px;
        }
         a{
            display: inline-block;
            font-family:Arial, sans-serif;
            text-decoration: none;
            font-size: 13.5px;
            line-height: 15px;
            color:darkgray;
            padding-left: 85px;
            
            }
        a:hover{
        color:black;
        }   
    </style>
<body class="bg-img1">

    <div class="signup">
        <form action="signup.php" method="post" onSubmit = "return check(this)">
            <h1>Sign Up</h1>
            <label><b>Username</b></label>
            <input type="text" name="username" placeholder="Enter Username" size=47 required autocomplete="off">
            <label><b>Email</b></label>
            <input type="email" name="email" placeholder="Enter Email-Id" size=47 required autocomplete="off">
            <label><b>Password</b></label>
            <input type="password" name="password" id="psd" placeholder="Enter Password" size=47 maxlength="10" required 
             pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,10}" title="Must contain at least one number and one uppercase and lowercase letter, and 10 characters" 
             autocomplete="off">
            <label><b>Confirm Password</b></label>
            <input type="password" name="cfmpassword" placeholder="Confirm Password" size=47 maxlength="10" required autocomplete="off">
            <input type="submit" value="Sign-Up" class="button" ><br>
            <a href="#" onclick="location.href='login.php'">Already have an account?</a>
        </form>
    </div>

    <script>
    function check(form)
    {
        if(form.password.value!=form.cfmpassword.value)
          {
            alert("Passwords donot match");
           form.password.value="";
           form.cfmpassword.value="";
           return false;
          }  
        
    }
    </script>
    
</body>

</html>
