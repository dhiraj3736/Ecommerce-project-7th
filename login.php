



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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto " >
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                
            
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Sign Up</a>
                </li>
               
            </ul>
        </div>
    </nav>

   

    <!-- Blog Section -->
    <section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-3">Log In</h2>

              <form method="post" action="session.php"  onsubmit="return Validate()">
                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="email" name="emai" class="form-control form-control-lg" />
                  </div>

                <div class="form-outline mb-2">
                <label class="form-label" for="form3Example4cg">Password</label>
                  <input type="password" id="password" name="passwor" class="form-control form-control-lg" />
                 </div>
                <div class="d-flex justify-content-center">
                 <input type="submit" name="login" value="Login" >
                </div>

                <p class="text-center text-muted mt-5 mb-0">Not have account? <a href="signup.php"
                    class="fw-bold text-body"><u>Register</u></a></p>

              </form>
              <script>
                            function Validate() {
                            
                                var email = document.getElementById("email").value;
                                var pass = document.getElementById("password").value;
                            

                                // Check if any field is empty
                                if (email.trim() === '' || pass.trim() === '') {
                                    alert('Please fill in all fields');
                                    return false;
                                }

                                return true; // Form is valid, proceed with submission
                            }
                </script>
   
    
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
    
 
   






   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
