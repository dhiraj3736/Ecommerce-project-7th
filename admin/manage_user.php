<?php
        include('connection.php');
        $sql="SELECT * FROM user";
        $query=mysqli_query($conn,$sql);



        //delete part
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];

            $sql="DELETE FROM user where id='$id'";
            if(mysqli_query($conn,$sql)){
                header("location:manage_user.php");
            }
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
    table {
            border-collapse: collapse;
            width: 100%;
            
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        h1 {
            text-align:center;
            color: #333; /* Adjust color as needed */
            font-size: 24px; /* Adjust font size as needed */
            margin-top: 100px; /* Adjust top margin as needed */
            padding:10px;
        }
  </style>
</head>
<body>

<ul>
  <li><a  href="#home">Home</a></li>
  <li><a href="add_category.php">Add category</a></li>
  <li><a href="viewpost.php">Manage Post</a></li>
  <li><a class="active" href="manage_user.php">Manage user</a></li>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>User</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php foreach($query as $bow){?>
        <tr>
            <td><?php echo $bow['id'];?></td>
            <td><?php echo $bow['Name'];?></td>
            <td><?php echo $bow['Email'];?></td>
            <td><?php echo $bow['Password'];?></td>
            <td><a href="?delete=<?php echo $bow['id'];?>">Delete</a></td>
        </tr>
        <?php }?>
    </table>
</div>


</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
