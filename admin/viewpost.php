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

        img {
            width: 40px;
            height: 40px;
        }
        a {
            text-decoration: none;
            color: #007bff; /* Default link color */
        }

        a:hover {
            color: #0056b3; /* Link color on hover */
        }
  </style>
</head>
<body>

<ul>
  <li><a  href="admin_dashboard.php">Home</a></li>
  <li><a href="add_category.php">Add category</a></li>
  <li><a class="active" href="viewpost.php">Manage Post</a></li>
  <li><a href="manage_user.php">Manage User</a></li>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">

<table border=1px>
    <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Title</th>
        <th>Action</th>
        
    </tr>
   
      <?php
      include('connection.php');
      $sql="SELECT *FROM item";
      $query=mysqli_query($conn,$sql);
      foreach($query as $row){
      ?>
       <tr>
      <td><?php echo $row['id']?></td>
      <td> <img src="/ambition_guru/day4/pimage/<?php echo $row['image']; ?>" class="card-img-top" alt="..." style="width:40px; height:40px; " ></td>
      <td><?php echo $row['title']?></td>
      <td><a href="a_detail.php?detail=<?php echo $row['id']?>">Detail</a><br><a href="a_detail.php?delete=<?php echo $row['id']?>">Delete</a></td>
      

    </tr>
    
    <?php  }?>
</table>



</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
