<?php
if (isset($_POST["reg-submit"])){

    require "dbconn.php";

    $email=$_POST["email"];
    $uname=$_POST["uname"];
    $uaddress=$_POST["uaddress"];
    $uphone=$_POST["uphone"];
    $pwd=$_POST["pwd"];
    $pwdRpt=$_POST["pwd-repeat"];

    if(empty($email) || empty($uname) || empty($uaddress) || empty($uphone) || empty($pwd) || empty($pwdRpt)){
        header("Location: ../registr.php?error=emptyfields&email=".$email."&uname=".$uname);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$uname)){
        header("Location: ../registr.php?error=invalidemailuname");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registr.php?error=invalidemail&uname=".$uname);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/",$uname)){
        header("Location: ../registr.php?error=invaliduname&email=".$email);
        exit();
    }
    elseif ($pwd !== $pwdRpt){
        header("Location: ../registr.php?error=passwordcheck&email=".$email."&uname=".$uname);
        exit();
    }
    else {
        $sql = "SELECT username FROM registration WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../registr.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $uname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../registr.php?error=usertaken&email=".$email);
                exit();
            }
            else{
                $sql = "INSERT INTO registration (email, username, pwd, regAddress, regPhone) VALUES (?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../registr.php?error=sqlerror");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $email, $uname, $hashedPwd, $uaddress, $uphone);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../registr.php?registration=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("Location: ../registr.php");
    exit();
}