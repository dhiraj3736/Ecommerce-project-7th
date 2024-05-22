
<?php
    
session_start();
include('connection.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>
  <?php
        $id=$_SESSION['id'];
        $sql="SELECT * FROM user WHERE id='$id'";
        $row=mysqli_query($conn,$sql);
		$bow=mysqli_fetch_array($row);
       
       
        
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            padding-top: 56px;
        }

        content {
            padding: 20px;
        }

     
        .navbar-nav li {
            margin-right: 15px;
        }
        .navbar-nav li a {
            color: white !important;
        }
        .custom-button {
        background-color: #3361FF;
        color: white;
        border:none;
        border-radius: 5px;
        /* Add any other styles you need */
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

       <div class="navbar-brand">Welcome <?php echo $bow['Name']?></div>
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto " >
                <li class="nav-item">
                    <a class="nav-link" href="Userdashboard.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mypost.php">My post</a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="additem.php">Add Blog</a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

   

 
    


       

  <div class="container mt-5">
  <?php
    include('connection.php');
   
if (isset($_POST['submit'])) {
    if (isset($_POST['sid'])) {
        $sid = $_POST['sid']; 
        $query = mysqli_query($conn,"SELECT * from item where id='$sid'")or die(mysqli_error($conn));
	$value= mysqli_fetch_array($query);
        
?>
        
        
        <form action="detail.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_image" class="form-label">Image:</label>
                <input type="file" name="product_image" accept="image/x-png,image/jpeg" value="<?php echo $value['title'];?>" class="form-control" id="product_image" required>
            
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" value="<?php echo $value['title'];?>" class="form-control" id="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="des" rows="4"  cols="50" class="form-control" required><?php echo $value['discription'];?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $sid;?>">
            
            <input type="submit" name="submit" value ="Update" class="btn btn-primary">

            <?php
     }
    }
    ?>
        </form>
    
    </div> 
    
 
   
   
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>















