<?php



$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$row = mysqli_query($conn, $sql);
$bow = mysqli_fetch_array($row);
?>


<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel" style=" margin-top:50px; width: 250px; height: 250px;">
<div class="offcanvas-header">
    <img src="pimage/pro.webp" alt="Icon" width="20" height="20">
    <h5 class="offcanvas-title" id="staticBackdropLabel"><?php echo $bow['Name'] ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   
</div>
<div style="margin-top: -10px; margin-left: 40px"> <!-- You can adjust the margin-top value as needed -->
        <a href="profile.php">View Profile</a>
    </div>
    <div class="container">
    <!-- Your content here -->
    <hr class="straight-line">
</div>

    <div class="offcanvas-body">
       <ul >
        <li><img src="pimage/pp.png" alt="Icon" width="20" height="20"><a href="" style="padding:15px;" class="ppp">contact support</a></li>
        <li><img src="pimage/setting.png" alt="Icon" width="20" height="20"><a href="change_profile.php"style="padding:15px;" class="ppp">Setting</a></li>
        <li><img src="pimage/logout.png" alt="Icon" width="20" height="20"><a href="signout.php"style="padding:15px;" class="ppp">logout</a></li>
        

       </ul>
          
    </div>
</div>
<style>
    ul{
        margin-right: 10px;
        
    }
    li{
        margin-top: 10px;
        list-style-type: none;

       
    }
    .ppp{
        text-decoration: none;
        color: black;
        padding: 15px;
    }
    .straight-line {
        border-top: 1px solid #000; /* Define the style of the line */
        margin: 10px 0; /* Adjust margin as needed */
    }
    li:hover{
        color:white;
        background-color: #D6DDF4;
    }
    li:hover .ppp {
        color: white; /* Change link color on hover */
    }
    #staticBackdrop{
        border-radius: 5px;
     
    }
</style>
