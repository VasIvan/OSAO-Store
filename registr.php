<?php require "header.php"; ?>


<section id="container-responsive-reg" class="container container-responsive p-3 mb-5">
<h3 class="mb-3">Registration Form</h3>

<?php

if(isset($_GET["error"])){
  if($_GET["error"] == "emptyfields"){
    echo '<div class="alert alert-danger" role="alert">
            All the fields are required!
          </div>';
  }
  elseif($_GET["error"] == "invalidemailuname"){
    echo '<div class="alert alert-danger" role="alert">
            Invalid email and username!
          </div>';
  }
  elseif($_GET["error"] == "invalidemail"){
    echo '<div class="alert alert-danger" role="alert">
            Invalid email!
          </div>';
  }
  elseif($_GET["error"] == "invaliduname"){
    echo '<div class="alert alert-danger" role="alert">
            Invalid username, you can use only a-z, A-Z and 0-9 symbols!
          </div>';
  }
  elseif($_GET["error"] == "passwordcheck"){
    echo '<div class="alert alert-danger" role="alert">
            Your passwords do not match!
          </div>';
  }
  elseif($_GET["error"] == "usertaken"){
    echo '<div class="alert alert-danger" role="alert">
            This username already exists!
          </div>';
  }
  elseif($_GET["error"] == "notregistered"){
    echo '<div class="alert alert-danger" role="alert">
            You are not registered in our website, Please make a registration!
          </div>';
  }

}
elseif(isset($_GET["registration"])){
if($_GET["registration"] == "success"){
  echo '<div class="alert alert-success" role="alert">
          Registration successful!
        </div>';
}
}


?>

<form action="action/registr-exc.php" method="post" id="form-reg">
<div class="row">
  <div class="col-12 col-lg-6">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input name="uname" type="text" class="form-control" id="username">
  </div>
  <div class="form-group">
    <label for="uaddress">Home address</label>
    <input name="uaddress" type="text" class="form-control" id="uaddress">
  </div>
  </div>

  <div class="col-12 col-lg-6">
  <div class="form-group">
    <label for="uphone">Phone number</label>
    <input name="uphone" type="text" class="form-control" id="uphone">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="pwd" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Repeat Password</label>
    <input name="pwd-repeat" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button name="reg-submit" type="submit" class="btn btn-info">Register</button>
  </div>

</div>
</form>
</section>

<?php require "footer.php"; ?>