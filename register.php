<?php
    
    require 'db_connection.php';
    ?>
<?php
    $account = false;
    $err = false;
    $passError = false;
    $fieldEmpty = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cname = $_POST['cname'];
            $cusername = $_POST['cusername'];
            $cemail = $_POST['cemail'];
            $cpass = $_POST['cpass'];
            $ccpass = $_POST['ccpass'];
            $passHash = password_hash($cpass, PASSWORD_DEFAULT);
            $existSql = "SELECT * FROM `login` WHERE username='$cusername'";
            $existResult = mysqli_query($con, $existSql);
            $existRows = mysqli_num_rows($existResult);
            if(empty($cname) ||empty($cusername) || empty($cpass) || empty($cemail) || empty($ccpass)){
                $fieldEmpty = true;
            }else{
                if($existRows > 0){
                    $err = true;
                }else{
                    if ($cpass == $ccpass) {
                        $sql = "INSERT INTO `login` (`name`, `username`, `email`, `pass`) VALUES ('$cname', '$cusername', '$cemail', '$passHash')";
                        $result = mysqli_query($con, $sql);
                        if($result){
                            $account = true;                  
                            
                    }else{
                        $err = true;
                    }
                
                    }else{
                        $passError = true;
                    }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>PHP Login System</title>
</head>

<body>
<?php require 'header.php'; ?>
    <div class="container">
        <?php
    if($account == true){ 
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account successfully created<a href="login.php"> click here</a> to login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($err == true){ 
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> username already exist.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($passError == true){ 
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Password Does Not Match.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($fieldEmpty == true){ 
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Your Fields are Empty.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    echo '<div class="container mt-5" style="text-align: center;"><h3>Register here if you can not have account.</h3></div>';
    ?>
        <form class="mt-3" action="" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Enter Name</label>
                <input type="text" name="cname" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Name" require>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Enter Username</label>
                <input type="text" name="cusername" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Username" require>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="cemail" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Email" require>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Enter Password</label>
                <input type="password" name="cpass" class="form-control" id="exampleInputPassword1"
                    placeholder="Password" require>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" name="ccpass" class="form-control" id="exampleInputPassword1"
                    placeholder="Confirm Password" require>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>