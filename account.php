<?php
session_start();
    require 'db_connection.php';

    $loggedin = false;
    if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
      header("location: login.php");
      exit;
    }else{
      $loggedin = true;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>PHP Login System</title>
</head>

<body>
    <?php
  $passErr = false;
  require 'header.php';
  $user = $_SESSION['username'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $currentPass = $_POST['currentPassword'];
    $newPass = $_POST['newPassword'];
    $confirmNewPass = $_POST['confirmNewPassword'];
    $hashPass = password_hash($newPass, PASSWORD_DEFAULT);
    $sqlCheck = "SELECT * FROM `login` WHERE `username` = '$user'";
    $resultCheck = mysqli_query($con, $sqlCheck);
    $numRows = mysqli_num_rows($resultCheck);
    while($row = mysqli_fetch_assoc($resultCheck)){
      $pass = password_verify($currentPass, $row['pass']);
      if($pass){
        $hashPass = password_hash($newPass, PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE `login` SET `pass` = '$hashPass' WHERE `username` = '$user'";
        $resultUpdate = mysqli_query($con, $sqlUpdate);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your password is successfully updated.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Password Does Not Match.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
    
  }

?>
    <?php 
     
     $user = $_SESSION['username'];
     $sql = "SELECT * FROM `login` WHERE username='$user'";
     $result = mysqli_query($con, $sql);
     $fetchRow = mysqli_num_rows($result);
     while($row=mysqli_fetch_assoc($result)){
       echo '<div class="container"><div class="alert mt-5 alert-success" role="alert">
       <h4 class="alert-heading">Hey '.$row['name'].'</h4>
       <p>Your name is '.$row['name'].', Your username is '.$row['username'].', And your email is '.$row['email'].'</p>
       <hr>
       <p class="mb-0">Hope you are enjoying our website.</p>
     </div></div>';
     }
 ?>




    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter">
            Change Password
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Your Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Current Password</label>
                                <input type="password" name="currentPassword" class="form-control"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" name="newPassword" class="form-control"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm New Password</label>
                                <input type="password" name="confirmNewPassword" class="form-control"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-outline-success">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>