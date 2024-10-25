<!DOCTYPE html>
<html>
<head>
<?php
session_start(); // Start the session to access user data
require 'connection.php'; // Include your database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the content from the form
    $post_text = $_POST['content'];

    // Prepare an SQL statement to insert post into database
    $user_id = $_SESSION['id']; 

    // chech if the post is empty 
    if (!empty($post_text)) {
        $query = "INSERT INTO posts (id, text) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $user_id, $post_text); // Bind user ID and post text

        // Execute the statement and check for success
        if ($stmt->execute()) {
            header("Location: Timeline page.php"); // re opens the timeline page to refresh it
            exit();
        } else {
            echo "Error uploading post: " . $stmt->error; // error message should the   post upload fail
        }
    } else {
        echo "Post content cannot be empty.";
    }

    $stmt->close(); // Close the statement
}
$conn->close(); //close the database  and lets other pages be able to acaess the database after 
?>
    <title>Home</title>
    <style>
        nav {
            margin: auto;
            color: lightblue;
        }
        .nav__links {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-around;
            color: lightblue;
        }
        .nav__logo {
            text-align: center;
            cursor: pointer;
            color: lightseagreen;
        }
        a {
            color: lightseagreen;
        }
        img {
            border-radius: 50%;
            width: 100px;
        }
        .button {
            width: 100px;
            padding: 10px;
            background-color: lightseagreen;
            color: white;
            border-radius: 5%;
            border: none; 
            font-size: 14px;
            box-shadow: 0 2px 10px lightseagreen;
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
        .post {
            height: 200px;
            width: 240px;
        }
        .timeline-post {
            background-color: white; 
            padding: 10px; 
            margin-bottom: 15px; 
            border-radius: 5%; 
            box-shadow: 0 2px 5px lightgray; 
        }
    </style>
</head>
<body>
<nav>
    <ul class="nav__links">
        <li class="link"><a href="Profile.php">Profile</a></li>
        <li class="link"><a href="Log in.php">Log in</a></li>
        <li class="nav__logo">
          <img src="Mysocial.png"/>
          <a href="index.php">Mysocial🛖</a>
        </li>
        <li class="link"><a href="Register.php">Sign Up</a></li>
        <li class="link"><a href="Timeline page.php">Timeline</a></li>
    </ul>
</nav>

<form action="Timeline page.php" method="POST" enctype="multipart/form-data">
    <textarea class="post" name="content" placeholder="Want to share something with your viewers?" required></textarea>
    <br><br>
    <button type="submit">Post</button>
</form>
<div id="posts">
    <?php
    require 'connection.php'; // Include your database connection

    // fecth all posts and ordering them in desecinding order by their  time stamp
    $query = "SELECT * FROM posts ORDER BY timestamp DESC"; 
    $result = $conn->query($query);

    // Check if the database has posts and post them
    if ($result && $result->num_rows > 0) {
        while ($post = $result->fetch_assoc()) {
            echo "<div class='timeline-post'>"; 
            echo  htmlspecialchars($post['timestamp']); 
            echo  htmlspecialchars($post['text']); 
            echo "</div>"; 
        }
    } else {
        echo "No posts available.";
    }

    $conn->close(); // Close the database connection
    ?>
</div>
<button class="button"><a class="button" href='Profile.php'>Profile</a></button>
<button class="button"><a class="button" href='index.php'>Logout</a></button>

<div id="posts">
   
</div>

</body>
</html>