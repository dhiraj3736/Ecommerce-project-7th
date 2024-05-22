<?php
session_start();
include('connection.php');

if (!isset($_SESSION['username'])) {
    header('location:login.php');
}







if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];


    $sql = "SELECT item.id,item.image,item.title,item.price,item.discription
    FROM item
    INNER JOIN card on card.p_id=item.id 
    where card.u_id=$u_id;
    ";
    // $que=mysqli_query($conn,$sql);




    // $sq = "SELECT * FROM item WHERE u_id='$u_id'";

    // Execute the query
} elseif (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    $sql = "SELECT * FROM item WHERE u_id='$id'";
} else {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM item WHERE u_id='$id'";
}
$query = mysqli_query($conn, $sql);




$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$row = mysqli_query($conn, $sql);
$bow = mysqli_fetch_array($row);

$cart_count = "SELECT count(*) AS row_count FROM card where u_id=$id";
$count = mysqli_query($conn, $cart_count);
$ro = mysqli_fetch_array($count);





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            color: white;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }






        .vertical-line {
            border-left: 1px solid black;
            /* Adjust color and thickness as needed */
            height: 500px;
            /* Adjust height as needed */
        }


        .image-container {
            display: flex;
            gap: 4px;
        }

        .image-container img {
            max-width: 50%;
            height: auto;
        }

        .image-details {
            flex: 1;
        }

        .image-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .image-description {
            font-size: 14px;
            margin-bottom: 5px;
            color: #666;
        }

        .image-price {
            font-size: 16px;
            font-weight: bold;
            color: #f00;
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

    <div class="container mt-4">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="input-group mb-3">
                    <div class="container text-center">
                        <form action="" method="post" class="d-inline">
                            <div class="d-flex justify-content-center">
                                <input type="text" class="form-control me-2" name="searc" placeholder="Search ...">
                                <button type="submit" name="search" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Section -->
    <div class="container mt-2">
        <div class="row">


            <div class="col-md-3">
                <div>

                    <div class="profile">
                        <img src="pimage/pro.jpg" alt="Icon" width="200    " height="200">
                        <h1> <?php echo $bow['Name'] ?></h1>
                        <p> <?php echo $bow['Address'] ?></p>
                        <p> <?php echo $bow['Number'] ?> | <a href="mailto:dhirajbikramshah@gmail.com"> <?php echo $bow['Email'] ?></a></p>
                        <p>Member Since: <?php echo $bow['Date'] ?></p>
                        <a href="change_profile.php">Edit Profile</a>
                    </div>
                </div>

            </div>





            <div class="col-md-1 d-flex justify-content-center align-items-center">
                <div class="vertical-line"></div>
            </div>


            <div class="col-md-5" ;>
                <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="height: 30px; padding: 10px 30px;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li>
                                    <a href="?d_id=<?php echo $_SESSION['id'] ?>">My post</a>
                                </li>
                                <li>
                                    <a href="?u_id=<?php echo $bow['id'] ?>">cart</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="image-container" style="display: flex; flex-direction: column; margin-right:200px; margin-top:20px;">
                    <?php foreach ($query as $row) { ?>
                        <div style="display: flex; align-items: center; margin-bottom: 20px;">
                            <img src="pimage/<?php echo $row['image']; ?>" alt="Icon" width="150" height="150">
                            <div class="image-details" style="margin-left: 10px;">
                                <span class="image-title"><?php echo $row['title'] ?></span><br>
                                <span class="image-description"><?php echo $row['discription'] ?></span><br>
                                <span class="image-price"><?php echo $row['price'] ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>


            <div class="col-md-1">
                <div class="vertical-line"></div>

            </div>


        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>