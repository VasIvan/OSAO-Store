<?php require "header.php"; ?>

<main>

<?php

if(isset($_SESSION["idUser"])){
    if( $_SESSION["idUser"] == $_SESSION["adminNumber"]){

require "action/dbconn.php";

$sql = "SELECT id, regDate, email, username FROM registration;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL statement failed!";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo '    <section id="table-users" class="container table-margin-100">';
    
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
      elseif(isset($_GET["edit"])){
        if($_GET["edit"] == "success"){
          echo '<div class="alert alert-success mt-3" role="alert">
                  User edit successful!
                </div>';
        }
        }

    echo '<table class="table table-striped table-responsive table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>';

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rowUser = $row["username"];
            $rowEmail = $row["email"];
            $rowId = $row["id"];
            $rowDate = $row["regDate"];


            echo ' <form action="action/editUser-exc.php" method="post">
            <tr id="delete'.$rowId.'">
            <th scope="row">'. $rowId .'</th>
            <td>'. $rowDate .'</td>
            <td><input name="email" type="email" class="form-control w-auto" value="'. $rowEmail .'"></td>
            <td><input name="uname" type="text" class="form-control w-auto" value="'. $rowUser .'"><input name="userId" type="hidden" class="form-control" value="'. $rowId .'"></td>
            <td><button onclick="deleteAjax(' . $rowId . ')" class="btn btn-danger w-auto"><i class="material-icons">delete</i> DELETE</button></td>
            <td><button name="editUser" type="submit" class="btn btn-primary w-auto"><i class="material-icons">edit</i> EDIT</button></td>
          </tr> </form>';
        
        }
    } else {
        echo '<section class="container container-responsive p-3 mb-5"><h1> 0 results </h1></section>';
    }

    echo '</tbody>
    </table></section>';
        }

    } else{
        echo '<section class="container container-responsive p-3 mb-5"><h1>You are not Admin! <a class="btn btn-info" href="index.php">Back</a></h1></section>';
    }

} else{
    echo '<section class="container container-responsive p-3 mb-5"><h1>Please, <a class="btn btn-info" href="index.php">log in</a>!</h1></section>';
}

?>

</main>

<script type="text/javascript">

function deleteAjax(id){
    if(confirm("Are you sure?")){
        $.ajax({
            type: 'post',
            url: 'action/deleteUser-exc.php',
            data:{
                delete_id:id,    
            },
            success:function(data){
                $("#delete"+id).hide();
            }

        });
    }
}

</script>

<?php require "footer.php"; ?>