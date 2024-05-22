<?php
session_start();
include('connection.php');

if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

// Fetch the user's details
$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$row = mysqli_query($conn, $sql);
$bow = mysqli_fetch_array($row);
$cart_count = "SELECT count(*) AS row_count FROM card where u_id=$id";
$count = mysqli_query($conn, $cart_count);
$ro = mysqli_fetch_array($count);

// Fetch category IDs from the database

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
            border: none;
            border-radius: 5px;
            /* Add any other styles you need */
        }

        .black-text {
            color: black;
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


    <div class="container mt-5" style="width: 600px; border: 1px solid #ced4da; padding: 20px;">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_image" class="form-label">Image:</label>
                <input type="file" name="product_image" accept="image/x-png,image/jpeg" class="form-control" id="product_image">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="des" rows="4" cols="50" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Price:</label>
                <input type="text" name="price" class="form-control" id="title">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select name='c_id' id='category' class="form-select">
                    <option value="">Select Category</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT id,Name FROM category") or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <option value='<?php echo $row['id'] ?>'><?php echo $row['Name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3" id="brandfield" style="display:none;">
                <label for="category" class="form-label">Brand:</label>
                <select name='b_id' id='brand' class="form-select">
                    <?php
                    $query = mysqli_query($conn, "SELECT id,B_name,c_id FROM brand") or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <option value=''></option>
                        <option value='<?php echo $row['id'] ?>' data_category='<?php echo $row['c_id'] ?>'><?php echo $row['B_name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3" id="bike_car_info" style="display: none;">
                <label for="bike_car_info" class="form-label">Add all the product or service specifications.</label>


                <div class="d-flex" style="padding:10px;">
                    <select name="v_type" id="type" class="form-select ">
                        <option value="">type*</option>
                        <option value="standard">standard</option>
                        <option value="dirt">dirt</option>
                    </select>
                    <input type="text" name="make_year" placeholder="Make year" class="form-control">

                </div>
                <div class="d-flex" style="padding:10px;">
                    <select name="transmission" id="" class="form-select ">
                        <option value="">Transmission*</option>
                        <option value="automatic">automatic</option>
                        <option value="mannual">mannual</option>
                    </select>
                    <input type="text" name="engine" placeholder="Engine(CC)" class="form-control">

                </div>

                <div class="d-flex" style="padding:10px;">
                    <input type="text" name="km" placeholder="Kilometer Run" class="form-control">
                    <input type="text" name="color" placeholder="Color" class="form-control">

                </div>
                <div class="d-flex" style="padding:10px;">
                    <select name="fuel" id="" class="form-select ">
                        <option value="">Fuel*</option>
                        <option value="petrol">Petrol</option>
                        <option value="diesel">Diesel</option>
                        <option value="electric">Electric</option>
                    </select>
                    <input type="text" name="feature" placeholder="Feature" class="form-control">

                </div>
                <div class="d-flex" style="padding:10px;">
                    <input type="text" name="lot" placeholder="Lot No" class="form-control">
                    <input type="text" name="mileage" placeholder="Mileage" class="form-control">

                </div>

            </div>


            <div id="additionalFields" style="display: none;">
                <div class="d-flex" style="padding:10px;">
                    <select name="h_type" id="type" class="form-select ">
                        <option value="">house type*</option>
                        <option value="bunglow">bunglow</option>
                        <option value="apartment">apartment</option>

                    </select>
                    <input type="text" name="broom" placeholder="BedRoom" class="form-control">
                    <input type="text" name="bathroom" placeholder="BathRoom" class="form-control">

                </div>

                <div class="d-flex" style="padding:10px;">

                    <input type="text" name="l_room" placeholder="Leaving Room" class="form-control">
                    <select name="road_type" id="type" class="form-select ">
                        <option value="">Road type*</option>
                        <option value="pitched">pitched</option>
                        <option value="gravel">gravel</option>
                    </select>
                    <input type="text" name="road_size" placeholder="Road Size" class="form-control">

                </div>

                <div class="d-flex" style="padding:10px;">
                    <select name="furnish" id="type" class="form-select ">
                        <option value="">Furnishing*</option>
                        <option value="full">full</option>
                        <option value="semi">semi</option>

                    </select>
                    <input type="text" name="kitchen" placeholder="Kitchen" class="form-control">
                    <input type="text" name="h_feature" placeholder="Feature" class="form-control">

                </div>

             
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <script>
            document.getElementById('category').addEventListener('change', function() {
                var selectedCategoryId = this.value;
                var brandField = document.getElementById('brandfield');
                var additionalFieldsContainer = document.getElementById('additionalFields');
                var bikeCarInfoContainer = document.getElementById('bike_car_info');

                if (selectedCategoryId !== '') {
                    brandField.style.display = 'block'; // Show the brand field

                    // Show the appropriate container based on the selected category
                    if (selectedCategoryId === '14') {
                        additionalFieldsContainer.style.display = 'block'; // Show additional fields container
                        bikeCarInfoContainer.style.display = 'none'; // Hide bike_car_info container
                    } else {
                        additionalFieldsContainer.style.display = 'none'; // Hide additional fields container
                        bikeCarInfoContainer.style.display = 'block'; // Show bike_car_info container
                    }

                    // Show/hide options based on the selected category
                    var brandDropdown = document.getElementById('brand');
                    for (var i = 0; i < brandDropdown.options.length; i++) {
                        var option = brandDropdown.options[i];
                        if (option.getAttribute('data_category') === selectedCategoryId || selectedCategoryId === '') {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    }
                } else {
                    brandField.style.display = 'none'; // Hide the brand field
                    additionalFieldsContainer.style.display = 'none'; // Hide additional fields container
                    bikeCarInfoContainer.style.display = 'none'; // Hide bike_car_info container
                }
            });
        </script>

    </div>


    <?php
    include("connection.php");

    if (isset($_POST['submit'])) {
        // Gather data from the form
        $title = $_POST['title'];
        $des = $_POST['des'];
        $product_image = $_FILES["product_image"]["name"];
        $c_id = $_POST['c_id'];
        $b_id = $_POST['b_id'];
        $price = $_POST['price'];
        $v_type = $_POST['v_type'];
        $makeyear = $_POST['make_year'];
        $tran = $_POST['transmission'];
        $engine = $_POST['engine'];
        $km = $_POST['km'];
        $color = $_POST['color'];
        $fuel = $_POST['fuel'];
        $feature = $_POST['feature'];
        $lot = $_POST['lot'];
        $mileage = $_POST['mileage'];
        
        $h_type=$_POST['h_type'];
        $bedroom=$_POST['broom'];
        $bathroom=$_POST['bathroom'];
        $l_room=$_POST['l_room'];
        $road_type = $_POST['road_type'];
        $road_size = $_POST['road_size'];
        $furnish=$_POST['furnish'];
        $kitchen=$_POST['kitchen'];
        $h_feature=$_POST['h_feature'];

        // Insert data into item table
        $sql_item = "INSERT INTO item (image, title, discription, price, c_id, b_id, u_id,type, make_year, transmission, engine, km, color, fuel, feature, lot, mileage,house_type,bath_room,bed_room,leaving_room,rood_type,road_size,furnishing,kitchen,h_featur)
                 VALUES ('$product_image', '$title', '$des', '$price', '$c_id', '$b_id', '$id', '$v_type', '$makeyear', '$tran', '$engine', '$km', '$color', '$fuel', '$feature', '$lot', '$mileage','$h_type','$bathroom','$bedroom','$l_room','$road_type','$road_size','$furnish','$kitchen','$h_feature')";
        $qq = mysqli_query($conn, $sql_item);

        if ($qq) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>