
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
       
        $cart_count = "SELECT count(*) AS row_count FROM card where u_id=$id";
        $count = mysqli_query($conn, $cart_count);
        $ro = mysqli_fetch_array($count);
        
        
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
    .card.blog-card:hover {
    cursor: pointer;
}
 /* Custom CSS to remove border around title and price */
 .card .card-body .card-title,
    .card .card-body .card-text {
        border: none;
        text-decoration: none; /* Corrected */
    }
    .card .card-body a {
        text-decoration: none;
        border: none;
    }


    .card-img-top {
            height: 200px; /* Adjust as needed */
            object-fit: cover;
        }

        /* Ensure card titles and text do not overflow */
        .card-title,
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
        }
     
    
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="navbar-brand">Welcome
            <button class="btn text-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <?php echo $bow['Name'] ?>
            </button>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="pimage/icon.png" alt="Icon" width="20" height="20"><?php echo $ro["row_count"]; ?>
                    </button>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Userdashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mypost.php">My post</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="additem.php">Add Post</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <?php include('cart.php') ?>
    <?php include('pnav.php') ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search for articles...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Section -->

    
    <div class="container mt-5">
      
       
        

        <div class="row">
        <?php
        include('connection.php');
        $sql="SELECT * FROM item where u_id=$id ORDER BY id DESC";
        $query=mysqli_query($conn,$sql);
        foreach($query as $row){
            $a=$row['image'];
            
            ?>
            <div class="col-md-3">
                <div class="card blog-card">
                <img src="/ambition_guru/day4/pimage/<?php echo $row['image']; ?>" class="card-img-top" alt="...">

                    <div class="card-body blog-content">
                      <h5 class="card-title"><?php echo $row['title'];?></h5>
                      <!-- <p class="card-text"><?php echo $row['discription'];?></p> -->
                      <a href="detail.php?id=<?php echo $row['id']; ?>&c_id=<?php echo $row['c_id']; ?>" class="btn btn-primary custom-button">Detail</a>

                    <form action="Delete.php" method="post" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <input type="submit" name="submit" value="Delete" class="custom-button">
                    </form>
                    <form action="update.php" method="post" class="d-inline" >
                    <input type="hidden" name="sid" value="<?php echo $row['id'];?>">

                        <input type="submit" name="submit" value="update" class="custom-button">
                    </form>
                    <!-- <form action="public.php" method="post" class="d-inline" >
                    <input type="hidden" name="sid" value="<?php echo $row['id'];?>">
                    
                        <input type="submit" name="submit" value="public" class="custom-button" onclick="toggleButton();"> -->



                      
                        
                    </form>
                    
                      <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <?php
    }
        ?>
           
           
         
        </div>
 
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
