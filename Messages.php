<!DOCTYPE html>
<html>
  <head>
  <?php
session_start(); // create session
require 'connection.php'; //connect to the  connection php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_email = $_POST['search_email'];

    // search fo a value using the email  with SQL
    $query = "SELECT * FROM user_data WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $search_email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any user was found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<h2>User Found:</h2>";
        echo "<p>Name: " . htmlspecialchars($user['name']) . " " . htmlspecialchars($user['surname']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
        
    } else {
        echo "No user found with that email.";
    }
}
?>
    <title>Home</title>
	<style>
    
   form {
      background-color: white;
      padding: 20px;
      border-radius: 2%;
      box-shadow: 0 2px 10px lightseagreen;
      width:300px;
      margin-top: 20px;
      margin-bottom: 20px;
   }

.body{
 color:lightblue;
 font-family:calibri;
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
</style>
  </head>
  <body>  
  <form method="post" action="Messages.php"> 
   <input type="email" name="search_email" placeholder="Enter email to search" required>
    <button type="submit">Search User</button>
</form>
<br><br><br>
<button><a href='timeline page.php'>Timeline</a></button> 
<button><a href='Profile.php'>Profile</a></button> 
<button><a href='index.php'>Logout</a></button> 
  </body>
</html>
