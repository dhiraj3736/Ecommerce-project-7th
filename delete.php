 
 <?php
 include('connection.php');
 if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $sql="DELETE FROM item where id='$id'";
    $execute=mysqli_query($conn,$sql);
	if(!$execute){
		die(mysqli_error($conn));
	}
    echo "<script>alert('sre you sure!');</script>";
	header("location:mypost.php");
}

 
 
 ?>