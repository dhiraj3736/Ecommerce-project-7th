<?php
session_start();
include('connection.php');

if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

// Constants for pagination
$records_per_page = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

$query = mysqli_query($conn, "SELECT id, Name FROM category") or die(mysqli_error($conn));
$categories = [];
while ($row = mysqli_fetch_assoc($query)) {
    $categories[$row['id']] = $row['Name'];
}



$brandQuery = null; // Initialize $brandQuery to null

$currentCategoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;

if (isset($_POST['search'])) {
    $search = $_POST['searc'];

    $sql = "SELECT * FROM item WHERE title LIKE '%$search%' LIMIT $offset, $records_per_page";
} elseif (isset($_GET['category_id']) && isset($_GET['b_id'])) {
    $categoryId = $_GET['category_id'];
    $b_id = $_GET['b_id'];
    $sql = "SELECT * FROM item WHERE b_id=$b_id  ORDER BY id DESC LIMIT $offset, $records_per_page";
    $brandQuery = mysqli_query($conn, "SELECT B_name,id
                FROM brand where c_id=$categoryId
                ");
} elseif (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $sql = "SELECT * FROM item WHERE c_id=$categoryId ORDER BY id DESC LIMIT $offset, $records_per_page";
    $brandQuery = mysqli_query($conn, "SELECT DISTINCT brand.B_name, brand.id
                FROM item 
                INNER JOIN brand ON brand.id = item.b_id 
                WHERE item.c_id = $categoryId");
} else {
    $sql = "SELECT * FROM item ORDER BY id DESC LIMIT $offset, $records_per_page";
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

        .category-link:hover {
            background-color: blue;
            color: #007bff;
        }

        .custom-button {
            background-color: #3361FF;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .card.blog-card:hover {
            cursor: pointer;
        }

        .card .card-body .card-title,
        .card .card-body .card-text {
            border: none;
            text-decoration: none;
        }

        .card .card-body a {
            text-decoration: none;
            border: none;
        }

        .ram:hover {
            transform: translateY(-8px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6);
        }

        .ram {
            box-shadow: -0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .second-column {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            margin-top: 5px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

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

            <div class="col-md-10">




                <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="height: 30px; padding: 10px 30px;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <?php
                                if ($brandQuery && mysqli_num_rows($brandQuery) > 0) {
                                    while ($brand = mysqli_fetch_assoc($brandQuery)) {
                                ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="?category_id=<?php echo $categoryId; ?>&b_id=<?php echo $brand['id']; ?>"><?php echo $brand['B_name']; ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>



                <!-- Card grid -->
                <div class="row" style="margin:20px">


                    <?php foreach ($query as $row) { ?>

                        <div class="col-md-4" style="padding:10px 30px ">
                            <a href="detail.php?id=<?php echo $row['id']; ?>&c_id=<?php echo $row['c_id']; ?>" class="card blog-card">
                                <div class="ram card">
                                    <img src="/ambition_guru/day4/pimage/<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body blog-content">
                                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                        <p class="card-text"><?php echo "Rs." . $row['price']; ?></p>
                                        <a href="detail.php?id=<?php echo $row['id']; ?>&c_id=<?php echo $row['c_id']; ?>" class="btn btn-primary custom-button">Detail</a>
                                        <a href="add_to_card.php?add_id=<?php echo $row['id']; ?>" class="btn btn-primary custom-button">add to cart</a>

                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <!-- Pagination -->
                <?php
                // Count total number of records
                $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM item"));
                // Calculate total pages
                $total_pages = ceil($total_records / $records_per_page);

                // Pagination links
                echo "<ul class='pagination justify-content-center'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                echo "</ul>";
                ?>

            </div>
            <div class="col-md-2 col-xs-12 second-column">
                <!-- Category menu -->
                <div id="get_category"></div>
                <div class="nav nav-pills flex-column">
                    <h4 class="nav-item">Categories</h4>
                    <?php foreach ($categories as $categoryId => $categoryName) : ?>
                        <li class="nav-item">
                            <a href="?category_id=<?php echo $categoryId; ?>" class="nav-link <?php echo ($categoryId == $currentCategoryId) ? 'active' : ''; ?>">
                                <?php echo $categoryName; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>