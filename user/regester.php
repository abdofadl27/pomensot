<?php 
include 'conn.php';
?>

<!doctype html>
<html>
    
    
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">



    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  
</head>
    
   
    
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-Pomen">
    <div class="container">
    <h1 class="navbar-brand" href="#">Pomen</h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>

    </div>
    </div>
</nav>
<?php
        if(isset($_POST['submit']))
        {    
        $name = $_POST['full_name'];
        $email = $_POST['email_address'];
        $Password = $_POST['Password'];
        $confirm_Password = $_POST['confirm_password'];
            
        

if ($_POST["Password"] === $_POST["confirm_password"]) {
  
    $sql_user = "SELECT * FROM users WHERE username='$name'";
  	$sql_email = "SELECT * FROM users WHERE email='$email'";
  	$user_query = mysqli_query($connection, $sql_user);
  	$email_query = mysqli_query($connection, $sql_email);

  	if (mysqli_num_rows($user_query) > 0) {
  	 
        echo '<script>alert("Username already taken")</script>';
  	}else if(mysqli_num_rows($email_query) > 0){
  	
echo '<script>alert("Email already taken")</script>'; 	
  	}else{
    $sql = "INSERT INTO users (username,email,password) VALUES ('$name','$email','$Password')";
    if (mysqli_query($connection, $sql)) {
    
    } else {
    echo "Error: " . $sql . ":-" . mysqli_error($connection);
    }
}}
else {
   echo '<script>alert("password does not match")</script>';
}
    
        
        }
        ?>
    
    
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="" method="post">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input required type="text" id="full_name" class="form-control" name="full_name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input required type="email" id="email_address" class="form-control" name="email_address">
                                    </div>
                                </div>



                                

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input required type="password" id="Password" class="form-control" name="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input required type="password" id="confirm_Password" class="form-control" name="confirm_password">
                                    </div>
                                </div>
                                

                              

                             

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>


</body>


<!-- initialize jQuery Library -->
  <script src="templ_public/plugins/jQuery/jquery.min.js"></script>
  <!-- Bootstrap jQuery -->
  <script src="templ_public/plugins/bootstrap/bootstrap.min.js" defer></script>
  <!-- Slick Carousel -->
  <script src="templ_public/plugins/slick/slick.min.js"></script>
  <script src="templ_public/plugins/slick/slick-animation.min.js"></script>
  <!-- Color box -->
  <script src="templ_public/plugins/colorbox/jquery.colorbox.js"></script>
  <!-- shuffle -->
  <script src="templ_public/plugins/shuffle/shuffle.min.js" defer></script>


  <!-- Google Map API Key-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
  <!-- Google Map Plugin-->
  <script src="templ_public/plugins/google-map/map.js" defer></script>

  <!-- Template custom -->
  <script src="templ_public/js/script.js"></script>
</html>