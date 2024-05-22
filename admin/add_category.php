<?php
 include('connection.php');
 if(isset($_POST['submit'])){
    $cat=$_POST['cat'];

    $sql="INSERT INTO category(Name)VALUES('$cat')";
    mysqli_query($conn,$sql);
 }
    $sql="SELECT * from category";
    $query=mysqli_query($conn,$sql);

    
 
 ?>
 <?php
include('connection.php');
if(isset($_POST['submit_brand'])){
  $name=$_POST['brand'];
  $c_id=$_POST['category'];

  $sql="INSERT INTO brand(B_name,c_id)value('$name','$c_id')";
  mysqli_query($conn,$sql);

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
      margin: 0;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      width: 25%;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
    }
    li a {
      display: block;
      color: #000;
      padding: 8px 16px;
      text-decoration: none;
    }
    li a.active {
      background-color: #04AA6D;
      color: white;
    }
    li a:hover:not(.active) {
      background-color: #555;
      color: white;
    }
  </style>
</head>
<body>

<ul>
  <li><a  href="admin_dashboard.php">Home</a></li>
  <li><a class="active" href="add_category.php">Add category</a></li>
  <li><a href="viewpost.php">Manage Post</a></li>
  <li><a href="manage_user.php">Manage User</a></li>
</ul>

<div style="margin-left:25%; padding: 20px; height:1000px;">
    <form action="" method="POST" style="margin-bottom: 20px;">
        Add Category:
        <input type="text" name='cat' style="margin-right: 10px;">
        <input type="submit" name='submit' value="Submit" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
    </form>

    <table border="1" style="border-collapse: collapse; width: 50%;">
        <tr>
            <th style="padding: 8px;">ID</th>
            <th style="padding: 8px;">Category</th>
            <th style="padding: 8px;">action</th>
        </tr>

        <?php foreach($query as $row) : ?>
            <tr>
                <td style="padding: 8px;"><?php echo $row['id']; ?></td>
                <td style="padding: 8px;"><?php echo $row['Name']; ?></td>
                <td style="padding: 8px;"> 
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="submit" value="Delete">
                </form>

                <!-- <form action="update.php" method="post">
                    <input type="hidden" name="id" value="">
                    <input type="submit" name="submit" value="Update">
                </form>
               -->
                         
            <a href="update.php?update=<?php echo $row['id']; ?>">update</a>   
            </td>
            </tr>
        <?php endforeach; ?>
    </table>


    <div style="margin-right: 10px;">
    <form action="" method="POST" >
          Choose category:
          <select name="category" id="">
          <?php foreach($query as $row) : ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['Name']; ?></option>
          <?php endforeach; ?>
          </select>
        Add Brand:
        <input type="text" name='brand' style="margin-right: 10px;">
        <input type="submit" name='submit_brand' value="Submit" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
    </form>



    
    </div>
</div>




<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
