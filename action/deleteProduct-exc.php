<?php

require "dbconn.php";

$id = $_POST["delete_id"];
$sql = "DELETE FROM gallery WHERE idGallery='$id';";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL statement failed!";
} else {
    mysqli_stmt_execute($stmt);
}