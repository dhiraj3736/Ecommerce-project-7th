<?php
include("connection.php");
session_start();

if (isset($_POST['submit'])) {
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
        $path = "C:/xampp/htdocs/ambition_guru/day4/pimage/";
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $path . $_FILES["product_image"]["name"]);
        $title = $_POST['title'];
        $des = $_POST['des'];
        $uid = $_POST['id'];
        $product_image = $_FILES["product_image"]["name"];

        $sql = "UPDATE item SET image='$product_image', title='$title', discription='$des' where id='$uid'";
        if (mysqli_query($conn, $sql)) {
            // header("location: detail.php?id=$uid");


        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // echo "Error uploading file.";
    }
}


if (isset($_SESSION['id'])) {
    // If user is logged in, execute the code
    $id = $_SESSION['id'];

    // Fetch user data
    $sql = "SELECT * FROM user WHERE id='$id'";
    $row = mysqli_query($conn, $sql);
    $bow = mysqli_fetch_array($row);

    // Count items in the cart
    $cart_count = "SELECT count(*) AS row_count FROM card WHERE u_id=$id";
    $count = mysqli_query($conn, $cart_count);
    $ro = mysqli_fetch_array($count);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            padding-top: 56px;
        }

        .container{
            padding: 10px;
            margin: 40px;

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
            border: none;
            border-radius: 5px;
            /* Add any other styles you need */
        }


        .img {
            margin: 0px;
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        .blog-item {
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .blog-item {
                display: flex;
                align-items: center;
            }

            .blog-item .title {
                margin-left: 20px;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: #f2f2f2;
        }

        th {
            background-color: #f2f2f2;

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="navbar-brand">Welcome

            <?php if (isset($_SESSION['id'])) : ?>
                <button class="btn text-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <?php echo $bow['Name']; ?>
                </button>
            <?php endif; ?>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <?php if (isset($_SESSION['id'])) { ?>
                    <li class="nav-item">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="pimage/icon.png" alt="Icon" width="20" height="20"><?php echo $ro["row_count"]; ?>
                        </button>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo isset($_SESSION['id']) ? 'Userdashboard.php' : 'dashboard.php'; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mypost.php">My post</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="additem.php">Add Blog</a>
                </li>


            </ul>
        </div>
    </nav>
    <?php
    if (isset($_SESSION['id'])) {
        // If user is logged in, execute the code
        include('cart.php');
        
    }
    // include('pnav.php');
    ?>



    <div class="container">
        <div class="row">
            <?php
            include('connection.php');
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM item INNER JOIN user ON user.id = item.u_id where item.id='$id'";



                $query = mysqli_query($conn, $sql);
                foreach ($query as $row) {
            ?>
                    <div class="col-md-3" style="margin-left: 0px;">
                        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
                        <div class="blog-item">
                            <img src="/ambition_guru/day4/pimage/<?php echo htmlspecialchars($row['image']); ?>" class="img" alt="Your Image Description"><br>
                        </div>
                        <h4 style="color: red;"><?php echo "Rs." . htmlspecialchars($row['price']); ?></h4>


                        <div class="title">
                            <h5>Discription</h5>
                            <p><?php echo htmlspecialchars($row['discription']); ?></p>
                        </div>
                    </div>

                    <div class="col-md-6" >
                        <h4 class="col" style="text-align: center;">Published By:</h4>
                        <h5 class="col" style="text-align: center; color: red;"><?php echo htmlspecialchars($row['Name']); ?></h5>

                        <div style="margin-top: 40px; ">
                            <table border="1">
                                <h6>specification</h6>

                                <?php if (!empty($row['type'])) : ?>
                                    <tr>
                                        <th>Type</th>
                                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                                    </tr>
                                <?php endif; ?>


                                <?php if (!empty($row['make_year'])) : ?>
                                    <tr>
                                        <th>Make year</th>
                                        <td><?php echo htmlspecialchars($row['make_year']); ?></td>
                                    </tr>
                                <?php endif; ?>


                                <?php if (!empty($row['transmission'])) : ?>
                                    <tr>
                                        <th>Transmission</th>
                                        <td><?php echo htmlspecialchars($row['transmission']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['engine'])) : ?>
                                    <tr>
                                        <th>Engine</th>
                                        <td><?php echo htmlspecialchars($row['engine']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['color'])) : ?>
                                    <tr>
                                        <th>Color</th>
                                        <td><?php echo htmlspecialchars($row['color']); ?></td>
                                    </tr>
                                <?php endif; ?>


                                <?php if (!empty($row['km'])) : ?>
                                    <tr>
                                        <th>Kilometer</th>
                                        <td><?php echo htmlspecialchars($row['km']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['fuel'])) : ?>
                                    <tr>
                                        <th>Fuel</th>
                                        <td><?php echo htmlspecialchars($row['fuel']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['feature'])) : ?>
                                    <tr>
                                        <th>Feature</th>
                                        <td><?php echo htmlspecialchars($row['feature']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['lot'])) : ?>
                                    <tr>
                                        <th>Lot no.</th>
                                        <td><?php echo htmlspecialchars($row['lot']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['mileage'])) : ?>
                                    <tr>
                                        <th>Mileage</th>
                                        <td><?php echo htmlspecialchars($row['mileage']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['house_type'])) : ?>
                                    <tr>
                                        <th>House type</th>
                                        <td><?php echo htmlspecialchars($row['house_type']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['bed_room'])) : ?>
                                    <tr>
                                        <th>Bed Room</th>
                                        <td><?php echo htmlspecialchars($row['bed_room']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['bath_room'])) : ?>
                                    <tr>
                                        <th>Bath Room</th>
                                        <td><?php echo htmlspecialchars($row['bath_room']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['leaving_room'])) : ?>
                                    <tr>
                                        <th>Leaving Room</th>
                                        <td><?php echo htmlspecialchars($row['leaving_room']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['rood_type'])) : ?>
                                    <tr>
                                        <th>Road type</th>
                                        <td><?php echo htmlspecialchars($row['rood_type']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['road_size'])) : ?>
                                    <tr>
                                        <th>Road Size</th>
                                        <td><?php echo htmlspecialchars($row['road_size']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['furnishing'])) : ?>
                                    <tr>
                                        <th>Furnishing</th>
                                        <td><?php echo htmlspecialchars($row['furnishing']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['kitchen'])) : ?>
                                    <tr>
                                        <th>Kitchen</th>
                                        <td><?php echo htmlspecialchars($row['kitchen']); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($row['h_featur'])) : ?>
                                    <tr>
                                        <th>Feature</th>
                                        <td><?php echo htmlspecialchars($row['h_featur']); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </table>

                        </div>


                    </div>
            <?php
                }
            } ?>
            <div class="col-md-3" >
                <h4 style="color: red;">similar product</h4>
                <div class="row" style="width: 100%">
                    <?php
                    if (isset($_GET['c_id'])) {
                        $cid = $_GET['c_id'];
                        $sql = "SELECT * FROM item where c_id=$cid";
                        $ro = mysqli_query($conn, $sql);
                    }
                    ?>

                    <?php foreach ($ro as $row) { ?>
                        <div class="col-md-6 mb-4" >
                            <a href="detail.php?id=<?php echo $row['id']; ?>&c_id=<?php echo $row['c_id']; ?>" class="card blog-card">
                                <div class="ram card">
                                    <img src="/ambition_guru/day4/pimage/<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body blog-content">
                                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                        <p class="card-text"><?php echo "Rs." . $row['price']; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>



        </div>










        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>