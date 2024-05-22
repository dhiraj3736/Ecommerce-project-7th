<?php
include 'connection.php';
session_start();
if(isset($_GET['id'])){
    $c_id=$_GET['id'];
    $u_id=$_SESSION['id'];

    $sql="DELETE from card where p_id=$c_id and u_id=$u_id";
   $succ=mysqli_query($conn,$sql);
   if($succ){
    echo "<script>history.back();</script>";

   }
   


}
?>