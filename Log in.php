<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();//create a session
    require 'connection.php'; //connect to the  connection php

    // define the varriables
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) { 
        $email = $_POST['email'];
        $password = $_POST['password'];

        // using sql fetch the user data from the databse
        $query = "SELECT * FROM user_data WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any user was found
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // compare the entered password with the one in the databse
            if ($password === $user['password']) {
                // Store user data in session
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header("Location: Profile.php"); //   move to the locked profile page 
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
    }
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
            width: 300px;
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
            margin-left: 10px;
            width: 100px;
            padding: 10px;
            background-color: lightseagreen;
            color: beige;
            border-radius: 5%;
            border: none; 
            font-size: 14px;
            box-shadow: 0 2px 10px lightseagreen;
        }

         a {
             color: beige;
         } 
         .a {
             color: green;
         } 
         h2 {
             color: lightseagreen;
         }
    </style>
    <title>Log in</title>
</head>
<body>
    <form method="post" action="Log in.php">
        <h2>Log In</h2>
        <br><br>
        <label>Email</label><br><input type="email" name="email" required> 
        <br><br>
        <label>Password</label><br><input type="password" name="password" required> <
        <br><br><br><br>
        <button type="submit" name="login">Log in</button> 
        <button class="button"><a href="index.php">Home</a></button>
        <p>Don't have an account? then <a class="a" href="Register.php">sign up</a></p>
    </form>
</body>
</html>