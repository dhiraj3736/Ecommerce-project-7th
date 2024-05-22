<?php
session_start();
include('connection.php');
if (isset($_GET['add_id'])) {
    $p_id = $_GET['add_id'];



    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        $sql = "SELECT * from card where p_id=$p_id and u_id=$user_id";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            
            echo "<script>alert('Item already added to card');history.back();</script>";
            

        } else {


            $sql = "INSERT into card(p_id,u_id)values('$p_id','$user_id')";
            mysqli_query($conn, $sql);
            echo "<script>history.back();</script>";
        }
    }else {
        // Handle case where user is not logged in
        header("location:login.php");
    }
}
