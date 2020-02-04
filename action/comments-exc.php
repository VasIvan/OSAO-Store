<?php
if (isset($_POST["comment-submit"])){

    require "dbconn.php";

    $uname=$_POST["uname"];
    $cmt=$_POST["cmt"];

    if(empty($uname) || empty($cmt)){
        header("Location: ../comments.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "INSERT INTO comments (username, comment)
                VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../comments.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $uname, $cmt);
            mysqli_stmt_execute($stmt);
            header("Location: ../comments.php?comment=success");
            exit();
                }
            }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("Location: ../comments.php");
    exit();
}