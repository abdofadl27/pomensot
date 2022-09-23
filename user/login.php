<?php include'conn.php';?>
<?php 

if(isset($_POST['submit']))
    {  
    
    $name_or_email = $_POST['name_or_email'];
    $Password = $_POST['password'];
    $sql = "select * from users where ( username='$name_or_email' OR email = '$name_or_email') and password='$Password'";
    $login_query = mysqli_query($connection, $sql);
    $row = mysqli_num_rows($login_query);
    if($row > 0 )
        {
        session_start();
        $_SESSION['username'] = $_POST['name_or_email'];
        $sql="select id from users where username='$name_or_email'";
        $user_id = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_array($user_id)) 
        {
        
            echo "user id = ".$row['id']." ";
            $id=$row['id'];
            $_SESSION['id']=$id;
            echo $_SESSION['id'];
        }

            
        echo "login done";
        }
    else{ echo "fail login ";
        }
  }


    ?>


<html> 
<form action="" method="post">
  <div class="container">
    <label for="name_or_email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="name_or_email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="submit">Login</button>
      
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
    </html>

