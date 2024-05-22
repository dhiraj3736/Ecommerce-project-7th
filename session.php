<?php
session_start();
include('connection.php');
if(isset($_POST['login'])){
    $email = $_POST['emai'];
    $pass = $_POST['passwor'];

    // Sanitize user input to prevent SQL injection (optional but recommended)
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Fetch user data from database
    $sql = "SELECT * FROM user WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);

    if($result){
        // Check if user exists
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['Password'];
           

            // Verify password
            if(password_verify($pass, $hashedPassword)){
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['Email'];
                header("Location: userdashboard.php");
                exit();
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}
?>
