<?php

if (isset($_POST["editUser"])){


require "dbconn.php";

$id = $_POST["userId"];
$uname = $_POST["uname"];
$email = $_POST["email"];

if(empty($email) || empty($uname) || empty($id)){
    header("Location: ../users.php?error=emptyfields");
    exit();
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$uname)){
    header("Location: ../users.php?error=invalidemailuname");
    exit();
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../users.php?error=invalidemail");
    exit();
}
elseif (!preg_match("/^[a-zA-Z0-9]*$/",$uname)){
    header("Location: ../users.php?error=invaliduname");
    exit();
}
else {
    $sql = "SELECT username FROM registration WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../users.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
            header("Location: ../users.php?error=usertaken");
            exit();
        }
        else{
            $sql = "UPDATE registration SET email=?, username=? WHERE id=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../users.php?error=sqlerror");
                exit();
            }
            else{
                

                mysqli_stmt_bind_param($stmt, "sss", $email, $uname, $id);
                mysqli_stmt_execute($stmt);
                header("Location: ../users.php?edit=success");
                exit();
            }
        }
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else{
    header("Location: ../users.php");
    exit();
}
