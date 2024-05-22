<?php
 include('connection.php');
 if(isset($_POST['submit'])){
    $id=$_POST['sid'];
    $sql = "UPDATE item SET status='1' where id='$id'";           
    // if(mysqli_query($conn, $sql));
    $execute=mysqli_query($conn,$sql);
	if(!$execute){
		die(mysqli_error($conn));
	}
    echo "<script>alert('sre you sure!');</script>";
	header("location:mypost.php");
}

 
 
 ?>