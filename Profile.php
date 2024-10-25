<?php
session_start(); // create a session

// Include database connection
require 'connection.php'; 

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: Log in.php"); //  if the user is not loged it move to the log in php
    exit();
}

// Fetch user details from database using session ID
$user_id = $_SESSION['id'];
$query = "SELECT * FROM user_data WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><?php
    //echo the stored variables on the browser  as the title of the page
    ?>
    <title><?php echo htmlspecialchars($user['name'] . ' ' . $user['surname']); ?>'s Profile</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Calibri;
            text-align: center;
        }
        .profile-container {
            background-color: white;
            padding: 20px;
            border-radius: 5%;
            box-shadow: 0 2px 10px lightseagreen;
            width: 300px;
            margin: auto;
        }
        h2 {
            color: lightseagreen;
        }
        .button {
            padding: 10px;
            background-color: lightseagreen;
            color: white;
            border-radius: 5%;
            border: none;
            cursor: pointer;
        }
        a {
            color: beige;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Welcome, <?php echo htmlspecialchars($user['name'] . ' ' . $user['surname']); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    
    
    <button class="button"><a href='Messages.php'>Messages</a></button> 
    <button class="button"><a href='index.php'>Logout</a></button> 
</div>

</body>
</html>