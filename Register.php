<!DOCTYPE html>
<html>
<head>
<?php
    session_start();
require 'connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    // execute the SQL statement
    $query = "INSERT INTO user_data(name, surname , email, password) VALUES ('$name', '$surname', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "Data entered successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
    <style>
        body {
            
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Calibri;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 2%;
            box-shadow: 0 2px 10px lightseagreen;
            width:300px;
            margin-top: 20px;
            margin-bottom: 20px;
            
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 220px;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 2%;
            border: 1px solid lightskyblue;
        }

        button {
            margin-left:10px;
            width: 100px;
            padding: 10px;
            background-color:lightseagreen;
            color: beige;
            border-radius: 5%;
            border :1px;
            font-size: 14px;
            box-shadow: 0 2px 10px lightseagreen;
        }
         a{
            color:beige;
         } 
         .a{
            color:green;
         } 
        
        
        h2{
            color:lightseagreen;
        }
    
    </style>
    <title>Sign up</title>
</head>
<body>
    
    <form method="post" action="Register.php">
        <h2>Register</h2>
        <br><br>
        <label name='name'>Name</label><br><input name="name" type="text">
        <br><br>
        <label name='surname'>Surname</label><br><input name="surname" type="text">
        <br><br>
        <label name='email'>Email</label><br><input type="email" name="email">
        <br><br>
        <label name='password'>Password</label><br><input type="password" name="password">
        <br><br>
        <button><a href="index.php">Home</a></button><button type="submit">Sign Up</button>
        <p>have an account? then <a  class="a"href="Log in.php">sign in</a></p>
    </form>
    
</body>
</html>