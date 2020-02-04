<?php require "header.php"; ?>

<main>

<?php

if(isset($_SESSION["idUser"])){
    if( $_SESSION["idUser"] != $_SESSION["adminNumber"]){

require "action/dbconn.php";

$username = $_SESSION["nameUser"];
$sql = "SELECT id, regDate, email, username, regAddress, regPhone FROM registration WHERE username=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL statement failed!";
} else {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo '<section id="container-responsive-edit" class="container container-responsive p-3 mb-5">';

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rowUser = $row["username"];
            $rowEmail = $row["email"];
            $rowId = $row["id"];
            $rowDate = $row["regDate"];
            $rowAddress = $row["regAddress"];
            $rowPhone = $row["regPhone"];
?>

<form action="action/editUser-profile-exc.php" method="post">
  <div class="form-group">
    <label class="font-weight-bold">Registration date:</label>
    <input type="text" class="form-control-plaintext" value="<?php echo $rowDate ;?>" readonly>
  </div>

  <div class="form-group">
    <label class="font-weight-bold">Email address:</label>
    <input name="email" type="email" class="form-control" value="<?php echo $rowEmail ;?>">
  </div>

  <div class="form-group">
    <label class="font-weight-bold">Username:</label>
    <input name="uname" type="text" class="form-control" value="<?php echo $rowUser ;?>"><input name="userId" type="hidden" class="form-control" value="<?php echo $rowId ;?>">
  </div>

  <div class="form-group">
    <label class="font-weight-bold">Home address:</label>
    <input name="address" type="text" class="form-control" value="<?php echo $rowAddress ;?>">
  </div>

  <div class="form-group">
    <label class="font-weight-bold">Phone number:</label>
    <input name="phone" type="text" class="form-control" value="<?php echo $rowPhone ;?>">
  </div>

  <button name="editUser-profile" type="submit" class="btn btn-primary"><i class="material-icons">edit</i> EDIT</button>
 
</form>


<?php
        }
    } else {
        echo '<section class="container container-responsive p-3 mb-5"><h1> 0 results!</h1></section>';
    }


    if(isset($_GET["error"])){
      if($_GET["error"] == "emptyfields"){
        echo '<div class="alert alert-danger mt-3" role="alert">
                All the fields are required!
              </div>';
      }
      elseif($_GET["error"] == "invalidemailuname"){
        echo '<div class="alert alert-danger mt-3" role="alert">
                Invalid email and username!
              </div>';
      }
      elseif($_GET["error"] == "invalidemail"){
        echo '<div class="alert alert-danger mt-3" role="alert">
                Invalid email!
              </div>';
      }
      elseif($_GET["error"] == "invaliduname"){
        echo '<div class="alert alert-danger mt-3" role="alert">
                Invalid username, you can use only a-z, A-Z and 0-9 symbols!
              </div>';
      }
      elseif($_GET["error"] == "sqlerror"){
        echo '<div class="alert alert-danger mt-3" role="alert">
                SQL error!
              </div>';
      }
      elseif($_GET["error"] == "usertaken"){
        echo '<div class="alert alert-danger mt-3" role="alert">
                This username already exists!
              </div>';
      }
    
    }


    echo '</section>';
        }

    } else{
        echo '<section class="container container-responsive p-3 mb-5"><h1>You are Admin! <a class="btn btn-info" href="users.php"><i class="material-icons">settings</i> Users</a></h1></section>';
    }

} else{
    echo '<section class="container container-responsive p-3 mb-5"><h1>Please, <a class="btn btn-info" href="index.php">log in</a>!</h1></section>';
}

?>

</main>



<?php require "footer.php"; ?>




