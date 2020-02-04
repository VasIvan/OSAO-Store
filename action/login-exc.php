<?php

if(isset($_POST["login-submit"])){

    require "dbconn.php";

    $email=$_POST["email"];
    $pwd=$_POST["pwd"];

    if(empty($email) || empty($pwd)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        $sql= "SELECT * FROM registration WHERE email=? OR username=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $email, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($pwd, $row["pwd"]);
                if($pwdCheck == true){
                    session_start();
                    $_SESSION["idUser"]= $row["id"];
                    $_SESSION["date"]= $row["date"];
                    $_SESSION["emailUser"]= $row["email"];
                    $_SESSION["nameUser"]= $row["username"];
                    $_SESSION["addressUser"]= $row["regAddress"];
                    $_SESSION["phoneUser"]= $row["regPhone"];
                    $_SESSION["adminNumber"]= 3;
                    
                    header("Location: ../index.php?login=success");
                    exit(); 

                }
                else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit(); 
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }

        }
    }

}
else{
    header("Location: ../index.php");
    exit();
}