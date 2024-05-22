<?php
session_start();
include('connection.php');

if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

// Constants for pagination
  

$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$row = mysqli_query($conn, $sql);
$bow = mysqli_fetch_array($row);
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
</button></div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto ">
               
                <li class="nav-item active">
                    <a class="nav-link" href="Userdashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mypost.php">My post</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="additem.php">Add Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

   
    <?php include('pnav.php') ?>
   <div>
   <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-3">change profile</h2>

              <form method="post" action=""  >

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="name" name="name" value="<?php echo $bow['Name'] ?>" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="email" name="email" value="<?php echo $bow['Email'] ?>" class="form-control form-control-lg" />
                  </div>
                  
                  <label class="form-label" for="confirmPassword">update password</label>
    <div class="form-outline mb-2">
        <input type="password" id="oldPassword" name="oldPassword" class="form-control form-control-lg" placeholder="Old Password" />
    </div>

    <div class="form-outline mb-2">
        <input type="password" id="newPassword" name="newPassword" class="form-control form-control-lg" placeholder="New Password" />
    </div>

    <div class="form-outline mb-2">
    
        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg" placeholder="Confirm Password"/>
    </div>



                <div class="d-flex justify-content-center">
                 <input type="submit" name="submit" value="submit" >
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   </div>

          <?php
        
          include 'connection.php';
          if(isset($_POST['submit'])){
            $u_id=$_SESSION['id'];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $old_pass=$_POST['oldPassword'];
            $new_passw=$_POST['newPassword'];
            $comfirm_passw=$_POST['confirmPassword'];

           
            $sql="UPDATE user SET Name='$name',Email='$email',Password='$new_passw' where Password='$old_pass' and id='$u_id'";
            mysqli_query($conn,$sql);

          }
          ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
