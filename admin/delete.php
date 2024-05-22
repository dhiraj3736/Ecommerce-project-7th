<?php
include('connection.php');
if(isset($_POST['submit'])){
    $id=$_POST['id'];


    $sql="SELECT * FROM item where c_id=$id";
    $query=mysqli_query($conn,$sql);

    if(mysqli_num_rows($query)>0){
        $del="DELETE FROM item where c_id=$id";
        mysqli_query($conn,$del);
    }
    
    $sqli="DELETE from category where id='$id'";
    mysqli_query($conn,$sqli);
    header("location:add_category.php");
}
?>