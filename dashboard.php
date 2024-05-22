<?php
include('connection.php');
$sql = "SELECT id, Name from category";
$bow = mysqli_query($conn, $sql);
$category = [];
while ($row = mysqli_fetch_assoc($bow)) {
    $category[$row['id']] = $row['Name'];
}
$brandQuery = null;



if (isset($_POST['search'])) {
    $search = $_POST['searc'];
    $sql = "SELECT * FROM item WHERE title='$search' ORDER BY id DESC";
} elseif (isset($_GET['category_id']) && isset($_GET['b_id'])) {
    $categoryId = $_GET['category_id'];
    $b_id = $_GET['b_id'];
    $sql = "SELECT * FROM item WHERE b_id=$b_id  ORDER BY id DESC";
    $brandQuery = mysqli_query($conn, "SELECT B_name,id
                            FROM brand where c_id=$categoryId
                            ");
} elseif (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $sql = "SELECT * FROM item where c_id=$categoryId ORDER BY id DESC";
    $brandQuery = mysqli_query($conn, "SELECT DISTINCT brand.B_name, brand.id
                   FROM item 
                   INNER JOIN brand ON brand.id = item.b_id 
                   WHERE item.c_id = $categoryId");
} else {
    $sql = "SELECT * FROM item ORDER BY id DESC ";
}

$query = mysqli_query($conn, $sql);

// Prepare HTML for dynamic content
$html = '';
while ($row = mysqli_fetch_assoc($query)) {
    $html .= '<div class="col-md-4" style="padding:10px 30px">';
    $html .= '<a href="detail.php?id=' . $row['id'] .'& c_id='.$row['c_id']. '" class="card blog-card">';
    $html .= '<div class="card ram">';
    $html .= '<img src="/ambition_guru/day4/pimage/' . $row['image'] . '" class="card-img-top" alt="...">';
    $html .= '<div class="card-body blog-content">';
    $html .= '<h5 class="card-title">' . $row['title'] . '</h5>';
    $html .= '<p class="card-text">Rs.' . $row['price'] . '</p>';
    $html .= '<a href="detail.php?id=' . $row['id'] . '& c_id='.$row['c_id']. '" class="btn btn-primary custom-button" style="margin-right: 10px;">Detail</a>';
    $html .='<a href="add_to_card.php?add_id='.$row['id'].'" class="btn btn-primary custom-button">Add to Cart</a>';

    $html .= '</div></div></a></div>';
}



// Echo the HTML response

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
            color: white;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f8f9fa;
            /* Change the background color on hover */
            color: #007bff;
            /* Change the text color on hover */
        }

        /* Hover effect for category links */
        .category-link:hover {
            background-color: blue;
            /* Change the background color on hover */
            color: #007bff;
            /* Change the text color on hover */
        }

        .custom-button {
            background-color: #3361FF;
            color: white;
            border: none;
            border-radius: 5px;
            /* Add any other styles you need */
        }

        /* Custom CSS for the second column */
        .second-column {
            background-color: #f8f9fa;
            /* Light gray background */
            padding: 10px;
            /* Add padding */
            border-radius: 10px;
            /* Add border radius */
            margin-top: 5px;
            /* Add top margin */
        }

        .second-column h4 {
            margin-bottom: 15px;
            /* Add bottom margin to headings */
        }

        .second-column .nav-item {
            margin-bottom: 10px;
            /* Add bottom margin to navigation items */
        }

        .category-link:hover {
            background-color: #f8f9fa;
            /* Change the background color on hover */
            color: #007bff;
            /* Change the text color on hover */
        }

        .card.blog-card:hover {
            cursor: pointer;
        }

        /* Custom CSS to remove border around title and price */
        .card .card-body .card-title,
        .card .card-body .card-text {
            border: none;
            text-decoration: none;
            /* Corrected */
        }

        .card .card-body a {
            text-decoration: none;
            border: none;
        }


        .card-img-top {
            height: 200px;
            /* Adjust as needed */
            object-fit: cover;
        }

        /* Ensure card titles and text do not overflow */
        .card-title,
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ram:hover {
            transform: translateY(-8px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6);
        }

        .ram {

            box-shadow: -0 4px 6px rgba(0, 0, 0, 0.3);
            /* Add shadow effect */
        }
    </style>

</head>

<body>
   <?php include('all/nav.php'); ?>

    <div class="container mt-4">
   
   
        <?php include('all/search.php'); ?>

        <!-- Blog Section -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-10">

                <?php include('all/nav2.php'); ?>
         



                    <div class="row" id="dynamic-content">
                       <?php echo $html; ?>
                    </div>
                </div>
           
                <div class="col-md-2  second-column">
                    <!-- Category menu -->
                    <?php include('all/category.php'); ?>
            </div>
        </div>
      

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
