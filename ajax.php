<?php
include('connection.php');

$page = $_POST['page'] ?? 1;
$limit = 5;
$row = ($page - 1) * $limit;

// Your SQL query logic based on $_POST parameters

if (isset($_POST['search'])) {
    $search = $_POST['searc'];
    $sql = "SELECT * FROM item WHERE title='$search' ORDER BY id DESC LIMIT $row, $limit";
} elseif (isset($_GET['category_id']) && isset($_GET['b_id'])) {
    $categoryId = $_GET['category_id'];
    $b_id = $_GET['b_id'];
    $sql = "SELECT * FROM item WHERE b_id=$b_id ORDER BY id DESC LIMIT $row, $limit";
} elseif (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $sql = "SELECT * FROM item WHERE c_id=$categoryId ORDER BY id DESC LIMIT $row, $limit";
} else {
    $sql = "SELECT * FROM item ORDER BY id DESC LIMIT $row, $limit";
}

$query = mysqli_query($conn, $sql);

// Prepare HTML for dynamic content
$html = '';
while ($row = mysqli_fetch_assoc($query)) {
    $html .= '<div class="col-md-4" style="padding:10px 30px">';
    $html .= '<a href="detail.php?id=' . $row['id'] . '" class="card blog-card">';
    $html .= '<div class="card ram">';
    $html .= '<img src="/ambition_guru/day4/pimage/' . $row['image'] . '" class="card-img-top" alt="...">';
    $html .= '<div class="card-body blog-content">';
    $html .= '<h5 class="card-title">' . $row['title'] . '</h5>';
    $html .= '<p class="card-text">Rs.' . $row['price'] . '</p>';
    $html .= '<a href="detail.php?id=' . $row['id'] . '" class="btn btn-primary custom-button">Detail</a>';
    $html .= '</div></div></a></div>';
}

// Echo the HTML response
echo $html;
?>
