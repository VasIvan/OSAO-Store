<?php

if(isset($_POST["reset-pwd-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwd-repeat"];

    if(empty($pwd) || empty($pwdRepeat)){
        header("Location: ../create-new-password.php?newpwd=empty&selector=$selector&validator=$validator");
        exit();
    }
    else if($pwd != $pwdRepeat){
        header("Location: ../create-new-password.php?newpwd=pwdnotsame&selector=$selector&validator=$validator");
        exit();
    }

    $currentDate = date("U");

    require "dbconn.php";

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error!";
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $results = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($results)){
            echo "You need to re-submit your reset request!";
            exit();
        }
        else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false){
                echo "You need to re-submit your reset request!";
                exit();
            }
            elseif($tokenCheck === true){
                $tokenEmail = $row["pwdResetEmail"];
                $sql = "SELECT * FROM registration WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "There was an error!";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $results = mysqli_stmt_get_result($stmt);
                        if(!$row = mysqli_fetch_assoc($results)){
                            header("Location:  ../registr.php?error=notregistered");
                            exit();
                            }
                            else {
                                $sql = "UPDATE registration SET pwd=? WHERE email=?";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    echo "There was an error!";
                                    exit();
                                }
                                else{
                                    $newPwdHash = password_hash($pwd, PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                                    mysqli_stmt_execute($stmt);

                                    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                                    $stmt = mysqli_stmt_init($conn);
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                                        echo "There was an error!";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                        mysqli_stmt_execute($stmt);
                                        header("Location: ../index.php?newpwd=passwordupdated");
                                    }

                                }
                    }
                }
            }
        }
    }

}
else{
    header("Location: ../index.php");
}