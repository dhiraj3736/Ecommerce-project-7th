<?php
include("connection.php");







    // Fetch user data
 
    // Count items in the cart

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
 



    <div class="container">
        <div class="row">
            <?php
            include('connection.php');
            if (isset($_GET['detail'])) {
                $id = $_GET['detail'];
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
           



        </div>










        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>