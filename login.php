<?php
    require 'db_connection.php';
    
    $fieldsEmpty = false;
    $wrongDetails = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $cusername = $_POST['cusername'];
      $cpass = $_POST['cpass'];
      if(empty($cusername) && empty($cpass)){
        $fieldsEmpty = true;
      }else{
        $sql = "SELECT * FROM `login` WHERE username='$cusername'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
          while($row=mysqli_fetch_assoc($result)){
            if(password_verify($cpass, $row['pass'])){
              session_start();
              $_SESSION['login'] = true;
              $_SESSION['username'] = $cusername;
              header("location: index.php");
            }else{
              $wrongDetails = true;
            }
          }
         
        }else{
          $wrongDetails = true;
        }

      }
    }
?>
  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>PHP Login System</title>
  </head>
  <body>
  <?php require 'header.php'; ?>
  <div class="container">
  <?php
  
  
    if($wrongDetails == true){ 
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Invalid Credentials.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($fieldsEmpty == true){ 
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Fields are empty.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    echo '<div class="container mt-5" style="text-align: center;"><h3>Login Here To Continue.</h3></div>';
    ?>
    </div>
    <div class="container mt-3">
    <form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Enter Username</label>
    <input type="text" class="form-control" name="cusername" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="cpass" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
