<?php

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
  $login = true;
  
}else{
  
  $login = false;
  
}
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PHP Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav  ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/PHP_Login/">Home <span class="sr-only">(current)</span></a>
      </li>';
      

      if($login){
        echo '<li class="nav-item active">
          <a class="nav-link" href="/PHP_Login/account.php">account <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/PHP_Login/logout.php">Logout <span class="sr-only">(current)</span></a>
        </li>';
     }


      if(!$login){
      echo '<li class="nav-item active">
        <a class="nav-link" href="/PHP_Login/login.php">login <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/PHP_Login/register.php">Register <span class="sr-only">(current)</span></a>
      </li>';
      }

     echo '</ul>
  </div>
</nav>';
       
?>