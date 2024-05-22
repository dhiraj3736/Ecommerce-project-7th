<?php
include("connection.php");
if(isset($_GET['update'])){
    $id=$_GET['update'];
    $sql="SELECT * FROM category where id='$id'";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($query);
    

if(isset($_POST['update'])){
    $cat=$_POST['cat'];
    $sql="UPDATE category set Name='$cat' where id='$id'";
    $qu=mysqli_query($conn,$sql);
    if($qu){
        header("location:add_category.php");
    }}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        Category:
        <input type="text" name="cat" value="<?php echo $row['Name'];?>">
        <input type="submit" value="update" name="update">
    </form>
</body>
</html>